<?php

use App\Http\Controllers\CreateProductController;
use App\Http\Controllers\DeleteProductController;
use App\Http\Controllers\EditProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
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
    if (Auth::check()) {
        return redirect('/home');
    }
    return view('welcome');
});


Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('/home', [HomeController::class, 'update'])->name('home.updatePrivateState');

Route::get('/products', [ProductController::class, 'overview'])->name('products.list');
Route::post('/products', [ProductController::class, 'filterProducts'])->name('products.filter');


Route::get('/product/show/{id}', [ProductController::class, 'show'])->name('product.show');

Route::get('/product/create', [CreateProductController::class, 'view'])->name('product.create');
Route::post('/product/create', [CreateProductController::class, 'store'])->name('product.create.store');

Route::get('/product/edit/{id}', [EditProductController::class, 'show'])->name('product.edit');
Route::post('/product/edit/{id}', [EditProductController::class, 'update'])->name('product.edit.store');

Route::get('/product/delete/{id}', [DeleteProductController::class, 'delete'])->name('product.delete');


Route::get('/list/create', [ProductController::class, 'create-list'])->name('list.create');


Auth::routes();

