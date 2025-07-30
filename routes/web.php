<?php

use App\Http\Controllers\ExamController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\StudentdbController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\TeacherController;
use App\Http\Livewire\Contact;
use App\Http\Livewire\Home;
use App\Http\Livewire\About;
use App\Http\Livewire\AdminAdmissionComponent;
use App\Http\Livewire\AdminAnsscrDistributionComponent;
use App\Http\Livewire\AdminAnsscrDistributioncwComponent;
use App\Http\Livewire\AdminMyclassAnserScriptDistributionBaseComponent;
use App\Http\Livewire\AdminMyclassSectionComponent;
use App\Http\Livewire\AdminTeacherWiseMarksEntryLinksComponent;
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
        Route::get('/dashboard', [ App\Http\Controllers\AdminController::class, 'dashboard'])
            ->name('adminDash');

        // Route::get('/admission/{myclassSection_id}', [App\Http\Controllers\AdminController::class, 'admission'])->name('admission');
        // Route::get('/dashboard', AdminDashboard::class)
        //     ->name('adminDash');

        // --------------------- Admin Dashboard Management ---------------------------------------------
        // Route::get('/userpreviledgemanagement', AdminUserPreviledgeControlComponent::class)
        //     ->name('admin.profilemanagement');

        // Route::get('/myclasssectionmanagement', AdminMyclassSectionComponent::class)
        //     ->name('admin.myclasssectionmanagement');
        
        // Route::get('/myclasssectionwiseanswerscriptmanagement', AdminMyclassAnserScriptDistributionBaseComponent::class)
        //     ->name('admin.myclasssectionwiseanswerscriptmanagement');

        // Route::get('teacherwisemarksentrylink', AdminTeacherWiseMarksEntryLinksComponent::class)
        //     ->name('admin.teacherwisemarksentrylink');

        // --------------------- Admin Dashboard Management -------------------------------------------
        

        // Route::get('/admission/{myclassSection_id}', AdminAdmissionComponent::class)
        //     ->name('admin.admission');
        
        // Route::get('/ansscrdistribution/{myclassSection_id}', AdminAnsscrDistributionComponent::class)
        //     ->name('admin.ansscrdistribution');
        
        // Route::get('/ansscrdistributionclasswise/{myclass_id}/{exam_id}', AdminAnsscrDistributioncwComponent::class)
        //     ->name('admin.ansscrdistributioncw');

        
        // Route::get('/marksentryclasswise/{myclassSection_id}', SubadminMarksEntryComponent::class)
        //     ->name('admin.marksentry');

        // Route::get('/marksentryentityclasswise/{myclassSection_id}/{myclassSubject_id}/{examdetail_id}', SubadminMarksEntryEntityComponent::class)
        //     ->name('admin.marksentryentity');

        
            
        Route::get('/home', Home::class)->name('home');
        Route::get('/contact', Contact::class)->name('contact');
        Route::get('/about', About::class)->name('about');

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
Route::resource('/teachers', TeacherController::class);
Route::resource('/exam', ExamController::class);
Route::resource('/students', StudentdbController::class);


Route::get('/dashboard', function () {
    // echo 'Hello from dashboard';
    // echo auth()->user()->name;
    // echo 'Auth:' . Auth::user();

    if (Auth::user() && Auth::user()->role_id == 4) {
        // Super Admin or owner
        return redirect(route('supAdminDash'));
    }

    if (Auth::user() && Auth::user()->role_id == 3) {
        // Admin or Headmaster
        return redirect(route('adminDash'));
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



Route::get('auth/google', [GoogleAuthController::class, 'redirect'])
    ->name('auth.google.login');

Route::get('auth/google/callback', [GoogleAuthController::class, 'callbackGoogle'])
    ->name('auth.google.callback');



require __DIR__ . '/auth.php';


// Route::any('{any}', [UserController::class,'index'])->where('any', '^(?!api).*$');