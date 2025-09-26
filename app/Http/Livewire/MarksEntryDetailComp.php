<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Exam05Detail;
use App\Models\MyclassSection;
use App\Models\Subject;
use App\Models\Studentcr;
use App\Models\Exam01Name;
use App\Models\Exam02Type;
use App\Models\Exam03Part;
use App\Models\Exam06ClassSubject;
use App\Models\Exam07AnsscrDist;
// use App\Models\Exam10MarksEntry;
use App\Models\Exam10MarksEntry;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class MarksEntryDetailComp extends Component
{
    public $examDetailId;
    public $subjectId;
    public $sectionId;

    public $examDetail;
    public $subject;
    public $section;
    public $students;

    public $ansscrDist;


    public $marks = [];
    public $previousMarks = [];
    public $examClassSubject;
    public $absentStudents = [];

    public function mount($examDetailId, $subjectId, $sectionId)
    {
        try {
            $this->examDetailId = $examDetailId;
            $this->subjectId = $subjectId;
            $this->sectionId = $sectionId;

            
            $this->loadData();
            $this->loadStudents();
            $this->loadPreviousMarks();

            $this->loadAnswerScriptDistribution();
        } catch (\Exception $e) {
            Log::error('Error in MarksEntryDetailComp mount: ' . $e->getMessage());
            session()->flash('error', 'Error initializing marks entry: ' . $e->getMessage());
        }
    }

    protected function loadAnswerScriptDistribution(){
        try {
            $this->ansscrDist = Exam07AnsscrDist::where('exam_detail_id', $this->examDetailId)
                ->where('exam_class_subject_id', $this->examClassSubject->id)
                ->where('myclass_section_id', $this->section->id)
                ->first();

                
        } catch (\Exception $e) {
            Log::error('Error loading answer script distribution: ' . $e->getMessage());
            session()->flash('error', 'Error loading answer script distribution: ' . $e->getMessage());
        }
    }


    protected function loadData()
    {
        try {
            // Load exam detail
            $this->examDetail = Exam05Detail::with(['examName', 'examType', 'examPart', 'myclass'])
                ->find($this->examDetailId);

            if (!$this->examDetail) {
                throw new \Exception('Exam detail not found');
            }

            // Load subject
            $this->subject = Subject::find($this->subjectId);

            if (!$this->subject) {
                throw new \Exception('Subject not found');
            }

            // Load section
            $this->section = MyclassSection::with('section')
                ->where('myclass_id', $this->examDetail->myclass_id)
                ->where('section_id', $this->sectionId)
                ->first();

            if (!$this->section) {
                throw new \Exception('Section not found');
            }
        } catch (\Exception $e) {
            Log::error('Error loading data: ' . $e->getMessage());
            session()->flash('error', 'Error loading exam data: ' . $e->getMessage());
        }
    }

    protected function loadStudents()
    {
        try {
            if (!$this->examDetail) {
                throw new \Exception('Exam detail not loaded');
            }

            // Load students for the class and section
            $this->students = Studentcr::where('myclass_id', $this->examDetail->myclass_id)
                ->where('section_id', $this->sectionId)
                // ->where('is_active', true)
                ->orderBy('roll_no')
                ->get();
            // dd($this->sectionId);

            // Initialize marks array and load existing marks
            $this->marks = [];
            $this->loadCurrentMarks();

            Log::info("Loaded " . $this->students->count() . " students for marks entry");
        } catch (\Exception $e) {
            Log::error('Error loading students: ' . $e->getMessage());
            session()->flash('error', 'Error loading students: ' . $e->getMessage());
            $this->students = collect();
            $this->marks = [];
        }
    }

    protected function loadCurrentMarks()
    {
        try {
            // Find the exam class subject for this combination
            $this->examClassSubject = Exam06ClassSubject::where('exam_detail_id', $this->examDetail->id)
                ->where('myclass_id', $this->examDetail->myclass_id)
                ->where('subject_id', $this->subjectId)
                ->first();

            if (!$this->examClassSubject) {
                // Initialize empty marks if no exam class subject found
                foreach ($this->students as $student) {
                    $this->marks[$student->id] = '';
                }
                return;
            }

            // Find the myclass section
            $myclassSection = MyclassSection::where('myclass_id', $this->examDetail->myclass_id)
                ->where('section_id', $this->sectionId)
                ->first();

            // Load existing marks from Exam10MarksEntry table
            foreach ($this->students as $student) {
                if ($myclassSection) {
                    $existingMark = Exam10MarksEntry::where('exam_detail_id', $this->examDetail->id)
                        ->where('exam_class_subject_id', $this->examClassSubject->id)
                        ->where('myclass_section_id', $myclassSection->id)
                        ->where('studentcr_id', $student->id)
                        ->first();

                    if ($existingMark && $existingMark->exam_marks == -99) {
                        // Student is marked as absent
                        $this->absentStudents[$student->id] = true;
                        $this->marks[$student->id] = '';
                    } else {
                        $this->absentStudents[$student->id] = false;
                        $this->marks[$student->id] = $existingMark ? round($existingMark->exam_marks,0) : '';
                    }
                } else {
                    $this->marks[$student->id] = '';
                    $this->absentStudents[$student->id] = false;
                }
            }
            
            Log::info('Loaded exam class subject with finalization status: ' . ($this->examClassSubject->is_finalized ? 'finalized' : 'not finalized'));
        } catch (\Exception $e) {
            Log::error('Error loading current marks: ' . $e->getMessage());
            foreach ($this->students as $student) {
                $this->marks[$student->id] = '';
                $this->absentStudents[$student->id] = false;
            }
        }
    }

    protected function loadPreviousMarks()
    {
        try {
            if (!$this->examDetail || !$this->subject) {
                return;
            }

            $this->previousMarks = [];

            foreach ($this->students as $student) {
                $this->previousMarks[$student->id] = [];

                // Get all exam details for this class and subject (excluding current)
                $otherExamDetails = Exam05Detail::with(['examName', 'examType', 'examPart'])
                    ->where('myclass_id', $this->examDetail->myclass_id)
                    ->where('id', '!=', $this->examDetail->id)
                    ->orderBy('exam_name_id')
                    ->orderBy('exam_type_id')
                    ->orderBy('exam_part_id')
                    ->get();

                foreach ($otherExamDetails as $otherExamDetail) {
                    // Find exam class subject for this exam detail
                    $otherExamClassSubject = Exam06ClassSubject::where('exam_detail_id', $otherExamDetail->id)
                        ->where('myclass_id', $otherExamDetail->myclass_id)
                        ->where('subject_id', $this->subjectId)
                        ->first();

                    if ($otherExamClassSubject) {
                        // Find the myclass section for this exam detail
                        $otherMyclassSection = MyclassSection::where('myclass_id', $otherExamDetail->myclass_id)
                            ->where('section_id', $this->sectionId)
                            ->first();

                        // Load marks from Exam10MarksEntry table
                        $previousMark = null;
                        if ($otherMyclassSection) {
                            $previousMark = Exam10MarksEntry::where('exam_detail_id', $otherExamDetail->id)
                                ->where('exam_class_subject_id', $otherExamClassSubject->id)
                                ->where('myclass_section_id', $otherMyclassSection->id)
                                ->where('studentcr_id', $student->id)
                                ->first();
                        }

                        $this->previousMarks[$student->id][] = [
                            'exam_name' => $otherExamDetail->examName->name ?? 'Unknown',
                            'exam_type' => $otherExamDetail->examType->name ?? 'Unknown',
                            'exam_part' => $otherExamDetail->examPart->name ?? 'Unknown',
                            'marks' => $previousMark ? $previousMark->exam_marks : null,
                            'exam_detail_id' => $otherExamDetail->id
                        ];
                    }
                }
            }

            Log::info("Loaded previous marks for " . $this->students->count() . " students");
        } catch (\Exception $e) {
            Log::error('Error loading previous marks: ' . $e->getMessage());
            $this->previousMarks = [];
        }
    }

    // Auto-save when marks are updated
    public function updatedMarks($value, $studentId)
    {
        try {
            // Check if marks are finalized
            if ($this->examClassSubject && $this->examClassSubject->is_finalized) {
                session()->flash('error', 'Cannot update marks: This exam has been finalized.');
                return;
            }

            if ($value !== '' && $value !== null && !$this->absentStudents[$studentId]) {
                $this->saveMarkForStudent($studentId, $value);
                session()->flash('message', 'Mark saved automatically for student ID: ' . $studentId);
            }
        } catch (\Exception $e) {
            Log::error('Error auto-saving mark: ' . $e->getMessage());
            session()->flash('error', 'Error saving mark: ' . $e->getMessage());
        }
    }

    // Handle when absent checkbox is toggled
    public function updatedAbsentStudents($value, $studentId)
    {
        try {
            // Check if marks are finalized
            if ($this->examClassSubject && $this->examClassSubject->is_finalized) {
                session()->flash('error', 'Cannot update absent status: This exam has been finalized.');
                return;
            }

            if ($value) {
                // Student is marked as absent
                $this->marks[$studentId] = '';
                $this->saveMarkForStudent($studentId, -99);
                session()->flash('message', 'Student marked as absent');
            } else {
                // Student is no longer absent, clear the absent mark
                $this->marks[$studentId] = '';
                // Delete the absent record
                $this->deleteMarkForStudent($studentId);
                session()->flash('message', 'Student unmarked as absent');
            }
        } catch (\Exception $e) {
            Log::error('Error updating absent status: ' . $e->getMessage());
            session()->flash('error', 'Error updating absent status: ' . $e->getMessage());
        }
    }

    protected function saveMarkForStudent($studentId, $mark)
    {
        try {
            if (!$this->examClassSubject) {
                throw new \Exception('Exam class subject not found');
            }

            $myclassSection = MyclassSection::where('myclass_id', $this->examDetail->myclass_id)
                ->where('section_id', $this->sectionId)
                ->first();
            if (!$myclassSection) {
                throw new \Exception('Myclass section not found');
            }

            // dd($myclassSection);

            DB::beginTransaction();

            Exam10MarksEntry::updateOrCreate([
                'exam_detail_id'    => $this->examDetailId,
                'exam_class_subject_id' => $this->examClassSubject->id,
                'myclass_section_id'    => $myclassSection->id,
                'studentcr_id'  => $studentId
            ], [
                'exam_marks'    => $mark,
                'updated_at'    => now(),


            ]);

            // Save to your marks table (adjust table name and structure as needed)
            // This is a placeholder - replace with your actual marks table structure
            /*
            DB::table('student_marks')->updateOrInsert([
                'student_id' => $studentId,
                'exam_class_subject_id' => $this->examClassSubject->id,
                'myclass_section_id' => $this->section->id,
            ], [
                'marks' => $mark,
                'updated_at' => now(),
                'updated_by' => auth()->id(),
            ]);
            */

            // For now, just log the action
            Log::info("Saving mark {$mark} for student {$studentId} in exam class subject {$this->examClassSubject->id}");

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    protected function deleteMarkForStudent($studentId)
    {
        try {
            $myclassSection = MyclassSection::where('myclass_id', $this->examDetail->myclass_id)
                ->where('section_id', $this->sectionId)
                ->first();

            if (!$myclassSection || !$this->examClassSubject) {
                return;
            }

            DB::beginTransaction();

            Exam10MarksEntry::where('exam_detail_id', $this->examDetailId)
                ->where('exam_class_subject_id', $this->examClassSubject->id)
                ->where('myclass_section_id', $myclassSection->id)
                ->where('studentcr_id', $studentId)
                ->delete();

            DB::commit();
            Log::info("Deleted mark record for student {$studentId}");
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function saveMarks()
    {
        try {
            // Check if marks are finalized
            if ($this->examClassSubject && $this->examClassSubject->is_finalized) {
                session()->flash('error', 'Cannot save marks: This exam has been finalized.');
                return;
            }

            DB::beginTransaction();

            foreach ($this->marks as $studentId => $mark) {
                if ($mark !== '' && $mark !== null) {
                    $this->saveMarkForStudent($studentId, $mark);
                }
            }

            DB::commit();
            session()->flash('message', 'All marks saved successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error saving marks: ' . $e->getMessage());
            session()->flash('error', 'Error saving marks: ' . $e->getMessage());
        }
    }

    public function goBack()
    {
        return redirect()->route('marks-entry');
    }

    public function finalizeMarks()
    {
        try {
            if (!$this->examClassSubject) {
                throw new \Exception('Exam class subject not found');
            }

            // Validate that all students have marks entered (or are marked absent)
            $unmarkedStudents = [];
            foreach ($this->students as $student) {
                $isAbsent = isset($this->absentStudents[$student->id]) && $this->absentStudents[$student->id];
                $hasMark = isset($this->marks[$student->id]) && $this->marks[$student->id] !== '' && $this->marks[$student->id] !== null;
                
                if (!$isAbsent && !$hasMark) {
                    $unmarkedStudents[] = $student->studentdb->name ?? $student->name ?? "Student ID: {$student->id}";
                }
            }

            if (!empty($unmarkedStudents)) {
                $studentList = implode(', ', $unmarkedStudents);
                throw new \Exception("Cannot finalize: The following students do not have marks entered: {$studentList}");
            }

            DB::beginTransaction();

            // Set the is_finalized flag to true
            $this->examClassSubject->update(['is_finalized' => true]);

            DB::commit();

            session()->flash('message', 'Marks have been finalized successfully. No further edits are allowed.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error finalizing marks: ' . $e->getMessage());
            session()->flash('error', 'Error finalizing marks: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.marks-entry-detail-comp');
    }
}
