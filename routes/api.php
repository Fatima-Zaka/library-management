<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{BookController, PatronController, AuthorController};

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    Route::apiResource('patrons', PatronController::class);
    Route::resource('books', BookController::class);
    Route::resource('authors', AuthorController::class);
    // Custom routes for borrowing and returning books
    Route::post('patrons/{patron}/borrow', [PatronController::class, 'borrowBook']);
    Route::post('patrons/{patron}/return/{bookId}', [PatronController::class, 'returnBook']);
});

Route::prefix('v1')->group(function () {
    Route::apiResource('patrons', PatronController::class);
    Route::apiresource('books', BookController::class);
    Route::apiResource('authors', AuthorController::class);

    // Custom routes for borrowing and returning books
    Route::post('/patrons/{patron}/borrow/{book}', [PatronController::class, 'borrowBook']);
    Route::post('patrons/{patron}/return/{bookId}', [PatronController::class, 'returnBook']);

    //custom routes to Retreive Records
    Route::get('/authors/{author}', [BookController::class, 'show']);
    Route::get('patrons/{patron}', [PatronController::class, 'show']);

    //Custom Route to update record
    Route::put('authors/{author}/update',[AuthorController::class,'update']);
    Route::put('books/{book}/update',[BookController::class,'update']);
    Route::put('/patrons/{patron}/update',[PatronController::class,'update']);

    //Custom routes to search records
    Route::post('/authors/search', [AuthorController::class, 'search']);
    Route::get('/books/search', [BookController::class, 'search']);

});

// Version 2 routes
Route::prefix('v2')->group(function () {
    // Assuming the functionality changes in the future
    Route::apiResource('books', 'V2\BookController');
    Route::apiResource('authors', 'V2\AuthorController');
    Route::apiResource('patrons', 'V2\LibraryPatronController');

    Route::post('patrons/{patron}/borrow/{book}', 'V2\LibraryPatronController@borrowBook');
    Route::put('patrons/{patron}/return/{book}', 'V2\LibraryPatronController@returnBook');
});

