<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
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
                            <div class="border-l-4 border-purple-500 pl-4 py-2">
                                <h3 class="font-semibold text-lg text-gray-800">Library Timing Change</h3>
                                <p class="text-gray-600 mt-1">Library timings have been extended till 6:00 PM from
                                    Monday to Friday.</p>
                                <p class="text-sm text-gray-500 mt-2">Posted on: 28 Jul 2023</p>
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
                                <h3 class="font-semibold text-lg text-gray-800 mb-4">Payment History</h3>
                                <div class="space-y-3">
                                    <div class="flex justify-between">
                                        <span>15 Jul 2023</span>
                                        <span class="text-green-600">₹5,000</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>10 Jun 2023</span>
                                        <span class="text-green-600">₹7,000</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>05 Apr 2023</span>
                                        <span class="text-green-600">₹3,000</span>
                                    </div>
                                </div>
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
                                <p class="text-gray-600 mt-2">Write an essay on "My Dream Career" (300-500 words)</p>
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
                                <p class="text-gray-600 mt-2">Create a model on any scientific principle of your choice
                                </p>
                                <div class="flex justify-between mt-3">
                                    <span class="text-sm text-gray-500">Due: 20 Aug 2023</span>
                                    <button class="text-blue-600 hover:text-blue-800 text-sm">Submit</button>
                                </div>
                            </div>
                            <div class="border border-gray-200 rounded-lg p-4">
                                <div class="flex justify-between">
                                    <h3 class="font-semibold text-gray-800">Social Studies - Map Work</h3>
                                    <span
                                        class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">Submitted</span>
                                </div>
                                <p class="text-gray-600 mt-2">Mark important rivers and mountain ranges on the Indian
                                    map</p>
                                <div class="flex justify-between mt-3">
                                    <span class="text-sm text-gray-500">Due: 18 Aug 202