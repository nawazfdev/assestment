<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\AffiliateController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/merchants/create', [MerchantController::class, 'merchantcreate'])->name('merchant.register');
Route::post('/merchants/store', [MerchantController::class, 'merchantstore'])->name('merchants.store');
Route::get('/find-merchant', [MerchantController::class, 'findMerchantByEmailForm'])->name('find-merchant-form');
Route::post('/find-merchant', [MerchantController::class, 'findMerchantByEmail'])->name('find-merchant');
    Route::get('/register-affiliate', [AffiliateController::class, 'showRegistrationForm']);
Route::post('/register-affiliate', [AffiliateController::class, 'register'])->name('register-affiliate');

});

require __DIR__.'/auth.php';
