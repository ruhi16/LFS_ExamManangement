<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Myclass;
use App\Models\Exam01Name;
use App\Models\Exam02Type;
use App\Models\Exam03Part;
use App\Models\Exam04Mode;
use App\Models\Exam05Detail;

class ExamSettings extends Component
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
    public $finalizedExamNames = [];

    public function mount()
    {
        $this->classes = Myclass::all();
        $this->examNames = Exam01Name::orderBy('name')->get();
        $this->examTypes = Exam02Type::orderBy('name')->get();
        $this->examParts = Exam03Part::orderBy('name')->get();
        $this->examModes = Exam04Mode::orderBy('name')->get();
    }

    public function selectClass($classId)
    {
        $this->selectedClassId = $classId;
        $this->loadConfigurationsForClass($classId);
    }

    public function loadConfigurationsForClass($classId = null)
    {
        if (!$classId) return;

        $this->selectedExamNames[$classId] = [];
        $this->selectedExamTypes[$classId] = [];
        $this->selectedExamParts[$classId] = [];
        $this->selectedExamModes[$classId] = [];

        $configurations = Exam05Detail::where('myclass_id', $classId)->get();
        foreach ($configurations as $config) {
            if ($config->exam_name_id) {
                $this->selectedExamNames[$classId][$config->exam_name_id] = true;
            }
            if ($config->exam_type_id) {
                $this->selectedExamTypes[$classId][$config->exam_name_id][$config->exam_type_id] = true;
            }
            if ($config->exam_part_id) {
                $this->selectedExamParts[$classId][$config->exam_name_id][$config->exam_type_id][$config->exam_part_id] = true;
            }
            if ($config->exam_mode_id) {
                if (!isset($this->selectedExamModes[$classId][$config->exam_name_id][$config->exam_type_id][$config->exam_part_id])) {
                    $this->selectedExamModes[$classId][$config->exam_name_id][$config->exam_type_id][$config->exam_part_id] = [];
                }
                $examModes = Exam04Mode::all();
                foreach ($examModes as $mode) {
                    $this->selectedExamModes[$classId][$config->exam_name_id][$config->exam_type_id][$config->exam_part_id][$mode->id] = false;
                }
                $this->selectedExamModes[$classId][$config->exam_name_id][$config->exam_type_id][$config->exam_part_id][$config->exam_mode_id] = true;
            }
        }

        $this->finalizedExamNames[$classId] = Exam05Detail::where('myclass_id', $classId)
            ->where('is_finalized', true)
            ->pluck('exam_name_id')
            ->unique()
            ->all();
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
                            $configurations[$key] = [
                                'exam_name_id' => $examNameId,
                                'exam_type_id' => $examTypeId,
                                'exam_part_id' => $examPartId,
                                'exam_mode_id' => $examModeId,
                            ];
                        }
                    }
                }
            }
        }

        Exam05Detail::where('myclass_id', $classId)->where('exam_name_id', $examNameId)->delete();

        foreach ($configurations as $config) {
            Exam05Detail::updateOrCreate(
                [
                    'myclass_id' => $classId,
                    'exam_name_id' => $config['exam_name_id'],
                    'exam_type_id' => $config['exam_type_id'],
                    'exam_part_id' => $config['exam_part_id'],
                    'exam_mode_id' => $config['exam_mode_id'],
                ],
                [
                    'name' => $examName->name ?? 'Exam Config',
                    'description' => 'Exam Configuration updated',
                    'is_active' => true,
                    'user_id' => auth()->id(),
                ]
            );
        }

        session()->flash('message', 'Configuration saved successfully!');
        $this->loadConfigurationsForClass($classId);
    }

    public function selectExamMode($classId, $examNameId, $examTypeId, $examPartId, $examModeId)
    {
        if (!isset($this->selectedExamModes[$classId][$examNameId][$examTypeId][$examPartId])) {
            $this->selectedExamModes[$classId][$examNameId][$examTypeId][$examPartId] = [];
        }
        $this->selectedExamModes[$classId][$examNameId][$examTypeId][$examPartId] = [$examModeId => true];
    }

    public function isSaveDisabled($classId, $examNameId)
    {
        if (empty($this->selectedExamNames[$classId][$examNameId])) return true;

        if (isset($this->selectedExamParts[$classId][$examNameId])) {
            foreach ($this->selectedExamParts[$classId][$examNameId] as $examTypeId => $parts) {
                if (!empty($this->selectedExamTypes[$classId][$examNameId][$examTypeId])) {
                    foreach ($parts as $examPartId => $partSelected) {
                        if ($partSelected) {
                            if (empty($this->selectedExamModes[$classId][$examNameId][$examTypeId][$examPartId])) return true;
                            $selectedModes = array_filter($this->selectedExamModes[$classId][$examNameId][$examTypeId][$examPartId]);
                            if (count($selectedModes) === 0) return true;
                        }
                    }
                }
            }
        }
        return false;
    }

    public function isFinalized($classId, $examNameId)
    {
        return in_array($examNameId, $this->finalizedExamNames[$classId] ?? []);
    }

    public function finalizeConfiguration($classId, $examNameId)
    {
        Exam05Detail::where('myclass_id', $classId)
            ->where('exam_name_id', $examNameId)
            ->update(['is_finalized' => true]);

        $this->loadConfigurationsForClass($classId);
        session()->flash('message', 'Configuration finalized successfully!');
    }

    public function render()
    {
        return view('livewire.exam-settings');
    }
}