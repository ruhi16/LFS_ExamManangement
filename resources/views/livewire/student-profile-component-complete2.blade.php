3</span>
<span class="text-sm text-gray-500">Submitted on: 16 Aug 2023</span>
</div>
</div>
<div class="border border-gray-200 rounded-lg p-4">
    <div class="flex justify-between">
        <h3 class="font-semibold text-gray-800">Computer Science - Programming</h3>
        <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs rounded-full">Pending</span>
    </div>
    <p class="text-gray-600 mt-2">Write a program to implement bubble sort algorithm</p>
    <div class="flex justify-between mt-3">
        <span class="text-sm text-gray-500">Due: 05 Sep 2023</span>
        <button class="text-blue-600 hover:text-blue-800 text-sm">Submit</button>
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
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="bg-white p-4 rounded-lg shadow">
                <div class="text-3xl font-bold text-blue-600">92%</div>
                <div class="text-gray-600">Overall Attendance</div>
            </div>
            <div class="bg-white p-4 rounded-lg shadow">
                <div class="text-3xl font-bold text-green-600">24</div>
                <div class="text-gray-600">Days Present</div>
            </div>
            <div class="bg-white p-4 rounded-lg shadow">
                <div class="text-3xl font-bold text-red-600">2</div>
                <div class="text-gray-600">Days Absent</div>
            </div>
        </div>

        <h3 class="font-semibold text-lg text-gray-800 mb-4">Monthly Attendance</h3>
        <div class="space-y-3">
            <div class="flex justify-between items-center">
                <span>August 2023</span>
                <div class="flex items-center">
                    <div class="w-32 bg-gray-200 rounded-full h-2.5 mr-3">
                        <div class="bg-blue-600 h-2.5 rounded-full" style="width: 95%"></div>
                    </div>
                    <span>95%</span>
                </div>
            </div>
            <div class="flex justify-between items-center">
                <span>July 2023</span>
                <div class="flex items-center">
                    <div class="w-32 bg-gray-200 rounded-full h-2.5 mr-3">
                        <div class="bg-green-600 h-2.5 rounded-full" style="width: 89%"></div>
                    </div>
                    <span>89%</span>
                </div>
            </div>
            <div class="flex justify-between items-center">
                <span>June 2023</span>
                <div class="flex items-center">
                    <div class="w-32 bg-gray-200 rounded-full h-2.5 mr-3">
                        <div class="bg-yellow-600 h-2.5 rounded-full" style="width: 92%"></div>
                    </div>
                    <span>92%</span>
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
                <h3 class="font-semibold text-lg text-gray-800 mb-4">Current Exams</h3>
                <div class="border border-gray-200 rounded-lg overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Exam</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Date</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Marks</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">Mid Term Exam</td>
                                <td class="px-6 py-4 whitespace-nowrap">15 Aug 2023</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Completed
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">85/100</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">Final Exam</td>
                                <td class="px-6 py-4 whitespace-nowrap">25 Sep 2023</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Upcoming
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">-</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div>
                <h3 class="font-semibold text-lg text-gray-800 mb-4">Previous Results</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-white p-4 rounded-lg shadow">
                        <div class="text-lg font-semibold">Quarterly Exam</div>
                        <div class="text-2xl font-bold text-blue-600 mt-2">82%</div>
                        <div class="text-sm text-gray-500 mt-1">April 2023</div>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow">
                        <div class="text-lg font-semibold">Half Yearly</div>
                        <div class="text-2xl font-bold text-green-600 mt-2">88%</div>
                        <div class="text-sm text-gray-500 mt-1">June 2023</div>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow">
                        <div class="text-lg font-semibold">Annual Exam</div>
                        <div class="text-2xl font-bold text-purple-600 mt-2">90%</div>
                        <div class="text-sm text-gray-500 mt-1">March 2023</div>
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
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Class Schedule</h2>
    <div class="bg-gray-50 rounded-lg p-6">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Time
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Monday</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Tuesday</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Wednesday</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Thursday</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Friday</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-medium">9:00 - 9:50</td>
                        <td class="px-6 py-4 whitespace-nowrap">Mathematics</td>
                        <td class="px-6 py-4 whitespace-nowrap">English</td>
                        <td class="px-6 py-4 whitespace-nowrap">Science</td>
                        <td class="px-6 py-4 whitespace-nowrap">Social Studies</td>
                        <td class="px-6 py-4 whitespace-nowrap">Computer</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-medium">9:50 - 10:40</td>
                        <td class="px-6 py-4 whitespace-nowrap">English</td>
                        <td class="px-6 py-4 whitespace-nowrap">Mathematics</td>
                        <td class="px-6 py-4 whitespace-nowrap">Hindi</td>
                        <td class="px-6 py-4 whitespace-nowrap">Science</td>
                        <td class="px-6 py-4 whitespace-nowrap">Art</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-medium">10:40 - 11:00</td>
                        <td class="px-6 py-4 whitespace-nowrap text-center font-semibold" colspan="5">Break</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-medium">11:00 - 11:50</td>
                        <td class="px-6 py-4 whitespace-nowrap">Science</td>
                        <td class="px-6 py-4 whitespace-nowrap">Social Studies</td>
                        <td class="px-6 py-4 whitespace-nowrap">Mathematics</td>
                        <td class="px-6 py-4 whitespace-nowrap">English</td>
                        <td class="px-6 py-4 whitespace-nowrap">Music</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-medium">11:50 - 12:40</td>
                        <td class="px-6 py-4 whitespace-nowrap">Hindi</td>
                        <td class="px-6 py-4 whitespace-nowrap">Computer</td>
                        <td class="px-6 py-4 whitespace-nowrap">English</td>
                        <td class="px-6 py-4 whitespace-nowrap">Mathematics</td>
                        <td class="px-6 py-4 whitespace-nowrap">Games</td>
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
                <h3 class="font-semibold text-lg text-gray-800 mb-4">Teacher Feedback</h3>
                <div class="space-y-4">
                    <div class="border-l-4 border-blue-500 pl-4 py-2">
                        <h4 class="font-medium text-gray-800">Mathematics - Mr. Sharma</h4>
                        <p class="text-gray-600 mt-1">Excellent problem-solving skills. Keep up the good work!</p>
                        <p class="text-sm text-gray-500 mt-2">Given on: 15 Aug 2023</p>
                    </div>
                    <div class="border-l-4 border-green-500 pl-4 py-2">
                        <h4 class="font-medium text-gray-800">Science - Dr. Verma</h4>
                        <p class="text-gray-600 mt-1">Shows great curiosity and asks insightful questions during
                            practical sessions.</p>
                        <p class="text-sm text-gray-500 mt-2">Given on: 10 Aug 2023</p>
                    </div>
                </div>
            </div>

            <div>
                <h3 class="font-semibold text-lg text-gray-800 mb-4">Submit Feedback</h3>
                <form class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
                        <select
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option>Select Subject</option>
                            <option>Mathematics</option>
                            <option>Science</option>
                            <option>English</option>
                            <option>Social Studies</option>
                            <option>Computer</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Feedback</label>
                        <textarea rows="4"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Enter your feedback..."></textarea>
                    </div>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        Submit Feedback
                    </button>
                </form>
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
                <h3 class="font-semibold text-lg text-gray-800 mb-4">Ask a Query</h3>
                <form class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
                        <select
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option>Select Subject</option>
                            <option>Admission</option>
                            <option>Fee</option>
                            <option>Academic</option>
                            <option>Examination</option>
                            <option>Other</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Query Title</label>
                        <input type="text"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Enter query title">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Query Details</label>
                        <textarea rows="4"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Enter your query details..."></textarea>
                    </div>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        Submit Query
                    </button>
                </form>
            </div>

            <div>
                <h3 class="font-semibold text-lg text-gray-800 mb-4">Recent Queries</h3>
                <div class="space-y-4">
                    <div class="border border-gray-200 rounded-lg p-4">
                        <div class="flex justify-between">
                            <h4 class="font-medium text-gray-800">Fee Receipt Issue</h4>
                            <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">Resolved</span>
                        </div>
                        <p class="text-gray-600 mt-2">I haven't received the fee receipt for July payment.</p>
                        <p class="text-sm text-gray-500 mt-2">Posted on: 20 Jul 2023</p>
                    </div>
                    <div class="border border-gray-200 rounded-lg p-4">
                        <div class="flex justify-between">
                            <h4 class="font-medium text-gray-800">Exam Date Change</h4>
                            <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs rounded-full">Pending</span>
                        </div>
                        <p class="text-gray-600 mt-2">Request to change exam date due to medical emergency.</p>
                        <p class="text-sm text-gray-500 mt-2">Posted on: 15 Aug 2023</p>
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
        <div class="space-y-4">
            <div class="border-l-4 border-blue-500 pl-4 py-2">
                <h3 class="font-semibold text-gray-800">Class Teacher - Mrs. Gupta</h3>
                <p class="text-gray-600 mt-1">Excellent participation in class activities. Shows leadership qualities.
                </p>
                <p class="text-sm text-gray-500 mt-2">Given on: 15 Aug 2023</p>
            </div>
            <div class="border-l-4 border-green-500 pl-4 py-2">
                <h3 class="font-semibold text-gray-800">Principal - Dr. Mehta</h3>
                <p class="text-gray-600 mt-1">Outstanding performance in inter-school debate competition. Proud of your
                    achievement!</p>
                <p class="text-sm text-gray-500 mt-2">Given on: 10 Aug 2023</p>
            </div>
            <div class="border-l-4 border-yellow-500 pl-4 py-2">
                <h3 class="font-semibold text-gray-800">Sports Coach - Mr. Singh</h3>
                <p class="text-gray-600 mt-1">Showing improvement in football skills. Keep practicing!</p>
                <p class="text-sm text-gray-500 mt-2">Given on: 05 Aug 2023</p>
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
            <div class="bg-gray-200 border-2 border-dashed rounded-xl w-full h-48 flex items-center justify-center">
                <span class="text-gray-500">Event Photo 1</span>
            </div>
            <div class="bg-gray-200 border-2 border-dashed rounded-xl w-full h-48 flex items-center justify-center">
                <span class="text-gray-500">Event Photo 2</span>
            </div>
            <div class="bg-gray-200 border-2 border-dashed rounded-xl w-full h-48 flex items-center justify-center">
                <span class="text-gray-500">Event Photo 3</span>
            </div>
            <div class="bg-gray-200 border-2 border-dashed rounded-xl w-full h-48 flex items-center justify-center">
                <span class="text-gray-500">Achievement Photo 1</span>
            </div>
            <div class="bg-gray-200 border-2 border-dashed rounded-xl w-full h-48 flex items-center justify-center">
                <span class="text-gray-500">Achievement Photo 2</span>
            </div>
            <div class="bg-gray-200 border-2 border-dashed rounded-xl w-full h-48 flex items-center justify-center">
                <span class="text-gray-500">School Activity</span>
            </div>
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
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Enter discussion topic">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Details</label>
                        <textarea rows="4"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Enter discussion details..."></textarea>
                    </div>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        Post Discussion
                    </button>
                </form>
            </div>

            <div>
                <h3 class="font-semibold text-lg text-gray-800 mb-4">Recent Discussions</h3>
                <div class="space-y-4">
                    <div class="border border-gray-200 rounded-lg p-4">
                        <h4 class="font-medium text-gray-800">Best Study Techniques</h4>
                        <p class="text-gray-600 mt-2">What study techniques work best for you? Share your experiences
                            and tips.</p>
                        <div class="flex justify-between mt-3">
                            <span class="text-sm text-gray-500">Posted by: Rohit Sharma</span>
                            <span class="text-sm text-gray-500">15 replies</span>
                        </div>
                    </div>
                    <div class="border border-gray-200 rounded-lg p-4">
                        <h4 class="font-medium text-gray-800">School Canteen Menu</h4>
                        <p class="text-gray-600 mt-2">What do you think about the new canteen menu? Any suggestions for
                            improvement?</p>
                        <div class="flex justify-between mt-3">
                            <span class="text-sm text-gray-500">Posted by: Priya Patel</span>
                            <span class="text-sm text-gray-500">8 replies</span>
                        </div>
                    </div>
                    <div class="border border-gray-200 rounded-lg p-4">
                        <h4 class="font-medium text-gray-800">Upcoming Sports Day</h4>
                        <p class="text-gray-600 mt-2">Who's participating in the upcoming sports day? Share your event
                            choices.</p>
                        <div class="flex justify-between mt-3">
                            <span class="text-sm text-gray-500">Posted by: Amit Kumar</span>
                            <span class="text-sm text-gray-500">22 replies</span>
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
</div>
</div>