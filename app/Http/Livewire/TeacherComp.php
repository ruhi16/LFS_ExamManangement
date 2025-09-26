<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\Teacher;
use App\Models\Subject;
use App\Models\User;
use App\Models\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class TeacherComp extends Component{

    use WithFileUploads, WithPagination;

    // Modal properties
    public $showModal = false;
    public $editMode = false;
    public $teacherId = null;

    // Form properties
    public $name;
    public $nickName;
    public $mobno;
    public $desig = 'Assistant Teacher';
    public $hqual;
    public $train_qual;
    public $extra_qual;
    public $main_subject_id;
    public $notes;
    public $img_ref;
    public $profile_image;
    public $status = 'active';
    public $remark;
    public $user_id;
    public $session_id;
    public $school_id;

    // Display properties
    public $selectedCategory = '';
    public $searchTerm = '';
    protected $subjects;

    // Teacher categories
    public $teacherCategories = [
        'Administrative Head' => ['Principal', 'Vice Principal', 'Head Master', 'Assistant Head Master'],
        'Senior Teachers' => ['Senior Teacher', 'Head of Department', 'Subject Coordinator'],
        'Regular Teachers' => ['Assistant Teacher', 'Teacher', 'Junior Teacher'],
        'Support Staff' => ['Lab Assistant', 'Library Assistant', 'Sports Teacher', 'Art Teacher'],
        'Temporary Staff' => ['Guest Teacher', 'Substitute Teacher', 'Part-time Teacher']
    ];

    // protected $rules = [
    //     'name' => 'required|string|max:255',
    //     'nickName' => 'nullable|string|max:100',
    //     'mobno' => 'nullable|string|max:15',
    //     'desig' => 'required|string|max:255',
    //     'hqual' => 'nullable|string|max:255',
    //     'train_qual' => 'nullable|string|max:255',
    //     'extra_qual' => 'nullable|string|max:255',
    //     'main_subject_id' => 'nullable|exists:subjects,id',
    //     'notes' => 'nullable|string|max:1000',
    //     'profile_image' => 'nullable|image|max:2048',
    //     'status' => 'required|in:active,inactive,retired,transferred',
    //     'remark' => 'nullable|string|max:500',
    //     'user_id' => 'required|integer',
    //     'session_id' => 'required|integer',
    //     'school_id' => 'required|integer',
    // ];

    protected $rules = [
        'name' => 'required|string|max:255',
        'nickName' => 'nullable|string|max:100',
        'mobno' => 'nullable|string|max:15',
        'desig' => 'required|string|max:255',
        'hqual' => 'nullable|string|max:255',
        'train_qual' => 'nullable|string|max:255',
        'extra_qual' => 'nullable|string|max:255',
        'main_subject_id' => 'nullable|exists:subjects,id',
        'notes' => 'nullable|string|max:1000',
        'profile_image' => 'nullable|image|max:2048',
        'status' => 'required|in:active,inactive,retired,transferred',
        'remark' => 'nullable|string|max:500',
        'user_id' => 'required|integer',
        'session_id' => 'required|integer',
        'school_id' => 'required|integer',
    ];

    protected $messages = [
        'name.required' => 'Teacher name is required.',
        'desig.required' => 'Designation is required.',
        'main_subject_id.exists' => 'Please select a valid subject.',
        'profile_image.image' => 'Profile image must be a valid image file.',
        'profile_image.max' => 'Profile image must not exceed 2MB.',
    ];

    public function mount()
    {
        try {
            $this->initializeDefaults();
            $this->loadSubjects();
        } catch (\Exception $e) {
            Log::error('Error in TeacherComp mount: ' . $e->getMessage());
            session()->flash('error', 'Error loading component: ' . $e->getMessage());

            // Initialize empty collections as fallback
            $this->subjects = collect();
        }
    }

    private function initializeDefaults()
    {
        // Set current session
        $currentSession = Session::currentlyActive()->first();      //Session::where('status', 'active')->first();
        $this->session_id = $currentSession ? $currentSession->id : 1;

        // Set current school (assuming there's a way to get current school)
        $this->school_id = 1; // This should be set based on current user's school

        // Set current user
        $this->user_id = auth()->id() ?? 1;

        // dd($this->session_id, $this->school_id, $this->user_id);
    }

    public function loadSubjects()
    {
        try {
            $this->subjects = Subject::orderBy('id')->get();
        } catch (\Exception $e) {
            Log::error('Error loading subjects: ' . $e->getMessage());
            $this->subjects = collect();
        }
    }

    public function updatedSelectedCategory()
    {
        $this->resetPage();
    }

    public function updatedSearchTerm()
    {
        $this->resetPage();
    }

    public function openModal($teacherId = null)
    {

        $this->resetForm();

        if ($teacherId) {
            $this->editMode = true;
            $this->teacherId = $teacherId;
            $this->loadTeacherData($teacherId);
        } else {
            $this->editMode = false;
            $this->teacherId = null;
        }

        $this->showModal = true;

        // Ensure subjects are loaded for the modal
        if (!$this->subjects || $this->subjects->isEmpty()) {
            $this->loadSubjects();
        }
        // dd($this->teachers, $this->showModal);
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->reset([
            'name',
            'nickName',
            'mobno',
            'hqual',
            'train_qual',
            'extra_qual',
            'main_subject_id',
            'notes',
            'profile_image',
            'remark'
        ]);
        $this->desig = 'Assistant Teacher';
        $this->status = 'active';
        $this->user_id = auth()->id() ?? 1;
        $this->session_id = null; // Will be set from current session
        $this->school_id = null; // Will be set from current school
        $this->editMode = false;
        $this->teacherId = null;
    }

    private function loadTeacherData($teacherId)
    {
        // dd('Test');
        try {
            $teacher = Teacher::findOrFail($teacherId);

            $this->name = $teacher->name;
            $this->nickName = $teacher->nickName;
            $this->mobno = $teacher->mobno;
            $this->desig = $teacher->desig;
            $this->hqual = $teacher->hqual;
            $this->train_qual = $teacher->train_qual;
            $this->extra_qual = $teacher->extra_qual;
            $this->main_subject_id = $teacher->main_subject_id;
            $this->notes = $teacher->notes;
            $this->img_ref = $teacher->img_ref;
            $this->status = $teacher->status ?? 'active';
            $this->remark = $teacher->remark;
            $this->user_id = $teacher->user_id;
            $this->session_id = $teacher->session_id;
            $this->school_id = $teacher->school_id;
        } catch (\Exception $e) {
            Log::error('Error loading teacher data: ' . $e->getMessage());
            session()->flash('error', 'Error loading teacher data.');
        }
    }

    public function save(){
        
        // dd('Before validation');
        // $validationResult = $this->validate();
        try{
            $this->validate();
        }catch(ValidationException $e){
            Log::error('Error saving teacher: ' . $e->getMessage());
            session()->flash('error', 'Error saving teacher: ' . $e->getMessage() );
        }
        // dd('Before validation');
        
        
        // dd($validatedData);
        $validatedData = null;
        try{
            // dd('Before validation');
            // $validatedData = $this->validate();
            // dd('After validation', $validatedData);


            $data = [
                'name' => $this->name,
                'nickName' => $this->nickName,
                'mobno' => $this->mobno,
                'desig' => $this->desig,
                'hqual' => $this->hqual,
                'train_qual' => $this->train_qual,
                'extra_qual' => $this->extra_qual,
                'main_subject_id' => $this->main_subject_id ?: null,
                'notes' => $this->notes,
                'status' => $this->status,
                'remark' => $this->remark,
                'user_id' => $this->user_id ?: auth()->id(),
                'session_id' => Session::currentlyActive()->first()->id, // Fixed: Added missing colon
                'school_id' => $this->school_id ?: 1,
            ];

            // dd('Without Validation:', $data);

            // Handle profile image upload
            if ($this->profile_image) {
                $data['img_ref'] = $this->profile_image->store('teacher-profiles', 'public');
            }
            
            // dd('After validation, with data:',$data);
            
            if ($this->editMode && $this->teacherId) {
                $teacher = Teacher::findOrFail($this->teacherId);

                // Delete old image if new one is uploaded
                if ($this->profile_image && $teacher->img_ref) {
                    Storage::disk('public')->delete($teacher->img_ref);
                }
                
                
                $teacher->update($data);
                $this->closeModal();
                session()->flash('message', 'Teacher updated successfully!');
            } else {
                Teacher::create($data);
                session()->flash('message', 'Teacher created successfully!');
            }

            $this->closeModal();
       
        } catch (\Exception $e) {
            Log::error('Error saving teacher: ' . $e->getMessage());
            session()->flash('error', 'Error saving teacher: ' . $e->getMessage() . $validatedData);
        }
    }

    public function toggleStatus($teacherId)
    {
        try {
            $teacher = Teacher::findOrFail($teacherId);

            // Toggle between active and inactive
            $newStatus = $teacher->status === 'active' ? 'inactive' : 'active';
            $teacher->update(['status' => $newStatus]);

            $statusText = $newStatus === 'active' ? 'activated' : 'suspended';
            session()->flash('message', "Teacher {$statusText} successfully!");
        } catch (\Exception $e) {
            Log::error('Error toggling teacher status: ' . $e->getMessage());
            session()->flash('error', 'Error updating teacher status: ' . $e->getMessage());
        }
    }

    public function delete($teacherId)
    {
        try {
            $teacher = Teacher::findOrFail($teacherId);

            // Check if teacher has related data
            $hasRelatedData = $teacher->Myclassteachers()->exists() ||
                $teacher->Answerscriptdistributions()->exists();

            if ($hasRelatedData) {
                session()->flash('error', 'Cannot delete teacher with related assignments. Please remove assignments first.');
                return;
            }

            // Delete profile image if exists
            if ($teacher->img_ref) {
                Storage::disk('public')->delete($teacher->img_ref);
            }

            $teacher->delete();
            session()->flash('message', 'Teacher deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Error deleting teacher: ' . $e->getMessage());
            session()->flash('error', 'Error deleting teacher: ' . $e->getMessage());
        }
    }

    public function getStatusColor($status)
    {
        switch ($status) {
            case 'active':
                return 'bg-green-100 text-green-800';
            case 'inactive':
                return 'bg-gray-100 text-gray-800';
            case 'retired':
                return 'bg-blue-100 text-blue-800';
            case 'transferred':
                return 'bg-yellow-100 text-yellow-800';
            default:
                return 'bg-gray-100 text-gray-800';
        }
    }

    public function getCategoryColor($category)
    {
        switch ($category) {
            case 'Administrative Head':
                return 'bg-purple-100 text-purple-800';
            case 'Senior Teachers':
                return 'bg-blue-100 text-blue-800';
            case 'Regular Teachers':
                return 'bg-green-100 text-green-800';
            case 'Support Staff':
                return 'bg-orange-100 text-orange-800';
            case 'Temporary Staff':
                return 'bg-gray-100 text-gray-800';
            default:
                return 'bg-gray-100 text-gray-800';
        }
    }

    public function getTeacherCategory($designation)
    {
        foreach ($this->teacherCategories as $category => $designations) {
            if (in_array($designation, $designations)) {
                return $category;
            }
        }
        return 'Other';
    }

    public function clearFilters()
    {
        $this->selectedCategory = '';
        $this->searchTerm = '';
        $this->resetPage();
    }

    public function refreshData()
    {
        $this->loadSubjects();
        session()->flash('message', 'Teacher data refreshed successfully!');
    }

    public function testModal()
    {
        $this->showModal = true;
        session()->flash('message', 'Test Modal - showModal is now: ' . ($this->showModal ? 'TRUE' : 'FALSE'));
    }

    public function render()
    {
        // Ensure subjects are loaded
        if (!$this->subjects || $this->subjects->isEmpty()) {
            $this->loadSubjects();
        }

        // Load teachers directly in render method for proper pagination
        $query = Teacher::with(['subject']);
        
        if ($this->selectedCategory) {
            $categoryDesignations = $this->teacherCategories[$this->selectedCategory] ?? [];
            if (!empty($categoryDesignations)) {
                $query->whereIn('desig', $categoryDesignations);
            }
        }
        
        if ($this->searchTerm) {
            $searchTerm = trim($this->searchTerm);
            if (!empty($searchTerm)) {
                $query->where(function ($q) use ($searchTerm) {
                    $q->where('name', 'like', "%{$searchTerm}%")
                        ->orWhere('nickName', 'like', "%{$searchTerm}%")
                        ->orWhere('mobno', 'like', "%{$searchTerm}%")
                        ->orWhere('desig', 'like', "%{$searchTerm}%");
                });
            }
        }
        
        $teachers = $query->orderBy('id')->paginate(10);

        return view('livewire.teacher-comp', [
            'teachers' => $teachers,
            'subjects' => $this->subjects ?? collect()
        ]);
    }
}
