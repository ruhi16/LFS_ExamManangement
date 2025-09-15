<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Myclass;
use App\Models\Exam01Name;
use App\Models\Exam02Type;
use App\Models\Exam05Detail;
use App\Models\Exam06ClassSubject;
use App\Models\Exam07AnsscrDist;
use App\Models\MyclassSection;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AnswerScriptDistributionComp2 extends Component
{
    public $selectedClassId = null;
    public $classes;
    public $examNames;
    public $subjects;
    public $teachers;
    public $distributions = []; // Key: subjectId_examNameId, Value: teacher_id

    public function mount()
    {
        $this->classes = Myclass::where('is_active', true)->orderBy('id')->get();
        $this->teachers = Teacher::where('is_active', true)->orderBy('name')->get();
        $this->examNames = collect();
        $this->subjects = collect();
    }

    public function selectClass($classId)
    {
        $this->selectedClassId = $classId;
        $this->loadDataForClass();
    }

    public function loadDataForClass()
    {
        if (!$this->selectedClassId) {
            $this->resetData();
            return;
        }

        // 1. Load active Exam Names for the selected class
        $this->examNames = Exam01Name::whereHas('examDetails', function ($query) {
            $query->where('myclass_id', $this->selectedClassId)->where('is_active', true);
        })->orderBy('id')->get();

        // 2. Load subjects grouped by exam type
        $this->loadSubjects();

        // 3. Load existing distributions
        $this->loadDistributions();
    }

    protected function resetData()
    {
        $this->examNames = collect();
        $this->subjects = collect();
        $this->distributions = [];
    }

    protected function loadSubjects()
    {
        // Get all subjects configured for any exam in this class
        $configuredSubjects = Exam06ClassSubject::with(['subject', 'examDetail.examType'])
            ->where('myclass_id', $this->selectedClassId)
            ->whereHas('subject') // Ensure subject exists
            ->whereHas('examDetail.examType') // Ensure exam type exists
            ->where('is_active', true)
            ->get();

        // A subject can be both summative and formative. We need a unique list of subjects.
        $uniqueSubjects = $configuredSubjects->unique('subject_id');

        // Add a 'display_type' property to each unique subject for grouping in the view.
        $this->subjects = $uniqueSubjects
            ->sortBy(function ($cs) {
                return optional($cs->subject)->name;
            })
            ->map(function ($cs) {
                $cs->display_type = optional($cs->examDetail->examType)->name ?? 'Uncategorized';
                return $cs;
            });
    }

    protected function loadDistributions()
    {
        $this->distributions = [];
        if (!$this->selectedClassId || $this->examNames->isEmpty()) return;

        $examDetailIds = Exam05Detail::where('myclass_id', $this->selectedClassId)
            ->whereIn('exam_name_id', $this->examNames->pluck('id'))
            ->pluck('id');

        $classSubjectIds = Exam06ClassSubject::where('myclass_id', $this->selectedClassId)
            ->whereIn('exam_detail_id', $examDetailIds)
            ->pluck('id');

        $rawDistributions = Exam07AnsscrDist::with('examClassSubject.examDetail')
            ->whereIn('exam_class_subject_id', $classSubjectIds)
            ->get();

        foreach ($rawDistributions as $dist) {
            if ($dist->examClassSubject && $dist->examClassSubject->examDetail) {
                $key = $dist->examClassSubject->subject_id . '_' . $dist->examClassSubject->examDetail->exam_name_id;
                // Since there can be multiple parts/sections, we just take the first teacher found for the UI.
                if (!isset($this->distributions[$key])) {
                    $this->distributions[$key] = $dist->teacher_id;
                }
            }
        }
    }

    public function updatedDistributions($teacherId, $key)
    {
        list($subjectId, $examNameId) = explode('_', $key);

        // This is a simplified UI. When a teacher is assigned, we create/update
        // distributions for ALL exam_details (type/part) and ALL sections for that subject/exam_name combo.

        try {
            DB::beginTransaction();

            // Find all exam_detail_ids for this class and exam_name
            $examDetailIds = Exam05Detail::where('myclass_id', $this->selectedClassId)
                ->where('exam_name_id', $examNameId)
                ->pluck('id');

            // Find all exam_class_subject records for this subject and the exam_details
            $examClassSubjects = Exam06ClassSubject::where('myclass_id', $this->selectedClassId)
                ->where('subject_id', $subjectId)
                ->whereIn('exam_detail_id', $examDetailIds)
                ->get();

            // Find all sections for this class
            $classSections = MyclassSection::where('myclass_id', $this->selectedClassId)->get();

            if ($examClassSubjects->isEmpty() || $classSections->isEmpty()) {
                session()->flash('error', 'Configuration incomplete (Subject/Section missing). Cannot assign teacher.');
                unset($this->distributions[$key]); // Reset dropdown
                DB::rollBack();
                return;
            }

            // First, delete all existing distributions for this subject/exam_name combo
            Exam07AnsscrDist::whereIn('exam_class_subject_id', $examClassSubjects->pluck('id'))->delete();

            if (!empty($teacherId)) {
                // Now, create new distributions for every combination
                foreach ($examClassSubjects as $ecs) {
                    foreach ($classSections as $section) {
                        Exam07AnsscrDist::create([
                            'name' => "dist_{$ecs->id}_{$section->id}",
                            'exam_detail_id' => $ecs->exam_detail_id,
                            'myclass_section_id' => $section->id,
                            'exam_class_subject_id' => $ecs->id,
                            'teacher_id' => $teacherId,
                            'user_id' => auth()->id(),
                            'is_active' => true,
                        ]);
                    }
                }
            }

            DB::commit();
            session()->flash('message', 'Teacher assignment updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error updating distribution for key {$key}: " . $e->getMessage());
            session()->flash('error', 'An error occurred while updating the assignment.');
            unset($this->distributions[$key]); // Reset dropdown
        }
    }

    public function render()
    {
        return view('livewire.answer-script-distribution-comp2');
    }
}
