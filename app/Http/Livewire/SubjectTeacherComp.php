<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Support\Facades\Log;

class SubjectTeacherComp extends Component
{
    use WithPagination;

    // Modal properties
    public $showModal = false;
    public $editMode = false;
    public $assignmentId = null;

    // Form properties
    public $subject_id;
    public $teacher_id;
    public $is_primary = false;
    public $notes;
    public $status = 'active';

    // Display properties
    public $selectedSubject = '';
    public $searchTerm = '';
    public $testCounter = 0;
    protected $subjects;
    protected $teachers;
    protected $subjectTeachers;

    protected $rules = [
        'subject_id' => 'required|exists:subjects,id',
        'teacher_id' => 'required|exists:teachers,id',
        'is_primary' => 'boolean',
        'notes' => 'nullable|string|max:500',
        'status' => 'required|in:active,inactive',
    ];

    protected $messages = [
        'subject_id.required' => 'Please select a subject.',
        'teacher_id.required' => 'Please select a teacher.',
        'subject_id.exists' => 'Please select a valid subject.',
        'teacher_id.exists' => 'Please select a valid teacher.',
    ];

    public function mount()
    {
        try {
            $this->loadData();
        } catch (\Exception $e) {
            Log::error('Error in SubjectTeacherComp mount: ' . $e->getMessage());
            session()->flash('error', 'Error loading component: ' . $e->getMessage());

            // Initialize empty collections as fallback
            $this->subjects = collect();
            $this->teachers = collect();
            $this->subjectTeachers = new \Illuminate\Pagination\LengthAwarePaginator(
                collect(),
                0,
                10,
                1,
                ['path' => request()->url()]
            );
        }
    }

    public function loadData()
    {
        $this->loadSubjects();
        $this->loadTeachers();
        $this->loadSubjectTeachers();
    }

    public function loadSubjects()
    {
        try {
            $this->subjects = Subject::orderBy('name')->get();
        } catch (\Exception $e) {
            Log::error('Error loading subjects: ' . $e->getMessage());
            $this->subjects = collect();
        }
    }

    public function loadTeachers()
    {
        try {
            $this->teachers = Teacher::where('status', 'active')->orderBy('name')->get();
        } catch (\Exception $e) {
            Log::error('Error loading teachers: ' . $e->getMessage());
            $this->teachers = collect();
        }
    }

    public function loadSubjectTeachers()
    {
        try {
            $query = Subject::with(['teachers' => function ($q) {
                $q->orderBy('name');
            }]);

            if ($this->selectedSubject) {
                $query->where('id', $this->selectedSubject);
            }

            if ($this->searchTerm) {
                $searchTerm = trim($this->searchTerm);
                if (!empty($searchTerm)) {
                    $query->where(function ($q) use ($searchTerm) {
                        $q->where('name', 'like', "%{$searchTerm}%")
                            ->orWhereHas('teachers', function ($tq) use ($searchTerm) {
                                $tq->where('name', 'like', "%{$searchTerm}%");
                            });
                    });
                }
            }

            $this->subjectTeachers = $query->orderBy('name')->paginate(10);
        } catch (\Exception $e) {
            Log::error('Error loading subject teachers: ' . $e->getMessage());
            // Create empty paginated result as fallback
            $this->subjectTeachers = new \Illuminate\Pagination\LengthAwarePaginator(
                collect(),
                0,
                10,
                1,
                ['path' => request()->url()]
            );
        }
    }

    public function updatedSelectedSubject()
    {
        $this->resetPage();
        $this->loadSubjectTeachers();
    }

    public function updatedSearchTerm()
    {
        $this->resetPage();
        $this->loadSubjectTeachers();
    }

    public function openModal($subjectId = null, $teacherId = null)
    {
        $this->resetForm();

        if ($subjectId && $teacherId) {
            $this->editMode = true;
            $this->subject_id = $subjectId; // Pre-fill subject for editing
            $this->loadAssignmentData($subjectId, $teacherId);
        } else {
            $this->editMode = false;
            // Pre-fill subject if provided (for adding teacher to specific subject)
            if ($subjectId) {
                $this->subject_id = $subjectId;
            }
        }

        $this->showModal = true;

        // Ensure data is loaded for the modal
        if (!$this->subjects || $this->subjects->isEmpty()) {
            $this->loadSubjects();
        }
        if (!$this->teachers || $this->teachers->isEmpty()) {
            $this->loadTeachers();
        }
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->reset([
            'subject_id',
            'teacher_id',
            'is_primary',
            'notes'
        ]);
        $this->status = 'active';
        $this->editMode = false;
        $this->assignmentId = null;
    }

