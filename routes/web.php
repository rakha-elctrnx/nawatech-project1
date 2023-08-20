<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(AdminController::class)->prefix('admin')->name('admin.')->middleware('auth', 'verified')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/brand', 'brand')->name('brand');
    Route::get('/brand/add', 'addBrand')->name('addBrand');
    Route::post('/brand/store', 'storeBrand')->name('storeBrand');
    Route::get('/brand/edit/{brand_id}', 'editBrand')->name('editBrand');
    Route::post('/brand/update/{brand_id}', 'updateBrand')->name('updateBrand');
    Route::delete('/brand/delete/{brand_id}', 'deleteBrand')->name('deleteBrand');
});

require __DIR__.'/auth.php';
