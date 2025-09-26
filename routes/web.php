<?php

use App\Http\Controllers\ExamController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\StudentdbController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Livewire\Contact;
use App\Http\Livewire\Home;
use App\Http\Livewire\About;
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
    ['prefix' => 'admin', 'middleware' => ['web', 'auth', 'isAdmin']],
    function () {
        Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])
            ->name('adminDash');
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
    }
);

// Test route for admin dashboard
Route::get('/test-admin-dashboard', function () {
    return view('test-admin-dashboard');
})->name('test.admin.dashboard');


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

// Include test routes
require __DIR__ . '/test.php';

Route::get('auth/google', [GoogleAuthController::class, 'redirect'])
    ->name('auth.google.login');

Route::get('auth/google/callback', [GoogleAuthController::class, 'callbackGoogle'])
    ->name('auth.google.callback');

require __DIR__ . '/auth.php';