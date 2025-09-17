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

        // Get exam class subject IDs for the selected class
        $examClassSubjectIds = Exam06ClassSubject::where('myclass_id', $this->selectedClassId)
            ->pluck('id')
            ->toArray();

        // Get all marks for these students and exam class subjects
        $marks = Exam10MarksEntry::whereIn('studentcr_id', $studentIds)
            ->whereIn('exam_class_subject_id', $examClassSubjectIds)
            ->with(['examDetail', 'examClassSubject.subject'])
            ->where('is_active', true)
            ->get();

        $marksArray = [];

        foreach ($marks as $mark) {
            if ($mark->examDetail && $mark->examClassSubject) {
                $studentId = $mark->studentcr_id;
                $subjectId = $mark->examClassSubject->subject_id;
                $examNameId = $mark->examDetail->exam_name_id;
                $examTypeId = $mark->examDetail->exam_type_id;
                $examPartId = $mark->examDetail->exam_part_id;

                $marksArray[$studentId][$subjectId][$examNameId][$examTypeId][$examPartId] = [
                    'marks' => $mark->exam_marks, // Corrected field name
                    'is_absent' => $mark->isAbsent(),
                    'status' => $mark->status
                ];
            }
        }

        $this->marksData = $marksArray;
    }

    public function getStudentMark($studentId, $subjectId, $examNameId, $examTypeId, $examPartId)
    {
        if (isset($this->marksData[$studentId][$subjectId][$examNameId][$examTypeId][$examPartId])) {
            $markData = $this->marksData[$studentId][$subjectId][$examNameId][$examTypeId][$examPartId];

            if ($markData['is_absent'] || $markData['marks'] < 0) {
                return 'AB';
            }

            return number_format($markData['marks'], 1);
        }

        return '-';
    }

    public function getMarkClass($studentId, $subjectId, $examNameId, $examTypeId, $examPartId)
    {
        if (isset($this->marksData[$studentId][$subjectId][$examNameId][$examTypeId][$examPartId])) {
            $markData = $this->marksData[$studentId][$subjectId][$examNameId][$examTypeId][$examPartId];

            if ($markData['is_absent'] || $markData['marks'] < 0) {
                return 'text-red-600 font-bold bg-red-50';
            }

            // Get pass marks for this combination
            $passMarks = $this->subjectsData[$subjectId]['exam_types'][$examTypeId]['parts'][$examPartId]['pass_marks'] ?? 0;

            if ($markData['marks'] >= $passMarks) {
                return 'text-green-700 font-medium bg-green-50';
            } else {
                return 'text-red-600 font-medium bg-red-50';
            }
        }

        return 'text-gray-400 bg-gray-50';
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

    public function debugData()
    {
        try {
            $debugInfo = [
                'selected_class_id' => $this->selectedClassId,
                'students_count' => count($this->students),
                'subjects_count' => count($this->subjectsData),
                'exam_names_count' => count($this->examNames),
                'marks_data_keys' => array_keys($this->marksData),
                'first_student_marks' => !empty($this->marksData) ? array_keys($this->marksData)[0] ?? 'none' : 'none'
            ];

            Log::info('MarkRegister Debug Info:', $debugInfo);
            session()->flash('message', 'Debug info logged. Students: ' . count($this->students) . ', Subjects: ' . count($this->subjectsData) . ', Exams: ' . count($this->examNames));
        } catch (\Exception $e) {
            Log::error('Debug error: ' . $e->getMessage());
            session()->flash('error', 'Debug error: ' . $e->getMessage());
        }
    }

    public function testConnection()
    {
        try {
            $counts = [
                'classes' => Myclass::count(),
                'students' => Studentcr::count(),
                'marks_entries' => Exam10MarksEntry::count(),
                'exam_details' => Exam05Detail::count(),
                'class_subjects' => Exam06ClassSubject::count()
            ];

            session()->flash('message', 'DB Test: Classes=' . $counts['classes'] . ', Students=' . $counts['students'] . ', Marks=' . $counts['marks_entries']);
        } catch (\Exception $e) {
            session()->flash('error', 'DB connection failed: ' . $e->getMessage());
        }
    }

    public function isSummativeType($examTypeName)
    {
        return strtolower($examTypeName) === 'summative';
    }

    public function isFormativeType($examTypeName)
    {
        return strtolower($examTypeName) === 'formative';
    }

    public function getSummativeTotal($studentId, $subjectId)
    {
        $total = 0;
        $hasMarks = false;

        foreach ($this->examNames as $examName) {
            $examNameId = $examName['id'];
            if (isset($this->subjectsData[$subjectId]['exam_types'])) {
                foreach ($this->subjectsData[$subjectId]['exam_types'] as $examTypeId => $examType) {
                    // Only calculate for Summative types
                    if ($this->isSummativeType($examType['name'])) {
                        foreach ($examType['parts'] as $examPartId => $examPart) {
                            if (isset($this->marksData[$studentId][$subjectId][$examNameId][$examTypeId][$examPartId])) {
                                $markData = $this->marksData[$studentId][$subjectId][$examNameId][$examTypeId][$examPartId];
                                if (!$markData['is_absent'] && $markData['marks'] >= 0) {
                                    $total += $markData['marks'];
                                    $hasMarks = true;
                                }
                            }
                        }
                    }
                }
            }
        }

        return $hasMarks ? number_format($total, 1) : '-';
    }

    public function getFormativeTotal($studentId, $subjectId)
    {
        $total = 0;
        $hasMarks = false;

        foreach ($this->examNames as $examName) {
            $examNameId = $examName['id'];
            if (isset($this->subjectsData[$subjectId]['exam_types'])) {
                foreach ($this->subjectsData[$subjectId]['exam_types'] as $examTypeId => $examType) {
                    // Only calculate for Formative types
                    if ($this->isFormativeType($examType['name'])) {
                        foreach ($examType['parts'] as $examPartId => $examPart) {
                            if (isset($this->marksData[$studentId][$subjectId][$examNameId][$examTypeId][$examPartId])) {
                                $markData = $this->marksData[$studentId][$subjectId][$examNameId][$examTypeId][$examPartId];
                                if (!$markData['is_absent'] && $markData['marks'] >= 0) {
                                    $total += $markData['marks'];
                                    $hasMarks = true;
                                }
                            }
                        }
                    }
                }
            }
        }

        return $hasMarks ? number_format($total, 1) : '-';
    }

    public function getGrandTotal($studentId)
    {
        $grandTotal = 0;
        $hasMarks = false;

        foreach ($this->subjectsData as $subjectId => $subject) {
            $subjectTotal = $this->getTotalMarks($studentId, $subjectId);
            if ($subjectTotal !== '-') {
                $grandTotal += $subjectTotal;
                $hasMarks = true;
            }
        }

        return $hasMarks ? number_format($grandTotal, 1) : '-';
    }

    public function getOverallGrade($studentId)
    {
        $grandTotal = $this->getGrandTotal($studentId);

        if ($grandTotal === '-') {
            return '-';
        }

        // Calculate total possible marks across all subjects
        $totalPossibleMarks = 0;
        foreach ($this->subjectsData as $subjectId => $subject) {
            foreach ($this->examNames as $examName) {
                $examNameId = $examName['id'];
                foreach ($subject['exam_types'] as $examTypeId => $examType) {
                    foreach ($examType['parts'] as $examPartId => $examPart) {
                        if (isset($this->marksData[$studentId][$subjectId][$examNameId][$examTypeId][$examPartId])) {
                            $totalPossibleMarks += $examPart['full_marks'];
                        }
                    }
                }
            }
        }

        if ($totalPossibleMarks == 0) {
            return '-';
        }

        $percentage = ($grandTotal / $totalPossibleMarks) * 100;

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

    public function getStudentRank($studentId)
    {
        // Calculate ranks based on grand total
        $studentTotals = [];

        foreach ($this->students as $student) {
            $total = $this->getGrandTotal($student['id']);
            if ($total !== '-') {
                $studentTotals[$student['id']] = floatval($total);
            }
        }

        // Sort by total marks in descending order
        arsort($studentTotals);

        $rank = 1;
        $previousTotal = null;
        $actualRank = 1;

        foreach ($studentTotals as $sId => $total) {
            if ($previousTotal !== null && $total < $previousTotal) {
                $rank = $actualRank;
            }

            if ($sId == $studentId) {
                return $rank;
            }

            $previousTotal = $total;
            $actualRank++;
        }

        return '-';
    }

    public function getClassAverage($subjectId = null)
    {
        if ($subjectId) {
            // Subject-wise average
            $totals = [];
            foreach ($this->students as $student) {
                $total = $this->getTotalMarks($student['id'], $subjectId);
                if ($total !== '-') {
                    $totals[] = floatval($total);
                }
            }
        } else {
            // Overall class average
            $totals = [];
            foreach ($this->students as $student) {
                $total = $this->getGrandTotal($student['id']);
                if ($total !== '-') {
                    $totals[] = floatval($total);
                }
            }
        }

        if (empty($totals)) {
            return '-';
        }

        return number_format(array_sum($totals) / count($totals), 2);
    }

    public function getPassFailStatus($studentId, $subjectId = null)
    {
        if ($subjectId) {
            // Check pass/fail for specific subject
            $total = $this->getTotalMarks($studentId, $subjectId);
            if ($total === '-') {
                return 'N/A';
            }

            // Calculate total pass marks for the subject
            $totalPassMarks = 0;
            foreach ($this->examNames as $examName) {
                $examNameId = $examName['id'];
                if (isset($this->subjectsData[$subjectId]['exam_types'])) {
                    foreach ($this->subjectsData[$subjectId]['exam_types'] as $examTypeId => $examType) {
                        foreach ($examType['parts'] as $examPartId => $examPart) {
                            if (isset($this->marksData[$studentId][$subjectId][$examNameId][$examTypeId][$examPartId])) {
                                $totalPassMarks += $examPart['pass_marks'];
                            }
                        }
                    }
                }
            }

            return floatval($total) >= $totalPassMarks ? 'PASS' : 'FAIL';
        } else {
            // Check overall pass/fail status
            $failedSubjects = 0;
            foreach ($this->subjectsData as $sId => $subject) {
                if ($this->getPassFailStatus($studentId, $sId) === 'FAIL') {
                    $failedSubjects++;
                }
            }

            return $failedSubjects === 0 ? 'PASS' : 'FAIL';
        }
    }

    public function render()
    {
        return view('livewire.mark-register-comp');
    }
}
