<div class="p-6">
    <!-- Debug Panel -->
    <div class="mb-4 p-3 bg-yellow-100 border border-yellow-400 rounded text-sm">
        <strong>🐛 DEBUG:</strong>
        showRoleModal = <span
            class="font-bold {{ $showRoleModal ? 'text-green-600' : 'text-red-600' }}">{{ $showRoleModal ? 'TRUE' : 'FALSE' }}</span>,
        showUserModal = <span
            class="font-bold {{ $showUserModal ? 'text-green-600' : 'text-red-600' }}">{{ $showUserModal ? 'TRUE' : 'FALSE' }}</span>,
        currentUserRole = {{ $currentUserRole ?? 'NULL' }},
        roles = {{ $roles ? $roles->count() : 'NULL' }},
        users = {{ $users ? $users->count() : 'NULL' }},
        showTestModal = {{ $showTestModal ?? 'NULL' }}
    </div>

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">User Role Management</h1>
            <p class="text-gray-600 mt-1">Manage user roles and permissions with proper hierarchy control</p>
        </div>
        <div class="flex space-x-3">
            <button wire:click="refreshData"
                class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
                <i class="fas fa-sync-alt mr-2"></i>Refresh
            </button>
            <button wire:click="testRoleModal"
                class="px-3 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition-colors">
                Test Role
            </button>
            <button wire:click="testUserModal"
                class="px-3 py-2 bg-purple-500 text-white rounded-lg hover:bg-purple-600 transition-colors">
                Test User
            </button>
            <button wire:click="testBasicModal"
                class="px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
                Basic Test
            </button>
        </div>
    </div>

    <!-- Flash Messages -->
    @if (session()->has('message'))
        <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-md">
            <div class="flex">
                <i class="fas fa-check-circle mr-2 mt-0.5"></i>
                {{ session('message') }}
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-md">
            <div class="flex">
                <i class="fas fa-exclamation-circle mr-2 mt-0.5"></i>
                {{ session('error') }}
            </div>
        </div>
    @endif

    <!-- Roles Table -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden mb-8">
        <div class="flex justify-between items-center px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">System Roles</h3>
            @if($currentUserRole >= 4)
                <button wire:click="openRoleModal"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    <i class="fas fa-plus mr-2"></i>Add Role
                </button>
            @endif
        </div>

        @if($roles && $roles->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                ID
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Role Name
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Description
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Users Count
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($roles as $role)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $this->getRoleColor($role->id) }}">
                                        {{ $role->id }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $role->name }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900">{{ $role->description ?: 'No description' }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $role->users_count }} users</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        @if($currentUserRole >= 4 && $role->id < $currentUserRole)
                                            <button wire:click="openRoleModal({{ $role->id }})"
                                                class="inline-flex items-center px-2 py-1 bg-blue-100 text-blue-700 rounded hover:bg-blue-200 transition-colors"
                                                title="Edit Role">
                                                <i class="fas fa-edit text-xs"></i>
                                            </button>

                                            @if($role->users_count == 0)
                                                <button wire:click="deleteRole({{ $role->id }})"
                                                    onclick="return confirm('Are you sure you want to delete this role?')"
                                                    class="inline-flex items-center px-2 py-1 bg-red-100 text-red-700 rounded hover:bg-red-200 transition-colors"
                                                    title="Delete Role">
                                                    <i class="fas fa-trash text-xs"></i>
                                                </button>
                                            @endif
                                        @else
                                            <span class="text-gray-400 text-xs">No actions available</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-12">
                <div class="text-gray-400 mb-4">
                    <i class="fas fa-user-shield text-6xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No Roles Found</h3>
                <p class="text-gray-600 mb-4">Create your first role to get started.</p>
                @if($currentUserRole >= 4)
                    <button wire:click="openRoleModal"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        <i class="fas fa-plus mr-2"></i>Add Role
                    </button>
                @endif
            </div>
        @endif
    </div>

    <!-- Users Management Section -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <div class="flex justify-between items-center px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">User Management</h3>
            @if($currentUserRole >= 3)
                <button wire:click="openUserModal"
                    class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                    <i class="fas fa-user-plus mr-2"></i>Add User
                </button>
            @endif
        </div>

        <!-- Filters -->
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Search Users</label>
                    <input type="text" wire:model.debounce.300ms="searchTerm" placeholder="Search by name or email..."
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Filter by Role</label>
                    <select wire:model="selectedRole"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">All Roles</option>
                        @if($roles && $roles->count() > 0)
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="flex items-end">
                    <button wire:click="clearFilters"
                        class="w-full px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
                        <i class="fas fa-refresh mr-2"></i>Clear Filters
                    </button>
                </div>
            </div>
        </div>

        @if($users && $users->count() > 0)
            <!-- Users grouped by role -->
            @php
                $usersByRole = $users->groupBy('role_id')->sortKeysDesc();
            @endphp

            @foreach($usersByRole as $roleId => $roleUsers)
                @php
                    $role = $roles->firstWhere('id', $roleId);
                @endphp

                <div class="border-b border-gray-200 last:border-b-0">
                    <div class="px-6 py-3 bg-gray-100">
                        <h4 class="text-md font-semibold text-gray-800 flex items-center">
                            <span
                                class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $this->getRoleColor($roleId) }} mr-3">
                                ID: {{ $roleId }}
                            </span>
                            {{ $role ? $role->name : 'Unknown Role' }}
                            <span class="ml-2 text-sm text-gray-600">({{ $roleUsers->count() }} users)</span>
                        </h4>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        User Details
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Email
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($roleUsers as $user)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <div
                                                        class="h-10 w-10 rounded-full bg-gray-300 flex items-center justify-center">
                                                        <i class="fas fa-user text-gray-600"></i>
                                                    </div>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                                    <div class="text-sm text-gray-500">ID: {{ $user->id }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $user->email }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                                                                                                                                {{ ($user->status ?? 'active') === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ ucfirst($user->status ?? 'active') }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex space-x-2">
                                                @if($user->role_id < $currentUserRole)
                                                    <!-- Edit User -->
                                                    <button wire:click="openUserModal({{ $user->id }})"
                                                        class="inline-flex items-center px-2 py-1 bg-blue-100 text-blue-700 rounded hover:bg-blue-200 transition-colors"
                                                        title="Edit User">
                                                        <i class="fas fa-edit text-xs"></i>
                                                    </button>

                                                    <!-- Role Change Dropdown -->
                                                    <div class="relative inline-block">
                                                        <select
                                                            onchange="if(this.value) @this.call('changeUserRole', {{ $user->id }}, this.value); this.value='';"
                                                            class="text-xs px-2 py-1 bg-yellow-100 text-yellow-700 rounded hover:bg-yellow-200 transition-colors">
                                                            <option value="">Change Role</option>
                                                            @foreach($availableRoles as $availableRole)
                                                                @if($availableRole->id != $user->role_id)
                                                                    <option value="{{ $availableRole->id }}">{{ $availableRole->name }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <!-- Suspend/Activate -->
                                                    @if(($user->status ?? 'active') === 'active')
                                                        <button wire:click="suspendUser({{ $user->id }})"
                                                            onclick="return confirm('Are you sure you want to suspend this user?')"
                                                            class="inline-flex items-center px-2 py-1 bg-orange-100 text-orange-700 rounded hover:bg-orange-200 transition-colors"
                                                            title="Suspend User">
                                                            <i class="fas fa-user-slash text-xs"></i>
                                                        </button>
                                                    @else
                                                        <button wire:click="activateUser({{ $user->id }})"
                                                            class="inline-flex items-center px-2 py-1 bg-green-100 text-green-700 rounded hover:bg-green-200 transition-colors"
                                                            title="Activate User">
                                                            <i class="fas fa-user-check text-xs"></i>
                                                        </button>
                                                    @endif
                                                @else
                                                    <span class="text-gray-400 text-xs">Higher privilege</span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $users->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <div class="text-gray-400 mb-4">
                    <i class="fas fa-users text-6xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No Users Found</h3>
                <p class="text-gray-600 mb-4">Add your first user to get started.</p>
                @if($currentUserRole >= 3)
                    <button wire:click="openUserModal"
                        class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                        <i class="fas fa-user-plus mr-2"></i>Add User
                    </button>
                @endif
            </div>
        @endif
    </div>
</div>

<!-- Role Modal -->
@if($showRoleModal)
    <div class="fixed inset-0 bg-red-500 bg-opacity-75 flex items-center justify-center p-4" style="z-index: 9999;">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md border-4 border-blue-500">
            <!-- Modal Header -->
            <div class="flex justify-between items-center p-6 border-b border-gray-200 bg-blue-100">
                <h3 class="text-xl font-semibold text-gray-900">
                    🎯 ROLE MODAL WORKING! {{ $editMode ? 'Edit Role' : 'Add New Role' }}
                </h3>
                <button wire:click="closeRoleModal" class="text-red-600 hover:text-red-800 text-2xl font-bold">
                    ✕
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-6">
                <div class="space-y-4">
                    <!-- Role Name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Role Name *</label>
                        <input type="text" wire:model="roleName"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Enter role name">
                        @error('roleName') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Role Description -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <textarea wire:model="roleDescription" rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Enter role description..."></textarea>
                        @error('roleDescription') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="flex justify-end items-center p-6 border-t border-gray-200 space-x-3">
                <button wire:click="closeRoleModal"
                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors">
                    Cancel
                </button>
                <button wire:click="saveRole"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    <i class="fas fa-save mr-2"></i>{{ $editMode ? 'Update' : 'Create' }} Role
                </button>
            </div>
        </div>
    </div>
@endif

<!-- User Modal -->
@if($showUserModal)
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md">
            <!-- Modal Header -->
            <div class="flex justify-between items-center p-6 border-b border-gray-200">
                <h3 class="text-xl font-semibold text-gray-900">
                    {{ $editMode ? 'Edit User' : 'Add New User' }}
                </h3>
                <button wire:click="closeUserModal" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-6">
                <div class="space-y-4">
                    <!-- User Name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Name *</label>
                        <input type="text" wire:model="userName"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Enter user name">
                        @error('userName') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- User Email -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                        <input type="email" wire:model="userEmail"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Enter email address">
                        @error('userEmail') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- User Password -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Password {{ $editMode ? '(leave blank to keep current)' : '*' }}
                        </label>
                        <input type="password" wire:model="userPassword"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Enter password">
                        @error('userPassword') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- User Role -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Role *</label>
                        <select wire:model="userRoleId"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select Role</option>
                            @foreach($availableRoles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        @error('userRoleId') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- User Status -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select wire:model="userStatus"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="active">Active</option>
                            <option value="suspended">Suspended</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="flex justify-end items-center p-6 border-t border-gray-200 space-x-3">
                <button wire:click="closeUserModal"
                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors">
                    Cancel
                </button>
                <button wire:click="saveUser"
                    class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                    <i class="fas fa-save mr-2"></i>{{ $editMode ? 'Update' : 'Create' }} User
                </button>
            </div>
        </div>
    </div>
@endif
<!-- Basic
 Test Modal -->
@if($showTestModal)
    <div
        style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255, 0, 0, 0.9); z-index: 99999; display: flex; align-items: center; justify-content: center;">
        <div style="background: white; padding: 20px; border: 5px solid blue; border-radius: 10px; max-width: 400px;">
            <h2 style="color: red; font-size: 24px; font-weight: bold; margin-bottom: 10px;">🚨 BASIC TEST MODAL IS WORKING!
                🚨</h2>
            <p style="margin-bottom: 20px;">If you can see this, the modal system is working!</p>
            <button wire:click="$set('showTestModal', false)"
                style="background: red; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
                Close Test Modal
            </button>
        </div>
    </div>
@endif