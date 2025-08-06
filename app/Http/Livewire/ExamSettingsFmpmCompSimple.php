<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Exam06ClassSubject;
use App\Models\Myclass;
use App\Models\MyclassSubject;
use App\Models\Exam01Name;
use App\Models\Exam02Type;
use App\Models\Exam03Part;
use App\Models\Exam05Detail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ExamSettingsFmpmCompSimple extends Component
{
    public $selectedClassId = null;
    public $fullMarks = [];
    public $passMarks = [];
    public $timeInMinutes = [];
    public $configIds = [];

    public function mount()
    {
        // Initialize empty arrays
        $this->fullMarks = [];
        $this->passMarks = [];
        $this->timeInMinutes = [];
        $this->configIds = [];
    }

    public function selectClass($classId)
    {
        $this->selectedClassId = $classId;
        $this->loadExamConfigurations($classId);
    }

    protected function loadExamConfigurations($classId)
    {
        try {
            // Reset arrays
            $this->fullMarks = [];
            $this->passMarks = [];
            $this->timeInMinutes = [];
            $this->configIds = [];

            // Get existing configurations
            $existingConfigs = Exam06ClassSubject::where('myclass_id', $classId)->get();

            foreach ($existingConfigs as $config) {
                $flatKey = "{$config->subject_id}_{$config->exam_name_id}_{$config->exam_type_id}_{$config->exam_part_id}";
                $this->fullMarks[$flatKey] = $config->full_marks;
                $this->passMarks[$flatKey] = $config->pass_marks;
                $this->timeInMinutes[$flatKey] = $config->time_in_minutes;
                $this->configIds[$flatKey] = $config->id;
            }
        } catch (\Exception $e) {
            Log::error('Error loading configurations: ' . $e->getMessage());
            session()->flash('error', 'Error loading configurations');
        }
    }

    public function saveConfiguration($subjectId, $examNameId, $examTypeId, $examPartId)
    {
        try {
            $flatKey = "{$subjectId}_{$examNameId}_{$examTypeId}_{$examPartId}";
            
            // Validation
            if (empty($this->fullMarks[$flatKey]) || empty($this->passMarks[$flatKey]) || empty($this->timeInMinutes[$flatKey])) {
                session()->flash('error', 'All fields are required.');
                return;
            }

            $fullMarks = (int)$this->fullMarks[$flatKey];
            $passMarks = (int)$this->passMarks[$flatKey];
            $timeInMinutes = (int)$this->timeInMinutes[$flatKey];

            if ($fullMarks <= 0 || $passMarks <= 0 || $timeInMinutes <= 0) {
                session()->flash('error', 'All values must be greater than 0.');
                return;
            }

            if ($passMarks >= $fullMarks) {
                session()->flash('error', 'Pass marks must be less than full marks.');
                return;
            }

            $configData = [
                'name' => 'Configuration',
                'myclass_id' => $this->selectedClassId,
                'subject_id' => $subjectId,
                'exam_name_id' => $examNameId,
                'exam_type_id' => $examTypeId,
                'exam_part_id' => $examPartId,
                'full_marks' => $fullMarks,
                'pass_marks' => $passMarks,
                'time_in_minutes' => $timeInMinutes,
                'is_active' => true,
                'user_id' => auth()->id() ?? 1,
                'session_id' => 1,
                'school_id' => 1,
            ];

            if (isset($this->configIds[$flatKey]) && $this->configIds[$flatKey]) {
                // Update existing
                $config = Exam06ClassSubject::findOrFail($this->configIds[$flatKey]);
                $config->update($configData);
                session()->flash('message', 'Configuration updated successfully!');
            } else {
                // Create new
                $newConfig = Exam06ClassSubject::create($configData);
                $this->configIds[$flatKey] = $newConfig->id;
                session()->flash('message', 'Configuration saved successfully!');
            }
        } catch (\Exception $e) {
            Log::error('Error saving configuration: ' . $e->getMessage());
            session()->flash('error', 'Error saving configuration: ' . $e->getMessage());
        }
    }

    public function render()
    {
        $classes = Myclass::where('is_active', true)->orderBy('id')->get();
        $subjects = [];
        
        if ($this->selectedClassId) {
            $subjects = MyclassSubject::with('subject')
                ->where('myclass_id', $this->selectedClassId)
                ->where('is_active', true)
                ->get();
        }

        return view('livewire.exam-settings-fmpm-comp-simple', [
            'classes' => $classes,
            'subjects' => $subjects,
            'examNames' => Exam01Name::orderBy('name')->get(),
            'examTypes' => Exam02Type::orderBy('name')->get(),
            'examParts' => Exam03Part::orderBy('name')->get(),
        ]);
    }
}