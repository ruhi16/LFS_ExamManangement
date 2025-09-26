<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Exam10MarksEntry;
use App\Models\Exam05Detail;
use App\Models\Exam06ClassSubject;
use App\Models\MyclassSection;
use App\Models\Studentcr;
use App\Models\Exam08Grade;
use Livewire\WithPagination;
use App\Http\Livewire\Traits\FinalizationTrait;

class Exam10MarksEntryComp extends Component
{
    use WithPagination, FinalizationTrait;

    // Form properties
    public $exam_detail_id = '';
    public $exam_class_subject_id = '';
    public $myclass_section_id = '';
    public $studentcr_id = '';
    public $exam_marks = '';
    public $grade_id = '';
    public $is_absent = false;
    public $session_id = '';
    public $school_id = '';
    public $is_active = true;
    public $is_finalized = false;
    public $status = '';
    public $remarks = '';

    // Component state
    public $showModal = false;
    public $editingId = null;
    public $confirmingDeletion = false;
    public $deletingId = null;
    public $search = '';
    public $selectedClassId = '';
    public $selectedSectionId = '';
    public $selectedSubjectId = '';

    protected $rules = [
        'exam_detail_id' => 'required|integer',
        'exam_class_subject_id' => 'required|integer',
        'myclass_section_id' => 'required|integer',
        'studentcr_id' => 'required|integer',
        'exam_marks' => 'nullable|numeric|min:0|max:100',
        'grade_id' => 'nullable|integer',
        'is_absent' => 'boolean',
        'session_id' => 'nullable|integer',
        'school_id' => 'nullable|integer',
        'is_active' => 'boolean',
        'is_finalized' => 'boolean',
        'status' => 'nullable|string|max:100',
        'remarks' => 'nullable|string|max:500',
    ];

    protected $messages = [
        'exam_detail_id.required' => 'Exam detail is required.',
        'exam_class_subject_id.required' => 'Exam class subject is required.',
        'myclass_section_id.required' => 'Class section is required.',
        'studentcr_id.required' => 'Student is required.',
        'exam_marks.numeric' => 'Marks must be a number.',
        'exam_marks.min' => 'Marks must be at least 0.',
        'exam_marks.max' => 'Marks cannot exceed 100.',
    ];

