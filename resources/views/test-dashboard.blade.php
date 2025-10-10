<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Dashboard - LFS Exam Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .test-card {
            transition: all 0.3s ease;
        }

        .test-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen">
    <div class="container mx-auto py-8 px-4">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-800 mb-2">
                <i class="fas fa-bug text-red-500 mr-3"></i>
                Test Dashboard
            </h1>
            <p class="text-gray-600 text-lg">LFS Exam Management System - Testing & Debug Center</p>
            <div class="mt-4 inline-flex items-center px-4 py-2 bg-yellow-100 border border-yellow-400 rounded-lg">
                <i class="fas fa-exclamation-triangle text-yellow-600 mr-2"></i>
                <span class="text-yellow-800 font-medium">For Development & Testing Only</span>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-white rounded-lg shadow p-4 text-center">
                <div class="text-2xl font-bold text-blue-600">{{ $totalComponents ?? 'N/A' }}</div>
                <div class="text-gray-600">Components</div>
            </div>
            <div class="bg-white rounded-lg shadow p-4 text-center">
                <div class="text-2xl font-bold text-green-600">{{ $basicComponents ?? 'N/A' }}</div>
                <div class="text-gray-600">Basic</div>
            </div>
            <div class="bg-white rounded-lg shadow p-4 text-center">
                <div class="text-2xl font-bold text-purple-600">{{ $examComponents ?? 'N/A' }}</div>
                <div class="text-gray-600">Exam</div>
            </div>
            <div class="bg-white rounded-lg shadow p-4 text-center">
                <div class="text-2xl font-bold text-orange-600">{{ $otherComponents ?? 'N/A' }}</div>
                <div class="text-gray-600">Others</div>
            </div>
        </div>

        <!-- Basic Components -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-cube text-blue-500 mr-3"></i>
                Basic Components
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <!-- Classes -->
                <div class="test-card bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-school text-blue-500 text-2xl mr-3"></i>
                        <h3 class="text-lg font-semibold">Classes</h3>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">Manage school classes with ordering</p>
                    <a href="{{ route('test.myclass') }}"
                        class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition-colors">
                        <i class="fas fa-play mr-2"></i>Test Component
                    </a>
                </div>

                <!-- Sections -->
                <div class="test-card bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-layer-group text-green-500 text-2xl mr-3"></i>
                        <h3 class="text-lg font-semibold">Sections</h3>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">Manage school sections with capacity</p>
                    <a href="{{ route('test.section') }}"
                        class="inline-flex items-center px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 transition-colors">
                        <i class="fas fa-play mr-2"></i>Test Component
                    </a>
                </div>

                <!-- Class Sections -->
                <div class="test-card bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-link text-purple-500 text-2xl mr-3"></i>
                        <h3 class="text-lg font-semibold">Class Sections</h3>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">Assign sections to classes</p>
                    <a href="{{ route('test.myclass.section') }}"
                        class="inline-flex items-center px-4 py-2 bg-purple-500 text-white rounded hover:bg-purple-600 transition-colors">
                        <i class="fas fa-play mr-2"></i>Test Component
                    </a>
                </div>

                <!-- Subject Types -->
                <div class="test-card bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-tags text-orange-500 text-2xl mr-3"></i>
                        <h3 class="text-lg font-semibold">Subject Types</h3>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">Manage subject categories</p>
                    <a href="{{ route('test.subject.type') }}"
                        class="inline-flex items-center px-4 py-2 bg-orange-500 text-white rounded hover:bg-orange-600 transition-colors">
                        <i class="fas fa-play mr-2"></i>Test Component
                    </a>
                </div>

                <!-- Subjects -->
                <div class="test-card bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-book text-indigo-500 text-2xl mr-3"></i>
                        <h3 class="text-lg font-semibold">Subjects</h3>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">Manage school subjects</p>
                    <a href="{{ route('test.subject') }}"
                        class="inline-flex items-center px-4 py-2 bg-indigo-500 text-white rounded hover:bg-indigo-600 transition-colors">
                        <i class="fas fa-play mr-2"></i>Test Component
                    </a>
                </div>

                <!-- Class Subjects -->
                <div class="test-card bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-clipboard-list text-teal-500 text-2xl mr-3"></i>
                        <h3 class="text-lg font-semibold">Class Subjects</h3>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">Assign subjects to classes</p>
                    <a href="{{ route('test.myclass.subject') }}"
                        class="inline-flex items-center px-4 py-2 bg-teal-500 text-white rounded hover:bg-teal-600 transition-colors">
                        <i class="fas fa-play mr-2"></i>Test Component
                    </a>
                </div>
            </div>
        </div>

        <!-- Teacher & User Management -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-users text-green-500 mr-3"></i>
                Teacher & User Management
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <!-- Teachers -->
                <div class="test-card bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-chalkboard-teacher text-blue-500 text-2xl mr-3"></i>
                        <h3 class="text-lg font-semibold">Teachers</h3>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">Manage teaching staff</p>
                    <div class="flex space-x-2">
                        <a href="{{ route('test.teacher') }}"
                            class="inline-flex items-center px-3 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition-colors">
                            <i class="fas fa-play mr-1"></i>Normal
                        </a>
                        <a href="{{ route('test.teacher.modal') }}"
                            class="inline-flex items-center px-3 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition-colors">
                            <i class="fas fa-bug mr-1"></i>Debug
                        </a>
                    </div>
                </div>

                <!-- Subject Teachers -->
                <div class="test-card bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-user-graduate text-purple-500 text-2xl mr-3"></i>
                        <h3 class="text-lg font-semibold">Subject Teachers</h3>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">Assign teachers to subjects</p>
                    <a href="{{ route('test.subject.teacher') }}"
                        class="inline-flex items-center px-4 py-2 bg-purple-500 text-white rounded hover:bg-purple-600 transition-colors">
                        <i class="fas fa-play mr-2"></i>Test Component
                    </a>
                </div>

                <!-- User Roles -->
                <div class="test-card bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-user-shield text-orange-500 text-2xl mr-3"></i>
                        <h3 class="text-lg font-semibold">User Roles</h3>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">Manage user roles & permissions</p>
                    <a href="{{ route('test.user.role') }}"
                        class="inline-flex items-center px-4 py-2 bg-orange-500 text-white rounded hover:bg-orange-600 transition-colors">
                        <i class="fas fa-play mr-2"></i>Test Component
                    </a>
                </div>

                <!-- User Role Management -->
                <div class="test-card bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-user-cog text-indigo-500 text-2xl mr-3"></i>
                        <h3 class="text-lg font-semibold">User Role Management</h3>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">Advanced user role management</p>
                    <a href="{{ route('user.role.management') }}"
                        class="inline-flex items-center px-4 py-2 bg-indigo-500 text-white rounded hover:bg-indigo-600 transition-colors">
                        <i class="fas fa-play mr-2"></i>Test Component
                    </a>
                </div>
            </div>
        </div>

        <!-- Student Management -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-graduation-cap text-purple-500 mr-3"></i>
                Student Management
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <!-- Student Database -->
                <div class="test-card bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-database text-blue-500 text-2xl mr-3"></i>
                        <h3 class="text-lg font-semibold">Student Database</h3>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">Comprehensive student database</p>
                    <a href="{{ route('test.student.db') }}"
                        class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition-colors">
                        <i class="fas fa-play mr-2"></i>Test Component
                    </a>
                </div>

                <!-- Student Records -->
                <div class="test-card bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-id-card text-green-500 text-2xl mr-3"></i>
                        <h3 class="text-lg font-semibold">Student Records</h3>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">Class-wise student records</p>
                    <a href="{{ route('test.student.cr') }}"
                        class="inline-flex items-center px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 transition-colors">
                        <i class="fas fa-play mr-2"></i>Test Component
                    </a>
                </div>

                <!-- Student Profile -->
                <div class="test-card bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-user-graduate text-purple-500 text-2xl mr-3"></i>
                        <h3 class="text-lg font-semibold">Student Profile</h3>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">View student profile with tabs</p>
                    <div class="flex flex-col space-y-2">
                        <a href="{{ route('test.student.profile') }}"
                            class="inline-flex items-center px-4 py-2 bg-purple-500 text-white rounded hover:bg-purple-600 transition-colors">
                            <i class="fas fa-play mr-2"></i>Livewire Component
                        </a>
                        <a href="{{ route('simple.student.profile') }}"
                            class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition-colors">
                            <i class="fas fa-play mr-2"></i>Simple Component
                        </a>
                        <a href="{{ route('test.student.profile.view') }}"
                            class="inline-flex items-center px-4 py-2 bg-indigo-500 text-white rounded hover:bg-indigo-600 transition-colors">
                            <i class="fas fa-play mr-2"></i>Blade View
                        </a>
                        <a href="{{ route('debug.student.profile') }}"
                            class="inline-flex items-center px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition-colors">
                            <i class="fas fa-bug mr-2"></i>Debug Component
                        </a>
                    </div>
                </div>

                <!-- Student Progress Report -->
                <div class="test-card bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-chart-line text-indigo-500 text-2xl mr-3"></i>
                        <h3 class="text-lg font-semibold">Progress Report</h3>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">View student progress reports</p>
                    <a href="{{ route('test.student.progress.report') }}"
                        class="inline-flex items-center px-4 py-2 bg-indigo-500 text-white rounded hover:bg-indigo-600 transition-colors">
                        <i class="fas fa-play mr-2"></i>Test Component
                    </a>
                </div>
            </div>
        </div>

        <!-- Exam Management -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-clipboard-check text-red-500 mr-3"></i>
                Exam Management
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <!-- Class Exam Subject -->
                <div class="test-card bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-list-check text-blue-500 text-2xl mr-3"></i>
                        <h3 class="text-lg font-semibold">Class Exam Subject</h3>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">Configure exam subjects for classes</p>
                    <a href="{{ route('test.class.exam.subject') }}"
                        class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition-colors">
                        <i class="fas fa-play mr-2"></i>Test Component
                    </a>
                </div>

                <!-- FMPM Settings -->
                <div class="test-card bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-calculator text-green-500 text-2xl mr-3"></i>
                        <h3 class="text-lg font-semibold">FMPM Settings</h3>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">Full marks & pass marks configuration</p>
                    <div class="flex flex-col space-y-2">
                        <a href="{{ route('test.fmpm.simple') }}"
                            class="inline-flex items-center px-3 py-2 bg-teal-500 text-white rounded hover:bg-teal-600 transition-colors">
                            <i class="fas fa-play mr-1"></i>Simple FMPM
                        </a>
                        <a href="{{ route('exam.setting.fmpm') }}"
                            class="inline-flex items-center px-3 py-2 bg-green-500 text-white rounded hover:bg-green-600 transition-colors">
                            <i class="fas fa-play mr-1"></i>FMPM with Feature Flag
                        </a>
                        <a href="{{ route('exam.setting.modular') }}"
                            class="inline-flex items-center px-3 py-2 bg-purple-500 text-white rounded hover:bg-purple-600 transition-colors">
                            <i class="fas fa-play mr-1"></i>Modular Exam Setting
                        </a>
                        <a href="{{ route('exam.setting.legacy') }}"
                            class="inline-flex items-center px-3 py-2 bg-orange-500 text-white rounded hover:bg-orange-600 transition-colors">
                            <i class="fas fa-play mr-1"></i>Legacy Exam Setting
                        </a>
                    </div>
                </div>

                <!-- Exam Setting Components -->
                <div class="test-card bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-cogs text-indigo-500 text-2xl mr-3"></i>
                        <h3 class="text-lg font-semibold">Exam Setting Components</h3>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">Various exam setting implementations</p>
                    <div class="flex flex-col space-y-2">
                        <a href="{{ route('test.exam.setting') }}"
                            class="inline-flex items-center px-3 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition-colors">
                            <i class="fas fa-play mr-1"></i>Exam Setting
                        </a>
                        <a href="{{ route('test.updated.exam.setting') }}"
                            class="inline-flex items-center px-3 py-2 bg-purple-500 text-white rounded hover:bg-purple-600 transition-colors">
                            <i class="fas fa-play mr-1"></i>Updated Exam Setting
                        </a>
                        <a href="{{ route('test.modular.exam.setting') }}"
                            class="inline-flex items-center px-3 py-2 bg-indigo-500 text-white rounded hover:bg-indigo-600 transition-colors">
                            <i class="fas fa-play mr-1"></i>Modular Implementation
                        </a>
                    </div>
                </div>

                <!-- Answer Script Distribution -->
                <div class="test-card bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-file-alt text-purple-500 text-2xl mr-3"></i>
                        <h3 class="text-lg font-semibold">Script Distribution</h3>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">Assign answer scripts to teachers</p>
                    {{-- <a href="{{ route('test-test') }}"
                        class="inline-flex items-center px-4 py-2 bg-purple-500 text-white rounded hover:bg-purple-600 transition-colors">
                        <i class="fas fa-play mr-2"></i>Test Component
                    </a> --}}
                </div>

                <!-- Marks Entry -->
                <div class="test-card bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-edit text-orange-500 text-2xl mr-3"></i>
                        <h3 class="text-lg font-semibold">Marks Entry</h3>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">Enter student marks</p>
                    <div class="flex flex-col space-y-2">
                        <a href="{{ route('test.marks.entry') }}"
                            class="inline-flex items-center px-4 py-2 bg-orange-500 text-white rounded hover:bg-orange-600 transition-colors">
                            <i class="fas fa-play mr-2"></i>Marks Entry Test
                        </a>
                        <a href="{{ route('marks-entry') }}"
                            class="inline-flex items-center px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition-colors">
                            <i class="fas fa-play mr-2"></i>Marks Entry
                        </a>
                        <a href="{{ route('test-teacher-wise-marks-entry') }}"
                            class="inline-flex items-center px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition-colors">
                            <i class="fas fa-play mr-2"></i>Teacher Wise Entry
                        </a>
                    </div>
                </div>

                <!-- Formative Marks Entry -->
                <div class="test-card bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-file-contract text-teal-500 text-2xl mr-3"></i>
                        <h3 class="text-lg font-semibold">Formative Marks Entry</h3>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">Enter formative assessment marks</p>
                    <div class="flex flex-col space-y-2">
                        <a href="{{ route('test.formative.marks.entry.info') }}"
                            class="inline-flex items-center px-4 py-2 bg-teal-500 text-white rounded hover:bg-teal-600 transition-colors">
                            <i class="fas fa-play mr-2"></i>Info Page
                        </a>
                        <a href="{{ route('test.formative.marks.entry', ['exam_detail_id' => 1, 'myclass_section_id' => 1]) }}"
                            class="inline-flex items-center px-4 py-2 bg-cyan-500 text-white rounded hover:bg-cyan-600 transition-colors">
                            <i class="fas fa-play mr-2"></i>Entry Component
                        </a>
                    </div>
                </div>

                <!-- Mark Register -->
                <div class="test-card bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-chart-bar text-red-500 text-2xl mr-3"></i>
                        <h3 class="text-lg font-semibold">Mark Register</h3>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">View comprehensive mark register</p>
                    <a href="{{ route('test.mark.register') }}"
                        class="inline-flex items-center px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition-colors">
                        <i class="fas fa-play mr-2"></i>Test Component
                    </a>
                </div>

                <!-- Exam Finalization -->
                <div class="test-card bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-lock text-gray-700 text-2xl mr-3"></i>
                        <h3 class="text-lg font-semibold">Exam Finalization</h3>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">Task finalization & lock status</p>
                    <div class="flex flex-col space-y-2">
                        <a href="{{ route('task.finalize.lock.status') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-700 text-white rounded hover:bg-gray-800 transition-colors">
                            <i class="fas fa-play mr-2"></i>Lock Status
                        </a>
                        <a href="{{ route('test.class.exam.finalization') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 transition-colors">
                            <i class="fas fa-play mr-2"></i>Class Finalization
                        </a>
                    </div>
                </div>

                <!-- Grades -->
                <div class="test-card bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-award text-yellow-500 text-2xl mr-3"></i>
                        <h3 class="text-lg font-semibold">Grades</h3>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">Grade management and configuration</p>
                    {{-- <a href="{{ route('test.grades') }}"
                        class="inline-flex items-center px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition-colors">
                        <i class="fas fa-play mr-2"></i>Test Component
                    </a> --}}
                </div>
            </div>
        </div>

        <!-- System Components -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-cogs text-gray-500 mr-3"></i>
                System Components
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <!-- Dashboard -->
                <div class="test-card bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-tachometer-alt text-blue-500 text-2xl mr-3"></i>
                        <h3 class="text-lg font-semibold">Dashboard</h3>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">Main dashboard component</p>
                    <a href="{{ route('test.dashboard') }}"
                        class="inline-flex items-center px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition-colors">
                        <i class="fas fa-play mr-2"></i>Test Component
                    </a>
                </div>

                <!-- Sessions -->
                <div class="test-card bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-calendar-alt text-green-500 text-2xl mr-3"></i>
                        <h3 class="text-lg font-semibold">Sessions</h3>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">Manage academic sessions</p>
                    <div class="flex flex-col space-y-2">
                        <a href="{{ route('test.session') }}"
                            class="inline-flex items-center px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 transition-colors">
                            <i class="fas fa-play mr-2"></i>Session Test
                        </a>
                        <a href="{{ route('test.session.comp') }}"
                            class="inline-flex items-center px-4 py-2 bg-emerald-500 text-white rounded hover:bg-emerald-600 transition-colors">
                            <i class="fas fa-play mr-2"></i>Session Component
                        </a>
                    </div>
                </div>

                <!-- Logs Viewer -->
                <div class="test-card bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-file-code text-gray-500 text-2xl mr-3"></i>
                        <h3 class="text-lg font-semibold">Logs Viewer</h3>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">View system logs</p>
                    <a href="{{ route('test.logs.viewer') }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 transition-colors">
                        <i class="fas fa-play mr-2"></i>Test Component
                    </a>
                </div>

                <!-- Modals & UI Components -->
                <div class="test-card bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-window-maximize text-purple-500 text-2xl mr-3"></i>
                        <h3 class="text-lg font-semibold">Modals & UI</h3>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">UI components and modals</p>
                    <div class="flex flex-col space-y-2">
                        <a href="{{ route('test.modal.simple') }}"
                            class="inline-flex items-center px-4 py-2 bg-purple-500 text-white rounded hover:bg-purple-600 transition-colors">
                            <i class="fas fa-play mr-2"></i>Simple Modal
                        </a>
                    </div>
                </div>

                <!-- Subject Grouping -->
                <div class="test-card bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-object-group text-indigo-500 text-2xl mr-3"></i>
                        <h3 class="text-lg font-semibold">Subject Grouping</h3>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">Group subjects for exams</p>
                    <a href="{{ route('test.subject.grouping') }}"
                        class="inline-flex items-center px-4 py-2 bg-indigo-500 text-white rounded hover:bg-indigo-600 transition-colors">
                        <i class="fas fa-play mr-2"></i>Test Component
                    </a>
                </div>

                <!-- Class Section Tasks -->
                <div class="test-card bg-white rounded-lg shadow-md p-6">
                    <div class="flex items-center mb-3">
                        <i class="fas fa-tasks text-orange-500 text-2xl mr-3"></i>
                        <h3 class="text-lg font-semibold">Class Section Tasks</h3>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">Manage class section tasks</p>
                    <div class="flex flex-col space-y-2">
                        {{-- <a href="{{ route('test.class.section.tasks') }}"
                            class="inline-flex items-center px-4 py-2 bg-orange-500 text-white rounded hover:bg-orange-600 transition-colors">
                            <i class="fas fa-play mr-2"></i>Tasks Component
                        </a> --}}
                        <a href="{{ route('test.class.section.tasks.info') }}"
                            class="inline-flex items-center px-4 py-2 bg-amber-500 text-white rounded hover:bg-amber-600 transition-colors">
                            <i class="fas fa-play mr-2"></i>Tasks Info
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-bolt text-yellow-500 mr-3"></i>
                Quick Actions
            </h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <a href="/"
                    class="flex items-center justify-center px-4 py-3 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-colors">
                    <i class="fas fa-home mr-2"></i>Home
                </a>
                <a href="/dashboard"
                    class="flex items-center justify-center px-4 py-3 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition-colors">
                    <i class="fas fa-tachometer-alt mr-2"></i>Dashboard
                </a>
                <a href="/admin/home"
                    class="flex items-center justify-center px-4 py-3 bg-purple-100 text-purple-700 rounded-lg hover:bg-purple-200 transition-colors">
                    <i class="fas fa-user-shield mr-2"></i>Admin
                </a>
                <button onclick="window.location.reload()"
                    class="flex items-center justify-center px-4 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                    <i class="fas fa-sync-alt mr-2"></i>Refresh
                </button>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-8 text-gray-500">
            <p>&copy; {{ date('Y') }} LFS Exam Management System - Test Dashboard</p>
            <p class="text-sm mt-1">Built with Laravel & Livewire</p>
        </div>
    </div>
</body>

</html>