<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Exam05Detail;
use App\Models\Myclass;

class ExamSettingsView extends Component
{
    public $classes;
    public $selectedClassId = null;
    public $examConfigurations = [];
    
    public function mount()
    {
        $this->classes = Myclass::all();
    }
    
    public function selectClass($classId)
    {
        $this->selectedClassId = $classId;
        $this->loadExamConfigurations($classId);
    }
    
    protected function loadExamConfigurations($classId)
    {
        $configurations = Exam05Detail::with([
            'examName', 
            'examType', 
            'examPart', 
            'examMode', 
            'user'
        ])
        ->where('myclass_id', $classId)
        ->where('is_active', true)
        ->orderBy('exam_name_id')
        ->orderBy('exam_type_id')
        ->orderBy('exam_part_id')
        ->orderBy('exam_mode_id')
        ->get();

        // Organize data in matrix format: examName -> examType -> [parts with modes]
        $this->examConfigurations = [];
        
        foreach ($configurations as $config) {
            $examNameId = $config->exam_name_id;
            $examTypeId = $config->exam_type_id;
            
            if (!isset($this->examConfigurations[$examNameId])) {
                $this->examConfigurations[$examNameId] = [
                    'examName' => $config->examName,
                    'types' => []
                ];
            }
            
            if (!isset($this->examConfigurations[$examNameId]['types'][$examTypeId])) {
                $this->examConfigurations[$examNameId]['types'][$examTypeId] = [
                    'examType' => $config->examType,
                    'parts' => []
                ];
            }
            
            $this->examConfigurations[$examNameId]['types'][$examTypeId]['parts'][] = [
                'examPart' => $config->examPart,
                'examMode' => $config->examMode,
                'config' => $config
            ];
        }
    }
    
    public function getAllExamTypes()
    {
        return \App\Models\Exam02Type::all();
    }
    
    public function getConfigurationSummary($classId)
    {
        if (!$classId) return null;
        
        $total = Exam05Detail::where('myclass_id', $classId)->where('is_active', true)->count();
        $finalized = Exam05Detail::where('myclass_id', $classId)->where('is_active', true)->where('is_finalized', true)->count();
        $examNames = Exam05Detail::where('myclass_id', $classId)->where('is_active', true)->distinct('exam_name_id')->count();
        
        return [
            'total' => $total,
            'finalized' => $finalized,
            'exam_names' => $examNames,
            'pending' => $total - $finalized
        ];
    }
    
    public function render()
    {
        return view('livewire.exam-settings-view');
    }
}
