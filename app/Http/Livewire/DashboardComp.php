<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Studentdb;
use App\Models\Studentcr;
use App\Models\Myclass;
use App\Models\Section;
use App\Models\Subject;
use App\Models\SubjectType;
use App\Models\MyclassSection;
use App\Models\MyclassSubject;
use App\Models\Exam01Name;
use App\Models\Exam02Type;
use App\Models\Exam03Part;
use App\Models\Exam04Mode;
use App\Models\Exam05Detail;
use App\Models\Exam06ClassSubject;
use App\Models\Exam07AnsscrDist;
use App\Models\Exam10MarksEntry;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardComp extends Component
{
    public $refreshInterval = 30000; // 30 seconds
    public $selectedTimeframe = 'today';
    public $showDetails = [];

    public function mount()
    {
        // Initialize show details for collapsible sections
        $this->showDetails = [
            'students' => true,
            'academics' => true,
            'exams' => true,
            'marks' => false,
            'system' => false,
        ];
    }

    public function toggleDetails($section)
    {
        $this->showDetails[$section] = !$this->showDetails[$section];
    }

    public function refreshData()
    {
        // Force component refresh
        $this->render();
        session()->flash('message', 'Dashboard data refreshed successfully!');
    }

    public function getStudentStats()
    {
        try {
            return [
                'total_students' => Studentdb::count(),
                'active_students' => Studentdb::where('crstatus', 'active')->count(),
                'inactive_students' => Studentdb::where('crstatus', '!=', 'active')->count(),
                'students_with_photos' => Studentdb::whereNotNull('img_ref_profile')->count(),
                'students_with_documents' => Studentdb::where(function ($q) {
                    $q->whereNotNull('img_ref_brthcrt')
                        ->orWhereNotNull('img_ref_adhaar');
                })->count(),
                'recent_admissions' => Studentdb::where('created_at', '>=', now()->subDays(30))->count(),
            ];
        } catch (\Exception $e) {
            return [
                'total_students' => 0,
                'active_students' => 0,
                'inactive_students' => 0,
                'students_with_photos' => 0,
                'students_with_documents' => 0,
                'recent_admissions' => 0,
            ];
        }
    }

    public function getAcademicStats()
    {
        try {
            return [
                'total_classes' => Myclass::count(),
                'total_sections' => Section::count(),
                'class_sections' => MyclassSection::count(),
                'total_subjects' => Subject::count(),
                'subject_types' => SubjectType::count(),
                'class_subjects' => MyclassSubject::count(),
                'summative_subjects' => Subject::whereHas('subjectType', function ($q) {
                    $q->where('name', 'like', '%summative%');
                })->count(),
                'formative_subjects' => Subject::whereHas('subjectType', function ($q) {
                    $q->where('name', 'like', '%formative%');
                })->count(),
            ];
        } catch (\Exception $e) {
            return [
                'total_classes' => 0,
                'total_sections' => 0,
                'class_sections' => 0,
                'total_subjects' => 0,
                'subject_types' => 0,
                'class_subjects' => 0,
                'summative_subjects' => 0,
                'formative_subjects' => 0,
            ];
        }
    }

    public function getExamStats()
    {
        try {
            return [
                'exam_names' => Exam01Name::count(),
                'exam_types' => Exam02Type::count(),
                'exam_parts' => Exam03Part::count(),
                'exam_modes' => Exam04Mode::count(),
                'exam_details' => Exam05Detail::count(),
                'configured_class_subjects' => Exam06ClassSubject::count(),
                'answer_script_distributions' => Exam07AnsscrDist::count(),
                'active_exams' => Exam05Detail::where('status', 'active')->count(),
                'completed_exams' => Exam05Detail::where('status', 'completed')->count(),
            ];
        } catch (\Exception $e) {
            return [
                'exam_names' => 0,
                'exam_types' => 0,
                'exam_parts' => 0,
                'exam_modes' => 0,
                'exam_details' => 0,
                'configured_class_subjects' => 0,
                'answer_script_distributions' => 0,
                'active_exams' => 0,
                'completed_exams' => 0,
            ];
        }
    }

    public function getMarksStats()
    {
        try {
            return [
                'total_marks_entries' => Exam10MarksEntry::count(),
                'marks_entered_today' => Exam10MarksEntry::whereDate('created_at', today())->count(),
                'marks_entered_this_week' => Exam10MarksEntry::where('created_at', '>=', now()->subWeek())->count(),
                'marks_entered_this_month' => Exam10MarksEntry::where('created_at', '>=', now()->subMonth())->count(),
                'absent_entries' => Exam10MarksEntry::where('marks', 'AB')->count(),
                'full_marks_entries' => Exam10MarksEntry::whereColumn('marks', 'full_marks')->count(),
            ];
        } catch (\Exception $e) {
            return [
                'total_marks_entries' => 0,
                'marks_entered_today' => 0,
                'marks_entered_this_week' => 0,
                'marks_entered_this_month' => 0,
                'absent_entries' => 0,
                'full_marks_entries' => 0,
            ];
        }
    }

    public function getSystemStats()
    {
        try {
            return [
                'total_users' => User::count(),
                'total_teachers' => Teacher::count(),
                'active_users' => User::where('status', 'active')->count(),
                'admin_users' => User::where('role', 'admin')->count(),
                'teacher_users' => User::where('role', 'teacher')->count(),
                'student_users' => User::where('role', 'student')->count(),
            ];
        } catch (\Exception $e) {
            return [
                'total_users' => 0,
                'total_teachers' => 0,
                'active_users' => 0,
                'admin_users' => 0,
                'teacher_users' => 0,
                'student_users' => 0,
            ];
        }
    }

    public function getRecentActivity()
    {
        try {
            return [
                'recent_students' => Studentdb::with(['myclass', 'sections'])
                    ->orderBy('created_at', 'desc')
                    ->limit(5)
                    ->get(),
                'recent_marks' => Exam10MarksEntry::orderBy('created_at', 'desc')
                    ->limit(5)
                    ->get(),
                'recent_distributions' => Exam07AnsscrDist::orderBy('created_at', 'desc')
                    ->limit(5)
                    ->get(),
            ];
        } catch (\Exception $e) {
            return [
                'recent_students' => collect([]),
                'recent_marks' => collect([]),
                'recent_distributions' => collect([]),
            ];
        }
    }

    public function getClassWiseStats()
    {
        try {
            return Myclass::withCount(['studentdb as students_count' => function ($q) {
                $q->where('crstatus', 'active');
            }])
                ->with(['myclass_sections'])
                ->orderBy('order')
                ->get();
        } catch (\Exception $e) {
            return collect([]);
        }
    }

    public function getExamProgress()
    {
        try {
            $examDetails = Exam05Detail::orderBy('created_at', 'desc')
                ->limit(10)
                ->get();

            return $examDetails->map(function ($exam) {
                $totalStudents = Studentdb::where('crstatus', 'active')->count();
                $marksEntered = 0;
                try {
                    $marksEntered = Exam10MarksEntry::where('exam_detail_id', $exam->id)->count();
                } catch (\Exception $e) {
                    $marksEntered = 0;
                }
                $progress = $totalStudents > 0 ? round(($marksEntered / $totalStudents) * 100, 2) : 0;

                return [
                    'exam' => $exam,
                    'total_students' => $totalStudents,
                    'marks_entered' => $marksEntered,
                    'progress' => $progress,
                    'status' => $progress == 100 ? 'completed' : ($progress > 0 ? 'in_progress' : 'not_started'),
                ];
            });
        } catch (\Exception $e) {
            return collect([]);
        }
    }

    public function getTopPerformers()
    {
        try {
            return Exam10MarksEntry::select('student_id', DB::raw('AVG(CAST(marks AS DECIMAL(5,2))) as avg_marks'))
                ->where('marks', '!=', 'AB')
                ->where('marks', '!=', '')
                ->whereNotNull('marks')
                ->groupBy('student_id')
                ->having('avg_marks', '>', 0)
                ->orderBy('avg_marks', 'desc')
                ->limit(10)
                ->get()
                ->map(function ($entry) {
                    $student = Studentdb::find($entry->student_id);
                    $entry->student = $student;
                    return $entry;
                });
        } catch (\Exception $e) {
            return collect([]);
        }
    }

    public function getSubjectWisePerformance()
    {
        try {
            return Subject::limit(10)->get()->map(function ($subject) {
                $subject->total_entries = 0;
                $subject->avg_marks = 0;
                return $subject;
            });
        } catch (\Exception $e) {
            return collect([]);
        }
    }

    public function render()
    {
        $data = [
            'student_stats' => $this->getStudentStats(),
            'academic_stats' => $this->getAcademicStats(),
            'exam_stats' => $this->getExamStats(),
            'marks_stats' => $this->getMarksStats(),
            'system_stats' => $this->getSystemStats(),
            'recent_activity' => $this->getRecentActivity(),
            'class_wise_stats' => $this->getClassWiseStats(),
            'exam_progress' => $this->getExamProgress(),
            'top_performers' => $this->getTopPerformers(),
            'subject_performance' => $this->getSubjectWisePerformance(),
        ];

        return view('livewire.dashboard-comp', $data);
    }
}