    public function mount()
    {
        $this->resetForm();
        $this->checkGlobalFinalizationStatus(Exam10MarksEntry::class);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function resetForm()
    {
        $this->exam_detail_id = '';
        $this->exam_class_subject_id = '';
        $this->myclass_section_id = '';
        $this->studentcr_id = '';
        $this->exam_marks = '';
        $this->grade_id = '';
        $this->is_absent = false;
        $this->session_id = '';
        $this->school_id = '';
        $this->is_active = true;
        $this->is_finalized = false;
        $this->status = '';
        $this->remarks = '';
        $this->editingId = null;
        $this->resetValidation();
    }

    public function openModal()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    public function save()
    {
        if ($this->preventActionIfFinalized('modify data')) {
            return;
        }

        $this->validate();

        $data = [
            'exam_detail_id' => $this->exam_detail_id,
            'exam_class_subject_id' => $this->exam_class_subject_id,
            'myclass_section_id' => $this->myclass_section_id,
            'studentcr_id' => $this->studentcr_id,
            'exam_marks' => $this->exam_marks ?: null,
            'grade_id' => $this->grade_id ?: null,
            'is_absent' => $this->is_absent,
            'session_id' => $this->session_id ?: null,
            'school_id' => $this->school_id ?: null,
            'is_active' => $this->is_active,
            'is_finalized' => $this->is_finalized,
            'status' => $this->status,
            'remarks' => $this->remarks,
            'user_id' => auth()->id(),
        ];

        if ($this->editingId) {
            $marksEntry = Exam10MarksEntry::findOrFail($this->editingId);
            $marksEntry->update($data);
            session()->flash('message', 'Marks entry updated successfully!');
        } else {
            Exam10MarksEntry::create($data);
            session()->flash('message', 'Marks entry created successfully!');
        }

        $this->closeModal();
    }

    public function edit($id)
    {
        $marksEntry = Exam10MarksEntry::findOrFail($id);
        
        $this->editingId = $id;
        $this->exam_detail_id = $marksEntry->exam_detail_id;
        $this->exam_class_subject_id = $marksEntry->exam_class_subject_id;
        $this->myclass_section_id = $marksEntry->myclass_section_id;
        $this->studentcr_id = $marksEntry->studentcr_id;
        $this->exam_marks = $marksEntry->exam_marks;
        $this->grade_id = $marksEntry->grade_id;
        $this->is_absent = $marksEntry->is_absent;
        $this->session_id = $marksEntry->session_id;
        $this->school_id = $marksEntry->school_id;
        $this->is_active = $marksEntry->is_active;
        $this->is_finalized = $marksEntry->is_finalized;
        $this->status = $marksEntry->status;
        $this->remarks = $marksEntry->remarks;
        
        $this->showModal = true;
    }

    public function confirmDelete($id)
    {
        $this->deletingId = $id;
        $this->confirmingDeletion = true;
    }

    public function delete()
    {
        if ($this->deletingId) {
            $marksEntry = Exam10MarksEntry::findOrFail($this->deletingId);
            $marksEntry->delete();
            session()->flash('message', 'Marks entry deleted successfully!');
        }
        
        $this->confirmingDeletion = false;
        $this->deletingId = null;
    }

    public function cancelDelete()
    {
        $this->confirmingDeletion = false;
        $this->deletingId = null;
    }

    public function toggleStatus($id)
    {
        if ($this->preventActionIfFinalized('modify data')) {
            return;
        }

        $marksEntry = Exam10MarksEntry::findOrFail($id);
        $marksEntry->update(['is_active' => !$marksEntry->is_active]);
        
        $status = $marksEntry->is_active ? 'activated' : 'deactivated';
        session()->flash('message', "Marks entry {$status} successfully!");
    }

    public function render()
    {
        $marksEntries = Exam10MarksEntry::query()
            ->with([
                'examDetail.examName', 
                'examClassSubject.subject', 
                'myclassSection.myclass', 
                'studentcr.studentdb',
                'grade'
            ])
            ->when($this->search, function ($query) {
                $query->whereHas('studentcr.studentdb', function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%');
                })->orWhereHas('examDetail.examName', function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->selectedClassId, function ($query) {
                $query->whereHas('myclassSection.myclass', function ($q) {
                    $q->where('id', $this->selectedClassId);
                });
            })
            ->when($this->selectedSectionId, function ($query) {
                $query->where('myclass_section_id', $this->selectedSectionId);
            })
            ->orderBy('id', 'asc')
            ->orderBy('exam_detail_id', 'asc')
            ->orderBy('myclass_section_id', 'asc')
            ->paginate(10);

        // Load related data for dropdowns
        $examDetails = Exam05Detail::with(['examName', 'myclass'])->orderBy('id')->get();
        $examClassSubjects = Exam06ClassSubject::with(['subject'])->orderBy('id')->get();
        $classSections = MyclassSection::with(['myclass'])->orderBy('id')->get();
        $students = Studentcr::with(['studentdb'])->orderBy('id')->get();
        $grades = Exam08Grade::orderBy('id')->get();
        $classes = \App\Models\Myclass::where('is_active', true)->orderBy('id')->get();

        return view('livewire.exam10-marks-entry-comp', [
            'marksEntries' => $marksEntries,
            'examDetails' => $examDetails,
            'examClassSubjects' => $examClassSubjects,
            'classSections' => $classSections,
            'students' => $students,
            'grades' => $grades,
            'classes' => $classes,
        ]);
    }
}