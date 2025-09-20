<?php

use App\Http\Controllers\ExamController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\StudentdbController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Livewire\Contact;
use App\Http\Livewire\Home;
use App\Http\Livewire\About;
use App\Http\Livewire\AdminUserPreviledgeControlComponent;
use App\Http\Livewire\SubadminMarksEntryComponent;
use App\Http\Livewire\SubadminMarksEntryEntityComponent;
use App\Http\Livewire\TeacherMarksEntryComp;
use App\Http\Livewire\UserChangePasswordComponent;
use Illuminate\Support\Facades\Artisan;

// use App\Http\Livewire\Admin;
// use App\View\Components\AdminDashboard;

Route::get('/clear', function(){
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('optimize:clear');
    // php artisan config:clear
    // php artisan route:clear
    // php artisan view:clear
    // php artisan optimize:clear 
    return '<h1>Cache Cleared</h1>';
});

Route::get('/link', function(){
    Artisan::call('storage:link');
    return '<h1>Storage link created</h1>';
});
Route::controller(App\Http\Controllers\NoticeController::class)->group(
    function () {
        Route::get('notices', 'index'); // all notices, in a tabluler form, add new notice, open create
        Route::get('notices/{id}', 'display'); //
        Route::get('notices/create', 'create'); // create a new notice, display form for data entry
        Route::post('notices/create', 'store'); // submit clicked from create, to save the notice, goto indexes
        Route::get('notices/{id}/edit', 'edit'); // edit any existing notice, display existing notice, goto update
        Route::put('notices/{id}/edit', 'update'); // save the edited notice, goto indexes
        Route::get('notices/{id}/delete', 'destroy'); // delete any existing notice, goto inexes
    }
);

// Route::get('/dashboard', [App\Http\Controllers\SuperAdminController::class, 'dashboard']);

Route::group(
    ['prefix' => 'sup-admin', 'middleware' => ['web', 'auth', 'isSuperAdmin']],
    function () {
        Route::get('/dashboard', [
            App\Http\Controllers\SuperAdminController::class,
            'dashboard',
        ])->name('supAdminDash');
    }
);

Route::group(
    ['prefix' => 'admin', 'middleware' => ['web', 'isAdmin']],
    function () {
        Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])
            ->name('adminDash');




        Route::get('/home', Home::class)->name('home');
        Route::get('/contact', Contact::class)->name('contact');
        Route::get('/about', About::class)->name('about');

        // Route::get('/changePassword', UserChangePasswordComponent::class)
        //     ->name('subadmin.changePassword');

    }
);


Route::group(
    ['prefix' => 'office', 'middleware' => ['web', 'isOffice']],
    function () {
        Route::get('/dashboard', [App\Http\Controllers\OfficeController::class, 'dashboard'])
            ->name('officeDash');




        // Route::get('/home', Home::class)->name('home');
        // Route::get('/contact', Contact::class)->name('contact');
        // Route::get('/about', About::class)->name('about');

        // Route::get('/changePassword', UserChangePasswordComponent::class)
        //     ->name('subadmin.changePassword');

    }
);

Route::group(
    ['prefix' => 'sub-admin', 'middleware' => ['web', 'isSubAdmin']],
    function () {
        Route::get('/dashboard', [App\Http\Controllers\SubAdminController::class, 'dashboard'])
            ->name('subAdminDash');

        Route::get('/admission/{myclassSection_id}', SubadminMarksEntryComponent::class)
            ->name('subadmin.marksEntry');

        Route::get('/marksentryentityclasswise/{myclassSection_id}/{myclassSubject_id}/{examdetail_id}', SubadminMarksEntryEntityComponent::class)
            ->name('subadmin.marksentryentity');
    }
);

Route::group(
    ['prefix' => 'user', 'middleware' => ['web', 'isUser']],
    function () {
        Route::get('/dashboard', [
            App\Http\Controllers\UserController::class,
            'dashboard',
        ])->name('userDash');
    }
);



// Route::resource('/teachers', [TeacherController::class, 'index']);
// Route::resource('/teachers', TeacherController::class);
Route::resource('/exam', ExamController::class);
Route::resource('/students', StudentdbController::class);


Route::get('/dashboard', function () {
    // echo 'Hello from dashboard';
    // echo auth()->user()->name;
    // echo 'Auth:' . Auth::user();
    if (Auth::user() && Auth::user()->role_id == 5) {
        // Super Admin or owner
        return redirect(route('supAdminDash'));
    }

    if (Auth::user() && Auth::user()->role_id == 4) {
        // Super Admin or owner
        return redirect(route('adminDash'));
    }

    if (Auth::user() && Auth::user()->role_id == 3) {
        // Admin or Headmaster
        return redirect(route('officeDash'));
    }

    if (Auth::user() && Auth::user()->role_id == 2) {
        // Sub Admin or Teacher
        return redirect(route('subAdminDash'));
    }

    if (Auth::user() && Auth::user()->role_id == 1) {
        // User or Students
        return redirect(route('userDash'));
    }

    if (Auth::user()) {
        // Any other authenticated users
        return redirect(route('userDash'));
    }

    // return view('dashboard');
})->middleware(['auth'])
    //   ->middleware(['auth', 'verified'])
    ->name('dashboard');



Route::get('/', function () {
    return view('welcome');
});

// Test route for Exam Setting with FMPM component (with feature flag)
Route::get('/exam-setting-fmpm', function () {
    // Feature flag for modular vs monolithic component
    $useModularExamSetting = config('app.use_modular_exam_setting', true);
    
    if ($useModularExamSetting) {
        return App\Http\Livewire\ExamSetting\ExamSettingContainer::class;
    } else {
        return App\Http\Livewire\ExamSettingWithFmpm::class;
    }
})
    ->middleware(['auth'])
    ->name('exam.setting.fmpm');

