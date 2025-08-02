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
        $this->examConfigurations = Exam05Detail::with([
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
        // ->groupBy(groupBy: 'exam_name_id');
        // dd($this->examConfigurations);
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
