<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AuthorController;
use App\Http\Middleware\CheckAccessToken;
use App\Http\Controllers\BookController;

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);


Route::middleware([CheckAccessToken::class])->group(function () {
    Route::get('/', [AuthorController::class, 'index']);
    Route::resource('authors', AuthorController::class);
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::post('/books', [BookController::class, 'store'])->name('books.store');
    Route::get('/books/delete/{bookID}', [BookController::class, 'deleteBook']);
});
