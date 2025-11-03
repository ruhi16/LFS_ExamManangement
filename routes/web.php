<?php

use App\Http\Controllers\ExamController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\StudentdbController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Livewire\Contact;
use App\Http\Livewire\Home;
use App\Http\Livewire\About;
use App\Http\Livewire\AdminStudentIdCardComp;
use App\Http\Livewire\SubadminMarksEntryComponent;
use App\Http\Livewire\SubadminMarksEntryEntityComponent;
use Illuminate\Support\Facades\Artisan;

// use App\Http\Livewire\Admin;
// use App\View\Components\AdminDashboard;

Route::get('/clear', function(){
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
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

// Debug route to check user authentication status
Route::get('/debug-user', function () {
    if (Auth::check()) {
        $user = Auth::user();
        return response()->json([
            'authenticated' => true,
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role_id' => $user->role_id,
            'studentdb_id' => $user->studentdb_id,
            'is_requested' => $user->is_requested,
            'role_description' => $user->role->description ?? 'No role'
        ]);
    } else {
        return response()->json(['authenticated' => false]);
    }
})->name('debug.user');

// Test controller routes
Route::get('/test-user-info', [App\Http\Controllers\TestController::class, 'userDashboard']);
Route::get('/test-user-dashboard-view', [App\Http\Controllers\TestController::class, 'testUserDashboardView']);

// Test simplified user dashboard view
Route::get('/test-simple-user-dashboard', function () {
    return view('test-user-dashboard');
})->name('test.simple.user.dashboard');

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

// Test route to check if user-dashboard view loads
Route::get('/test-user-dashboard', function () {
    return view('user-dashboard');
})->name('test.user.dashboard');

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
    ['prefix' => 'admin', 'middleware' => ['web', 'auth', 'isAdmin']],
    function () {
        Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])
            ->name('adminDash');
        
        Route::get('studentcr/records/{uuid}/idcard', [AdminStudentIdCardComp::class, 'getIdcard'])
            ->name('admin.student-idcard-comp');
    }
);


Route::group(
    ['prefix' => 'office', 'middleware' => ['web', 'isOffice']],
    function () {
        Route::get('/dashboard', [App\Http\Controllers\OfficeController::class, 'dashboard'])
            ->name('officeDash');
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
        
        Route::get('/profile', \App\Http\Livewire\StudentProfileComponent::class)
            ->name('user.profile');
            
        Route::get('/test-profile', function () {
            return view('test-student-profile');
        })->name('user.test.profile');
            
        Route::post('/request-teacher', [
            App\Http\Controllers\UserController::class,
            'requestToBeTeacher',
        ])->name('user.request.teacher');
        
        Route::post('/cancel-request-teacher', [
            App\Http\Controllers\UserController::class,
            'cancelTeacherRequest',
        ])->name('user.cancel.request.teacher');
        
        Route::post('/verify-student', [
            App\Http\Controllers\UserController::class,
            'verifyStudent',
        ])->name('user.verify.student');
        
        Route::post('/fetch-student-details', [
            App\Http\Controllers\UserController::class,
            'fetchStudentDetails',
        ])->name('user.fetch.student.details');
        
        Route::post('/verify-student-dob', [
            App\Http\Controllers\UserController::class,
            'verifyStudentDob',
        ])->name('user.verify.student.dob');
    }
);

// Test route for admin dashboard
Route::get('/test-admin-dashboard', function () {
    return view('test-admin-dashboard');
})->name('test.admin.dashboard');


// Route::resource('/teachers', [TeacherController::class, 'index']);
// Route::resource('/teachers', TeacherController::class);
// Route::resource('/exam', ExamController::class);
// Route::resource('/students', StudentdbController::class);


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
        // Any other authenticated users (including those with role_id = 0)
        return redirect(route('userDash'));
    }

    // return view('dashboard');
})->middleware(['auth'])
    //   ->middleware(['auth', 'verified'])
    ->name('dashboard');



Route::get('/', function () {
    return view('welcome');
});

// Include test routes
require __DIR__ . '/test.php';

Route::get('auth/google', [GoogleAuthController::class, 'redirect'])
    ->name('auth.google.login');

Route::get('auth/google/callback', [GoogleAuthController::class, 'callbackGoogle'])
    ->name('auth.google.callback');

require __DIR__ . '/auth.php';