<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Exam01Name;
use App\Models\Exam02Type;
use App\Models\Exam03Part;
use App\Models\Exam04Mode;
use App\Models\Exam05Detail;
use App\Models\Exam06ClassSubject;
use App\Models\Exam07AnsscrDist;
use App\Models\Exam08Grade;
use App\Models\Exam09ScheduleRoom;
use App\Models\Exam10MarksEntry;
use App\Models\Exam11QuestionPaper;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class TaskFinalizeLockStatusComp extends Component
{
    public $selectedClassId;
    public $classes = [];
    public $finalizationData = [];
    
    public function mount()
    {
        $this->classes = \App\Models\Myclass::where('is_active', true)
            ->when(Auth::check() && Auth::user()->school_id, function($query) {
                return $query->where('school_id', Auth::user()->school_id);
            })
            ->orderBy('order_index')
            ->get();
            
        if ($this->classes->isNotEmpty()) {
            $this->selectedClassId = $this->classes->first()->id;
            $this->loadFinalizationData();
        }
    }

    public function updatedSelectedClassId($value)
    {
        if ($value) {
            $this->loadFinalizationData();
        }
    }

    private function loadFinalizationData()
    {
        // Load all exam configuration levels with their finalization status
        $examNames = Exam01Name::whereHas('examDetails', function($query) {
            $query->where('myclass_id', $this->selectedClassId);
        })->get();

        $this->finalizationData = [];
        
        foreach ($examNames as $examName) {
            $examTypes = Exam02Type::whereHas('examDetails', function($query) use ($examName) {
                $query->where('exam_name_id', $examName->id)
                      ->where('myclass_id', $this->selectedClassId);
            })->get();
            
            $nameData = [
                'exam_name' => $examName,
                'is_finalized' => $examName->is_finalized ?? false,
                'exam_types' => []
            ];
            
            foreach ($examTypes as $examType) {
                $examParts = Exam03Part::whereHas('examDetails', function($query) use ($examName, $examType) {
                    $query->where('exam_name_id', $examName->id)
                          ->where('exam_type_id', $examType->id)
                          ->where('myclass_id', $this->selectedClassId);
                })->get();
                
                $typeData = [
                    'exam_type' => $examType,
                    'is_finalized' => $examType->is_finalized ?? false,
                    'exam_parts' => []
                ];
                
                foreach ($examParts as $examPart) {
                    $examModes = Exam04Mode::whereHas('examDetails', function($query) use ($examName, $examType, $examPart) {
                        $query->where('exam_name_id', $examName->id)
                              ->where('exam_type_id', $examType->id)
                              ->where('exam_part_id', $examPart->id)
                              ->where('myclass_id', $this->selectedClassId);
                    })->get();
                    
                    $partData = [
                        'exam_part' => $examPart,
                        'is_finalized' => $examPart->is_finalized ?? false,
                        'exam_modes' => []
                    ];
                    
                    foreach ($examModes as $examMode) {
                        $examDetail = Exam05Detail::where('exam_name_id', $examName->id)
                            ->where('exam_type_id', $examType->id)
                            ->where('exam_part_id', $examPart->id)
                            ->where('exam_mode_id', $examMode->id)
                            ->where('myclass_id', $this->selectedClassId)
                            ->first();
                            
                        $modeData = [
                            'exam_mode' => $examMode,
                            'is_finalized' => $examDetail ? $examDetail->is_finalized : false,
                            'has_dependencies' => false,
                            'dependencies' => []
                        ];
                        
                        if ($examDetail) {
                            // Check dependencies for this exam detail
                            $classSubjects = Exam06ClassSubject::where('exam_detail_id', $examDetail->id)->get();
                            $hasClassSubjects = $classSubjects->isNotEmpty();
                            
                            $modeData['has_dependencies'] = $hasClassSubjects;
                            $modeData['dependencies'] = [];
                            
                            if ($hasClassSubjects) {
                                // Question Paper
                                $questionPapers = Exam11QuestionPaper::where('exam_detail_id', $examDetail->id)->get();
                                $hasQuestionPapers = $questionPapers->isNotEmpty();
                                
                                $modeData['dependencies'][] = [
                                    'name' => 'Question Papers',
                                    'count' => $questionPapers->count(),
                                    'is_finalized' => $questionPapers->every(fn($qp) => $qp->is_finalized),
                                    'locked' => $questionPapers->every(fn($qp) => $qp->is_finalized)
                                ];
                                
                                // Answer Script Distribution
                                $ansscrDists = Exam07AnsscrDist::where('exam_detail_id', $examDetail->id)->get();
                                $hasAnsscrDists = $ansscrDists->isNotEmpty();
                                
                                $modeData['dependencies'][] = [
                                    'name' => 'Answer Script Distribution',
                                    'count' => $ansscrDists->count(),
                                    'is_finalized' => $ansscrDists->every(fn($dist) => $dist->is_finalized),
                                    'locked' => $ansscrDists->every(fn($dist) => $dist->is_finalized)
                                ];
                                
                                // Schedule Rooms
                                $scheduleRooms = Exam09ScheduleRoom::where('exam_detail_id', $examDetail->id)->get();
                                $hasScheduleRooms = $scheduleRooms->isNotEmpty();
                                
                                $modeData['dependencies'][] = [
                                    'name' => 'Schedule Rooms',
                                    'count' => $scheduleRooms->count(),
                                    'is_finalized' => $scheduleRooms->every(fn($room) => $room->is_finalized),
                                    'locked' => $scheduleRooms->every(fn($room) => $room->is_finalized)
                                ];
                                
                                // Marks Entry
                                $marksEntries = Exam10MarksEntry::where('exam_detail_id', $examDetail->id)->get();
                                $hasMarksEntries = $marksEntries->isNotEmpty();
                                
                                $modeData['dependencies'][] = [
                                    'name' => 'Marks Entry',
                                    'count' => $marksEntries->count(),
                                    'is_finalized' => $marksEntries->every(fn($entry) => $entry->is_finalized),
                                    'locked' => $marksEntries->every(fn($entry) => $entry->is_finalized)
                                ];
                                
                                // Grades
                                $grades = Exam08Grade::where('exam_type_id', $examType->id)->get();
                                $hasGrades = $grades->isNotEmpty();
                                
                                $modeData['dependencies'][] = [
                                    'name' => 'Grades',
                                    'count' => $grades->count(),
                                    'is_finalized' => $grades->every(fn($grade) => $grade->is_finalized),
                                    'locked' => $grades->every(fn($grade) => $grade->is_finalized)
                                ];
                            }
                        }
                        
                        $partData['exam_modes'][] = $modeData;
                    }
                    
                    $typeData['exam_parts'][] = $partData;
                }
                
                $nameData['exam_types'][] = $typeData;
            }
            
            $this->finalizationData[] = $nameData;
        }
    }
    
    public function toggleFinalization($level, $id)
    {
        $model = null;
        $attribute = 'is_finalized';
        
        switch($level) {
            case 'exam_name':
                $model = Exam01Name::find($id);
                break;
            case 'exam_type':
                $model = Exam02Type::find($id);
                break;
            case 'exam_part':
                $model = Exam03Part::find($id);
                break;
            case 'exam_mode':
                // For exam mode, we need to update the exam_detail record
                $examDetail = Exam05Detail::where('exam_mode_id', $id)
                    ->where('myclass_id', $this->selectedClassId)
                    ->first();
                
                if ($examDetail) {
                    $examDetail->is_finalized = !$examDetail->is_finalized;
                    $examDetail->save();
                    
                    // Refresh the data
                    $this->loadFinalizationData();
                    session()->flash('success', 'Exam mode finalization status updated successfully!');
                    return;
                }
                break;
        }
        
        if ($model) {
            $model->$attribute = !$model->$attribute;
            $model->save();
            
            // Refresh the data
            $this->loadFinalizationData();
            session()->flash('success', ucfirst($level) . ' finalization status updated successfully!');
        } else {
            session()->flash('error', 'Could not find the specified record.');
        }
    }
    
    public function render()
    {
        return view('livewire.task-finalize-lock-status-comp');
    }
}