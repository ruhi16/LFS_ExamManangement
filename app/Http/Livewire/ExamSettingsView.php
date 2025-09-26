<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Exam05Detail;
use App\Models\Myclass;

class ExamSettingsView extends Component
{
    public $classes;
    public $classConfigurations = [];
    
    public function mount()
    {
        $this->classes = Myclass::all();
        $this->loadAllClassConfigurations();
    }
    
    protected function loadAllClassConfigurations()
    {
        foreach ($this->classes as $class) {
            $this->classConfigurations[$class->id] = $this->loadExamConfigurations($class->id);
        }
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
        $examConfigurations = [];
        
        foreach ($configurations as $config) {
            $examNameId = $config->exam_name_id;
            $examTypeId = $config->exam_type_id;
            
            if (!isset($examConfigurations[$examNameId])) {
                $examConfigurations[$examNameId] = [
                    'examName' => $config->examName,
                    'types' => []
                ];
            }
            
            if (!isset($examConfigurations[$examNameId]['types'][$examTypeId])) {
                $examConfigurations[$examNameId]['types'][$examTypeId] = [
                    'examType' => $config->examType,
                    'parts' => []
                ];
            }
            
            $examConfigurations[$examNameId]['types'][$examTypeId]['parts'][] = [
                'examPart' => $config->examPart,
                'examMode' => $config->examMode,
                'config' => $config
            ];
        }
        
        return $examConfigurations;
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