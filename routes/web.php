<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
});



Route::get("products/trash",[ProductController::class, 'trash'])->name('products.trash');
Route::put("products/restore/{id}",[ProductController::class, 'restore'])->name('products.restore');
Route::delete("products/force-delete/{id}",[ProductController::class, 'forceDelete'])->name('products.force-delete');

Route::resource("product",ProductController::class);

//filter product by name or sku
Route::get("products/filter",[ProductController::class, 'filter'])->name('products.filter');
require __DIR__.'/auth.php';
