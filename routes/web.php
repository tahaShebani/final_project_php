<?php

use App\Http\Controllers\CutomerProfile;
use App\Http\Controllers\paymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Reservation;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     //return view('welcome');
//     return view('homePage');
// });

Route::get('/', [App\Http\Controllers\ViewCarClasses::class, 'viewAll']);

Route::get('/home', [App\Http\Controllers\ViewCarClasses::class, 'viewAll'])->name('home');

// Route::get('/home', function () {
//     return view('homePage');
// })->name('home');
Route::get('/search', [App\Http\Controllers\ViewVehicles::class, 'viewAll'])->name('search');
Route::get('/searchFilter', [App\Http\Controllers\ViewVehicles::class, 'viewAllFilter'])->name('searchFilter');



Route::get('/cars',[App\Http\Controllers\ViewCarModels::class,'viewAll'])->name('cars.index');
Route::get('/cars/{carmodel}',[App\Http\Controllers\ViewCarModels::class,'show'])->name('car.show');


Route::get('/dashboard', [Reservation::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth','customer_auth'])->group(function () {
    Route::get('/rent/{vehicle}',[App\Http\Controllers\RentController::class,'viewAll'])->name('rent.checkout');
    Route::get('/payments', [paymentController::class, 'index'])->name('payments.index');
     Route::patch('/payments/{payment}', [paymentController::class, 'update'])->name('payments.update');
    Route::get('/reservation/{reservation}', [Reservation::class, 'show'])->name('reservation.show');
    Route::patch('/reservation/{reservation}', [Reservation::class, 'update'])->name('reservation.update');
    Route::post('/reservation', [Reservation::class, 'store'])->name('reservation.store');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/cutomerProfile', [CutomerProfile::class, 'update'])->name('cutomerProfile.update');
    Route::get('/cutomerProfile', [CutomerProfile::class, 'edit'])->name('cutomerProfile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
