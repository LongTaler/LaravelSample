<?php

use App\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\BooksController;

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

Route::get('/', [BooksController::class, 'index']);
Route::post('/books', [BooksController::class, 'store']);
Route::post('/booksedit/{books}', [BooksController::class, 'edit']);
Route::post('books/update', [BooksController::class, 'update']);
Route::delete('/book/{book}',[BooksController::class, 'destroy']);
Route::get('/phpinfo', function () {
    phpinfo();});
Auth::routes();
Route::get('/home', [App\Http\Controllers\BooksController::class, 'index'])->name('home');
