<?php

use App\Http\Controllers\DealerProfileController;
use App\Http\Controllers\RegisterationController;
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

Route::get('/register',[RegisterationController::class, 'index'])->name('register');
Route::post('/regsiter',[RegisterationController::class, 'storeRegister']);
Route::get('/login', [RegisterationController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [RegisterationController::class, 'storeLogin'])->middleware('guest');
Route::post('/check-email', [RegisterationController::class, 'checkEmail'])->name('check-email');

Route::get('/dealer/profile/{id?}', [DealerProfileController::class, 'index'])->name('dealer.city_state_zip')->middleware('check.first.login');
Route::post('/dealer/profile', [DealerProfileController::class, 'update'])->name('dealer.update_city_state_zip')->middleware('check.first.login');

Route::get('/dealers',[DealerProfileController::class, 'list'] )->name('dealers.index')->middleware('check.first.login');
Route::post('/dealers/search',[DealerProfileController::class, "search"])->name('dealers.search')->middleware('check.first.login');

Route::post('/logout', [RegisterationController::class, 'logout'])->name('logout');