<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ExamSettings extends Component
{
    public $classes;
    public $selectedClassId = null;
    
    public $examNames = [];
    
    // Configuration arrays
    public $selectedExamNames = [];
    public $selectedExamTypes = [];
    public $selectedExamParts = [];
    public $selectedExamModes = [];
    
    public function mount()
    {
        $this->classes = \App\Models\Myclass::all();
        $this->examNames = \App\Models\Exam01Name::all();
        
        // Load any existing configurations
        $this->loadConfigurations();
    }
    
    public function selectClass($classId)
    {
        $this->selectedClassId = $classId;
        $this->loadConfigurations($classId);
    }
    
    protected function loadConfigurations($classId = null)
    {
        if (!$classId) return;
        
        // Reset arrays for this class
        $this->selectedExamNames[$classId] = [];
        $this->selectedExamTypes[$classId] = [];
        $this->selectedExamParts[$classId] = [];
        $this->selectedExamModes[$classId] = [];
        
        // Load existing configurations for this class
        $configurations = \App\Models\Exam05Detail::where('myclass_id', $classId)->get();

        foreach ($configurations as $config) {
            // Populate the selected arrays with existing configuration
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
                // Initialize the array if it doesn't exist
                if (!isset($this->selectedExamModes[$classId][$config->exam_name_id][$config->exam_type_id][$config->exam_part_id])) {
                    $this->selectedExamModes[$classId][$config->exam_name_id][$config->exam_type_id][$config->exam_part_id] = [];
                }
                
                // Set all modes to false first (radio button behavior)
                $examModes = \App\Models\Exam04Mode::all();
                foreach ($examModes as $mode) {
                    $this->selectedExamModes[$classId][$config->exam_name_id][$config->exam_type_id][$config->exam_part_id][$mode->id] = false;
                }
                
                // Then set the selected mode to true
                $this->selectedExamModes[$classId][$config->exam_name_id][$config->exam_type_id][$config->exam_part_id][$config->exam_mode_id] = true;
            }
        }
    }
    
    public function saveExamConfiguration($classId, $examNameId)
    {
        $this->validate([
            "selectedExamNames.$classId.$examNameId" => 'sometimes|boolean',
            "selectedExamTypes.$classId.$examNameId.*" => 'sometimes|boolean',
            "selectedExamParts.$classId.$examNameId.*.*" => 'sometimes|boolean',
            "selectedExamModes.$classId.$examNameId.*.*.*" => 'sometimes|boolean',
        ]);
        
        // Get the exam name for the record
        $examName = \App\Models\Exam01Name::find($examNameId);
        
        // Collect all unique combinations of exam configurations
        $configurations = [];
        
        // Process exam modes (most specific level)
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
        
        // Process exam parts (if not already covered by modes)
        if (isset($this->selectedExamParts[$classId][$examNameId])) {
            foreach ($this->selectedExamParts[$classId][$examNameId] as $examTypeId => $parts) {
                foreach ($parts as $examPartId => $selected) {
                    if ($selected) {
                        $key = "{$examNameId}-{$examTypeId}-{$examPartId}-null";
                        if (!isset($configurations[$key]) && !$this->hasExamModeForPart($classId, $examNameId, $examTypeId, $examPartId)) {
                            $configurations[$key] = [
                                'exam_name_id' => $examNameId,
                                'exam_type_id' => $examTypeId,
                                'exam_part_id' => $examPartId,
                                'exam_mode_id' => null,
                            ];
                        }
                    }
                }
            }
        }
        
        // Process exam types (if not already covered by parts/modes)
        if (isset($this->selectedExamTypes[$classId][$examNameId])) {
            foreach ($this->selectedExamTypes[$classId][$examNameId] as $examTypeId => $selected) {
                if ($selected) {
                    $key = "{$examNameId}-{$examTypeId}-null-null";
                    if (!isset($configurations[$key]) && !$this->hasExamPartForType($classId, $examNameId, $examTypeId)) {
                        $configurations[$key] = [
                            'exam_name_id' => $examNameId,
                            'exam_type_id' => $examTypeId,
                            'exam_part_id' => null,
                            'exam_mode_id' => null,
                        ];
                    }
                }
            }
        }
        
        // Process exam names (if not already covered by types/parts/modes)
        if (isset($this->selectedExamNames[$classId][$examNameId]) && $this->selectedExamNames[$classId][$examNameId]) {
            $key = "{$examNameId}-null-null-null";
            if (!isset($configurations[$key]) && !$this->hasExamTypeForName($classId, $examNameId)) {
                $configurations[$key] = [
                    'exam_name_id' => $examNameId,
                    'exam_type_id' => null,
                    'exam_part_id' => null,
                    'exam_mode_id' => null,
                ];
            }
        }

        // dd($configurations);
        // foreach($configurations as $config){
        //     dd( $config, implode(', ',$config) );
        // }
        
        // Delete existing configurations for this class and exam name
        \App\Models\Exam05Detail::where('myclass_id', $classId)
            ->where('exam_name_id', $examNameId)
            ->delete();
        
        // Save each unique configuration
        foreach ($configurations as $config) {
            \App\Models\Exam05Detail::updateOrCreate(
                [
                    'myclass_id' => $classId,
                    'exam_name_id' => $config['exam_name_id'],
                    'exam_type_id' => $config['exam_type_id'],
                    'exam_part_id' => $config['exam_part_id'],
                    'exam_mode_id' => $config['exam_mode_id'],
                ],
                [
                    'name' => $examName->name ?? 'Exam Config New',
                    'description' => 'Exam Configuration updated',
                    'is_active' => true,
                    'user_id' => auth()->id(),
                ]
            );
        }
        
        session()->flash('message', 'Configuration saved successfully!');
    }
    
    private function hasExamModeForPart($classId, $examNameId, $examTypeId, $examPartId)
    {
        return isset($this->selectedExamModes[$classId][$examNameId][$examTypeId][$examPartId]) &&
               array_filter($this->selectedExamModes[$classId][$examNameId][$examTypeId][$examPartId]);
    }
    
    private function hasExamPartForType($classId, $examNameId, $examTypeId)
    {
        return isset($this->selectedExamParts[$classId][$examNameId][$examTypeId]) &&
               array_filter($this->selectedExamParts[$classId][$examNameId][$examTypeId]);
    }
    
    private function hasExamTypeForName($classId, $examNameId)
    {
        return isset($this->selectedExamTypes[$classId][$examNameId]) &&
               array_filter($this->selectedExamTypes[$classId][$examNameId]);
    }
    
    public function saveAllConfigurations($classId)
    {
        // dd($this->configuration);
        
        // Save all configurations for this class (implement your save logic here
        foreach ($this->examNames as $examName) {
            if (isset($this->selectedExamNames[$classId][$examName->id])) {
                $this->saveExamConfiguration($classId, $examName->id);
            }
        }
        
        session()->flash('message', 'All configurations saved successfully!');
    }
    
    public function isExamConfigurationComplete($classId, $examNameId)
    {
        if (!isset($this->selectedExamNames[$classId][$examNameId]) || !$this->selectedExamNames[$classId][$examNameId]) {
            return false;
        }

        // Check if at least one exam type is selected
        if (!isset($this->selectedExamTypes[$classId][$examNameId]) || 
            !array_filter($this->selectedExamTypes[$classId][$examNameId])) {
            return false;
        }

        // For each selected exam type, check if all parts and modes are properly configured
        foreach ($this->selectedExamTypes[$classId][$examNameId] as $examTypeId => $typeSelected) {
            if ($typeSelected) {
                // Check if at least one part is selected for this type
                if (!isset($this->selectedExamParts[$classId][$examNameId][$examTypeId]) || 
                    !array_filter($this->selectedExamParts[$classId][$examNameId][$examTypeId])) {
                    return false;
                }

                // For each selected part, check if exactly one mode is selected
                foreach ($this->selectedExamParts[$classId][$examNameId][$examTypeId] as $examPartId => $partSelected) {
                    if ($partSelected) {
                        if (!isset($this->selectedExamModes[$classId][$examNameId][$examTypeId][$examPartId])) {
                            return false;
                        }
                        
                        $selectedModes = array_filter($this->selectedExamModes[$classId][$examNameId][$examTypeId][$examPartId]);
                        if (count($selectedModes) !== 1) {
                            return false;
                        }
                    }
                }
            }
        }

        return true;
    }

    public function areAllExamConfigurationsComplete($classId)
    {
        foreach ($this->examNames as $examName) {
            if (isset($this->selectedExamNames[$classId][$examName->id]) && 
                $this->selectedExamNames[$classId][$examName->id]) {
                if (!$this->isExamConfigurationComplete($classId, $examName->id)) {
                    return false;
                }
            }
        }
        
        // Check if at least one exam is selected
        return isset($this->selectedExamNames[$classId]) && 
               array_filter($this->selectedExamNames[$classId]);
    }

    public function selectExamMode($classId, $examNameId, $examTypeId, $examPartId, $examModeId)
    {
        // Clear all other modes for this part (radio button behavior)
        if (isset($this->selectedExamModes[$classId][$examNameId][$examTypeId][$examPartId])) {
            foreach ($this->selectedExamModes[$classId][$examNameId][$examTypeId][$examPartId] as $modeId => $selected) {
                $this->selectedExamModes[$classId][$examNameId][$examTypeId][$examPartId][$modeId] = false;
            }
        }
        
        // Select the chosen mode
        $this->selectedExamModes[$classId][$examNameId][$examTypeId][$examPartId][$examModeId] = true;
    }

    public function render()
    {
        return view('livewire.exam-settings', [
            'examTypes' => \App\Models\Exam02Type::all(),
            'examParts' => \App\Models\Exam03Part::all(),
            'examModes' => \App\Models\Exam04Mode::all(),
        ]);
    }
}
