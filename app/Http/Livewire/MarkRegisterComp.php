<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Myclass;
use App\Models\Studentcr;
use App\Models\Exam10MarksEntry;
use App\Models\Exam01Name;
use App\Models\Exam02Type;
use App\Models\Exam03Part;
use App\Models\Exam05Detail;
use App\Models\Exam06ClassSubject;
use Illuminate\Support\Facades\Log;

class MarkRegisterComp extends Component
{
    public $selectedClassId = null;
    public $classes;
    public $students = [];
    public $examNames = [];
    public $subjectsData = [];
    public $marksData = [];

    public function mount()
    {
        $this->classes = Myclass::where('is_active', true)->orderBy('id')->get();
    }

    public function selectClass($classId)
    {
        try {
            $this->selectedClassId = $classId;
            $this->loadClassData();
        } catch (\Exception $e) {
            Log::error('Error selecting class: ' . $e->getMessage());
            session()->flash('error', 'Error loading class data: ' . $e->getMessage());
        }
    }

    protected function loadClassData()
    {
        if (!$this->selectedClassId) {
            return;
        }

        try {
            $this->loadStudents();
            $this->loadExamNames();
            $this->loadSubjects();
            $this->loadMarksData();
        } catch (\Exception $e) {
            Log::error('Error loading class data: ' . $e->getMessage());
            session()->flash('error', 'Error loading class data: ' . $e->getMessage());
        }
    }

    protected function loadStudents()
    {
        $this->students = Studentcr::where('myclass_id', $this->selectedClassId)
            ->orderBy('roll_no')
            ->get()
            ->map(fn($student) => [
                'id' => $student->id,
                'name' => $student->name,
                'roll_number' => $student->roll_no,
                'admission_number' => $student->id
            ])
            ->toArray();
    }

    protected function loadExamNames()
    {
        // Get exam names that have active configurations for this class
        $this->examNames = Exam05Detail::where('myclass_id', $this->selectedClassId)
            ->where('is_active', true)
            ->with('examName')
            ->get()
            ->groupBy('exam_name_id')
            ->map(fn($details, $examNameId) => [
                'id' => $examNameId,
                'name' => $details->first()->examName->name
            ])
            ->values()
            ->toArray();
    }

    protected function loadSubjects()
    {
        // Get subjects configured for this class with their exam configurations
        $configuredSubjects = Exam06ClassSubject::where('myclass_id', $this->selectedClassId)
            ->with(['subject', 'examDetail.examType', 'examDetail.examPart'])
            ->get()
            ->groupBy('subject_id');

        $subjects = [];

        foreach ($configuredSubjects as $subjectId => $configs) {
            $firstConfig = $configs->first();

            // Group by exam type (Summative first, then Formative)
            $examTypeGroups = [];

            foreach ($configs as $config) {
                if ($config->examDetail && $config->examDetail->examType) {
                    $examTypeId = $config->examDetail->examType->id;
                    $examTypeName = $config->examDetail->examType->name;

                    if (!isset($examTypeGroups[$examTypeId])) {
                        $examTypeGroups[$examTypeId] = [
                            'id' => $examTypeId,
                            'name' => $examTypeName,
                            'parts' => []
                        ];
                    }

                    $examPartId = $config->examDetail->examPart->id;
                    $examTypeGroups[$examTypeId]['parts'][$examPartId] = [
                        'id' => $examPartId,
                        'name' => $config->examDetail->examPart->name,
                        'full_marks' => $config->full_marks,
                        'pass_marks' => $config->pass_marks,
                        'exam_detail_id' => $config->examDetail->id
                    ];
                }
            }

            // Sort exam types: Summative first, then Formative
            uasort($examTypeGroups, function ($a, $b) {
                if (strtolower($a['name']) === 'summative') return -1;
                if (strtolower($b['name']) === 'summative') return 1;
                if (strtolower($a['name']) === 'formative') return -1;
                if (strtolower($b['name']) === 'formative') return 1;
                return strcmp($a['name'], $b['name']);
            });

            $subjects[$subjectId] = [
                'id' => $subjectId,
                'name' => $firstConfig->subject->name ?? 'Unknown Subject',
                'exam_types' => $examTypeGroups
            ];
        }

        $this->subjectsData = $subjects;
    }

