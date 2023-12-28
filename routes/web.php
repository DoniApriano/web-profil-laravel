<?php

use App\Http\Controllers\admin\AboutController;
use App\Http\Controllers\admin\ContributorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\admin\ConfigurationController;
use App\Http\Controllers\admin\ExtraController;
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

// Route::get('/', function () {
//     return view('dahsboard.login');
// });


Route::group(['middleware' => 'guest'], function () {
    Route::get("/auth/login", [AuthController::class, 'index']);
    Route::post("/auth/login", [AuthController::class, 'login'])->name('login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Contributor
    Route::get('/dashboard/pengguna', [ContributorController::class, 'index'])->name('contributor.index')->middleware(['check-role:admin']);
    Route::get('/dashboard/pengguna/{id}', [ContributorController::class, 'show'])->name('contributor.show')->middleware(['check-role:admin']);
    Route::post('/dashboard/pengguna/store', [ContributorController::class, 'store'])->name('contributor.store')->middleware(['check-role:admin']);
    Route::post('/dashboard/pengguna/update/{id}', [ContributorController::class, 'update'])->name('contributor.update')->middleware(['check-role:admin']);
    Route::delete('/dashboard/pengguna/delete/{id}', [ContributorController::class, 'delete'])->name('contributor.delete')->middleware(['check-role:admin']);

    // Configuration
    Route::get('/dashboard/konfigurasi', [ConfigurationController::class, 'index'])->name('configuration.index')->middleware(['check-role:admin']);
    Route::post('/dashboard/konfigurasi/store', [ConfigurationController::class, 'store'])->name('configuration.store')->middleware(['check-role:admin']);

    // About
    Route::get('/dashboard/tentang', [AboutController::class, 'index'])->name('about.index')->middleware(['check-role:admin']);
    Route::post('/dashboard/tentang/store', [AboutController::class, 'store'])->name('about.store')->middleware(['check-role:admin']);

    // Extra
    Route::get('/dashboard/ekstrakurikuler', [ExtraController::class, 'index'])->name('extra.index')->middleware(['check-role:admin']);
    Route::get('/dashboard/ekstrakurikuler/{id}', [ExtraController::class, 'show'])->name('extra.show')->middleware(['check-role:admin']);
    Route::post('/dashboard/ekstrakurikuler/store', [ExtraController::class, 'store'])->name('extra.store')->middleware(['check-role:admin']);
    Route::post('/dashboard/ekstrakurikuler/update/{id}', [ExtraController::class, 'update'])->name('extra.update')->middleware(['check-role:admin']);
    Route::delete('/dashboard/ekstrakurikuler/delete/{id}', [ExtraController::class, 'delete'])->name('extra.delete')->middleware(['check-role:admin']);

});