// Test route for Modular Exam Setting (direct access)
Route::get('/exam-setting-modular', App\Http\Livewire\ExamSetting\ExamSettingContainer::class)
    ->middleware(['auth'])
    ->name('exam.setting.modular');

// Test route for Legacy Exam Setting (direct access)
Route::get('/exam-setting-legacy', App\Http\Livewire\ExamSettingWithFmpm::class)
    ->middleware(['auth'])
    ->name('exam.setting.legacy');

// Test route for Exam Setting (without auth for testing)
Route::get('/test-exam-setting', function () {
    return view('test-exam-setting');
})->name('test.exam.setting');

// Test route for Updated Exam Setting with FMPM component
Route::get('/test-updated-exam-setting', function () {
    return view('test-fmpm');
})->name('test.updated.exam.setting');

// Test route for simple FMPM component
Route::get('/test-fmpm-simple', function () {
    return view('test-fmpm-simple');
})->name('test.fmpm.simple');

// Test route for Student CR component
Route::get('/test-student-cr', function () {
    return view('test-student-cr');
})->name('test.student.cr');

// Test route for Answer Script Distribution component
Route::get('/test-test', TeacherMarksEntryComp::class);


// Route::get('/test-answer-script-distribution', function () {
//     return view('teacher-marks-entry-comp');
// })->name('test.answer.script.distribution');

// Marks Entry routes
Route::get('/marks-entry', App\Http\Livewire\MarksEntryComp::class)
    ->name('marks-entry');

Route::get('/marks-entry/detail/{examDetailId}/{subjectId}/{sectionId}', App\Http\Livewire\MarksEntryDetailComp::class)
    ->name('marks-entry.detail');

// Test route for Marks Entry component
Route::get('/test-marks-entry', function () {
    return view('test-marks-entry');
})->name('test.marks.entry');

// Test route for Logs Viewer component
Route::get('/test-logs-viewer', function () {
    return view('test-logs-viewer');
})->name('test.logs.viewer');

// Test route for Class Exam Subject component
Route::get('/test-class-exam-subject', function () {
    return view('test-class-exam-subject');
})->name('test.class.exam.subject');

// Test route for Mark Register component
Route::get('/test-mark-register', function () {
    return view('test-mark-register');
})->name('test.mark.register');

// Test route for Myclass Subject component
Route::get('/test-myclass-subject', function () {
    return view('test-myclass-subject');
})->name('test.myclass.subject');

// Test route for Myclass component
Route::get('/test-myclass', function () {
    return view('test-myclass');
})->name('test.myclass');

// Test route for Section component
Route::get('/test-section', function () {
    return view('test-section');
})->name('test.section');

// Test route for Myclass Section component
Route::get('/test-myclass-section', function () {
    return view('test-myclass-section');
})->name('test.myclass.section');

// Test route for Subject Type component
Route::get('/test-subject-type', function () {
    return view('test-subject-type');
})->name('test.subject.type');

// Test route for Subject component
Route::get('/test-subject', function () {
    return view('test-subject');
})->name('test.subject');

Route::get('auth/google', [GoogleAuthController::class, 'redirect'])
    ->name('auth.google.login');

Route::get('auth/google/callback', [GoogleAuthController::class, 'callbackGoogle'])
    ->name('auth.google.callback');

Route::get('/test-teacher-wise-marks-entry', function () {
    return view('livewire.marks-entry-comp');
})->name('test-teacher-wise-marks-entry');

require __DIR__ . '/auth.php';



// Route::any('{any}', [UserController::class,'index'])->where('any', '^(?!api).*$');/
// Test route for Student Database component
Route::get('/test-student-db', function () {
    return view('test-student-db');
})->name('test.student.db');
// Test route for Dashboard component
Route::get('/test-dashboard', function () {
    return view('test-dashboard');
})->name('test.dashboard');
// Test route for Session component
Route::get('/test-session', function () {
    return view('test-session');
})->name('test.session');
// Test route for Teacher component
Route::get('/test-teacher', function () {
    return view('test-teacher');
})->name('test.teacher');

// Test route for Teacher Modal component
Route::get('/test-teacher-modal', function () {
    return view('test-teacher-modal');
})->name('test.teacher.modal');

// Test route for Subject Teacher component
Route::get('/test-subject-teacher', function () {
    return view('test-subject-teacher');
})->name('test.subject.teacher');

// Test route for User Role component
Route::get('/test-user-role', function () {
    return view('test-user-role');
})->name('test.user.role');

// Simple Modal Test
Route::get('/test-modal-simple', function () {
    return view('test-modal-simple');
})->name('test.modal.simple');

// Main Test Dashboard
Route::get('/test-dashboard-main', function () {
    return view('test-dashboard', [
        'totalComponents' => 20,
        'basicComponents' => 6,
        'examComponents' => 5,
        'otherComponents' => 9
    ]);
})->name('test.dashboard.main');

// Test Index Page
Route::get('/test-index', function () {
    return view('test-index');
})->name('test.index');

// Test page for Modular Exam Setting Implementation
Route::get('/test-modular-exam-setting', function () {
    return view('test-modular-exam-setting');
})->name('test.modular.exam.setting');

// Task Finalization & Lock Status route
Route::get('/task-finalize-lock-status', App\Http\Livewire\TaskFinalizeLockStatusComp::class)
    ->middleware(['auth'])
    ->name('task.finalize.lock.status');
