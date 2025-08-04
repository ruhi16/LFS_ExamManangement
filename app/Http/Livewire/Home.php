<?php
namespace App\Http\Livewire;

use Livewire\Component;

class Home extends Component{

    public $activeMenu = 'dashboard';
    public $openSubmenus = [];
    
    protected $menuItems = [
        'dashboard' => [
            'label' => 'Dashboard',
            'icon' => 'M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z M8 5a2 2 0 012-2h4a2 2 0 012 2v6H8V5z',
            'description' => 'Welcome back! Here\'s what\'s happening with your application.'
        ],
        'users' => [
            'label' => 'Users',
            'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z',
            'description' => 'Manage all system users and their permissions.',
            'subitems' => [
                'all-users' => [
                    'label' => 'All Users',
                    'icon' => 'M9 5H7a2 2 0 00-2 2v6a2 2 0 002 2h6a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2',
                    'component' => 'myclass-comp',
                    'description' => 'Manage all system users and their permissions.'
                ],
                'add-user' => [
                    'label' => 'Add User',
                    'icon' => 'M12 6v6m0 0v6m0-6h6m-6 0H6',
                    'component' => 'myclass-subject-comp',
                    'description' => 'Create new user accounts for the system.'
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

    public function setActiveMenu($menu, $submenu = null)
    {
        if ($submenu) {
            $this->activeMenu = $submenu;
        } else {
            $this->activeMenu = $menu;
        }
    }

    public function toggleSubmenu($menu)
    {
        if (in_array($menu, $this->openSubmenus)) {
            $this->openSubmenus = array_diff($this->openSubmenus, [$menu]);
        } else {
            $this->openSubmenus[] = $menu;
        }
    }


    public function render(){
        return view('livewire.home', [
            'menuItems' => $this->menuItems
        ]);
    }
}
