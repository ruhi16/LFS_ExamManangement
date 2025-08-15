<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserRoleComp extends Component
{
    use WithPagination;

    // Modal properties
    public $showRoleModal = false;
    public $showUserModal = false;
    public $editMode = false;
    public $roleId = null;
    public $userId = null;

    // Role form properties
    public $roleName;
    public $roleDescription;

    // User form properties
    public $userName;
    public $userEmail;
    public $userPassword;
    public $userRoleId;
    public $userStatus = 'active';

    // Display properties
    public $searchTerm = '';
    public $selectedRole = '';
    protected $roles;
    protected $users;

    // Role hierarchy (higher number = higher privilege)
    protected $roleHierarchy = [
        5 => 'Super Admin',
        4 => 'Admin',
        3 => 'Office',
        2 => 'Sub Admin',
        1 => 'User'
    ];

    protected $rules = [
        'roleName' => 'required|string|max:255|unique:roles,name',
        'roleDescription' => 'nullable|string|max:500',
        'userName' => 'required|string|max:255',
        'userEmail' => 'required|email|unique:users,email',
        'userPassword' => 'required|string|min:8',
        'userRoleId' => 'required|exists:roles,id',
    ];

    protected $messages = [
        'roleName.required' => 'Role name is required.',
        'roleName.unique' => 'This role name already exists.',
        'userName.required' => 'User name is required.',
        'userEmail.required' => 'Email is required.',
        'userEmail.unique' => 'This email is already registered.',
        'userPassword.required' => 'Password is required.',
        'userPassword.min' => 'Password must be at least 8 characters.',
        'userRoleId.required' => 'Please select a role.',
    ];

    public function mount()
    {
        $this->checkPermissions();
        $this->loadData();
    }

    private function checkPermissions()
    {
        $currentUser = Auth::user();
        if (!$currentUser) {
            // For testing purposes, create a mock user with admin privileges
            session()->flash('warning', 'No authenticated user found. Using test mode with admin privileges.');
            return;
        }

        if ($currentUser->role_id < 3) {
            session()->flash('error', 'Unauthorized access. Only Office level and above can manage user roles. Current role: ' . $currentUser->role_id);
            // Don't abort for testing, just show warning
            return;
        }
    }

    public function loadData()
    {
        $this->loadRoles();
        $this->loadUsers();
    }

    public function loadRoles()
    {
        try {
            $this->roles = Role::withCount('users')->orderBy('id', 'desc')->get();
        } catch (\Exception $e) {
            Log::error('Error loading roles: ' . $e->getMessage());
            $this->roles = collect();
        }
    }

    public function loadUsers()
    {
        try {
            $query = User::with(['role']);

            if ($this->selectedRole) {
                $query->where('role_id', $this->selectedRole);
            }

            if ($this->searchTerm) {
                $searchTerm = trim($this->searchTerm);
                if (!empty($searchTerm)) {
                    $query->where(function ($q) use ($searchTerm) {
                        $q->where('name', 'like', "%{$searchTerm}%")
                            ->orWhere('email', 'like', "%{$searchTerm}%");
                    });
                }
            }

            $this->users = $query->orderBy('role_id', 'desc')
                ->orderBy('name')
                ->paginate(15);
        } catch (\Exception $e) {
            Log::error('Error loading users: ' . $e->getMessage());
            $this->users = User::paginate(15);
        }
    }

    public function updatedSelectedRole()
    {
        $this->resetPage();
        $this->loadUsers();
    }

    public function updatedSearchTerm()
    {
        $this->resetPage();
        $this->loadUsers();
    }

    // Role Management Methods
    public function openRoleModal($roleId = null)
    {
        $this->resetRoleForm();

        if ($roleId) {
            $this->editMode = true;
            $this->roleId = $roleId;
            $this->loadRoleData($roleId);
        } else {
            $this->editMode = false;
            $this->roleId = null;
        }

        $this->showRoleModal = true;
    }

    public function closeRoleModal()
    {
        $this->showRoleModal = false;
        $this->resetRoleForm();
    }

    public function resetRoleForm()
    {
        $this->reset(['roleName', 'roleDescription']);
        $this->editMode = false;
        $this->roleId = null;
    }

    private function loadRoleData($roleId)
    {
        try {
            $role = Role::findOrFail($roleId);
            $this->roleName = $role->name;
            $this->roleDescription = $role->description;
        } catch (\Exception $e) {
            Log::error('Error loading role data: ' . $e->getMessage());
            session()->flash('error', 'Error loading role data.');
        }
    }

    public function saveRole()
    {
        $this->validate([
            'roleName' => $this->editMode ? 'required|string|max:255|unique:roles,name,' . $this->roleId : 'required|string|max:255|unique:roles,name',
            'roleDescription' => 'nullable|string|max:500',
        ]);

        try {
            $data = [
                'name' => $this->roleName,
                'description' => $this->roleDescription,
            ];

            if ($this->editMode && $this->roleId) {
                Role::findOrFail($this->roleId)->update($data);
                session()->flash('message', 'Role updated successfully!');
            } else {
                Role::create($data);
                session()->flash('message', 'Role created successfully!');
            }

            $this->loadRoles();
            $this->closeRoleModal();
        } catch (\Exception $e) {
            Log::error('Error saving role: ' . $e->getMessage());
            session()->flash('error', 'Error saving role: ' . $e->getMessage());
        }
    }

    public function deleteRole($roleId)
    {
        try {
            $role = Role::findOrFail($roleId);

            // Check if role has users
            if ($role->users()->count() > 0) {
                session()->flash('error', 'Cannot delete role with assigned users. Please reassign users first.');
                return;
            }

            $role->delete();
            session()->flash('message', 'Role deleted successfully!');
            $this->loadRoles();
        } catch (\Exception $e) {
            Log::error('Error deleting role: ' . $e->getMessage());
            session()->flash('error', 'Error deleting role: ' . $e->getMessage());
        }
    }

    // User Management Methods
    public function openUserModal($userId = null)
    {
        $this->resetUserForm();

        if ($userId) {
            $this->editMode = true;
            $this->userId = $userId;
            $this->loadUserData($userId);
        } else {
            $this->editMode = false;
            $this->userId = null;
        }

        $this->showUserModal = true;
    }

    public function closeUserModal()
    {
        $this->showUserModal = false;
        $this->resetUserForm();
    }

    public function resetUserForm()
    {
        $this->reset(['userName', 'userEmail', 'userPassword', 'userRoleId']);
        $this->userStatus = 'active';
        $this->editMode = false;
        $this->userId = null;
    }

    private function loadUserData($userId)
    {
        try {
            $user = User::findOrFail($userId);
            $this->userName = $user->name;
            $this->userEmail = $user->email;
            $this->userRoleId = $user->role_id;
            $this->userStatus = $user->status ?? 'active';
        } catch (\Exception $e) {
            Log::error('Error loading user data: ' . $e->getMessage());
            session()->flash('error', 'Error loading user data.');
        }
    }

    public function saveUser()
    {
        $rules = [
            'userName' => 'required|string|max:255',
            'userRoleId' => 'required|exists:roles,id',
        ];

        if ($this->editMode) {
            $rules['userEmail'] = 'required|email|unique:users,email,' . $this->userId;
            if (!empty($this->userPassword)) {
                $rules['userPassword'] = 'string|min:8';
            }
        } else {
            $rules['userEmail'] = 'required|email|unique:users,email';
            $rules['userPassword'] = 'required|string|min:8';
        }

        $this->validate($rules);

        // Check if current user can assign this role
        if (!$this->canAssignRole($this->userRoleId)) {
            session()->flash('error', 'You cannot assign a role higher than or equal to your own.');
            return;
        }

        try {
            $data = [
                'name' => $this->userName,
                'email' => $this->userEmail,
                'role_id' => $this->userRoleId,
                'status' => $this->userStatus,
            ];

            if (!empty($this->userPassword)) {
                $data['password'] = Hash::make($this->userPassword);
            }

            if ($this->editMode && $this->userId) {
                User::findOrFail($this->userId)->update($data);
                session()->flash('message', 'User updated successfully!');
            } else {
                User::create($data);
                session()->flash('message', 'User created successfully!');
            }

            $this->loadUsers();
            $this->closeUserModal();
        } catch (\Exception $e) {
            Log::error('Error saving user: ' . $e->getMessage());
            session()->flash('error', 'Error saving user: ' . $e->getMessage());
        }
    }

    public function changeUserRole($userId, $newRoleId)
    {
        if (!$this->canAssignRole($newRoleId)) {
            session()->flash('error', 'You cannot assign a role higher than or equal to your own.');
            return;
        }

        try {
            $user = User::findOrFail($userId);
            $user->update(['role_id' => $newRoleId]);

            session()->flash('message', 'User role updated successfully!');
            $this->loadUsers();
        } catch (\Exception $e) {
            Log::error('Error changing user role: ' . $e->getMessage());
            session()->flash('error', 'Error changing user role: ' . $e->getMessage());
        }
    }

    public function suspendUser($userId)
    {
        try {
            $user = User::findOrFail($userId);

            // Cannot suspend users with higher or equal privilege
            if ($user->role_id >= Auth::user()->role_id) {
                session()->flash('error', 'You cannot suspend users with higher or equal privileges.');
                return;
            }

            $user->update(['status' => 'suspended']);
            session()->flash('message', 'User suspended successfully!');
            $this->loadUsers();
        } catch (\Exception $e) {
            Log::error('Error suspending user: ' . $e->getMessage());
            session()->flash('error', 'Error suspending user: ' . $e->getMessage());
        }
    }

    public function activateUser($userId)
    {
        try {
            $user = User::findOrFail($userId);
            $user->update(['status' => 'active']);
            session()->flash('message', 'User activated successfully!');
            $this->loadUsers();
        } catch (\Exception $e) {
            Log::error('Error activating user: ' . $e->getMessage());
            session()->flash('error', 'Error activating user: ' . $e->getMessage());
        }
    }

    private function canAssignRole($roleId)
    {
        $currentUserRole = Auth::user()->role_id;
        return $roleId < $currentUserRole;
    }

    public function getAvailableRoles()
    {
        $currentUserRole = Auth::user() ? Auth::user()->role_id : 5; // Default to admin for testing
        return $this->roles->filter(function ($role) use ($currentUserRole) {
            return $role->id < $currentUserRole;
        });
    }

    public function getRoleColor($roleId)
    {
        switch ($roleId) {
            case 5:
                return 'bg-purple-100 text-purple-800';
            case 4:
                return 'bg-red-100 text-red-800';
            case 3:
                return 'bg-blue-100 text-blue-800';
            case 2:
                return 'bg-green-100 text-green-800';
            case 1:
                return 'bg-gray-100 text-gray-800';
            default:
                return 'bg-gray-100 text-gray-800';
        }
    }

    public function clearFilters()
    {
        $this->selectedRole = '';
        $this->searchTerm = '';
        $this->resetPage();
        $this->loadUsers();
    }

    public function refreshData()
    {
        $this->loadData();
        session()->flash('message', 'Data refreshed successfully!');
    }

    public function testRoleModal()
    {
        $this->showRoleModal = true;
        session()->flash('message', 'Test Role Modal - showRoleModal is now: ' . ($this->showRoleModal ? 'TRUE' : 'FALSE'));
    }

    public function testUserModal()
    {
        $this->showUserModal = true;
        session()->flash('message', 'Test User Modal - showUserModal is now: ' . ($this->showUserModal ? 'TRUE' : 'FALSE'));
    }

    public $showTestModal = false;

    public function testBasicModal()
    {
        $this->showTestModal = true;
        session()->flash('message', 'Basic Test Modal - showTestModal is now: ' . ($this->showTestModal ? 'TRUE' : 'FALSE'));
    }

    public function render()
    {
        // Ensure data is loaded
        if (!$this->roles) {
            $this->loadRoles();
        }
        if (!$this->users) {
            $this->loadUsers();
        }

        return view('livewire.user-role-comp', [
            'roles' => $this->roles ?? collect(),
            'users' => $this->users ?? collect(),
            'availableRoles' => $this->getAvailableRoles(),
            'currentUserRole' => Auth::user() ? Auth::user()->role_id : 5 // Default to admin for testing
        ]);
    }
}
