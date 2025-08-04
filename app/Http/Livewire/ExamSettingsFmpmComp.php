<?php

namespace App\Http\Livewire;

use Livewire\Component;
// use App\Models\Exam06ClassSubject;
use App\Models\Myclass;
// use App\Models\MyclassSubject;
// use App\Models\Exam01Name;
// use App\Models\Exam02Type;
// use App\Models\Exam03Part;

class ExamSettingsFmpmComp extends Component
{
    public $classes;
    public $selectedClassId = null;
    public $examConfigurations = [];
    
    // Flattened form data to avoid hydration issues
    public $fullMarks = [];
    public $passMarks = [];
    public $timeInMinutes = [];
    public $configIds = [];
    public $enabledConfigs = [];

    public function mount()
    {
        $this->classes = Myclass::where('is_active', true)->orderBy('id')->get();
    }

    public function selectClass($classId)
    {
        $this->selectedClassId = $classId;
        $this->loadExamConfigurations($classId);
    }

    protected function loadExamConfigurations($classId){
        // Reset arrays
        $this->fullMarks = [];
        $this->passMarks = [];
        $this->timeInMinutes = [];
        $this->configIds = [];
        $this->enabledConfigs = [];
        
        // Get all subjects for this class
        $classSubjects = \App\Models\MyclassSubject::with('subject')
            ->where('myclass_id', $classId)
            ->where('is_active', true)
            ->orderBy('order_index', 'asc')
            ->orderBy('name', 'asc')
            ->get();

        // Get active exam configurations from Exam05Detail for this class
        $activeExamConfigs = \App\Models\Exam05Detail::where('myclass_id', $classId)
            ->where('is_active', true)
            ->get()
            ->keyBy(function($item) {
                return $item->exam_name_id . '_' . $item->exam_type_id . '_' . $item->exam_part_id;
            });
            // dd($activeExamConfigs);

        // Get existing Exam06ClassSubject configurations
        $existingConfigs = \App\Models\Exam06ClassSubject::where('myclass_id', $classId)
            ->get()
            ->keyBy(function($item) {
                return $item->subject_id . '_' . $item->exam_name_id . '_' . $item->exam_type_id . '_' . $item->exam_part_id;
            });

        $this->examConfigurations = [];

        foreach ($classSubjects as $classSubject) {
            $subjectId = $classSubject->subject_id;
            $this->examConfigurations[$subjectId] = [
                'subject' => $classSubject->subject,
                'classSubject' => $classSubject
            ];

            // Only load data for combinations that exist in Exam05Detail
            foreach ($this->getAllExamNames() as $examName) {
                foreach ($this->getAllExamTypes() as $examType) {
                    foreach ($this->getAllExamParts() as $examPart) {
                        $examConfigKey = $examName->id . '_' . $examType->id . '_' . $examPart->id;
                        $flatKey = $subjectId . '_' . $examName->id . '_' . $examType->id . '_' . $examPart->id;
                        
                        // Only process if this combination exists in Exam05Detail
                        if (isset($activeExamConfigs[$examConfigKey])) {
                            $this->enabledConfigs[$flatKey] = true;
                            
                            if (isset($existingConfigs[$flatKey])) {
                                $config = $existingConfigs[$flatKey];
                                $this->fullMarks[$flatKey] = $config->full_marks;
                                $this->passMarks[$flatKey] = $config->pass_marks;
                                $this->timeInMinutes[$flatKey] = $config->time_in_minutes;
                                $this->configIds[$flatKey] = $config->id;
                            } else {
                                $this->fullMarks[$flatKey] = '';
                                $this->passMarks[$flatKey] = '';
                                $this->timeInMinutes[$flatKey] = '';
                                $this->configIds[$flatKey] = null;
                            }
                        } else {
                            $this->enabledConfigs[$flatKey] = false;
                            $this->fullMarks[$flatKey] = '';
                            $this->passMarks[$flatKey] = '';
                            $this->timeInMinutes[$flatKey] = '';
                            $this->configIds[$flatKey] = null;
                        }
                    }
                }
            }
        }
    }

