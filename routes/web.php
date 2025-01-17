<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;
use App\Models\Book;
use App\Models\Category;

Route::get('/', function () {
    return view('auth.dashboardawal');
})->name('dash');

Route::get('/admin', function () {
    return view('admin.dashboard');
});

Route::get('/kategori', function () {
    $categories = Category::all();
    return view('admin.kategori',compact('categories'));
})->name('kategori');

Route::get('/buku', function () {
    $books = Book::all();
    $categories = Category::all();
    return view('admin.buku',compact('books','categories'));
})->name('buku');

Route::get('/admins', function () {
    return view('admindasar');
});
Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');
Route::get('/verify',function (){
    return view('auth.verify');
})->name('verify');

Route::post('/', [LoginController::class, 'actionlogin'])->name('actionlogin');
Route::get('actionlogout', [LoginController::class, 'actionlogout'])->name('actionlogout')->middleware('auth');

Route::post('/users', [UserController::class, 'register'])->name('register');

Route::get('/categories', [CategoryController::class, 'index'])->name('products.index');
Route::post('/categories', [CategoryController::class, 'add'])->name('addcategory');
Route::get('/categories/{category}', [CategoryController::class, 'edit'])->name('editcategory');
Route::post('/categories/{category}', [CategoryController::class, 'update'])->name('updatecategory');
Route::delete('/categories/{category}', [CategoryController::class, 'delete'])->name('deletecategory');

Route::get('/books',[BookController::class, 'index'])->name('books.index');
Route::post('/books',[BookController::class, 'add'])->name('addbook');
Route::get('/books/{book}',[BookController::class, 'edit'])->name('editbook');
Route::post('/books/{book}',[BookController::class, 'update'])->name('updatebook');
Route::delete('/books/{book}',[BookController::class, 'delete'])->name('deletebook');

