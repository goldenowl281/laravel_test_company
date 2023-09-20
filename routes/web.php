<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Company Controller
Route::resource('companies', CompanyController::class);
//Employee Controller
Route::resource('employees', EmployeeController::class);



// Route::get('/company/index', [CompanyController::class, 'index'])->name('company.index');
// Route::get('/companay/create', [CompanyController::class, 'create'])
//     ->name('company.create');
// Route::post('/companay/store', [CompanyController::class, 'store'])
//     ->name('company.store');

