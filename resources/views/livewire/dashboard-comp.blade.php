<div class="p-6">
    <!-- Header Section -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Exam Management Dashboard</h1>
            <p class="text-gray-600 mt-1">Complete overview of your examination system</p>
        </div>
        <div class="flex items-center space-x-4">
            <!-- Session Widget -->
            <div class="w-64">
                @livewire('session-comp', ['widget' => true])
            </div>
            <button wire:click="refreshData"
                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                <i class="fas fa-sync-alt mr-2"></i>Refresh Data
            </button>
        </div>
    </div>

    <!-- Quick Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Students Card -->
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg shadow-lg text-white p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm font-medium">Total Students</p>
                    <p class="text-3xl font-bold">{{ number_format($student_stats['total_students']) }}</p>
                    <p class="text-blue-100 text-xs mt-1">
                        {{ $student_stats['active_students'] }} active
                    </p>
                </div>
                <div class="bg-blue-400 bg-opacity-30 rounded-full p-3">
                    <i class="fas fa-users text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Classes Card -->
        <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-lg shadow-lg text-white p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-sm font-medium">Classes & Sections</p>
                    <p class="text-3xl font-bold">
                        {{ $academic_stats['total_classes'] }}/{{ $academic_stats['total_sections'] }}
                    </p>
                    <p class="text-green-100 text-xs mt-1">
                        {{ $academic_stats['class_sections'] }} combinations
                    </p>
                </div>
                <div class="bg-green-400 bg-opacity-30 rounded-full p-3">
                    <i class="fas fa-school text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Exams Card -->
        <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg shadow-lg text-white p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-sm font-medium">Exam Configurations</p>
                    <p class="text-3xl font-bold">{{ $exam_stats['exam_details'] }}</p>
                    <p class="text-purple-100 text-xs mt-1">
                        {{ $exam_stats['active_exams'] }} active
                    </p>
                </div>
                <div class="bg-purple-400 bg-opacity-30 rounded-full p-3">
                    <i class="fas fa-clipboard-list text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Marks Card -->
        <div class="bg-gradient-to-r from-orange-500 to-orange-600 rounded-lg shadow-lg text-white p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-orange-100 text-sm font-medium">Marks Entries</p>
                    <p class="text-3xl font-bold">{{ number_format($marks_stats['total_marks_entries']) }}</p>
                    <p class="text-orange-100 text-xs mt-1">
                        {{ $marks_stats['marks_entered_today'] }} today
                    </p>
                </div>
                <div class="bg-orange-400 bg-opacity-30 rounded-full p-3">
                    <i class="fas fa-chart-line text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Column - Detailed Stats -->
        <div class="lg:col-span-2 space-y-6">

            <!-- Student Statistics -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="flex items-center justify-between p-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-users text-blue-500 mr-2"></i>Student Statistics
                    </h3>
                    <button wire:click="toggleDetails('students')" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-{{ $showDetails['students'] ? 'chevron-up' : 'chevron-down' }}"></i>
                    </button>
                </div>
                @if($showDetails['students'])
                    <div class="p-4">
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            <div class="text-center p-3 bg-blue-50 rounded-lg">
                                <div class="text-2xl font-bold text-blue-600">{{ $student_stats['total_students'] }}</div>
                                <div class="text-sm text-gray-600">Total Students</div>
                            </div>
                            <div class="text-center p-3 bg-green-50 rounded-lg">
                                <div class="text-2xl font-bold text-green-600">{{ $student_stats['active_students'] }}</div>
                                <div class="text-sm text-gray-600">Active Students</div>
                            </div>
                            <div class="text-center p-3 bg-yellow-50 rounded-lg">
                                <div class="text-2xl font-bold text-yellow-600">{{ $student_stats['students_with_photos'] }}
                                </div>
                                <div class="text-sm text-gray-600">With Photos</div>
                            </div>
                            <div class="text-center p-3 bg-purple-50 rounded-lg">
                                <div class="text-2xl font-bold text-purple-600">
                                    {{ $student_stats['students_with_documents'] }}
                                </div>
                                <div class="text-sm text-gray-600">With Documents</div>
                            </div>
                            <div class="text-center p-3 bg-indigo-50 rounded-lg">
                                <div class="text-2xl font-bold text-indigo-600">{{ $student_stats['recent_admissions'] }}
                                </div>
                                <div class="text-sm text-gray-600">Recent Admissions</div>
                            </div>
                            <div class="text-center p-3 bg-red-50 rounded-lg">
                                <div class="text-2xl font-bold text-red-600">{{ $student_stats['inactive_students'] }}</div>
                                <div class="text-sm text-gray-600">Inactive Students</div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Academic Structure -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="flex items-center justify-between p-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-school text-green-500 mr-2"></i>Academic Structure
                    </h3>
                    <button wire:click="toggleDetails('academics')" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-{{ $showDetails['academics'] ? 'chevron-up' : 'chevron-down' }}"></i>
                    </button>
                </div>
                @if($showDetails['academics'])
                    <div class="p-4">
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div class="text-center p-3 bg-green-50 rounded-lg">
                                <div class="text-2xl font-bold text-green-600">{{ $academic_stats['total_classes'] }}</div>
                                <div class="text-sm text-gray-600">Classes</div>
                            </div>
                            <div class="text-center p-3 bg-blue-50 rounded-lg">
                                <div class="text-2xl font-bold text-blue-600">{{ $academic_stats['total_sections'] }}</div>
                                <div class="text-sm text-gray-600">Sections</div>
                            </div>
                            <div class="text-center p-3 bg-purple-50 rounded-lg">
                                <div class="text-2xl font-bold text-purple-600">{{ $academic_stats['total_subjects'] }}
                                </div>
                                <div class="text-sm text-gray-600">Subjects</div>
                            </div>
                            <div class="text-center p-3 bg-indigo-50 rounded-lg">
                                <div class="text-2xl font-bold text-indigo-600">{{ $academic_stats['subject_types'] }}</div>
                                <div class="text-sm text-gray-600">Subject Types</div>
                            </div>
                            <div class="text-center p-3 bg-yellow-50 rounded-lg">
                                <div class="text-2xl font-bold text-yellow-600">{{ $academic_stats['class_sections'] }}
                                </div>
                                <div class="text-sm text-gray-600">Class-Sections</div>
                            </div>
                            <div class="text-center p-3 bg-pink-50 rounded-lg">
                                <div class="text-2xl font-bold text-pink-600">{{ $academic_stats['class_subjects'] }}</div>
                                <div class="text-sm text-gray-600">Class-Subjects</div>
                            </div>
                            <div class="text-center p-3 bg-orange-50 rounded-lg">
                                <div class="text-2xl font-bold text-orange-600">{{ $academic_stats['summative_subjects'] }}
                                </div>
                                <div class="text-sm text-gray-600">Summative</div>
                            </div>
                            <div class="text-center p-3 bg-teal-50 rounded-lg">
                                <div class="text-2xl font-bold text-teal-600">{{ $academic_stats['formative_subjects'] }}
                                </div>
                                <div class="text-sm text-gray-600">Formative</div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Exam System Overview -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="flex items-center justify-between p-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-clipboard-list text-purple-500 mr-2"></i>Exam System Overview
                    </h3>
                    <button wire:click="toggleDetails('exams')" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-{{ $showDetails['exams'] ? 'chevron-up' : 'chevron-down' }}"></i>
                    </button>
                </div>
                @if($showDetails['exams'])
                        <div class="p-4">
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                <div class="text-center p-3 bg-purple-50 rounded-lg">
                                    <div class="text-2xl font-bold text-purple-600">{{ $exam_stats['exam_names'] }}</div>
                                    <div class="text-sm text-gray-600">Exam Names</div>
                                </div>
                                <div class="text-center p-3 bg-blue-50 rounded-lg">
                                    <div class="text-2xl font-bold text-blue-600">{{ $exam_stats['exam_types'] }}</div>
                                    <div class="text-sm text-gray-600">Exam Types</div>
                                </div>
                                <div class="text-center p-3 bg-green-50 rounded-lg">
                                    <div class="text-2xl font-bold text-green-600">{{ $exam_stats['exam_parts'] }}</div>
                                    <div class="text-sm text-gray-600">Exam Parts</div>
                                </div>
                                <div class="text-center p-3 bg-yellow-50 rounded-lg">
                                    <div class="text-2xl font-bold text-yellow-600">{{ $exam_stats['exam_modes'] }}</div>
                                    <div class="text-sm text-gray-600">Exam Modes</div>
                                </div>
                                <div class="text-center p-3 bg-indigo-50 rounded-lg">
                                    <div class="text-2xl font-bold text-indigo-600">{{ $exam_stats['exam_details'] }}</div>
                                    <div class="text-sm text-gray-600">Exam Details</div>
                                </div>
                                <div class="text-center p-3 bg-pink-50 rounded-lg">
                                    <div class="text-2xl font-bold text-pink-600">{{ $exam_stats['configured_class_subjects'] }}
                                    </div>
                                    <div class="text-sm text-gray-600">Configured Subjects</div>
                                </div>
                                <div class="text-center p-3 bg-orange-50 rounded-lg">
                                    <div class="text-2xl font-bold text-orange-600">
                                        {{ $exam_stats['answer_script_distributions'] }}
                                    </div>
                                    <div class="text-sm text-gray-600">Script Distributions</div>
                                </div>
                                <div class="text-center p-3 bg-teal-50 rounded-lg">
                                    <div class="text-2xl font-bold text-teal-600">{{ $exam_stats['active_exams'] }}</div>
                                    <div class="text-sm text-gray-600">Active Exams</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
        </div>

        <!-- Class-wise Student Distribution -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-chart-bar text-indigo-500 mr-2"></i>Class-wise Student Distribution
                </h3>
            </div>
            <div class="p-4">
                <div class="space-y-3">
                    @foreach($class_wise_stats as $class)
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-indigo-100 rounded-full flex items-center justify-center mr-3">
                                    <span class="text-indigo-600 font-semibold text-sm">{{ $class->order }}</span>
                                </div>
                                <div>
                                    <div class="font-medium text-gray-900">{{ $class->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $class->myclass_sections->count() }} sections
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-lg font-bold text-indigo-600">{{ $class->students_count }}</div>
                                <div class="text-sm text-gray-500">students</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column - Activity & Performance -->
    <div class="space-y-6">

        <!-- Recent Activity -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-clock text-blue-500 mr-2"></i>Recent Activity
                </h3>
            </div>
            <div class="p-4">
                <div class="space-y-4">
                    <div>
                        <h4 class="font-medium text-gray-900 mb-2">Latest Students</h4>
                        <div class="space-y-2">
                            @foreach($recent_activity['recent_students'] as $student)
                                <div class="flex items-center text-sm">
                                    <div class="w-2 h-2 bg-green-400 rounded-full mr-2"></div>
                                    <span class="text-gray-900">{{ $student->name }}</span>
                                    <span class="text-gray-500 ml-auto">{{ $student->created_at->diffForHumans() }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Exam Progress -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-tasks text-purple-500 mr-2"></i>Exam Progress
                </h3>
            </div>
            <div class="p-4">
                <div class="space-y-4">
                    @foreach($exam_progress->take(5) as $progress)
                        <div class="space-y-2">
                            <div class="flex justify-between items-center">
                                <div class="text-sm font-medium text-gray-900">
                                    Exam ID: {{ $progress['exam']->id ?? 'N/A' }}
                                </div>
                                <div class="text-sm text-gray-500">{{ $progress['progress'] }}%</div>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-{{ $progress['status'] == 'completed' ? 'green' : ($progress['status'] == 'in_progress' ? 'blue' : 'gray') }}-500 h-2 rounded-full"
                                    style="width: {{ $progress['progress'] }}%"></div>
                            </div>
                            <div class="text-xs text-gray-500">
                                {{ $progress['marks_entered'] }}/{{ $progress['total_students'] }} marks entered
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Top Performers -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-trophy text-yellow-500 mr-2"></i>Top Performers
                </h3>
            </div>
            <div class="p-4">
                <div class="space-y-3">
                    @foreach($top_performers->take(5) as $index => $performer)
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center mr-3">
                                <span class="text-yellow-600 font-bold text-sm">{{ $index + 1 }}</span>
                            </div>
                            <div class="flex-1">
                                <div class="font-medium text-gray-900">{{ $performer->student->name ?? 'N/A' }}</div>
                                <div class="text-sm text-gray-500">Avg: {{ number_format($performer->avg_marks, 2) }}%
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- System Statistics -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="flex items-center justify-between p-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i class="fas fa-cogs text-gray-500 mr-2"></i>System Statistics
                </h3>
                <button wire:click="toggleDetails('system')" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-{{ $showDetails['system'] ? 'chevron-up' : 'chevron-down' }}"></i>
                </button>
            </div>
            @if($showDetails['system'])
                <div class="p-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="text-center p-3 bg-gray-50 rounded-lg">
                            <div class="text-2xl font-bold text-gray-600">{{ $system_stats['total_users'] }}</div>
                            <div class="text-sm text-gray-600">Total Users</div>
                        </div>
                        <div class="text-center p-3 bg-blue-50 rounded-lg">
                            <div class="text-2xl font-bold text-blue-600">{{ $system_stats['active_users'] }}</div>
                            <div class="text-sm text-gray-600">Active Users</div>
                        </div>
                        <div class="text-center p-3 bg-green-50 rounded-lg">
                            <div class="text-2xl font-bold text-green-600">{{ $system_stats['total_teachers'] }}</div>
                            <div class="text-sm text-gray-600">Teachers</div>
                        </div>
                        <div class="text-center p-3 bg-purple-50 rounded-lg">
                            <div class="text-2xl font-bold text-purple-600">{{ $system_stats['admin_users'] }}</div>
                            <div class="text-sm text-gray-600">Admins</div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Flash Messages -->
@if (session()->has('message'))
    <div class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
        <div class="flex items-center">
            <i class="fas fa-check-circle mr-2"></i>
            {{ session('message') }}
        </div>
    </div>
@endif
</div>

<script>
    // Auto-hide flash messages
    setTimeout(funct ion() {
        const messages = document.querySelectorAll('[class*="fixed top-4 right-4"]');
        messages.forEach(func tion(message) {
            message.style.opacity = '0';
            setTimeout(fun ction () {
            message.remove();
        }, 300);
    });
    }, 3000);

    // Auto-refresh data every 30 seconds
    setInterval(fu nction() {
        @this.call('refreshData');
    }, 30000);
</script>