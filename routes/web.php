<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;

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
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/home',[HomeController::class,'index'])->middleware('auth')->name('home');
Route::get('/companies',[CompanyController::class,'index'])->middleware(['auth','admin'])->name('companyIndex');
Route::get('/companies/add-form',[CompanyController::class,'create'])->middleware(['auth','admin'])->name('company-add-form');
Route::post('/companies/create',[CompanyController::class,'store'])->middleware(['auth','admin'])->name('company-create');
Route::get('/companies/edit/{id}',[CompanyController::class,'edit'])->middleware(['auth','admin'])->name('company-edit');
Route::post('/companies/update/{id}',[CompanyController::class,'update'])->middleware(['auth','admin']);
Route::get('/companies/delete/{id}',[CompanyController::class,'destroy'])->middleware(['auth','admin']);
Route::get('/companies/show/{id}',[CompanyController::class,'show'])->middleware(['auth','admin'])->name('company-show');

Route::get('/employees',[EmployeeController::class,'index'])->middleware(['auth','admin'])->name('employee-index');
Route::get('/employees/add-form',[EmployeeController::class,'create'])->middleware(['auth','admin'])->name('employee-add-form');
Route::post('/employees/create',[EmployeeController::class,'store'])->middleware(['auth','admin'])->name('employee-create');
Route::get('/employees/edit/{id}',[EmployeeController::class,'edit'])->middleware(['auth','admin'])->name('employee-edit');
Route::post('/employees/update/{id}',[EmployeeController::class,'update'])->middleware(['auth','admin']);
Route::get('/employees/delete/{id}',[EmployeeController::class,'destroy'])->middleware(['auth','admin']);
Route::get('/employees/show/{id}',[EmployeeController::class,'show'])->middleware(['auth','admin'])->name('employee-show');

