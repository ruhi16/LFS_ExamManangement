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
use App\Http\Livewire\UserChangePasswordComponent;

// use App\Http\Livewire\Admin;
// use App\View\Components\AdminDashboard;


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

// Test route for FMPM component
Route::get('/test-fmpm', function () {
    return view('test-fmpm');
})->name('test.fmpm');

// Test route for simple FMPM component
Route::get('/test-fmpm-simple', function () {
    return view('test-fmpm-simple');
})->name('test.fmpm.simple');

// Test route for Student CR component
Route::get('/test-student-cr', function () {
    return view('test-student-cr');
})->name('test.student.cr');

// Test route for Answer Script Distribution component
Route::get('/test-answer-script-distribution', function () {
    return view('test-answer-script-distribution');
})->name('test.answer.script.distribution');

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

Route::get('auth/google', [GoogleAuthController::class, 'redirect'])
    ->name('auth.google.login');

Route::get('auth/google/callback', [GoogleAuthController::class, 'callbackGoogle'])
    ->name('auth.google.callback');



require __DIR__ . '/auth.php';


// Route::any('{any}', [UserController::class,'index'])->where('any', '^(?!api).*$');