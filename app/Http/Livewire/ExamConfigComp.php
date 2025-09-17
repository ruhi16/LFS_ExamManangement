<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Myclass;
use App\Models\Exam01Name;
use App\Models\Exam02Type;
use App\Models\Exam03Part;
use App\Models\Exam04Mode;
use App\Models\Exam05Detail;
use App\Models\Exam06ClassSubject;
use App\Models\MyclassSubject;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ExamConfigComp extends Component
{
    public $classes;
    public $selectedClassId = null;

    public $examNames = [];
    public $examTypes = [];
    public $examParts = [];
    public $examModes = [];

    // Configuration arrays
    public $selectedExamNames = [];
    public $selectedExamTypes = [];
    public $selectedExamParts = [];
    public $selectedExamModes = [];
    public $selectedSubjects = [];

    public function mount()
    {
        $this->classes = Myclass::where('is_active', true)->orderBy('id')->get();
        $this->examNames = Exam01Name::all();
        $this->examTypes = Exam02Type::all();
        $this->examParts = Exam03Part::all();
        $this->examModes = Exam04Mode::all();
    }

    public function selectClass($classId)
    {
        $this->selectedClassId = $classId;
        $this->loadConfigurations($classId);
    }

    protected function getClassSubjects($classId)
    {
        if (!$classId) {
            return collect();
        }

        return MyclassSubject::with(['subject.subjectType'])
            ->where('myclass_id', $classId)
            ->where('is_active', true)
            ->get()
            ->groupBy('subject.subjectType.name');
    }

    protected function loadConfigurations($classId = null)
    {
        if (!$classId) return;

        $this->selectedExamNames[$classId] = [];
        $this->selectedExamTypes[$classId] = [];
        $this->selectedExamParts[$classId] = [];
        $this->selectedExamModes[$classId] = [];
        $this->selectedSubjects[$classId] = [];

        $configurations = Exam05Detail::where('myclass_id', $classId)->get();

        foreach ($configurations as $config) {
            if ($config->exam_name_id) {
                $this->selectedExamNames[$classId][$config->exam_name_id] = true;
            }

            if ($config->exam_name_id && $config->exam_type_id) {
                $this->selectedExamTypes[$classId][$config->exam_name_id][$config->exam_type_id] = true;
            }

            if ($config->exam_name_id && $config->exam_type_id && $config->exam_part_id) {
                $this->selectedExamParts[$classId][$config->exam_name_id][$config->exam_type_id][$config->exam_part_id] = true;
            }

            if ($config->exam_name_id && $config->exam_type_id && $config->exam_part_id && $config->exam_mode_id) {
                if (!isset($this->selectedExamModes[$classId][$config->exam_name_id][$config->exam_type_id][$config->exam_part_id])) {
                    $this->selectedExamModes[$classId][$config->exam_name_id][$config->exam_type_id][$config->exam_part_id] = [];
                }
                foreach ($this->examModes as $mode) {
                    $this->selectedExamModes[$classId][$config->exam_name_id][$config->exam_type_id][$config->exam_part_id][$mode->id] = false;
                }
                $this->selectedExamModes[$classId][$config->exam_name_id][$config->exam_type_id][$config->exam_part_id][$config->exam_mode_id] = true;
            }
        }

        $classSubjectConfigs = Exam06ClassSubject::where('myclass_id', $classId)
            ->with('examDetail')
            ->get();

        foreach ($classSubjectConfigs as $csConfig) {
            if ($csConfig->examDetail && $csConfig->examDetail->myclass_id == $classId) {
                $detail = $csConfig->examDetail;
                $this->selectedSubjects[$classId][$detail->exam_name_id][$detail->exam_type_id][$detail->exam_part_id][$csConfig->subject_id] = true;
            }
        }
    }

    public function saveExamConfiguration($classId, $examNameId)
    {
        $examName = Exam01Name::find($examNameId);
        $configurations = [];

        if (isset($this->selectedExamModes[$classId][$examNameId])) {
            foreach ($this->selectedExamModes[$classId][$examNameId] as $examTypeId => $types) {
                foreach ($types as $examPartId => $parts) {
                    foreach ($parts as $examModeId => $selected) {
                        if ($selected) {
                            $key = "{$examNameId}-{$examTypeId}-{$examPartId}-{$examModeId}";
                            $configurations[$key] = ['exam_name_id' => $examNameId, 'exam_type_id' => $examTypeId, 'exam_part_id' => $examPartId, 'exam_mode_id' => $examModeId];
                        }
                    }
                }
            }
        }

        if (isset($this->selectedExamParts[$classId][$examNameId])) {
            foreach ($this->selectedExamParts[$classId][$examNameId] as $examTypeId => $parts) {
                foreach ($parts as $examPartId => $selected) {
                    if ($selected && !$this->hasExamModeForPart($classId, $examNameId, $examTypeId, $examPartId)) {
                        $key = "{$examNameId}-{$examTypeId}-{$examPartId}-null";
                        if (!isset($configurations[$key])) {
                            $configurations[$key] = ['exam_name_id' => $examNameId, 'exam_type_id' => $examTypeId, 'exam_part_id' => $examPartId, 'exam_mode_id' => null];
                        }
                    }
                }
            }
        }

        if (isset($this->selectedExamTypes[$classId][$examNameId])) {
            foreach ($this->selectedExamTypes[$classId][$examNameId] as $examTypeId => $selected) {
                if ($selected && !$this->hasExamPartForType($classId, $examNameId, $examTypeId)) {
                    $key = "{$examNameId}-{$examTypeId}-null-null";
                    if (!isset($configurations[$key])) {
                        $configurations[$key] = ['exam_name_id' => $examNameId, 'exam_type_id' => $examTypeId, 'exam_part_id' => null, 'exam_mode_id' => null];
                    }
                }
            }
        }

        if (isset($this->selectedExamNames[$classId][$examNameId]) && $this->selectedExamNames[$classId][$examNameId] && !$this->hasExamTypeForName($classId, $examNameId)) {
            $key = "{$examNameId}-null-null-null";
            if (!isset($configurations[$key])) {
                $configurations[$key] = ['exam_name_id' => $examNameId, 'exam_type_id' => null, 'exam_part_id' => null, 'exam_mode_id' => null];
            }
        }

        try {
            DB::transaction(function () use ($classId, $examNameId, $configurations, $examName) {
                $oldDetails = Exam05Detail::where('myclass_id', $classId)->where('exam_name_id', $examNameId)->get();
                if ($oldDetails->isNotEmpty()) {
                    $oldDetailIds = $oldDetails->pluck('id');
                    Exam06ClassSubject::whereIn('exam_detail_id', $oldDetailIds)->delete();
                    Exam05Detail::whereIn('id', $oldDetailIds)->delete();
                }

                foreach ($configurations as $config) {
                    $newDetail = Exam05Detail::create(
                        array_merge($config, [
                            'myclass_id' => $classId,
                            'name' => $examName->name ?? 'Exam Config',
                            'description' => 'Exam Configuration updated',
                            'is_active' => true,
                            'user_id' => auth()->id(),
                        ])
                    );

                    if (isset($this->selectedSubjects[$classId][$examNameId][$newDetail->exam_type_id][$newDetail->exam_part_id])) {
                        foreach ($this->selectedSubjects[$classId][$examNameId][$newDetail->exam_type_id][$newDetail->exam_part_id] as $subjectId => $selected) {
                            if ($selected) {
                                Exam06ClassSubject::create([
                                    'name' => 'Class Subject Config',
                                    'myclass_id' => $classId,
                                    'subject_id' => $subjectId,
                                    'exam_detail_id' => $newDetail->id,
                                    'is_active' => true,
                                    'user_id' => auth()->id(),
                                    'session_id' => session('current_session_id', 1),
                                ]);
                            }
                        }
                    }
                }
            });

            session()->flash('message', 'Configuration for ' . ($examName->name ?? '') . ' saved successfully!');
            Log::info("Successfully saved exam configuration for class: {$classId}, exam name: {$examNameId}");
        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred while saving the configuration. Please try again.');
            Log::error("Error saving exam configuration: " . $e->getMessage() . ' on line ' . $e->getLine());
        }
    }

    private function hasExamModeForPart($classId, $examNameId, $examTypeId, $examPartId)
    {
        return !empty($this->selectedExamModes[$classId][$examNameId][$examTypeId][$examPartId]) &&
            array_filter($this->selectedExamModes[$classId][$examNameId][$examTypeId][$examPartId]);
    }

    private function hasExamPartForType($classId, $examNameId, $examTypeId)
    {
        return !empty($this->selectedExamParts[$classId][$examNameId][$examTypeId]) &&
            array_filter($this->selectedExamParts[$classId][$examNameId][$examTypeId]);
    }

    private function hasExamTypeForName($classId, $examNameId)
    {
        return !empty($this->selectedExamTypes[$classId][$examNameId]) &&
            array_filter($this->selectedExamTypes[$classId][$examNameId]);
    }

    public function selectExamMode($classId, $examNameId, $examTypeId, $examPartId, $examModeId)
    {
        if (isset($this->selectedExamModes[$classId][$examNameId][$examTypeId][$examPartId])) {
            foreach ($this->selectedExamModes[$classId][$examNameId][$examTypeId][$examPartId] as $modeId => $selected) {
                $this->selectedExamModes[$classId][$examNameId][$examTypeId][$examPartId][$modeId] = false;
            }
        }
        $this->selectedExamModes[$classId][$examNameId][$examTypeId][$examPartId][$examModeId] = true;
    }

    public function render()
    {
        return view('livewire.exam-config-comp', [
            'subjectsGrouped' => $this->getClassSubjects($this->selectedClassId)
        ]);
    }
}