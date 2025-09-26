<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        @if(!$studentdb)
        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-6">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-triangle text-yellow-400 text-xl"></i>
                </div>
                <div class="ml-3">
                    <p class="text-lg font-medium text-yellow-800">
                        No Student Data Available
                    </p>
                    <div class="mt-2 text-sm text-yellow-700">
                        <p>
                            @if(!Auth::check())
                            You need to be logged in to view your profile.
                            @elseif(!Auth::user()->studentdb_id)
                            Your account is not linked to a student record. Please contact the administrator.
                            @else
                            We couldn't find your student information in our database.
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Debug Information</h3>
            <div class="bg-gray-50 rounded-lg p-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                    <div>
                        <p><span class="font-medium">Authenticated:</span> {{ Auth::check() ? 'Yes' : 'No' }}</p>
                        @if(Auth::check())
                        <p><span class="font-medium">User ID:</span> {{ Auth::user()->id }}</p>
                        <p><span class="font-medium">Role ID:</span> {{ Auth::user()->role_id }}</p>
                        <p><span class="font-medium">Student DB ID:</span> {{ Auth::user()->studentdb_id ?? 'NULL' }}
                        </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @else
        <!-- Profile Header -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 px-6 py-8 sm:px-10 sm:py-10">
            <div class="flex flex-col md:flex-row items-center">
                <div class="flex-shrink-0 mb-6 md:mb-0 md:mr-8">
                    <div
                        class="bg-gray-200 border-2 border-dashed rounded-xl w-32 h-32 flex items-center justify-center">
                        <i class="fas fa-user-graduate text-gray-500 text-4xl"></i>
                    </div>
                </div>
                <div class="text-center md:text-left">
                    <h1 class="text-3xl font-bold text-white">{{ $studentdb->name ?? 'Student Name' }}</h1>
                    <p class="text-blue-100 mt-2">
                        <i class="fas fa-id-card mr-2"></i>
                        Student ID: {{ $studentdb->studentid ?? 'N/A' }}
                    </p>
                    <p class="text-blue-100 mt-1">
                        <i class="fas fa-calendar-alt mr-2"></i>
                        Date of Birth: {{ $studentdb->dob ? date('d M, Y', strtotime($studentdb->dob)) : 'N/A' }}
                    </p>
                    @if($studentcr)
                    <p class="text-blue-100 mt-1">
                        <i class="fas fa-book mr-2"></i>
                        Class: {{ $studentcr->myclass->name ?? 'N/A' }} -
                        Section: {{ $studentcr->section->name ?? 'N/A' }}
                    </p>
                    <p class="text-blue-100 mt-1">
                        <i class="fas fa-hashtag mr-2"></i>
                        Roll No: {{ $studentcr->roll_no ?? 'N/A' }}
                    </p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Main Content with Sidebar -->
        <div class="flex flex-col md:flex-row">
            <!-- Left Sidebar Menu -->
            <div class="w-full md:w-64 bg-gray-50 border-r border-gray-200">
                <nav class="p-4">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Student Portal</h3>
                    <ul class="space-y-2">
                        <li>
                            <button wire:click="setActiveSection('profile')"
                                class="w-full text-left px-4 py-3 rounded-lg transition-colors {{ $activeSection === 'profile' ? 'bg-blue-100 text-blue-700 font-medium' : 'text-gray-600 hover:bg-gray-100' }}">
                                <i class="fas fa-user mr-3"></i>My Profile
                            </button>
                        </li>
                        <li>
                            <button wire:click="setActiveSection('notices')"
                                class="w-full text-left px-4 py-3 rounded-lg transition-colors {{ $activeSection === 'notices' ? 'bg-blue-100 text-blue-700 font-medium' : 'text-gray-600 hover:bg-gray-100' }}">
                                <i class="fas fa-bell mr-3"></i>Notices
                            </button>
                        </li>
                        <li>
                            <button wire:click="setActiveSection('fees')"
                                class="w-full text-left px-4 py-3 rounded-lg transition-colors {{ $activeSection === 'fees' ? 'bg-blue-100 text-blue-700 font-medium' : 'text-gray-600 hover:bg-gray-100' }}">
                                <i class="fas fa-rupee-sign mr-3"></i>Fees Status
                            </button>
                        </li>
                        <li>
                            <button wire:click="setActiveSection('assignments')"
                                class="w-full text-left px-4 py-3 rounded-lg transition-colors {{ $activeSection === 'assignments' ? 'bg-blue-100 text-blue-700 font-medium' : 'text-gray-600 hover:bg-gray-100' }}">
                                <i class="fas fa-tasks mr-3"></i>Assignments
                            </button>
                        </li>
                        <li>
                            <button wire:click="setActiveSection('attendance')"
                                class="w-full text-left px-4 py-3 rounded-lg transition-colors {{ $activeSection === 'attendance' ? 'bg-blue-100 text-blue-700 font-medium' : 'text-gray-600 hover:bg-gray-100' }}">
                                <i class="fas fa-calendar-check mr-3"></i>Attendance
                            </button>
                        </li>
                        <li>
                            <button wire:click="setActiveSection('exams')"
                                class="w-full text-left px-4 py-3 rounded-lg transition-colors {{ $activeSection === 'exams' ? 'bg-blue-100 text-blue-700 font-medium' : 'text-gray-600 hover:bg-gray-100' }}">
                                <i class="fas fa-clipboard-check mr-3"></i>Exams Details
                            </button>
                        </li>
                        <li>
                            <button wire:click="setActiveSection('schedule')"
                                class="w-full text-left px-4 py-3 rounded-lg transition-colors {{ $activeSection === 'schedule' ? 'bg-blue-100 text-blue-700 font-medium' : 'text-gray-600 hover:bg-gray-100' }}">
                                <i class="fas fa-clock mr-3"></i>Schedule
                            </button>
                        </li>
                        <li>
                            <button wire:click="setActiveSection('feedback')"
                                class="w-full text-left px-4 py-3 rounded-lg transition-colors {{ $activeSection === 'feedback' ? 'bg-blue-100 text-blue-700 font-medium' : 'text-gray-600 hover:bg-gray-100' }}">
                                <i class="fas fa-comment-dots mr-3"></i>Feedback
                            </button>
                        </li>
                        <li>
                            <button wire:click="setActiveSection('query')"
                                class="w-full text-left px-4 py-3 rounded-lg transition-colors {{ $activeSection === 'query' ? 'bg-blue-100 text-blue-700 font-medium' : 'text-gray-600 hover:bg-gray-100' }}">
                                <i class="fas fa-question-circle mr-3"></i>Query
                            </button>
                        </li>
                        <li>
                            <button wire:click="setActiveSection('remarks')"
                                class="w-full text-left px-4 py-3 rounded-lg transition-colors {{ $activeSection === 'remarks' ? 'bg-blue-100 text-blue-700 font-medium' : 'text-gray-600 hover:bg-gray-100' }}">
                                <i class="fas fa-sticky-note mr-3"></i>Remarks
                            </button>
                        </li>
                        <li>
                            <button wire:click="setActiveSection('gallery')"
                                class="w-full text-left px-4 py-3 rounded-lg transition-colors {{ $activeSection === 'gallery' ? 'bg-blue-100 text-blue-700 font-medium' : 'text-gray-600 hover:bg-gray-100' }}">
                                <i class="fas fa-images mr-3"></i>Gallery
                            </button>
                        </li>
                        <li>
                            <button wire:click="setActiveSection('forum')"
                                class="w-full text-left px-4 py-3 rounded-lg transition-colors {{ $activeSection === 'forum' ? 'bg-blue-100 text-blue-700 font-medium' : 'text-gray-600 hover:bg-gray-100' }}">
                                <i class="fas fa-comments mr-3"></i>Open Forum
                            </button>
                        </li>
                    </ul>
                </nav>
            </div>

            <!-- Main Content Area -->
            <div class="flex-1">
                <!-- Profile Content (default) -->
                @if($activeSection === 'profile')
                <!-- Navigation Tabs -->
                <div class="border-b border-gray-200">
                    <nav class="flex -mb-px overflow-x-auto">
                        <button wire:click="setActiveTab('basic')"
                            class="py-4 px-6 text-center border-b-2 font-medium text-sm whitespace-nowrap {{ $activeTab === 'basic' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                            <i class="fas fa-user mr-2"></i>Basic Information
                        </button>
                        <button wire:click="setActiveTab('academic')"
                            class="py-4 px-6 text-center border-b-2 font-medium text-sm whitespace-nowrap {{ $activeTab === 'academic' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                            <i class="fas fa-graduation-cap mr-2"></i>Academic Details
                        </button>
                        <button wire:click="setActiveTab('contact')"
                            class="py-4 px-6 text-center border-b-2 font-medium text-sm whitespace-nowrap {{ $activeTab === 'contact' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                            <i class="fas fa-address-book mr-2"></i>Contact Information
                        </button>
                        <button wire:click="setActiveTab('guardian')"
                            class="py-4 px-6 text-center border-b-2 font-medium text-sm whitespace-nowrap {{ $activeTab === 'guardian' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                            <i class="fas fa-user-friends mr-2"></i>Guardian Details
                        </button>
                    </nav>
                </div>

                <!-- Tab Content -->
                <div class="p-6 sm:p-8">
                    <!-- Basic Information Tab -->
                    @if($activeTab === 'basic')
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div class="bg-gray-50 rounded-lg p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b border-gray-200 pb-2">Personal
                                Details
                            </h3>
                            <div class="space-y-4">
                                <div class="flex">
                                    <div class="w-1/3 text-gray-600 font-medium">Full Name</div>
                                    <div class="w-2/3 text-gray-900">{{ $studentdb->name ?? 'N/A' }}</div>
                                </div>
                                <div class="flex">
                                    <div class="w-1/3 text-gray-600 font-medium">Student ID</div>
                                    <div class="w-2/3 text-gray-900">{{ $studentdb->studentid ?? 'N/A' }}</div>
                                </div>
                                <div class="flex">
                                    <div class="w-1/3 text-gray-600 font-medium">Date of Birth</div>
                                    <div class="w-2/3 text-gray-900">{{ $studentdb->dob ? date('d M, Y',
                                        strtotime($studentdb->dob)) : 'N/A' }}</div>
                                </div>
                                <div class="flex">
                                    <div class="w-1/3 text-gray-600 font-medium">Gender</div>
                                    <div class="w-2/3 text-gray-900">{{ $studentdb->ssex ?? 'N/A' }}</div>
                                </div>
                                <div class="flex">
                                    <div class="w-1/3 text-gray-600 font-medium">Blood Group</div>
                                    <div class="w-2/3 text-gray-900">{{ $studentdb->blood_grp ?? 'N/A' }}</div>
                                </div>
                                <div class="flex">
                                    <div class="w-1/3 text-gray-600 font-medium">Religion</div>
                                    <div class="w-2/3 text-gray-900">{{ $studentdb->relg ?? 'N/A' }}</div>
                                </div>
                                <div class="flex">
                                    <div class="w-1/3 text-gray-600 font-medium">Nationality</div>
                                    <div class="w-2/3 text-gray-900">{{ $studentdb->natn ?? 'N/A' }}</div>
                                </div>
                                <div class="flex">
                                    <div class="w-1/3 text-gray-600 font-medium">Aadhaar Number</div>
                                    <div class="w-2/3 text-gray-900">{{ $studentdb->adhaar ?? 'N/A' }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b border-gray-200 pb-2">Admission
                                Details
                            </h3>
                            <div class="space-y-4">
                                <div class="flex">
                                    <div class="w-1/3 text-gray-600 font-medium">Admission Date</div>
                                    <div class="w-2/3 text-gray-900">{{ $studentdb->admDate ? date('d M, Y',
                                        strtotime($studentdb->admDate)) : 'N/A' }}</div>
                                </div>
                                <div class="flex">
                                    <div class="w-1/3 text-gray-600 font-medium">Admission Book No</div>
                                    <div class="w-2/3 text-gray-900">{{ $studentdb->admBookNo ?? 'N/A' }}</div>
                                </div>
                                <div class="flex">
                                    <div class="w-1/3 text-gray-600 font-medium">Admission Sl No</div>
                                    <div class="w-2/3 text-gray-900">{{ $studentdb->admSlNo ?? 'N/A' }}</div>
                                </div>
                                <div class="flex">
                                    <div class="w-1/3 text-gray-600 font-medium">Previous Class</div>
                                    <div class="w-2/3 text-gray-900">{{ $studentdb->prCls ?? 'N/A' }}</div>
                                </div>
                                <div class="flex">
                                    <div class="w-1/3 text-gray-600 font-medium">Previous School</div>
                                    <div class="w-2/3 text-gray-900">{{ $studentdb->prSch ?? 'N/A' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Academic Details Tab -->
                    @if($activeTab === 'academic')
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div class="bg-gray-50 rounded-lg p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b border-gray-200 pb-2">Current
                                Academic
                                Information</h3>
                            <div class="space-y-4">
                                @if($studentcr)
                                <div class="flex">
                                    <div class="w-1/3 text-gray-600 font-medium">Session</div>
                                    <div class="w-2/3 text-gray-900">{{ $studentcr->session->name ?? 'N/A' }}</div>
                                </div>
                                <div class="flex">
                                    <div class="w-1/3 text-gray-600 font-medium">Class</div>
                                    <div class="w-2/3 text-gray-900">{{ $studentcr->myclass->name ?? 'N/A' }}</div>
                                </div>
                                <div class="flex">
                                    <div class="w-1/3 text-gray-600 font-medium">Section</div>
                                    <div class="w-2/3 text-gray-900">{{ $studentcr->section->name ?? 'N/A' }}</div>
                                </div>
                                <div class="flex">
                                    <div class="w-1/3 text-gray-600 font-medium">Roll Number</div>
                                    <div class="w-2/3 text-gray-900">{{ $studentcr->roll_no ?? 'N/A' }}</div>
                                </div>
                                <div class="flex">
                                    <div class="w-1/3 text-gray-600 font-medium">Result</div>
                                    <div class="w-2/3 text-gray-900">{{ $studentcr->result ?? 'N/A' }}</div>
                                </div>
                                <div class="flex">
                                    <div class="w-1/3 text-gray-600 font-medium">Status</div>
                                    <div class="w-2/3 text-gray-900">
                                        <span
                                            class="px-2 py-1 text-xs rounded-full {{ $studentcr->crstatus === 'Active' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            {{ $studentcr->crstatus ?? 'N/A' }}
                                        </span>
                                    </div>
                                </div>
                                @else
                                <p class="text-gray-500">No academic record found.</p>
                                @endif
                            </div>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b border-gray-200 pb-2">Academic
                                History
                            </h3>
                            <div class="space-y-4">
                                @if($studentdb && $studentdb->studentcrs)
                                @foreach($studentdb->studentcrs as $record)
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex justify-between">
                                        <div class="font-medium">{{ $record->myclass->name ?? 'N/A' }} - {{
                                            $record->section->name ?? 'N/A' }}</div>
                                        <div class="text-sm text-gray-500">{{ $record->session->name ?? 'N/A' }}</div>
                                    </div>
                                    <div class="mt-2 text-sm">
                                        <span class="text-gray-600">Roll:</span> {{ $record->roll_no ?? 'N/A' }}
                                        <span class="mx-2">|</span>
                                        <span class="text-gray-600">Result:</span> {{ $record->result ?? 'N/A' }}
                                    </div>
                                </div>
                                @endforeach
                                @else
                                <p class="text-gray-500">No academic history available.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Contact Information Tab -->
                    @if($activeTab === 'contact')
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div class="bg-gray-50 rounded-lg p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b border-gray-200 pb-2">Address
                                Information</h3>
                            <div class="space-y-4">
                                <div class="flex">
                                    <div class="w-1/3 text-gray-600 font-medium">Village</div>
                                    <div class="w-2/3 text-gray-900">{{ $studentdb->vill1 ?? 'N/A' }}</div>
                                </div>
                                <div class="flex">
                                    <div class="w-1/3 text-gray-600 font-medium">Post Office</div>
                                    <div class="w-2/3 text-gray-900">{{ $studentdb->post ?? 'N/A' }}</div>
                                </div>
                                <div class="flex">
                                    <div class="w-1/3 text-gray-600 font-medium">Police Station</div>
                                    <div class="w-2/3 text-gray-900">{{ $studentdb->pstn ?? 'N/A' }}</div>
                                </div>
                                <div class="flex">
                                    <div class="w-1/3 text-gray-600 font-medium">District</div>
                                    <div class="w-2/3 text-gray-900">{{ $studentdb->dist ?? 'N/A' }}</div>
                                </div>
                                <div class="flex">
                                    <div class="w-1/3 text-gray-600 font-medium">Pin Code</div>
                                    <div class="w-2/3 text-gray-900">{{ $studentdb->pin ?? 'N/A' }}</div>
                                </div>
                                <div class="flex">
                                    <div class="w-1/3 text-gray-600 font-medium">State</div>
                                    <div class="w-2/3 text-gray-900">{{ $studentdb->state ?? 'N/A' }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b border-gray-200 pb-2">Contact
                                Details
                            </h3>
                            <div class="space-y-4">
                                <div class="flex">
                                    <div class="w-1/3 text-gray-600 font-medium">Mobile 1</div>
                                    <div class="w-2/3 text-gray-900">{{ $studentdb->mobl1 ?? 'N/A' }}</div>
                                </div>
                                <div class="flex">
                                    <div class="w-1/3 text-gray-600 font-medium">Mobile 2</div>
                                    <div class="w-2/3 text-gray-900">{{ $studentdb->mobl2 ?? 'N/A' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Guardian Details Tab -->
                    @if($activeTab === 'guardian')
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div class="bg-gray-50 rounded-lg p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b border-gray-200 pb-2">Father's
                                Information</h3>
                            <div class="space-y-4">
                                <div class="flex">
                                    <div class="w-1/3 text-gray-600 font-medium">Name</div>
                                    <div class="w-2/3 text-gray-900">{{ $studentdb->fname ?? 'N/A' }}</div>
                                </div>
                                <div class="flex">
                                    <div class="w-1/3 text-gray-600 font-medium">Occupation</div>
                                    <div class="w-2/3 text-gray-900">{{ $studentdb->focc ?? 'N/A' }}</div>
                                </div>
                                <div class="flex">
                                    <div class="w-1/3 text-gray-600 font-medium">Education</div>
                                    <div class="w-2/3 text-gray-900">{{ $studentdb->fedu ?? 'N/A' }}</div>
                                </div>
                                <div class="flex">
                                    <div class="w-1/3 text-gray-600 font-medium">Annual Income</div>
                                    <div class="w-2/3 text-gray-900">{{ $studentdb->fincome ?? 'N/A' }}</div>
                                </div>
                                <div class="flex">
                                    <div class="w-1/3 text-gray-600 font-medium">Aadhaar Number</div>
                                    <div class="w-2/3 text-gray-900">{{ $studentdb->fadhaar ?? 'N/A' }}</div>
                                </div>
                                <div class="flex">
                                    <div class="w-1/3 text-gray-600 font-medium">Mobile</div>
                                    <div class="w-2/3 text-gray-900">{{ $studentdb->fmob ?? 'N/A' }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b border-gray-200 pb-2">Mother's
                                Information</h3>
                            <div class="space-y-4">
                                <div class="flex">
                                    <div class="w-1/3 text-gray-600 font-medium">Name</div>
                                    <div class="w-2/3 text-gray-900">{{ $studentdb->mname ?? 'N/A' }}</div>
                                </div>
                                <div class="flex">
                                    <div class="w-1/3 text-gray-600 font-medium">Occupation</div>
                                    <div class="w-2/3 text-gray-900">{{ $studentdb->mocc ?? 'N/A' }}</div>
                                </div>
                                <div class="flex">
                                    <div class="w-1/3 text-gray-600 font-medium">Education</div>
                                    <div class="w-2/3 text-gray-900">{{ $studentdb->medu ?? 'N/A' }}</div>
                                </div>
                                <div class="flex">
                                    <div class="w-1/3 text-gray-600 font-medium">Annual Income</div>
                                    <div class="w-2/3 text-gray-900">{{ $studentdb->mincome ?? 'N/A' }}</div>
                                </div>
                                <div class="flex">
                                    <div class="w-1/3 text-gray-600 font-medium">Aadhaar Number</div>
                                    <div class="w-2/3 text-gray-900">{{ $studentdb->madhaar ?? 'N/A' }}</div>
                                </div>
                                <div class="flex">
                                    <div class="w-1/3 text-gray-600 font-medium">Mobile</div>
                                    <div class="w-2/3 text-gray-900">{{ $studentdb->mmob ?? 'N/A' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                @endif

                <!-- Notices Content -->
                @if($activeSection === 'notices')
                <div class="p-6 sm:p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Notices & Announcements</h2>
                    <div class="bg-gray-50 rounded-lg p-6">
                        <div class="space-y-4">
                            <div class="border-l-4 border-blue-500 pl-4 py-2">
                                <h3 class="font-semibold text-lg text-gray-800">School Holiday Notice</h3>
                                <p class="text-gray-600 mt-1">School will remain closed on 15th August for Independence
                                    Day celebration.</p>
                                <p class="text-sm text-gray-500 mt-2">Posted on: 10 Aug 2023</p>
                            </div>
                            <div class="border-l-4 border-green-500 pl-4 py-2">
                                <h3 class="font-semibold text-lg text-gray-800">Exam Schedule Published</h3>
                                <p class="text-gray-600 mt-1">Final exam schedule for current session has been
                                    published. Check your timetable.</p>
                                <p class="text-sm text-gray-500 mt-2">Posted on: 05 Aug 2023</p>
                            </div>
                            <div class="border-l-4 border-yellow-500 pl-4 py-2">
                                <h3 class="font-semibold text-lg text-gray-800">Sports Day Event</h3>
                                <p class="text-gray-600 mt-1">Annual Sports Day will be held on 25th August. All
                                    students are requested to participate.</p>
                                <p class="text-sm text-gray-500 mt-2">Posted on: 01 Aug 2023</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Fees Status Content -->
                @if($activeSection === 'fees')
                <div class="p-6 sm:p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Fees Status</h2>
                    <div class="bg-gray-50 rounded-lg p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h3 class="font-semibold text-lg text-gray-800 mb-4">Fee Summary</h3>
                                <div class="space-y-3">
                                    <div class="flex justify-between">
                                        <span>Total Fees</span>
                                        <span class="font-medium">₹15,000</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Paid Amount</span>
                                        <span class="font-medium text-green-600">₹12,000</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Due Amount</span>
                                        <span class="font-medium text-red-600">₹3,000</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Last Payment</span>
                                        <span>₹5,000 (15 Jul 2023)</span>
                                    </div>
                                </div>
                            </div>
                            <div>

                            </div>
                        </div>
                        <div class="mt-6">
                            <button
                                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                Pay Due Amount
                            </button>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Assignments Content -->
                @if($activeSection === 'assignments')
                <div class="p-6 sm:p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Assignments</h2>
                    <div class="bg-gray-50 rounded-lg p-6">
                        <div class="space-y-4">
                            <div class="border border-gray-200 rounded-lg p-4">
                                <div class="flex justify-between">
                                    <h3 class="font-semibold text-gray-800">Mathematics - Algebra Assignment</h3>
                                    <span
                                        class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs rounded-full">Pending</span>
                                </div>
                                <p class="text-gray-600 mt-2">Solve problems from Chapter 5, Exercise 5.2 (Questions
                                    1-10)</p>
                                <div class="mt-2 text-sm">
                                    <span class="font-medium">Due Date:</span> 30 Aug 2023
                                </div>
                            </div>
                            <div class="border border-gray-200 rounded-lg p-4">
                                <div class="flex justify-between">
                                    <h3 class="font-semibold text-gray-800">Science - Chemistry Assignment</h3>
                                    <span
                                        class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">Submitted</span>
                                </div>
                                <p class="text-gray-600 mt-2">Write a report on the properties of water</p>
                                <div class="mt-2 text-sm">
                                    <span class="font-medium">Due Date:</span> 25 Aug 2023
                                </div>
                            </div>
                            <div class="border border-gray-200 rounded-lg p-4">
                                <div class="flex justify-between">
                                    <h3 class="font-semibold text-gray-800">English - Essay Writing</h3>
                                    <span
                                        class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs rounded-full">Pending</span>
                                </div>
                                <p class="text-gray-600 mt-2">Write an essay on "My Favorite Season"</p>
                                <div class="mt-2 text-sm">
                                    <span class="font-medium">Due Date:</span> 20 Aug 2023
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Attendance Content -->
                @if($activeSection === 'attendance')
                <div class="p-6 sm:p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Attendance</h2>
                    <div class="bg-gray-50 rounded-lg p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h3 class="font-semibold text-lg text-gray-800 mb-4">Monthly Summary</h3>
                                <div class="space-y-3">
                                    <div class="flex justify-between">
                                        <span>Total Days</span>
                                        <span class="font-medium">20</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Present</span>
                                        <span class="font-medium text-green-600">18</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Absent</span>
                                        <span class="font-medium text-red-600">2</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Percentage</span>
                                        <span class="font-medium">90%</span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg text-gray-800 mb-4">Recent Attendance</h3>
                                <div class="space-y-3">
                                    <div class="flex justify-between">
                                        <span>15 Aug 2023</span>
                                        <span class="text-green-600">Present</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>14 Aug 2023</span>
                                        <span class="text-green-600">Present</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>13 Aug 2023</span>
                                        <span class="text-green-600">Present</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>12 Aug 2023</span>
                                        <span class="text-green-600">Present</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>11 Aug 2023</span>
                                        <span class="text-green-600">Present</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>10 Aug 2023</span>
                                        <span class="text-green-600">Present</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>09 Aug 2023</span>
                                        <span class="text-green-600">Present</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>08 Aug 2023</span>
                                        <span class="text-green-600">Present</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>07 Aug 2023</span>
                                        <span class="text-green-600">Present</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>06 Aug 2023</span>
                                        <span class="text-green-600">Present</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>05 Aug 2023</span>
                                        <span class="text-green-600">Present</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>04 Aug 2023</span>
                                        <span class="text-green-600">Present</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>03 Aug 2023</span>
                                        <span class="text-green-600">Present</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>02 Aug 2023</span>
                                        <span class="text-green-600">Present</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>01 Aug 2023</span>
                                        <span class="text-green-600">Present</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Exams Content -->
                @if($activeSection === 'exams')
                <div class="p-6 sm:p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Exams Details</h2>
                    <div class="bg-gray-50 rounded-lg p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h3 class="font-semibold text-lg text-gray-800 mb-4">Upcoming Exams</h3>
                                <div class="space-y-3">
                                    <div class="flex justify-between">
                                        <span>Mathematics</span>
                                        <span class="text-green-600">15 Aug 2023</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Science</span>
                                        <span class="text-green-600">16 Aug 2023</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>English</span>
                                        <span class="text-green-600">17 Aug 2023</span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg text-gray-800 mb-4">Previous Exams</h3>
                                <div class="space-y-3">
                                    <div class="flex justify-between">
                                        <span>Mathematics</span>
                                        <span class="text-green-600">10 Aug 2023</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Science</span>
                                        <span class="text-green-600">11 Aug 2023</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>English</span>
                                        <span class="text-green-600">12 Aug 2023</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Schedule Content -->
                @if($activeSection === 'schedule')
                <div class="p-6 sm:p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Schedule</h2>
                    <div class="bg-gray-50 rounded-lg p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h3 class="font-semibold text-lg text-gray-800 mb-4">Class Schedule</h3>
                                <div class="space-y-3">
                                    <div class="flex justify-between">
                                        <span>Mathematics</span>
                                        <span class="text-green-600">10:00 AM - 11:00 AM</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Science</span>
                                        <span class="text-green-600">11:00 AM - 12:00 PM</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>English</span>
                                        <span class="text-green-600">12:00 PM - 01:00 PM</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Lunch Break</span>
                                        <span class="text-green-600">01:00 PM - 02:00 PM</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>History</span>
                                        <span class="text-green-600">02:00 PM - 03:00 PM</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Geography</span>
                                        <span class="text-green-600">03:00 PM - 04:00 PM</span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg text-gray-800 mb-4">Activity Schedule</h3>
                                <div class="space-y-3">
                                    <div class="flex justify-between">
                                        <span>Art and Craft</span>
                                        <span class="text-green-600">04:00 PM - 04:30 PM</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Physical Education</span>
                                        <span class="text-green-600">04:30 PM - 05:00 PM</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Feedback Content -->
                @if($activeSection === 'feedback')
                <div class="p-6 sm:p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Feedback</h2>
                    <div class="bg-gray-50 rounded-lg p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h3 class="font-semibold text-lg text-gray-800 mb-4">Teacher Feedback</h3>
                                <div class="space-y-3">
                                    <div class="flex justify-between">
                                        <span>Mathematics</span>
                                        <span class="text-green-600">Good</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Science</span>
                                        <span class="text-green-600">Very Good</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>English</span>
                                        <span class="text-green-600">Good</span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg text-gray-800 mb-4">Parent Feedback</h3>
                                <div class="space-y-3">
                                    <div class="flex justify-between">
                                        <span>Mathematics</span>
                                        <span class="text-green-600">Good</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Science</span>
                                        <span class="text-green-600">Very Good</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>English</span>
                                        <span class="text-green-600">Good</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Query Content -->
                @if($activeSection === 'query')
                <div class="p-6 sm:p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Query</h2>
                    <div class="bg-gray-50 rounded-lg p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h3 class="font-semibold text-lg text-gray-800 mb-4">Ask a Question</h3>
                                <form>
                                    <div class="mb-4">
                                        <label for="question"
                                            class="block text-sm font-medium text-gray-700">Question</label>
                                        <textarea id="question" rows="4"
                                            class="mt-1 block w-full p-2.5 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"></textarea>
                                    </div>
                                    <button type="submit"
                                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                        Submit
                                    </button>
                                </form>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg text-gray-800 mb-4">Previous Queries</h3>
                                <div class="space-y-3">
                                    <div class="border border-gray-200 rounded-lg p-4">
                                        <div class="flex justify-between">
                                            <h3 class="font-semibold text-gray-800">Mathematics</h3>
                                            <span class="text-gray-500">15 Aug 2023</span>
                                        </div>
                                        <p class="text-gray-600 mt-2">How to solve this problem?</p>
                                        <p class="text-gray-500 mt-2">Answer: Use the formula...</p>
                                    </div>
                                    <div class="border border-gray-200 rounded-lg p-4">
                                        <div class="flex justify-between">
                                            <h3 class="font-semibold text-gray-800">Science</h3>
                                            <span class="text-gray-500">14 Aug 2023</span>
                                        </div>
                                        <p class="text-gray-600 mt-2">What is the difference between...</p>
                                        <p class="text-gray-500 mt-2">Answer: The difference is...</p>
                                    </div>
                                    <div class="border border-gray-200 rounded-lg p-4">
                                        <div class="flex justify-between">
                                            <h3 class="font-semibold text-gray-800">English</h3>
                                            <span class="text-gray-500">13 Aug 2023</span>
                                        </div>
                                        <p class="text-gray-600 mt-2">How to improve my writing?</p>
                                        <p class="text-gray-500 mt-2">Answer: Practice regularly...</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Remarks Content -->
                @if($activeSection === 'remarks')
                <div class="p-6 sm:p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Remarks</h2>
                    <div class="bg-gray-50 rounded-lg p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h3 class="font-semibold text-lg text-gray-800 mb-4">Teacher Remarks</h3>
                                <div class="space-y-3">
                                    <div class="border border-gray-200 rounded-lg p-4">
                                        <div class="flex justify-between">
                                            <h3 class="font-semibold text-gray-800">Mathematics</h3>
                                            <span class="text-gray-500">15 Aug 2023</span>
                                        </div>
                                        <p class="text-gray-600 mt-2">Good effort. Keep it up!</p>
                                    </div>
                                    <div class="border border-gray-200 rounded-lg p-4">
                                        <div class="flex justify-between">
                                            <h3 class="font-semibold text-gray-800">Science</h3>
                                            <span class="text-gray-500">14 Aug 2023</span>
                                        </div>
                                        <p class="text-gray-600 mt-2">Excellent work!</p>
                                    </div>
                                    <div class="border border-gray-200 rounded-lg p-4">
                                        <div class="flex justify-between">
                                            <h3 class="font-semibold text-gray-800">English</h3>
                                            <span class="text-gray-500">13 Aug 2023</span>
                                        </div>
                                        <p class="text-gray-600 mt-2">Good effort. Keep it up!</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg text-gray-800 mb-4">Parent Remarks</h3>
                                <div class="space-y-3">
                                    <div class="border border-gray-200 rounded-lg p-4">
                                        <div class="flex justify-between">
                                            <h3 class="font-semibold text-gray-800">Mathematics</h3>
                                            <span class="text-gray-500">15 Aug 2023</span>
                                        </div>
                                        <p class="text-gray-600 mt-2">Good effort. Keep it up!</p>
                                    </div>
                                    <div class="border border-gray-200 rounded-lg p-4">
                                        <div class="flex justify-between">
                                            <h3 class="font-semibold text-gray-800">Science</h3>
                                            <span class="text-gray-500">14 Aug 2023</span>
                                        </div>
                                        <p class="text-gray-600 mt-2">Excellent work!</p>
                                    </div>
                                    <div class="border border-gray-200 rounded-lg p-4">
                                        <div class="flex justify-between">
                                            <h3 class="font-semibold text-gray-800">English</h3>
                                            <span class="text-gray-500">13 Aug 2023</span>
                                        </div>
                                        <p class="text-gray-600 mt-2">Good effort. Keep it up!</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Gallery Content -->
                @if($activeSection === 'gallery')
                <div class="p-6 sm:p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Gallery</h2>
                    <div class="bg-gray-50 rounded-lg p-6">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="bg-gray-200 rounded-lg p-4">
                                <img src="https://via.placeholder.com/300" alt="Gallery Image 1"
                                    class="w-full h-full object-cover rounded-lg">
                            </div>
                            <div class="bg-gray-200 rounded-lg p-4">
                                <img src="https://via.placeholder.com/300" alt="Gallery Image 2"
                                    class="w-full h-full object-cover rounded-lg">
                            </div>
                            <div class="bg-gray-200 rounded-lg p-4">
                                <img src="https://via.placeholder.com/300" alt="Gallery Image 3"
                                    class="w-full h-full object-cover rounded-lg">
                            </div>
                            <div class="bg-gray-200 rounded-lg p-4">
                                <img src="https://via.placeholder.com/300" alt="Gallery Image 4"
                                    class="w-full h-full object-cover rounded-lg">
                            </div>
                            <div class="bg-gray-200 rounded-lg p-4">
                                <img src="https://via.placeholder.com/300" alt="Gallery Image 5"
                                    class="w-full h-full object-cover rounded-lg">
                            </div>
                            <div class="bg-gray-200 rounded-lg p-4">
                                <img src="https://via.placeholder.com/300" alt="Gallery Image 6"
                                    class="w-full h-full object-cover rounded-lg">
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Forum Content -->
                @if($activeSection === 'forum')
                <div class="p-6 sm:p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Open Forum</h2>
                    <div class="bg-gray-50 rounded-lg p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h3 class="font-semibold text-lg text-gray-800 mb-4">Post a Message</h3>
                                <form>
                                    <div class="mb-4">
                                        <label for="message"
                                            class="block text-sm font-medium text-gray-700">Message</label>
                                        <textarea id="message" rows="4"
                                            class="mt-1 block w-full p-2.5 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"></textarea>
                                    </div>
                                    <button type="submit"
                                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                        Submit
                                    </button>
                                </form>
                            </div>
                            <div>
                                1-10)</p>
                                <div class="flex justify-between mt-3">
                                    <span class="text-sm text-gray-500">Due: 30 Aug 2023</span>
                                    <button class="text-blue-600 hover:text-blue-800 text-sm">Submit</button>
                                </div>
                            </div>
                            <div class="border border-gray-200 rounded-lg p-4">
                                <div class="flex justify-between">
                                    <h3 class="font-semibold text-gray-800">English - Essay Writing</h3>
                                    <span
                                        class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">Submitted</span>
                                </div>
                                <p class="text-gray-600 mt-2">Write an essay on "My Dream Career" (300-500 words)
                                </p>
                                <div class="flex justify-between mt-3">
                                    <span class="text-sm text-gray-500">Due: 25 Aug 2023</span>
                                    <span class="text-sm text-gray-500">Submitted on: 22 Aug 2023</span>
                                </div>
                            </div>
                            <div class="border border-gray-200 rounded-lg p-4">
                                <div class="flex justify-between">
                                    <h3 class="font-semibold text-gray-800">Science - Project Work</h3>
                                    <span class="px-2 py-1 bg-red-100 text-red-800 text-xs rounded-full">Overdue</span>
                                </div>
                                <p class="text-gray-600 mt-2">Create a model on any scientific principle of your
                                    choice
                                </p>
                                <div class="flex justify-between mt-3">
                                    <span class="text-sm text-gray-500">Due: 20 Aug 2023</span>
                                    <button class="text-blue-600 hover:text-blue-800 text-sm">Submit Now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Attendance Content -->
                @if($activeSection === 'attendance')
                <div class="p-6 sm:p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Attendance</h2>
                    <div class="bg-gray-50 rounded-lg p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h3 class="font-semibold text-lg text-gray-800 mb-4">Monthly Summary</h3>
                                <div class="space-y-3">
                                    <div class="flex justify-between">
                                        <span>Total Working Days</span>
                                        <span class="font-medium">22</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Present</span>
                                        <span class="font-medium text-green-600">20</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Absent</span>
                                        <span class="font-medium text-red-600">2</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Attendance Percentage</span>
                                        <span class="font-medium">90.9%</span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg text-gray-800 mb-4">Recent Records</h3>
                                <div class="space-y-3">
                                    <div class="flex justify-between">
                                        <span>15 Aug 2023</span>
                                        <span class="text-green-600">Present</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>14 Aug 2023</span>
                                        <span class="text-green-600">Present</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>13 Aug 2023</span>
                                        <span class="text-red-600">Absent</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-6">
                            <h3 class="font-semibold text-lg text-gray-800 mb-4">Attendance Chart</h3>
                            <div class="h-64 flex items-end space-x-2">
                                <div class="flex flex-col items-center flex-1">
                                    <div class="w-8 bg-blue-500 rounded-t" style="height: 80%"></div>
                                    <span class="text-xs mt-2">Mon</span>
                                </div>
                                <div class="flex flex-col items-center flex-1">
                                    <div class="w-8 bg-blue-500 rounded-t" style="height: 90%"></div>
                                    <span class="text-xs mt-2">Tue</span>
                                </div>
                                <div class="flex flex-col items-center flex-1">
                                    <div class="w-8 bg-blue-500 rounded-t" style="height: 70%"></div>
                                    <span class="text-xs mt-2">Wed</span>
                                </div>
                                <div class="flex flex-col items-center flex-1">
                                    <div class="w-8 bg-blue-500 rounded-t" style="height: 100%"></div>
                                    <span class="text-xs mt-2">Thu</span>
                                </div>
                                <div class="flex flex-col items-center flex-1">
                                    <div class="w-8 bg-blue-500 rounded-t" style="height: 90%"></div>
                                    <span class="text-xs mt-2">Fri</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Exams Details Content -->
                @if($activeSection === 'exams')
                <div class="p-6 sm:p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Exams Details</h2>
                    <div class="bg-gray-50 rounded-lg p-6">
                        <div class="space-y-6">
                            <div>
                                <h3 class="font-semibold text-lg text-gray-800 mb-4">Upcoming Exams</h3>
                                <div class="space-y-4">
                                    <div class="border border-gray-200 rounded-lg p-4">
                                        <div class="flex justify-between">
                                            <h4 class="font-medium text-gray-800">Mid-Term Examination</h4>
                                            <span
                                                class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs rounded-full">Upcoming</span>
                                        </div>
                                        <p class="text-gray-600 mt-2">Mathematics, Science, English</p>
                                        <div class="flex justify-between mt-3">
                                            <span class="text-sm text-gray-500">Date: 25 Aug 2023</span>
                                            <span class="text-sm text-gray-500">Time: 10:00 AM - 12:00 PM</span>
                                        </div>
                                    </div>
                                    <div class="border border-gray-200 rounded-lg p-4">
                                        <div class="flex justify-between">
                                            <h4 class="font-medium text-gray-800">Final Examination</h4>
                                            <span
                                                class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs rounded-full">Scheduled</span>
                                        </div>
                                        <p class="text-gray-600 mt-2">All Subjects</p>
                                        <div class="flex justify-between mt-3">
                                            <span class="text-sm text-gray-500">Date: 15 Sep 2023</span>
                                            <span class="text-sm text-gray-500">Time: 9:00 AM - 4:00 PM</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg text-gray-800 mb-4">Previous Results</h3>
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-100">
                                            <tr>
                                                <th
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Exam</th>
                                                <th
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Math</th>
                                                <th
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Science</th>
                                                <th
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    English</th>
                                                <th
                                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                    Total</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">Unit
                                                    Test
                                                    1</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">25/30
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">28/30
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">27/30
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">80/90
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">Unit
                                                    Test
                                                    2</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">22/30
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">26/30
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">24/30
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">72/90
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Schedule Content -->
                @if($activeSection === 'schedule')
                <div class="p-6 sm:p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Class Schedule</h2>
                    <div class="bg-gray-50 rounded-lg p-6">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Time</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Monday</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Tuesday</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Wednesday</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Thursday</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Friday</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            9:00 -
                                            9:50</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">Mathematics
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">English</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">Science</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">Social Studies
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">Hindi</td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            9:50 -
                                            10:40</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">Science</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">Mathematics
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">English</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">Hindi</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">Social Studies
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            10:40
                                            - 11:00</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 font-bold"
                                            colspan="5">Break</td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            11:00
                                            - 11:50</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">English</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">Science</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">Mathematics
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">Computer</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">Games</td>
                                    </tr>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            11:50
                                            - 12:40</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">Hindi</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">Social Studies
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">Hindi</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">Mathematics
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">English</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Feedback Content -->
                @if($activeSection === 'feedback')
                <div class="p-6 sm:p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Feedback</h2>
                    <div class="bg-gray-50 rounded-lg p-6">
                        <div class="space-y-6">
                            <div>
                                <h3 class="font-semibold text-lg text-gray-800 mb-4">Submit Feedback</h3>
                                <form class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
                                        <input type="text"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Feedback
                                            Type</label>
                                        <select
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                            <option>General Feedback</option>
                                            <option>Teacher Feedback</option>
                                            <option>Infrastructure</option>
                                            <option>Other</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                                        <textarea rows="4"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                                    </div>
                                    <div>
                                        <button type="submit"
                                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                            Submit Feedback
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg text-gray-800 mb-4">Recent Feedback</h3>
                                <div class="space-y-4">
                                    <div class="border-l-4 border-blue-500 pl-4 py-2">
                                        <h4 class="font-medium text-gray-800">Regarding Mathematics Teacher</h4>
                                        <p class="text-gray-600 mt-1">The teaching methodology is excellent and easy
                                            to
                                            understand.</p>
                                        <p class="text-sm text-gray-500 mt-2">Submitted on: 10 Aug 2023 | Status:
                                            Resolved</p>
                                    </div>
                                    <div class="border-l-4 border-green-500 pl-4 py-2">
                                        <h4 class="font-medium text-gray-800">Library Facilities</h4>
                                        <p class="text-gray-600 mt-1">Need more books on science and technology.</p>
                                        <p class="text-sm text-gray-500 mt-2">Submitted on: 05 Aug 2023 | Status: In
                                            Progress</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Query Content -->
                @if($activeSection === 'query')
                <div class="p-6 sm:p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Queries</h2>
                    <div class="bg-gray-50 rounded-lg p-6">
                        <div class="space-y-6">
                            <div>
                                <h3 class="font-semibold text-lg text-gray-800 mb-4">Ask a Question</h3>
                                <form class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
                                        <input type="text"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Query
                                            Type</label>
                                        <select
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                            <option>Academic</option>
                                            <option>Fee Related</option>
                                            <option>Admission</option>
                                            <option>Other</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Question</label>
                                        <textarea rows="4"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                                    </div>
                                    <div>
                                        <button type="submit"
                                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                            Submit Query
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg text-gray-800 mb-4">Recent Queries</h3>
                                <div class="space-y-4">
                                    <div class="border border-gray-200 rounded-lg p-4">
                                        <div class="flex justify-between">
                                            <h4 class="font-medium text-gray-800">Regarding Exam Syllabus</h4>
                                            <span
                                                class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">Resolved</span>
                                        </div>
                                        <p class="text-gray-600 mt-2">What is the syllabus for the upcoming
                                            mathematics
                                            exam?</p>
                                        <p class="text-sm text-gray-500 mt-2">Asked on: 12 Aug 2023</p>
                                        <div class="mt-3 p-3 bg-blue-50 rounded-md">
                                            <p class="text-sm text-gray-700">The syllabus includes chapters 1-5 from
                                                your textbook. Please refer to the detailed syllabus document shared
                                                in
                                                Google Classroom.</p>
                                            <p class="text-xs text-gray-500 mt-1">Answered by: Mr. Sharma (Math
                                                Teacher)
                                                on 13 Aug 2023</p>
                                        </div>
                                    </div>
                                    <div class="border border-gray-200 rounded-lg p-4">
                                        <div class="flex justify-between">
                                            <h4 class="font-medium text-gray-800">Fee Payment Issue</h4>
                                            <span
                                                class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs rounded-full">Pending</span>
                                        </div>
                                        <p class="text-gray-600 mt-2">I'm unable to complete my fee payment online.
                                            The
                                            payment gateway is not working.</p>
                                        <p class="text-sm text-gray-500 mt-2">Asked on: 10 Aug 2023</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Remarks Content -->
                @if($activeSection === 'remarks')
                <div class="p-6 sm:p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Remarks & Comments</h2>
                    <div class="bg-gray-50 rounded-lg p-6">
                        <div class="space-y-6">
                            <div>
                                <h3 class="font-semibold text-lg text-gray-800 mb-4">Teacher's Remarks</h3>
                                <div class="space-y-4">
                                    <div class="border-l-4 border-blue-500 pl-4 py-2">
                                        <h4 class="font-medium text-gray-800">Class Teacher - Mr. Verma</h4>
                                        <p class="text-gray-600 mt-1">The student is performing well in academics
                                            and
                                            participates actively in class discussions. Needs to improve
                                            handwriting.
                                        </p>
                                        <p class="text-sm text-gray-500 mt-2">Date: 15 Aug 2023</p>
                                    </div>
                                    <div class="border-l-4 border-green-500 pl-4 py-2">
                                        <h4 class="font-medium text-gray-800">Mathematics Teacher - Mr. Sharma</h4>
                                        <p class="text-gray-600 mt-1">Excellent problem-solving skills. Regularly
                                            completes assignments on time.</p>
                                        <p class="text-sm text-gray-500 mt-2">Date: 10 Aug 2023</p>
                                    </div>
                                    <div class="border-l-4 border-yellow-500 pl-4 py-2">
                                        <h4 class="font-medium text-gray-800">Science Teacher - Mrs. Gupta</h4>
                                        <p class="text-gray-600 mt-1">Shows great interest in practical work. Could
                                            participate more in theory classes.</p>
                                        <p class="text-sm text-gray-500 mt-2">Date: 05 Aug 2023</p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg text-gray-800 mb-4">Principal's Remarks</h3>
                                <div class="border-l-4 border-purple-500 pl-4 py-2">
                                    <h4 class="font-medium text-gray-800">Annual Performance Review</h4>
                                    <p class="text-gray-600 mt-1">Outstanding performance throughout the academic year.
                                        Consistently ranks among top 5 students in class. Active participant in
                                        extracurricular activities.</p>
                                    <p class="text-sm text-gray-500 mt-2">Date: 20 Jul 2023 | Principal: Dr. A.K. Singh
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Gallery Content -->
                @if($activeSection === 'gallery')
                <div class="p-6 sm:p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Gallery</h2>
                    <div class="bg-gray-50 rounded-lg p-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                            <div
                                class="bg-gray-200 border-2 border-dashed rounded-xl w-full h-48 flex items-center justify-center">
                                <span class="text-gray-500">School Event Photo</span>
                            </div>
                            <div
                                class="bg-gray-200 border-2 border-dashed rounded-xl w-full h-48 flex items-center justify-center">
                                <span class="text-gray-500">Sports Day Photo</span>
                            </div>
                            <div
                                class="bg-gray-200 border-2 border-dashed rounded-xl w-full h-48 flex items-center justify-center">
                                <span class="text-gray-500">Science Exhibition</span>
                            </div>
                            <div
                                class="bg-gray-200 border-2 border-dashed rounded-xl w-full h-48 flex items-center justify-center">
                                <span class="text-gray-500">Classroom Activity</span>
                            </div>
                            <div
                                class="bg-gray-200 border-2 border-dashed rounded-xl w-full h-48 flex items-center justify-center">
                                <span class="text-gray-500">Annual Function</span>
                            </div>
                            <div
                                class="bg-gray-200 border-2 border-dashed rounded-xl w-full h-48 flex items-center justify-center">
                                <span class="text-gray-500">Field Trip</span>
                            </div>
                        </div>
                        <div class="mt-6 text-center">
                            <button
                                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                Load More
                            </button>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Open Forum Content -->
                @if($activeSection === 'forum')
                <div class="p-6 sm:p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Open Forum</h2>
                    <div class="bg-gray-50 rounded-lg p-6">
                        <div class="space-y-6">
                            <div>
                                <h3 class="font-semibold text-lg text-gray-800 mb-4">Post a Discussion</h3>
                                <form class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Topic</label>
                                        <input type="text"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                                        <select
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                            <option>Academic Discussion</option>
                                            <option>School Events</option>
                                            <option>Extracurricular Activities</option>
                                            <option>Others</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                                        <textarea rows="4"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                                    </div>
                                    <div>
                                        <button type="submit"
                                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                            Post Discussion
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg text-gray-800 mb-4">Recent Discussions</h3>
                                <div class="space-y-4">
                                    <div class="border border-gray-200 rounded-lg p-4">
                                        <div class="flex justify-between">
                                            <h4 class="font-medium text-gray-800">Study Group for Mathematics</h4>
                                            <span
                                                class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded-full">Academic</span>
                                        </div>
                                        <p class="text-gray-600 mt-2">Anyone interested in forming a study group for
                                            upcoming mathematics exam? We can meet in the library after school.</p>
                                        <div class="flex justify-between mt-3">
                                            <span class="text-sm text-gray-500">Posted by: Priya Sharma</span>
                                            <span class="text-sm text-gray-500">15 Aug 2023</span>
                                        </div>
                                        <div class="mt-3 flex space-x-4">
                                            <button class="text-blue-600 hover:text-blue-800 text-sm">
                                                <i class="fas fa-thumbs-up mr-1"></i> 12
                                            </button>
                                            <button class="text-blue-600 hover:text-blue-800 text-sm">
                                                <i class="fas fa-comment mr-1"></i> 5
                                            </button>
                                        </div>
                                    </div>
                                    <div class="border border-gray-200 rounded-lg p-4">
                                        <div class="flex justify-between">
                                            <h4 class="font-medium text-gray-800">Annual Sports Day Preparation</h4>
                                            <span
                                                class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">Events</span>
                                        </div>
                                        <p class="text-gray-600 mt-2">All participants for the annual sports day are
                                            requested to practice regularly. The event is scheduled for 25th August.
                                        </p>
                                        <div class="flex justify-between mt-3">
                                            <span class="text-sm text-gray-500">Posted by: Sports Captain</span>
                                            <span class="text-sm text-gray-500">10 Aug 2023</span>
                                        </div>
                                        <div class="mt-3 flex space-x-4">
                                            <button class="text-blue-600 hover:text-blue-800 text-sm">
                                                <i class="fas fa-thumbs-up mr-1"></i> 24
                                            </button>
                                            <button class="text-blue-600 hover:text-blue-800 text-sm">
                                                <i class="fas fa-comment mr-1"></i> 8
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
        @endif
    </div>
</div>
</div>