    public function saveConfiguration($subjectId, $examNameId, $examTypeId, $examPartId)
    {
        $flatKey = $subjectId . '_' . $examNameId . '_' . $examTypeId . '_' . $examPartId;
        
        // Validation
        if (empty($this->fullMarks[$flatKey]) || empty($this->passMarks[$flatKey]) || empty($this->timeInMinutes[$flatKey])) {
            session()->flash('error', 'All fields (Full Marks, Pass Marks, Time) are required.');
            return;
        }

        if ($this->passMarks[$flatKey] >= $this->fullMarks[$flatKey]) {
            session()->flash('error', 'Pass marks must be less than full marks.');
            return;
        }

        $subject = $this->examConfigurations[$subjectId]['subject'];
        $examName = \App\Models\Exam01Name::find($examNameId);
        $examType = \App\Models\Exam02Type::find($examTypeId);
        $examPart = \App\Models\Exam03Part::find($examPartId);

        $configData = [
            'name' => $subject->name . ' - ' . $examName->name . ' - ' . $examType->name . ' - ' . $examPart->name,
            'myclass_id' => $this->selectedClassId,
            'subject_id' => $subjectId,
            'exam_name_id' => $examNameId,
            'exam_type_id' => $examTypeId,
            'exam_part_id' => $examPartId,
            'full_marks' => (int)$this->fullMarks[$flatKey],
            'pass_marks' => (int)$this->passMarks[$flatKey],
            'time_in_minutes' => (int)$this->timeInMinutes[$flatKey],
            'is_active' => true,
            'user_id' => auth()->id(),
        ];

        if ($this->configIds[$flatKey]) {
            // Update existing
            $config = \App\Models\Exam06ClassSubject::findOrFail($this->configIds[$flatKey]);
            $config->update($configData);
            session()->flash('message', 'Configuration updated successfully!');
        } else {
            // Create new
            $newConfig = \App\Models\Exam06ClassSubject::create($configData);
            $this->configIds[$flatKey] = $newConfig->id;
            session()->flash('message', 'Configuration saved successfully!');
        }
    }

    public function deleteConfiguration($subjectId, $examNameId, $examTypeId, $examPartId)
    {
        $flatKey = $subjectId . '_' . $examNameId . '_' . $examTypeId . '_' . $examPartId;
        
        if ($this->configIds[$flatKey]) {
            $config = \App\Models\Exam06ClassSubject::findOrFail($this->configIds[$flatKey]);
            $config->delete();
            
            // Reset form data
            $this->fullMarks[$flatKey] = '';
            $this->passMarks[$flatKey] = '';
            $this->timeInMinutes[$flatKey] = '';
            $this->configIds[$flatKey] = null;
            
            session()->flash('message', 'Configuration deleted successfully!');
        }
    }

    public function getAllExamNames(){
        return \App\Models\Exam01Name::orderBy('id')->get();
    }

    public function getAllExamTypes(){
        return \App\Models\Exam02Type::orderBy('id')->get();
    }

    public function getAllExamParts(){
        return \App\Models\Exam03Part::orderBy('id')->get();
    }

    public function getActiveExamConfigurations(){
        if (!$this->selectedClassId) {
            return collect();
        }
        
        return \App\Models\Exam05Detail::where('myclass_id', $this->selectedClassId)
            ->where('is_active', true)
            ->get()
            ->keyBy(function($item) {
                return $item->exam_name_id . '_' . $item->exam_type_id . '_' . $item->exam_part_id;
            });
    }

    public function isConfigurationEnabled($examNameId, $examTypeId, $examPartId){
        $activeConfigs = $this->getActiveExamConfigurations();
        $key = $examNameId . '_' . $examTypeId . '_' . $examPartId;
        return $activeConfigs->has($key);
    }

    public function render(){

        return view('livewire.exam-settings-fmpm-comp', [
            'examNames' => $this->getAllExamNames(),
            'examTypes' => $this->getAllExamTypes(),
            'examParts' => $this->getAllExamParts(),
            'activeExamConfigs' => $this->getActiveExamConfigurations()
        ]);
    }
}