    protected function loadMarksData()
    {
        if (empty($this->students) || empty($this->subjectsData)) {
            return;
        }

        $studentIds = array_column($this->students, 'id');
        $subjectIds = array_keys($this->subjectsData);

        // Get all marks for these students and subjects
        $marks = Exam10MarksEntry::whereIn('student_id', $studentIds)
            ->whereIn('subject_id', $subjectIds)
            ->with(['examDetail'])
            ->get();

        $marksArray = [];

        foreach ($marks as $mark) {
            if ($mark->examDetail) {
                $studentId = $mark->student_id;
                $subjectId = $mark->subject_id;
                $examNameId = $mark->examDetail->exam_name_id;
                $examTypeId = $mark->examDetail->exam_type_id;
                $examPartId = $mark->examDetail->exam_part_id;

                $marksArray[$studentId][$subjectId][$examNameId][$examTypeId][$examPartId] = [
                    'marks' => $mark->marks,
                    'is_absent' => $mark->is_absent
                ];
            }
        }

        $this->marksData = $marksArray;
    }

    public function getStudentMark($studentId, $subjectId, $examNameId, $examTypeId, $examPartId)
    {
        if (isset($this->marksData[$studentId][$subjectId][$examNameId][$examTypeId][$examPartId])) {
            $markData = $this->marksData[$studentId][$subjectId][$examNameId][$examTypeId][$examPartId];

            if ($markData['marks'] < 0 || $markData['is_absent']) {
                return 'AB';
            }

            return $markData['marks'];
        }

        return '-';
    }

    public function getMarkClass($studentId, $subjectId, $examNameId, $examTypeId, $examPartId)
    {
        if (isset($this->marksData[$studentId][$subjectId][$examNameId][$examTypeId][$examPartId])) {
            $markData = $this->marksData[$studentId][$subjectId][$examNameId][$examTypeId][$examPartId];

            if ($markData['marks'] < 0 || $markData['is_absent']) {
                return 'text-red-600 font-semibold';
            }

            // Get pass marks for this combination
            $passMarks = $this->subjectsData[$subjectId]['exam_types'][$examTypeId]['parts'][$examPartId]['pass_marks'] ?? 0;

            if ($markData['marks'] >= $passMarks) {
                return 'text-green-600';
            } else {
                return 'text-red-500';
            }
        }

        return 'text-gray-400';
    }

    public function getTotalMarks($studentId, $subjectId)
    {
        $total = 0;
        $hasMarks = false;

        foreach ($this->examNames as $examName) {
            $examNameId = $examName['id'];
            if (isset($this->subjectsData[$subjectId]['exam_types'])) {
                foreach ($this->subjectsData[$subjectId]['exam_types'] as $examTypeId => $examType) {
                    foreach ($examType['parts'] as $examPartId => $examPart) {
                        if (isset($this->marksData[$studentId][$subjectId][$examNameId][$examTypeId][$examPartId])) {
                            $markData = $this->marksData[$studentId][$subjectId][$examNameId][$examTypeId][$examPartId];
                            if ($markData['marks'] >= 0 && !$markData['is_absent']) {
                                $total += $markData['marks'];
                                $hasMarks = true;
                            }
                        }
                    }
                }
            }
        }

        return $hasMarks ? $total : '-';
    }

    public function getGrade($studentId, $subjectId)
    {
        $totalMarks = $this->getTotalMarks($studentId, $subjectId);

        if ($totalMarks === '-') {
            return '-';
        }

        // Calculate total full marks for the subject
        $totalFullMarks = 0;
        foreach ($this->examNames as $examName) {
            $examNameId = $examName['id'];
            if (isset($this->subjectsData[$subjectId]['exam_types'])) {
                foreach ($this->subjectsData[$subjectId]['exam_types'] as $examTypeId => $examType) {
                    foreach ($examType['parts'] as $examPartId => $examPart) {
                        if (isset($this->marksData[$studentId][$subjectId][$examNameId][$examTypeId][$examPartId])) {
                            $totalFullMarks += $examPart['full_marks'];
                        }
                    }
                }
            }
        }

        if ($totalFullMarks == 0) {
            return '-';
        }

        $percentage = ($totalMarks / $totalFullMarks) * 100;

        // Grade calculation
        if ($percentage >= 90) return 'A+';
        if ($percentage >= 80) return 'A';
        if ($percentage >= 70) return 'B+';
        if ($percentage >= 60) return 'B';
        if ($percentage >= 50) return 'C+';
        if ($percentage >= 40) return 'C';
        if ($percentage >= 30) return 'D';
        return 'F';
    }

    public function exportData()
    {
        session()->flash('message', 'Export functionality will be implemented soon.');
    }

    public function refreshData()
    {
        try {
            if ($this->selectedClassId) {
                $this->loadClassData();
                session()->flash('message', 'Data refreshed successfully!');
            }
        } catch (\Exception $e) {
            Log::error('Error refreshing data: ' . $e->getMessage());
            session()->flash('error', 'Error refreshing data: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.mark-register-comp');
    }
}
