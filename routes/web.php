<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\LeaveStatusController;
use App\Http\Controllers\SetPasswordController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserStatusController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if (Auth::check()) {

        if (Auth::user()->is_employee) {

            return to_route('employee.index');
        }

        return to_route('users.index');
    }

    return to_route('login');
});

Route::controller(LoginController::class)->group(function(){

    Route::get('/login', 'index')->name('login');

    Route::post('/login/auth', 'login')->name('login.auth');

    Route::post('/logout', 'logout')->name('logout');
});

Route::middleware('auth')->group(function(){

    Route::middleware('admin')->group(function(){

        Route::controller(UserController::class)->group(function(){

            Route::get('/users', 'index')->name('users.index');
            
            Route::get('/users/create', 'create')->name('users.create');

            Route::post('/users/store', 'store')->name('users.store');

            Route::get('/users/{user:slug}/edit', 'edit')->name('users.edit');

            Route::put('/users/{user:slug}/update', 'update')->name('users.update');

            Route::delete('/users/{user:slug}/delete', 'delete')->name('users.delete');
        });

        Route::post('/users/{user:slug}/status', UserStatusController::class)->name('users.status');

        Route::controller(SetPasswordController::class)->group(function(){

            Route::get('/{user:slug}/set-password', 'index')->name('set-password');

            Route::post('/{user:slug}/set-password', 'store')->name('set-password.store');

        });

    });

    Route::get('/employee', [EmployeeController::class, 'index'])->name('employee.index');

    Route::get('/attendance', [AttendanceController::class, 'store'])->name('attendance');

    Route::controller(LeaveController::class)->group(function(){

        Route::get('/employee/leaves', 'index')->name('leaves');

        Route::get('/employee/leaves/list', 'show')->name('leaves.show');
        
        Route::get('/employee/leaves/create', 'create')->name('leaves.create');

        Route::post('/employee/leaves/store', 'store')->name('leaves.store');
    });

    Route::get('/leaves/{leave}/status', LeaveStatusController::class)->name('leaves.status');

});

