<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\WebController;

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
Route::domain('web.local')->group(function () {
    Route::get('/', [WebController::class, 'index']);
});

Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::domain('admin.local')->group(function () {

        Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

        // Rutas para el modelo "Hotel"
        Route::get('/hotels', [HotelController::class, 'index'])->name('hotels.index');
        Route::get('/hotels/create', [HotelController::class, 'create'])->name('hotels.create');
        Route::post('/hotels', [HotelController::class, 'store'])->name('hotels.store');
        Route::get('/hotels/{id}', [HotelController::class, 'show'])->name('hotels.show');
        Route::get('/hotels/{id}/edit', [HotelController::class, 'edit'])->name('hotels.edit');
        Route::put('/hotels/{id}', [HotelController::class, 'update'])->name('hotels.update');
        Route::delete('/hotels/{id}', [HotelController::class, 'destroy'])->name('hotels.destroy');

        // Rutas para el modelo "Apartment"
        Route::get('/apartments', [ApartmentController::class, 'index'])->name('apartments.index');
        Route::get('/apartments/create', [ApartmentController::class, 'create'])->name('apartments.create');
        Route::post('/apartments', [ApartmentController::class, 'store'])->name('apartments.store');
        Route::get('/apartments/{id}', [ApartmentController::class, 'show'])->name('apartments.show');
        Route::get('/apartments/{id}/edit', [ApartmentController::class, 'edit'])->name('apartments.edit');
        Route::put('/apartments/{id}', [ApartmentController::class, 'update'])->name('apartments.update');
        Route::delete('/apartments/{id}', [ApartmentController::class, 'destroy'])->name('apartments.destroy');
    });
});