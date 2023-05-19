<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CompanyController;

// Route::get('/', [EmployeeController::class, 'index']);
Route::post('/emp_store', [EmployeeController::class, 'store'])->name('emp_store');
Route::get('/emp_fetchAll', [EmployeeController::class, 'fetchAll'])->name('emp_fetchAll');
Route::delete('/emp_delete', [EmployeeController::class, 'delete'])->name('emp_delete');
Route::get('/emp_edit', [EmployeeController::class, 'edit'])->name('emp_edit');
Route::post('/emp_update', [EmployeeController::class, 'update'])->name('emp_update');




Route::post('/comp_store', [CompanyController::class, 'store'])->name('comp_store');
Route::get('/comp_fetchAll', [CompanyController::class, 'fetchAll'])->name('comp_fetchAll');
Route::delete('/comp_delete', [CompanyController::class, 'delete'])->name('comp_delete');
Route::get('/comp_edit', [CompanyController::class, 'edit'])->name('comp_edit');
Route::post('/comp_update', [CompanyController::class, 'update'])->name('comp_update');





Route::get('dashboard', [CustomAuthController::class, 'dashboard']); 
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom'); 
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom'); 
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');