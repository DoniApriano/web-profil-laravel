<?php

use App\Http\Controllers\admin\ContributorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\auth\AuthController;
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
    Route::get('/pengguna', [ContributorController::class, 'index'])->name('contributor.index')->middleware(['check-role:admin']);;
    Route::get('/pengguna/{id}', [ContributorController::class, 'show'])->name('contributor.show')->middleware(['check-role:admin']);;
    Route::post('/pengguna/store', [ContributorController::class, 'store'])->name('contributor.store')->middleware(['check-role:admin']);
    Route::post('/pengguna/update/{id}', [ContributorController::class, 'update'])->name('contributor.update')->middleware(['check-role:admin']);
    Route::delete('/pengguna/delete/{id}', [ContributorController::class, 'delete'])->name('contributor.delete')->middleware(['check-role:admin']);
});
