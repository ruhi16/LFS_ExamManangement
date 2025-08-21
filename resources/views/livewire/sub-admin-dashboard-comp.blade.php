<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-100 py-12 px-4">

    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row gap-10">

            <!-- Left Side: Profile Card Vertical -->
            <div class="w-full md:w-1/3 flex-shrink-0">
                <div class="bg-white rounded-3xl shadow-xl border-b-4 border-indigo-400 p-8 flex flex-col items-center">
                    <div class="mb-4 relative">
                        <img src="{{ asset('storage/teacher-profiles/teacher-avatar.jpg') }}" alt="Profile"
                            class="h-32 w-32 rounded-full object-cover border-4 border-indigo-200 shadow-md" />
                    </div>
                    <h1 class="text-2xl font-extrabold text-indigo-800 mb-1 tracking-wide text-center">{{
                        $user->teacher->name }}</h1>
                    <p class="text-gray-500 mb-2 text-center">{{ $user->email }}</p>
                    {{-- <span
                        class="inline-block px-3 py-1 rounded-2xl text-xs font-bold
                        {{ $user->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-900' }}">
                        {{ ucfirst($user->status) }}
                    </span>
                    <div
                        class="mt-4 px-4 py-2 rounded-xl bg-gradient-to-br from-indigo-100 to-blue-100 text-indigo-700 font-semibold text-sm shadow-inner">
                        <i class="fas fa-chalkboard-teacher"></i> {{ ucfirst($user->role ?? 'Teacher') }}
                    </div> --}}
                </div>
            </div>

            <!-- Right Side: Stats and Info -->
            <div class="w-full md:w-2/3 flex flex-col gap-8">

                <!-- Feature Cards Row -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    <div
                        class="bg-gradient-to-br from-indigo-200 to-blue-100 rounded-2xl shadow-sm py-8 px-4 text-center">
                        <div class="mb-3">
                            <i class="fas fa-users text-2xl text-indigo-700"></i>
                        </div>
                        <div class="text-2xl font-bold text-indigo-900">{{ $user->students_count ?? 0 }}</div>
                        <div class="text-gray-500 text-base">Students</div>
                    </div>
                    <div
                        class="bg-gradient-to-br from-green-100 to-gray-50 rounded-2xl shadow-sm py-8 px-4 text-center">
                        <div class="mb-3">
                            <i class="fas fa-book text-2xl text-green-700"></i>
                        </div>
                        <div class="text-2xl font-bold text-green-900">{{ $user->subjects_count ?? 0 }}</div>
                        <div class="text-gray-500 text-base">Subjects</div>
                    </div>
                    <div
                        class="bg-gradient-to-br from-yellow-100 to-orange-50 rounded-2xl shadow-sm py-8 px-4 text-center">
                        <div class="mb-3">
                            <i class="fas fa-calendar-check text-2xl text-yellow-700"></i>
                        </div>
                        <div class="text-2xl font-bold text-yellow-900">{{ $user->upcoming_classes_count ?? 0 }}</div>
                        <div class="text-gray-500 text-base">Upcoming</div>
                    </div>
                </div>

                <!-- Basic Info and Subjects/Classes -->
                {{-- <div class="grid grid-cols-1 md:grid-cols-2 gap-8 bg-white opacity-95 rounded-2xl shadow-lg p-8">
                    <div>
                        <h2
                            class="text-xl font-semibold text-indigo-700 mb-4 border-indigo-100 border-b pb-1 flex items-center">
                            <i class="fas fa-info-circle mr-2 text-indigo-400"></i> Teacher Info
                        </h2>
                        <div class="mb-3"><strong>ID:</strong> <span class="font-mono text-indigo-900">{{ $user->id
                                }}</span></div>
                        <div class="mb-3"><strong>Role:</strong> {{ ucfirst($user->role ?? 'Teacher') }}</div>
                        <div class="mb-3"><strong>Total Classes:</strong> {{ $user->classes_count ?? 'N/A' }}</div>
                    </div>
                    <div>
                        <h2
                            class="text-xl font-semibold text-indigo-700 mb-4 border-indigo-100 border-b pb-1 flex items-center">
                            <i class="fas fa-book-open mr-2 text-indigo-400"></i> Subjects
                        </h2>
                        @if($user->subjects && count($user->subjects))
                        <ul class="list-disc pl-5">
                            @foreach($user->subjects as $subject)
                            <li class="font-mono text-blue-700 mb-1">{{ $subject }}</li>
                            @endforeach
                        </ul>
                        @else
                        <span class="text-gray-400 italic">No subjects assigned.</span>
                        @endif
                    </div>
                </div> --}}


            </div>
        </div>
        <!-- Recent Activity -->
        <div class="bg-white opacity-95 rounded-2xl shadow-lg p-8 mt-8">
            <h2 class="text-xl font-bold text-indigo-700 mb-5 flex items-center">
                <i class="fas fa-history text-indigo-400 mr-3"></i> Allotet Answer Scripts
            </h2>
            {{-- <ul class="space-y-3">
                @forelse($user->recent_activities ?? [] as $activity)
                <li class="flex items-center">
                    <span class="w-3 h-3 bg-blue-300 rounded-full mr-4"></span>
                    <span class="text-base text-gray-700 font-medium">{{ $activity }}</span>
                </li>
                @empty
                <li class="text-gray-400 italic ml-6">No recent activity found.</li>
                @endforelse
            </ul> --}}
            <table class="min-w-full divide-y divide-gray-200 mt-4">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Sl
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Date
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Exam Name
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Exam Type
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Class Section
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Subject
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    {{-- {{ $subAdminTeacher }} --}}
                    @forelse($subAdminTeacher->getAnswerScripts as $answerScript)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $loop->iteration }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $answerScript->created_at->format('M d, Y') }} {{--format('M d, Y h:i A') --}}
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $answerScript->examDetail->name ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $answerScript->examDetail->examType->name ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $answerScript->myclassSection->myclass->name ?? 'N/A' }} -
                            {{ $answerScript->myclassSection->section->name ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $answerScript->myclassSubject->Subject->name ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $answerScript->status ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            {{-- <a href="{{ route('marks-entry.detail') }}"
                                class="text-indigo-600 hover:text-indigo-900">View</a> --}}
                                {{-- {{ $answerScript }} --}}
                            <a class="text-indigo-600 hover:text-indigo-900"                                
                                href="{{ route('marks-entry.detail', [
                                    'examDetailId' => $answerScript->exam_detail_id, 
                                    'subjectId' => $answerScript->myclassSubject->subject_id, 
                                    'sectionId' => $answerScript->myclassSection->section_id]) }}">
                                View
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900" colspan="2">
                            No recent activity found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>


        </div>


        
    </div>
</div>