<div>

<div class="flex h-[calc(100vh_-_72px)] bg-gray-100 overflow-hidden">
    <!-- Sidebar -->
    <div class="w-64 bg-white shadow-lg border-r border-gray-200 flex flex-col">
        <!-- Logo -->
        <div class="flex items-center justify-center h-16 bg-gradient-to-r from-blue-600 to-blue-700 text-white">
            <div class="flex items-center space-x-2">
                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 2L3 7v11a1 1 0 001 1h3v-6a1 1 0 011-1h4a1 1 0 011 1v6h3a1 1 0 001-1V7l-7-5z"/>
                </svg>
                <span class="text-xl font-semibold">AdminPanel</span>
            </div>
        </div>
        
        <!-- Navigation -->
        <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
            <!-- Dashboard -->
            <div>
                <button 
                    wire:click="setActiveMenu('dashboard')" 
                    class="w-full flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors menu-item-hover
                        {{ $activeMenu === 'dashboard' ? 'bg-blue-100 text-blue-700 border-r-2 border-blue-600' : 'text-gray-700 hover:text-blue-600' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z"/>
                    </svg>
                    Dashboard
                </button>
            </div>

            <!-- Users Management -->
            <div>
                <button 
                    wire:click="toggleSubmenu('users')" 
                    class="w-full flex items-center justify-between px-3 py-2 text-sm font-medium rounded-lg transition-colors menu-item-hover
                        {{ in_array('users', $openSubmenus) ? 'bg-gray-100 text-gray-900' : 'text-gray-700 hover:text-blue-600' }}">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                        </svg>
                        Users
                    </div>
                    <svg class="w-4 h-4 transition-transform {{ in_array('users', $openSubmenus) ? 'rotate-180' : '' }}" 
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                
                <!-- Users Submenu -->
                <div class="submenu-enter {{ in_array('users', $openSubmenus) ? 'open' : '' }}">
                    <div class="ml-6 mt-2 space-y-1">
                        <button 
                            wire:click="setActiveMenu('users', 'all-users')"
                            class="w-full flex items-center px-3 py-2 text-sm rounded-lg transition-colors
                                {{ $activeMenu === 'all-users' ? 'bg-blue-100 text-blue-700 border-r-2 border-blue-600' : 'text-gray-600 hover:text-blue-600 hover:bg-gray-50' }}">
                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v6a2 2 0 002 2h6a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                            All Users
                        </button>
                        <button 
                            wire:click="setActiveMenu('users', 'add-user')"
                            class="w-full flex items-center px-3 py-2 text-sm rounded-lg transition-colors
                                {{ $activeMenu === 'add-user' ? 'bg-blue-100 text-blue-700 border-r-2 border-blue-600' : 'text-gray-600 hover:text-blue-600 hover:bg-gray-50' }}">
                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Add User
                        </button>
                        <button 
                            wire:click="setActiveMenu('users', 'user-roles')"
                            class="w-full flex items-center px-3 py-2 text-sm rounded-lg transition-colors
                                {{ $activeMenu === 'user-roles' ? 'bg-blue-100 text-blue-700 border-r-2 border-blue-600' : 'text-gray-600 hover:text-blue-600 hover:bg-gray-50' }}">
                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                            User Roles
                        </button>
                    </div>
                </div>
            </div>

            <!-- Content Management -->
            <div>
                <button 
                    wire:click="toggleSubmenu('content')" 
                    class="w-full flex items-center justify-between px-3 py-2 text-sm font-medium rounded-lg transition-colors menu-item-hover
                        {{ in_array('content', $openSubmenus) ? 'bg-gray-100 text-gray-900' : 'text-gray-700 hover:text-blue-600' }}">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14-7H5a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2V6a2 2 0 00-2-2z"/>
                        </svg>
                        Content
                    </div>
                    <svg class="w-4 h-4 transition-transform {{ in_array('content', $openSubmenus) ? 'rotate-180' : '' }}" 
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                
                <!-- Content Submenu -->
                <div class="submenu-enter {{ in_array('content', $openSubmenus) ? 'open' : '' }}">
                    <div class="ml-6 mt-2 space-y-1">
                        <button 
                            wire:click="setActiveMenu('content', 'posts')"
                            class="w-full flex items-center px-3 py-2 text-sm rounded-lg transition-colors
                                {{ $activeMenu === 'posts' ? 'bg-blue-100 text-blue-700 border-r-2 border-blue-600' : 'text-gray-600 hover:text-blue-600 hover:bg-gray-50' }}">
                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Posts
                        </button>
                        <button 
                            wire:click="setActiveMenu('content', 'pages')"
                            class="w-full flex items-center px-3 py-2 text-sm rounded-lg transition-colors
                                {{ $activeMenu === 'pages' ? 'bg-blue-100 text-blue-700 border-r-2 border-blue-600' : 'text-gray-600 hover:text-blue-600 hover:bg-gray-50' }}">
                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                            </svg>
                            Pages
                        </button>
                        <button 
                            wire:click="setActiveMenu('content', 'categories')"
                            class="w-full flex items-center px-3 py-2 text-sm rounded-lg transition-colors
                                {{ $activeMenu === 'categories' ? 'bg-blue-100 text-blue-700 border-r-2 border-blue-600' : 'text-gray-600 hover:text-blue-600 hover:bg-gray-50' }}">
                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                            Categories
                        </button>
                    </div>
                </div>
            </div>

            <!-- Settings -->
            <div>
                <button 
                    wire:click="toggleSubmenu('settings')" 
                    class="w-full flex items-center justify-between px-3 py-2 text-sm font-medium rounded-lg transition-colors menu-item-hover
                        {{ in_array('settings', $openSubmenus) ? 'bg-gray-100 text-gray-900' : 'text-gray-700 hover:text-blue-600' }}">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Settings
                    </div>
                    <svg class="w-4 h-4 transition-transform {{ in_array('settings', $openSubmenus) ? 'rotate-180' : '' }}" 
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                
                <!-- Settings Submenu -->
                <div class="submenu-enter {{ in_array('settings', $openSubmenus) ? 'open' : '' }}">
                    <div class="ml-6 mt-2 space-y-1">
                        <button 
                            wire:click="setActiveMenu('settings', 'general')"
                            class="w-full flex items-center px-3 py-2 text-sm rounded-lg transition-colors
                                {{ $activeMenu === 'general' ? 'bg-blue-100 text-blue-700 border-r-2 border-blue-600' : 'text-gray-600 hover:text-blue-600 hover:bg-gray-50' }}">
                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"/>
                            </svg>
                            General
                        </button>
                        <button 
                            wire:click="setActiveMenu('settings', 'security')"
                            class="w-full flex items-center px-3 py-2 text-sm rounded-lg transition-colors
                                {{ $activeMenu === 'security' ? 'bg-blue-100 text-blue-700 border-r-2 border-blue-600' : 'text-gray-600 hover:text-blue-600 hover:bg-gray-50' }}">
                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            Security
                        </button>
                    </div>
                </div>
            </div>

            <!-- Analytics -->
            <div>
                <button 
                    wire:click="setActiveMenu('analytics')" 
                    class="w-full flex items-center px-3 py-2 text-sm font-medium rounded-lg transition-colors menu-item-hover
                        {{ $activeMenu === 'analytics' ? 'bg-blue-100 text-blue-700 border-r-2 border-blue-600' : 'text-gray-700 hover:text-blue-600' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    Analytics
                </button>
            </div>
        </nav>

        <!-- User Profile -->
        <div class="border-t border-gray-200 p-4">
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                    <span class="text-sm font-medium text-white">JD</span>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900 truncate">John Doe</p>
                    <p class="text-xs text-gray-500 truncate">admin@example.com</p>
                </div>
                <button class="text-gray-400 hover:text-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Header -->
        <header class="bg-white shadow-sm border-b border-gray-200">
            <div class="flex items-center justify-between px-6 py-4">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900 capitalize">
                        {{ str_replace('-', ' ', $activeMenu) }}
                    </h1>
                    <p class="text-sm text-gray-500 mt-1">
                        @if($activeMenu === 'dashboard')
                            Welcome back! Here's what's happening with your application.
                        @elseif($activeMenu === 'all-users')
                            Manage all system users and their permissions.
                        @elseif($activeMenu === 'add-user')
                            Create new user accounts for the system.
                        @elseif($activeMenu === 'user-roles')
                            Configure user roles and permissions.
                        @elseif($activeMenu === 'posts')
                            Manage blog posts and articles.
                        @elseif($activeMenu === 'pages')
                            Create and edit static pages.
                        @elseif($activeMenu === 'categories')
                            Organize content with categories.
                        @elseif($activeMenu === 'general')
                            Configure general application settings.
                        @elseif($activeMenu === 'security')
                            Manage security and authentication settings.
                        @elseif($activeMenu === 'analytics')
                            View application analytics and reports.
                        @endif
                    </p>
                </div>
                <div class="flex items-center space-x-4">
                    <button class="p-2 text-gray-400 hover:text-gray-600 relative">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM12 8v8m-6-4h12"/>
                        </svg>
                        <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                    </button>
                    <button class="p-2 text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="flex-1 overflow-y-auto p-6">
            <div class="max-w-8xl mx-auto">
                @if($activeMenu === 'dashboard')
                    <!-- Dashboard Content -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                        <!-- Stats Cards -->
                        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                            <div class="flex items-center">
                                <div class="p-2 bg-blue-100 rounded-lg">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-2xl font-semibold text-gray-900">1,247</p>
                                    <p class="text-sm text-gray-500">Total Users</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                            <div class="flex items-center">
                                <div class="p-2 bg-green-100 rounded-lg">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-2xl font-semibold text-gray-900">89</p>
                                    <p class="text-sm text-gray-500">Active Posts</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                            <div class="flex items-center">
                                <div class="p-2 bg-purple-100 rounded-lg">
                                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-2xl font-semibold text-gray-900">24.7k</p>
                                    <p class="text-sm text-gray-500">Page Views</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                            <div class="flex items-center">
                                <div class="p-2 bg-orange-100 rounded-lg">
                                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-2xl font-semibold text-gray-900">$12,847</p>
                                    <p class="text-sm text-gray-500">Revenue</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Users</h3>
                            <div class="space-y-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                                        <span class="text-sm font-medium text-white">AS</span>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-900">Alice Smith</p>
                                        <p class="text-xs text-gray-500">alice@example.com</p>
                                    </div>
                                    <span class="text-xs text-gray-500">2 hours ago</span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                                        <span class="text-sm font-medium text-white">BJ</span>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-900">Bob Johnson</p>
                                        <p class="text-xs text-gray-500">bob@example.com</p>
                                    </div>
                                    <span class="text-xs text-gray-500">5 hours ago</span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center">
                                        <span class="text-sm font-medium text-white">CW</span>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-900">Carol Wilson</p>
                                        <p class="text-xs text-gray-500">carol@example.com</p>
                                    </div>
                                    <span class="text-xs text-gray-500">1 day ago</span>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                            <div class="grid grid-cols-2 gap-4">
                                <button class="p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-blue-400 hover:bg-blue-50 transition-colors">
                                    <svg class="w-8 h-8 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                    </svg>
                                    <span class="text-sm text-gray-600">Add User</span>
                                </button>
                                <button class="p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-green-400 hover:bg-green-50 transition-colors">
                                    <svg class="w-8 h-8 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    <span class="text-sm text-gray-600">New Post</span>
                                </button>
                                <button class="p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-purple-400 hover:bg-purple-50 transition-colors">
                                    <svg class="w-8 h-8 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                                    </svg>
                                    <span class="text-sm text-gray-600">View Reports</span>
                                </button>
                                <button class="p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-orange-400 hover:bg-orange-50 transition-colors">
                                    <svg class="w-8 h-8 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    <span class="text-sm text-gray-600">Settings</span>
                                </button>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Generic Content Area -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8">
                        <div class="text-center">
                            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2 capitalize">
                                {{ str_replace('-', ' ', $activeMenu) }} Page
                            </h3>
                            <p class="text-gray-500 mb-6">
                                This is the {{ str_replace('-', ' ', $activeMenu) }} section. Content for this page would be implemented here.
                            </p>
                            <button class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                                Get Started
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </main>
    </div>
</div>


{{-- <div class="flex-1 p-6 overflow-y-auto">
    <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md p-6">
        <!-- Form Header -->
        <div class="mb-6 border-b border-gray-200 pb-4">
            <h2 class="text-2xl font-semibold text-gray-800">Create New Item</h2>
            <p class="text-sm text-gray-500 mt-1">Fill in the form below to add a new item</p>
        </div>

        <!-- Form Content -->
        <form wire:submit.prevent="submitForm">
            <!-- Name Field -->
            <div class="mb-6">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                <input 
                    type="text" 
                    id="name" 
                    wire:model="name"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Enter name"
                >
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email Field -->
            <div class="mb-6">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input 
                    type="email" 
                    id="email" 
                    wire:model="email"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Enter email"
                >
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Select Dropdown -->
            <div class="mb-6">
                <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                <select 
                    id="role" 
                    wire:model="role"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                >
                    <option value="">Select a role</option>
                    <option value="admin">Admin</option>
                    <option value="editor">Editor</option>
                    <option value="viewer">Viewer</option>
                </select>
                @error('role')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Checkbox -->
            <div class="mb-6">
                <div class="flex items-center">
                    <input 
                        id="is_active" 
                        type="checkbox" 
                        wire:model="is_active"
                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                    >
                    <label for="is_active" class="ml-2 block text-sm text-gray-700">Active User</label>
                </div>
            </div>

            <!-- Textarea -->
            <div class="mb-6">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea 
                    id="description" 
                    wire:model="description"
                    rows="3"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Enter description"
                ></textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
                <button 
                    type="button" 
                    wire:click="cancel"
                    class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                >
                    Cancel
                </button>
                <button 
                    type="submit" 
                    class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                >
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div> --}}



@livewire('contact')

{{-- @livewire('about') --}}

</div>