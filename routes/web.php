<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\StudentController;
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
Route::middleware('IsLogin')->group(function(){
    Route::get('/logout' , [AuthController::class , 'logout'])->name('logout');
    Route::prefix('admin')->group(function (){
        Route::get('/students/Deleted' , [StudentController::class , 'Deleted'])->name('students.Deleted');
        Route::post('/students/{student}/restore' , [StudentController::class , 'restore'])->name('students.restore');
        Route::delete('/students/{student}/archive' , [StudentController::class , 'archive'])->name('students.archive');
        Route::resource('students', StudentController::class);
    });

});

Route::middleware('NotLogin')->group(function(){
    Route::get('/' , [AuthController::class , 'login'])->name('login');
    Route::post('/login' , [AuthController::class ,'handlelogin'])->name('handlelogin');

    Route::get('/register' , [AuthController::class , 'register'])->name('register');
    Route::post('/handleregister' , [AuthController::class ,'handleregister'])->name('handleregister');


});


