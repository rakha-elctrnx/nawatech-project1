<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\GuestController;
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

Route::get('/', [GuestController::class, 'index'])->name('home');
Route::get('/product', [GuestController::class, 'product'])->name('product.index');
Route::post('/product', [GuestController::class, 'product'])->name('product.index');
Route::get('/product-detail/{type_id}', [GuestController::class, 'productDetail'])->name('product.detail');

Route::middleware('auth', 'verified', 'role:2')->group(function () {
    Route::get('/order', [GuestController::class, 'order'])->name('order.index');
    Route::post('/order/create/{type_id}', [GuestController::class, 'orderCreate'])->name('order.create');
    Route::get('/order/export', [GuestController::class, 'orderExport'])->name('order.export');
    Route::delete('/order/cancel/{order_id}', [GuestController::class, 'orderCancel'])->name('order.cancel');
});

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->name('admin.')->middleware('auth', 'verified', 'role:1')->group(function () {

    Route::controller(BrandController::class)->prefix('brand')->group(function () {
        Route::get('/', 'index')->name('brand');
        Route::get('/add', 'create')->name('addBrand');
        Route::post('/store', 'store')->name('storeBrand');
        Route::get('/edit/{brand_id}', 'edit')->name('editBrand');
        Route::patch('/update/{brand_id}', 'update')->name('updateBrand');
        Route::delete('/delete/{brand_id}', 'destroy')->name('deleteBrand');
    });
    Route::controller(ProductController::class)->prefix('product')->group(function () {
        Route::get('/', 'index')->name('product');
        Route::get('/add', 'create')->name('addProduct');
        Route::post('/store', 'store')->name('storeProduct');
        Route::get('/edit/{product_id}', 'edit')->name('editProduct');
        Route::patch('/update/{product_id}', 'update')->name('updateProduct');
        Route::post('/store-type/{product_id}', 'storeType')->name('storeType');
        Route::post('/update-type/{type_id}', 'updateType')->name('updateType');
        Route::post('/store-spec/{type_id}', 'storeSpec')->name('storeSpec');
        Route::delete('/delete-spec/{spec_id}', 'deleteSpec')->name('deleteSpec');
    });
});



require __DIR__.'/auth.php';
