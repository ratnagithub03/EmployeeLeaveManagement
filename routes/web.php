<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LeaveController;
use App\Models\User;
use App\Models\Leave;
use App\Http\Middleware\CheckAuth;
use App\Http\Middleware\Revalidate;
use App\Http\Middleware\AdminRole;
use App\Http\Middleware\EmployeeRole;
use App\Http\Middleware\HrRole;



Route::get('/', function () {
    return view('welcome');
});
Route::get('/register', function () {
    return view('register');
});
Route::post('/register',[AuthController::class,'register']);
Route::get('/login', function () {
    return view('login');
});
Route::get('/forgotPassword',function(){
    return view('forgotPassword');
}); 
Route::post('/checkUser',[AuthController::class,'checkUser']);
Route::post('/resetPassword',[AuthController::class,'resetPassword']);
Route::post('/login',[AuthController::class,'login']);
// middleware used from here
Route::middleware([CheckAuth::class,Revalidate::class])->group(function(){
    Route::get('/adminhome',function(){
        return view('admin');
    })->middleware(AdminRole::class);
    Route::get('/viewUser',function(){
        $data=User::where('role','!=','admin')->get();
        return view('viewUser')->with('users',$data);
    })->middleware(AdminRole::class);
    Route::get('/activeUser',function(){
        $data=User::where('role','!=','admin')->where('status','=','active')->get();
        return view('activeuser')->with('users',$data);
    })->middleware(AdminRole::class);
    Route::get('/inactiveUser',function(){
        $data=User::where('role','!=','admin')->where('status','=','inactive')->get();
        return view('inactiveuser')->with('users',$data);
    })->middleware(AdminRole::class);
    Route::get('/changeStatus/{id}',[AuthController::class,'changeStatus'])->middleware(AdminRole::class);
    Route::get('/logout',[AuthController::class,'logout']);
    
    Route::get('/hrHome',function(){
        return view('Hr');
    })->middleware(HrRole::class);

    Route::get('/viewEmployee',function(){
        $data=User::where('role','=','Employee')->get();
        return view('viewEmployee')->with('users',$data);
    })->middleware(HrRole::class);
    Route::get('/activeEmployee',function(){
        $data=User::where('role','=','Employee')->where('status','=','active')->get();
        return view('activeEmployee')->with('users',$data);
    })->middleware(HrRole::class);
    Route::get('/inactiveEmployee',function(){
        $data=User::where('role','=','Employee')->where('status','=','inactive')->get();
        return view('inactiveEmployee')->with('users',$data);
    })->middleware(HrRole::class);
    Route::get('/changeStatus/{id}',[AuthController::class,'changeStatus'])->middleware(HrRole::class);
    
    Route::get('/hrchangePassword',function(){
        return view('hrchangePassword');
    });
    Route::get('/adminchangePassword',function(){
        return view('adminchangePassword');
    });
    Route::get('/changePassword',function(){
        return view('changePassword');
    });
    Route::post('/changePassword',[AuthController::class,'changePassword']);
    Route::get('/employeeHome', function(){
        return view('employee');
    })->middleware(EmployeeRole::class);

    Route::get('/editProfile', function(){
        $data=User::where('role','=', 'Employee')->where('status', '=','active')->get();
        return view('editProfile')->with('users', $data);
    })->middleware(EmployeeRole::class);

    Route::post('/hrchangePassword', [AuthController::class, 'changePassword']);

    Route::get('/applyLeave',function(){
        return view('applyLeave');
    })->middleware(EmployeeRole::class);
    Route::post('/applyLeave',[AuthController::class,'applyLeave']);
    
    Route::get('/applyLeaveByEmployee',function(){
        return view('applyLeaveByEmployee');
    })->middleware(EmployeeRole::class);
    Route::get('/appliedLeave',function(){
        return view('appliedLeave');
    })->middleware(AdminRole::class);
    Route::get('/approvedLeave',function(){
        return view('approvedLeave');
    })->middleware(AdminRole::class);
    Route::get('/rejectedLeave',function(){
        return view('rejectedLeave');
    })->middleware(AdminRole::class);
    // Route::post('/employee/editProfile', [AuthController::class, 'editProfile'])->name('employee.editProfile');
    // In web.php

Route::get('/profile/edit', [AuthController::class, 'editProfile'])->name('profile.edit');
Route::post('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');


    // Route::get('/get-leave-status', [LeaveController::class, 'getLeaveStatus']);

});