    private function loadAssignmentData($subjectId, $teacherId)
    {
        try {
            $subject = Subject::findOrFail($subjectId);
            $teacher = $subject->teachers()->where('teacher_id', $teacherId)->first();

            if ($teacher) {
                $this->subject_id = $subjectId;
                $this->teacher_id = $teacherId;
                $this->is_primary = $teacher->pivot->is_primary ?? false;
                $this->notes = $teacher->pivot->notes ?? '';
                $this->status = $teacher->pivot->status ?? 'active';
                $this->assignmentId = $teacher->pivot->id ?? null;
            }
        } catch (\Exception $e) {
            Log::error('Error loading assignment data: ' . $e->getMessage());
            session()->flash('error', 'Error loading assignment data.');
        }
    }

    public function save()
    {
        $this->validate();

        try {
            $subject = Subject::findOrFail($this->subject_id);

            // Check if assignment already exists
            $existingAssignment = $subject->teachers()->where('teacher_id', $this->teacher_id)->first();

            if ($this->editMode && $existingAssignment) {
                // Update existing assignment
                $subject->teachers()->updateExistingPivot($this->teacher_id, [
                    'is_primary' => $this->is_primary,
                    'notes' => $this->notes,
                    'status' => $this->status,
                    'updated_at' => now(),
                ]);
                session()->flash('message', 'Subject-Teacher assignment updated successfully!');
            } else {
                // Check for duplicate assignment
                if ($existingAssignment) {
                    session()->flash('error', 'This teacher is already assigned to this subject.');
                    return;
                }

                // Create new assignment
                $subject->teachers()->attach($this->teacher_id, [
                    'is_primary' => $this->is_primary,
                    'notes' => $this->notes,
                    'status' => $this->status,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                session()->flash('message', 'Subject-Teacher assignment created successfully!');
            }

            $this->loadSubjectTeachers();
            $this->closeModal();
        } catch (\Exception $e) {
            Log::error('Error saving subject-teacher assignment: ' . $e->getMessage());
            session()->flash('error', 'Error saving assignment: ' . $e->getMessage());
        }
    }

    public function removeAssignment($subjectId, $teacherId)
    {
        try {
            $subject = Subject::findOrFail($subjectId);
            $subject->teachers()->detach($teacherId);

            session()->flash('message', 'Teacher removed from subject successfully!');
            $this->loadSubjectTeachers();
        } catch (\Exception $e) {
            Log::error('Error removing subject-teacher assignment: ' . $e->getMessage());
            session()->flash('error', 'Error removing assignment: ' . $e->getMessage());
        }
    }

    public function toggleStatus($subjectId, $teacherId)
    {
        try {
            $subject = Subject::findOrFail($subjectId);
            $teacher = $subject->teachers()->where('teacher_id', $teacherId)->first();

            if ($teacher) {
                $newStatus = $teacher->pivot->status === 'active' ? 'inactive' : 'active';
                $subject->teachers()->updateExistingPivot($teacherId, [
                    'status' => $newStatus,
                    'updated_at' => now(),
                ]);

                $statusText = $newStatus === 'active' ? 'activated' : 'deactivated';
                session()->flash('message', "Assignment {$statusText} successfully!");
                $this->loadSubjectTeachers();
            }
        } catch (\Exception $e) {
            Log::error('Error toggling assignment status: ' . $e->getMessage());
            session()->flash('error', 'Error updating assignment status: ' . $e->getMessage());
        }
    }

    public function clearFilters()
    {
        $this->selectedSubject = '';
        $this->searchTerm = '';
        $this->resetPage();
        $this->loadSubjectTeachers();
    }

    public function refreshData()
    {
        $this->loadData();
        session()->flash('message', 'Subject-Teacher data refreshed successfully!');
    }

    public function testModal()
    {
        $this->showModal = true;
        session()->flash('message', 'Modal test - showModal is now: ' . ($this->showModal ? 'TRUE' : 'FALSE'));
    }

    public function forceShowModal()
    {
        $this->showModal = true;
    }

    public function hideModal()
    {
        $this->showModal = false;
    }

    public function incrementCounter()
    {
        $this->testCounter++;
        session()->flash('message', 'Counter incremented to: ' . $this->testCounter);
    }

    public function render()
    {
        // Ensure all collections are initialized
        if (!$this->subjects) {
            $this->loadSubjects();
        }
        if (!$this->teachers) {
            $this->loadTeachers();
        }
        if (!$this->subjectTeachers) {
            $this->loadSubjectTeachers();
        }

        return view('livewire.subject-teacher-comp', [
            'subjects' => $this->subjects ?? collect(),
            'teachers' => $this->teachers ?? collect(),
            'subjectTeachers' => $this->subjectTeachers ?? collect()
        ]);
    }
}
