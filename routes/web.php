<?php

use App\Http\Controllers\admin\AboutController;
use App\Http\Controllers\admin\ArticleController as AdminArticleController;
use App\Http\Controllers\contributor\ArticleController;
use App\Http\Controllers\admin\ContributorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\admin\ConfigurationController;
use App\Http\Controllers\admin\ExtraController;
use App\Http\Controllers\admin\GalleryController;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\HistoryController;
use App\Http\Controllers\admin\MajorController;
use App\Http\Controllers\admin\SocialMediaController;
use App\Http\Controllers\admin\ProfileController;
use App\Http\Controllers\admin\WelcomeTextController;
use App\Http\Controllers\public\AboutController as PublicAboutController;
use App\Http\Controllers\public\ArticleController as PublicArticleController;
use App\Http\Controllers\public\ExtraController as PublicExtraController;
use App\Http\Controllers\public\HomeController as PublicHomeController;
use App\Http\Controllers\public\MajorController as PublicMajorController;
use App\Http\Controllers\public\WelcomeTextController as PublicWelcomeTextController;
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
    // Logout
    Route::delete("/auth/logout", [AuthController::class, 'logout'])->name('logout');

    // Dashboard
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

    // Gallery
    Route::get('/dashboard/galeri', [GalleryController::class, 'index'])->name('gallery.index')->middleware(['check-role:admin']);
    Route::post('/dashboard/galeri/store', [GalleryController::class, 'store'])->name('gallery.store')->middleware(['check-role:admin']);
    Route::delete('/dashboard/galeri/delete/{id}', [GalleryController::class, 'delete'])->name('gallery.delete')->middleware(['check-role:admin']);

    // Home
    Route::get('/dashboard/halaman-utama', [HomeController::class, 'index'])->name('home.index')->middleware(['check-role:admin']);
    Route::post('/dashboard/halaman-utama/store', [HomeController::class, 'store'])->name('home.store')->middleware(['check-role:admin']);

    // Article
    Route::get('/dashboard/artikel', [ArticleController::class, 'index'])->name('article.index')->middleware(['check-role:contributor']);
    Route::get('/dashboard/artikel/{id}', [ArticleController::class, 'show'])->name('article.show')->middleware(['check-role:contributor']);
    Route::post('/dashboard/artikel/store', [ArticleController::class, 'store'])->name('article.store')->middleware(['check-role:contributor']);
    Route::post('/dashboard/artikel/update/{id}', [ArticleController::class, 'update'])->name('article.update')->middleware(['check-role:contributor', 'article-owner']);
    Route::delete('/dashboard/artikel/delete/{id}', [ArticleController::class, 'delete'])->name('article.delete')->middleware(['check-role:contributor', 'article-owner']);


    //Article Admin
    Route::get('/dashboard/semua-artikel', [AdminArticleController::class, 'index'])->name('all-article.index')->middleware(['check-role:admin']);
    Route::delete('/dashboard/all-artikel/delete/{id}', [AdminArticleController::class, 'delete'])->name('all-article.delete')->middleware(['check-role:admin']);
    Route::get('/dashboard/all-artikel/show/{id}', [AdminArticleController::class, 'show'])->name('all-article.show')->middleware(['check-role:admin']);


    // Category Article
    Route::get('/dashboard/kategori-artikel', [CategoryController::class, 'index'])->name('category.index')->middleware(['check-role:admin']);
    Route::post('/dashboard/kategori-artikel/store', [CategoryController::class, 'store'])->name('category.store')->middleware(['check-role:admin']);
    Route::post('/dashboard/kategori-artikel/update/{id}', [CategoryController::class, 'update'])->name('category.update')->middleware(['check-role:admin']);
    Route::delete('/dashboard/kategori-artikel/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete')->middleware(['check-role:admin']);
    Route::get('/dashboard/kategori-artikel/show/{id}', [CategoryController::class, 'show'])->name('category.show')->middleware(['check-role:admin']);

    // Major
    Route::get('/dashboard/kejuruan', [MajorController::class, 'index'])->name('major.index')->middleware(['check-role:admin']);
    Route::get('/dashboard/kejuruan/{id}', [MajorController::class, 'show'])->name('major.show')->middleware(['check-role:admin']);
    Route::post('/dashboard/kejuruan/store', [MajorController::class, 'store'])->name('major.store')->middleware(['check-role:admin']);
    Route::post('/dashboard/kejuruan/update/{id}', [MajorController::class, 'update'])->name('major.update')->middleware(['check-role:admin']);
    Route::delete('/dashboard/kejuruan/delete/{id}', [MajorController::class, 'delete'])->name('major.delete')->middleware(['check-role:admin']);

    // Social Media
    Route::get('/dashboard/media-sosial', [SocialMediaController::class, 'index'])->name('social-media.index')->middleware(['check-role:admin']);
    Route::post('/dashboard/media-sosial/store', [SocialMediaController::class, 'store'])->name('social-media.store')->middleware(['check-role:admin']);

    // Profile
    Route::get('/dashboard/profil', [ProfileController::class, 'index'])->name('profil.index')->middleware(['check-role:admin']);
    Route::post('/dashboard/profil/store', [ProfileController::class, 'store'])->name('profil.store')->middleware(['check-role:admin']);

    // Welcome text
    Route::get('/dashboard/sambutan', [WelcomeTextController::class, 'index'])->name('welcome-text.index')->middleware(['check-role:admin']);
    Route::post('/dashboard/sambutan/store', [WelcomeTextController::class, 'store'])->name('welcome-text.store')->middleware(['check-role:admin']);

    // History
    Route::get('/dashboard/sejarah', [HistoryController::class, 'index'])->name('history.index')->middleware(['check-role:admin']);
    Route::post('/dashboard/sejarah/store', [HistoryController::class, 'store'])->name('history.store')->middleware(['check-role:admin']);
});

Route::get('/',[PublicHomeController::class,'index'])->name('index');
Route::get('/kompetensi-keahlian',[PublicMajorController::class,'index'])->name('public-major.index');
Route::get('/kompetensi-keahlian/{slug}',[PublicMajorController::class,'show'])->name('public-major.show');

Route::get('/ekstrakurikuler',[PublicExtraController::class,'index'])->name('public-extra.index');
Route::get('/ekstrakurikuler/{slug}',[PublicExtraController::class,'show'])->name('public-extra.show');

Route::get('/artikel',[PublicArticleController::class,'index'])->name('public-article.index');
Route::get('/artikel/{slug}',[PublicArticleController::class,'show'])->name('public-article.show');

Route::get('/tentang',[PublicAboutController::class,'index'])->name('public-about.index');

Route::get('/sambutan',[PublicWelcomeTextController::class,'index'])->name('public-welcome.index');
