<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Home extends Component
{

    public $activeMenu = 'dashboard';
    public $openSubmenus = [];

    protected $menuItems = [
        'dashboard' => [
            'label' => 'Dashboard',
            'icon' => 'M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z',
            'component' => 'dashboard-comp',
            'description' => 'Welcome back! Here\'s what\'s happening with your application.'
        ],
        'users' => [
            'label' => 'Users',
            'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z',
            'description' => 'Manage all system users and their permissions.',
            'subitems' => [
                'MyClass' => [
                    'label' => 'My Class',
                    'icon' => 'M9 5H7a2 2 0 00-2 2v6a2 2 0 002 2h6a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2',
                    'component' => 'myclass-comp',
                    'description' => 'Manage school classes and their configurations.'
                ],
                'myclass-subjects' => [
                    'label' => 'Class Subjects',
                    'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253',
                    'component' => 'myclass-subject-comp',
                    'description' => 'Assign subjects to classes and manage their configurations.'
                ],
                'Exam-Settings' => [
                    'label' => 'Exam Settings',
                    'icon' => 'M12 6v6m0 0v6m0-6h6m-6 0H6',
                    'component' => 'exam-settings',
                    'description' => 'Configure exam settings for classes and subjects.'
                ],
                'exam-settings-view' => [
                    'label' => 'Exam Settings View',
                    'icon' => 'M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z',
                    'component' => 'exam-settings-view',
                    'description' => 'View and review exam configurations.'
                ],
                'exam-settings-fmpm' => [
                    'label' => 'Marks & Time Config',
                    'icon' => 'M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z',
                    'component' => 'exam-settings-fmpm-comp',
                    'description' => 'Configure full marks, pass marks, and time allocation for exams.'
                ],
                'exam-names' => [
                    'label' => 'Exam Names',
                    'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
                    'component' => 'exam-name-comp',
                    'description' => 'Manage exam names and their configurations.'
                ],
                'exam-types' => [
                    'label' => 'Exam Types',
                    'icon' => 'M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z',
                    'component' => 'exam-type-comp',
                    'description' => 'Manage exam types and their configurations.'
                ],
                'exam-parts' => [
                    'label' => 'Exam Parts',
                    'icon' => 'M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z',
                    'component' => 'exam-part-comp',
                    'description' => 'Manage exam parts and their configurations.'
                ],
                'exam-modes' => [
                    'label' => 'Exam Modes',
                    'icon' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z',
                    'component' => 'exam-mode-comp',
                    'description' => 'Manage exam modes and their configurations.'
                ],
                'student-cr' => [
                    'label' => 'Student Class Records',
                    'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z',
                    'component' => 'student-cr-comp',
                    'description' => 'View and manage class-wise student information from student database.'
                ],
                'answer-script-distribution' => [
                    'label' => 'Answer Script Distribution',
                    'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
                    'component' => 'answer-script-distribution-comp',
                    'description' => 'Assign teachers to evaluate answer scripts for different exam types and parts.'
                ],
                'marks-entry' => [
                    'label' => 'Marks Entry',
                    'icon' => 'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z',
                    'component' => 'marks-entry-comp',
                    'description' => 'Enter marks for students across different exam types and parts.'
                ],
                'logs-viewer' => [
                    'label' => 'System Logs',
                    'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
                    'component' => 'logs-viewer-comp',
                    'description' => 'Monitor and analyze application logs for debugging and system health.'
                ],
                'class-exam-subject' => [
                    'label' => 'Class Exam Subjects',
                    'icon' => 'M9 5H7a2 2 0 00-2 2v6a2 2 0 002 2h6a2 2 0 002-2V7a2 2 0 00-2-2H9z M9 5a2 2 0 012-2h2a2 2 0 012 2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4',
                    'component' => 'class-exam-subject-comp',
                    'description' => 'Configure which subjects are available for each class, exam, and exam type combination.'
                ],
                'mark-register' => [
                    'label' => 'Mark Register',
                    'icon' => 'M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
                    'component' => 'mark-register-comp',
                    'description' => 'View comprehensive class-wise mark register with all student marks across exam types and parts.'
                ],
                'user-roles' => [
                    'label' => 'User Roles',
                    'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z',
                    'description' => 'Configure user roles and permissions.'
                ]
            ]
        ],
        'content' => [
            'label' => 'Content',
            'icon' => 'M19 11H5m14-7H5a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2V6a2 2 0 00-2-2z',
            'description' => 'Manage your website content.',
            'subitems' => [
                'posts' => [
                    'label' => 'Posts',
                    'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
                    'description' => 'Manage blog posts and articles.'
                ],
                'pages' => [
                    'label' => 'Pages',
                    'icon' => 'M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z',
                    'description' => 'Create and edit static pages.'
                ],
                'categories' => [
                    'label' => 'Categories',
                    'icon' => 'M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z',
                    'description' => 'Organize content with categories.'
                ]
            ]
        ],
        'settings' => [
            'label' => 'Settings',
            'icon' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z',
            'description' => 'Configure application settings.',
            'subitems' => [
                'general' => [
                    'label' => 'General',
                    'icon' => 'M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4',
                    'description' => 'Configure general application settings.'
                ],
                'security' => [
                    'label' => 'Security',
                    'icon' => 'M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z',
                    'description' => 'Manage security and authentication settings.'
                ]
            ]
        ],
        'analytics' => [
            'label' => 'Analytics',
            'icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z',
            'description' => 'View application analytics and reports.'
        ]
    ];

    public function mount()
    {
        // Initialize with users submenu open
        $this->openSubmenus = ['users'];
    }

    public function setActiveMenu($menu, $submenu = null)
    {
        if ($submenu) {
            $this->activeMenu = $submenu;
            // Ensure the parent menu is open when selecting a submenu
            if (!in_array($menu, $this->openSubmenus)) {
                $this->openSubmenus[] = $menu;
            }
        } else {
            $this->activeMenu = $menu;
        }

        // Force re-render
        $this->render();
    }

    public function toggleSubmenu($menu)
    {
        if (in_array($menu, $this->openSubmenus)) {
            $this->openSubmenus = array_diff($this->openSubmenus, [$menu]);
        } else {
            $this->openSubmenus[] = $menu;
        }
    }

    public function updatedActiveMenu()
    {
        // This will be called whenever activeMenu changes
        // Force a re-render by emitting an event
        $this->emit('menuChanged', $this->activeMenu);
    }

    public function getCurrentComponent()
    {
        // First check if it's a direct menu item
        if (isset($this->menuItems[$this->activeMenu]['component'])) {
            return $this->menuItems[$this->activeMenu]['component'];
        }

        // Check if it's a submenu item
        foreach ($this->menuItems as $menu) {
            if (isset($menu['subitems'])) {
                foreach ($menu['subitems'] as $subKey => $subItem) {
                    if ($subKey === $this->activeMenu && isset($subItem['component'])) {
                        return $subItem['component'];
                    }
                }
            }
        }

        return null;
    }

    public function render()
    {
        return view('livewire.home', [
            'menuItems' => $this->menuItems,
            'currentComponent' => $this->getCurrentComponent()
        ]);
    }
}
