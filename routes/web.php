<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AuthController;
use Faker\Provider\ar_EG\Company;

// Route::get('/', [EmployeeController::class, 'index']);
Route::post('/emp_store', [EmployeeController::class, 'store'])->name('store');
Route::get('/emp_fetchall', [EmployeeController::class, 'fetchAll'])->name('fetchAll');
Route::delete('/emp_delete', [EmployeeController::class, 'delete'])->name('delete');
Route::get('/emp_edit', [EmployeeController::class, 'edit'])->name('edit');
Route::post('/emp_update', [EmployeeController::class, 'update'])->name('update');




Route::post('/comp_store', [CompanyController::class, 'store'])->name('store');
Route::get('/emp_fetchall', [CompanyController::class, 'fetchAll'])->name('fetchAll');
Route::delete('/comp_delete', [CompanyController::class, 'delete'])->name('delete');
Route::get('/comp_edit', [CompanyController::class, 'edit'])->name('edit');
Route::post('/comp_update', [CompanyController::class, 'update'])->name('update');





Route::get('dashboard', [CustomAuthController::class, 'dashboard']); 
Route::get('admin_dashboard', [CustomAuthController::class, 'admin_dashboard']); 
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom'); 
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom'); 
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');