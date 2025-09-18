<div class="p-6">
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Teacher-wise Answer Script Allotments</h1>
        <p class="mt-1 text-sm text-gray-600">Arranged by Exam, then Class-Section with allotted subjects</p>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider w-64 sticky left-0 bg-gray-50 z-10">
                            Teacher
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                            Exam Name
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                            Exam Type
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                            Exam Mode
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                            Class
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                            Section
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                            Subject
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($distributions as $distribution)
                        <tr class="hover:bg-gray-50 align-top">
                            <td class="px-6 py-4 text-sm font-medium text-gray-900 sticky left-0 bg-white hover:bg-gray-50 z-10 border-r border-gray-200">
                                <div class="font-semibold">{{ optional($distribution->teacher)->name }}</div>
                            </td>
                        
                            <td class="px-6 py-4 text-sm font-medium text-gray-900 border-r border-gray-200">
                                <div class="font-semibold">{{ optional(optional($distribution->examDetail)->examName)->name }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900 border-r border-gray-200">
                                <div class="font-semibold">{{ optional(optional($distribution->examDetail)->examType)->name }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900 border-r border-gray-200">
                                <div class="font-semibold">{{ optional(optional($distribution->examDetail)->examMode)->name }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900 border-r border-gray-200">
                                <div class="font-semibold">{{ optional(optional($distribution->myclassSection)->myclass)->name }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900 border-r border-gray-200">
                                <div class="font-semibold">{{ optional(optional($distribution->myclassSection)->section)->name }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900 border-r border-gray-200">
                                <div class="font-semibold">{{ optional(optional($distribution->examClassSubject)->subject)->name ?? 'N/A' }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                @if($distribution->examClassSubject && $distribution->myclassSection)
                                    <a class="text-indigo-600 hover:text-indigo-900"
                                    href="{{ route('marks-entry.detail', [
                                        'examDetailId' => $distribution->exam_detail_id,
                                        'subjectId' => optional($distribution->examClassSubject)->subject_id,
                                        'sectionId' => $distribution->myclassSection->section_id]) }}">
                                        View
                                    </a>
                                @else
                                    <span class="text-gray-400 cursor-not-allowed" title="Cannot generate link due to missing data.">View</span>
                                @endif
                            </td>
                            {{-- @if($distByTeacher->has($teacher->id))
                                <div class="space-y-4">
                            @endif --}}
                        
                        
                        {{-- @php
                            $tDists = $distByTeacher->get($teacher->id, collect());
                            // Group by Exam Name first
                            $byExamName = $tDists->groupBy(function($d){
                                return optional(optional($d->examDetail)->examName)->name ?? 'Unknown Exam';
                            })->sortKeys();
                        @endphp
                        <tr class="hover:bg-gray-50 align-top">
                            <td class="px-6 py-4 text-sm font-medium text-gray-900 sticky left-0 bg-white z-10 border-r border-gray-200">
                                <div class="font-semibold">{{ $teacher->name }}</div>
                                @if(!empty($teacher->nickName))
                                    <div class="text-xs text-gray-500">({{ $teacher->nickName }})</div>
                                @endif
                                <div class="text-xs text-gray-400">ID: {{ $teacher->id }}</div>
                            </td> --}}
                            {{-- <td class="px-6 py-4">
                                @if($tDists->isEmpty())
                                    <span class="inline-block text-xs px-2 py-1 rounded bg-gray-100 text-gray-600 border border-gray-200">No allotments</span>
                                @else
                                    <div class="space-y-4">
                                        @foreach($byExamName as $examName => $examGroup)
                                            <div class="border border-gray-200 rounded-md">
                                                <div class="px-3 py-2 bg-gray-100 text-sm font-semibold text-gray-800 flex items-center gap-2">
                                                    <span class="inline-block px-2 py-0.5 rounded bg-blue-200 text-blue-800 text-xs">Exam</span>
                                                    <span>{{ $examName }}</span>
                                                </div>
                                                @php
                                                    // For this exam, group by class-section
                                                    $bySection = $examGroup->groupBy('myclass_section_id');
                                                @endphp
                                                <div class="p-3 space-y-3">
                                                    @foreach($bySection as $sectionId => $secGroup)
                                                        @php
                                                            $sec = optional($secGroup->first()->myclassSection);
                                                            $className = optional($sec->myclass)->name ?? 'Class?';
                                                            $sectionName = optional($sec->section)->name ?? 'Section?';
                                                            // Unique subjects for this class-section and exam for the teacher
                                                            $subIds = $secGroup->pluck('exam_class_subject_id')->filter()->unique();
                                                        @endphp
                                                        <div class="">
                                                            <div class="text-sm font-medium text-gray-800 mb-1">
                                                                <span class="inline-block px-2 py-0.5 rounded bg-indigo-100 text-indigo-800 text-xs mr-2">Class-Section</span>
                                                                <span>{{ $className }} - {{ $sectionName }}</span>
                                                            </div>
                                                            <div class="flex flex-wrap gap-2">
                                                                @forelse($subIds as $subId)
                                                                    @php
                                                                        $exClsSub = $subjectMap->get($subId);
                                                                        $subName = optional(optional($exClsSub)->subject)->name ?? 'Subject?';
                                                                    @endphp
                                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 border border-green-200">
                                                                        {{ $subName }}
                                                                    </span>
                                                                @empty
                                                                    <span class="text-xs text-gray-500">No subjects</span>
                                                                @endforelse
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
