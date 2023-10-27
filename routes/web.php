<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BannedController;
use App\Http\Controllers\CreateProductController;
use App\Http\Controllers\DeleteProductController;
use App\Http\Controllers\EditProductController;
use App\Http\Controllers\EditUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListController;
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

Route::get('/banned', [BannedController::class, 'view'])->name('banned');

Route::get('/list/create', [ListController::class, 'createList'])->middleware('isactive')->name('list.create');
Route::post('/list/create', [ListController::class, 'storeList'])->middleware('isactive')->name('list.store');

Route::get('/list/edit/{id}', [ListController::class, 'editList'])->middleware('isactive')->name('list.edit');
Route::post('/list/edit/{id}', [ListController::class, 'updateList'])->middleware('isactive')->name('list.edit.store');

Route::get('/list/delete/{id}', [ListController::class, 'deleteList'])->middleware('isactive')->name('list.delete');

Route::get('/list/view/{id}', [ListController::class, 'viewList'])->middleware('isactive')->name('list.view');
Route::post('/remove-product-from-list/{product}/{list}', [ListController::class, 'removeProductFromList']);
Route::post('/remove-product-from-list/{product}/{list}', [ListController::class, 'removeProductFromList'])
    ->name('remove.product.from.list');

Route::get('/product/add-to-list/{id}', [ProductController::class, 'addToList'])->middleware('isactive')->name('product.addtolist');
Route::post('/product/add-to-list/{id}', [ProductController::class, 'addToListStore'])->middleware('isactive')->name('product.addtolist.store');


Route::get('/home', [HomeController::class, 'index'])->middleware('isactive')->name('home');
Route::post('/home', [HomeController::class, 'update'])->middleware('isactive')->name('home.updatePrivateState');

Route::get('/edit-account/{id}', [EditUserController::class, 'index'])->middleware('isactive')->name('user.edit');
Route::post('/edit-account/{id}', [EditUserController::class, 'updateAccount'])->middleware('isactive')->name('user.edit.store');

Route::get('/products', [ProductController::class, 'overview'])->middleware('isactive')->name('products.list');
Route::post('/products', [ProductController::class, 'filterProducts'])->middleware('isactive')->name('products.filter');

Route::get('/product/show/{id}', [ProductController::class, 'show'])->middleware('isactive')->name('product.show');

Route::get('/product/create', [CreateProductController::class, 'view'])->middleware('isactive')->name('product.create');
Route::post('/product/create', [CreateProductController::class, 'store'])->middleware('isactive')->name('product.create.store');

Route::get('/product/edit/{id}', [EditProductController::class, 'show'])->middleware('isactive')->name('product.edit');
Route::post('/product/edit/{id}', [EditProductController::class, 'update'])->middleware('isactive')->name('product.edit.store');

Route::get('/product/delete/{id}', [DeleteProductController::class, 'delete'])->middleware('isactive')->name('product.delete');

// Admin pages

Route::get('/dashboard', [AdminController::class, 'view'])->middleware('isactive')->middleware('admin')->name('dashboard');
Route::get('/dashboard/tag-management', [AdminController::class, 'tagManagement'])->middleware('isactive')->middleware('admin')->name('tag-management');

Route::get('/dashboard/tag-management/edit/{id}', [AdminController::class, 'editTag'])->middleware('isactive')->middleware('admin')->name('tag-management.edit');
Route::post('/dashboard/tag-management/edit/{id}', [AdminController::class, 'updateTag'])->middleware('isactive')->middleware('admin')->name('tag-management.store');
Route::get('/dashboard/tag-management/delete/{id}', [AdminController::class, 'deleteTag'])->middleware('isactive')->middleware('admin')->name('tag-management.delete');

Route::get('/dashboard/tag-management/create', [AdminController::class, 'createTag'])->middleware('isactive')->middleware('admin')->name('tag-management.create');
Route::post('/dashboard/tag-management/create', [AdminController::class, 'storeTag'])->middleware('isactive')->middleware('admin')->name('tag-management.create.store');

Route::get('/dashboard/account-administration', [AdminController::class, 'accountAdministration'])->middleware('isactive')->middleware('admin')->name('account-administration');
Route::get('/dashboard/account-administration/edit/{id}', [AdminController::class, 'editAccount'])->middleware('isactive')->middleware('admin')->name('account-administration.edit');
Route::post('/dashboard/account-administration/edit/{id}', [AdminController::class, 'updateAccount'])->middleware('isactive')->middleware('admin')->name('account-administration.store');
Route::get('/dashboard/account-administration/delete/{id}', [AdminController::class, 'deleteAccount'])->middleware('isactive')->middleware('admin')->name('account-administration.delete');
Route::post('/dashboard/account-administration', [AdminController::class, 'updateAccountActive'])->middleware('isactive')->name('account-administration.update.active');

Auth::routes();

