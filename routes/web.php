<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::group(['middleware' => ['authenticate', 'roles']], function () {
    Route::get('/dashboard', [
        'as' => 'dashboard',
        'uses' => 'DashboardController@dashboard'
    ]);
});

Route::post('/books', 'App\Http\Controllers\BooksController@store');
Route::patch('/books/{book}-{slug}', 'App\Http\Controllers\BooksController@update');
Route::delete('/books/{book}-{slug}', 'App\Http\Controllers\BooksController@destroy');

Route::get('/authors/create', 'App\Http\Controllers\AuthorsController@create');
Route::post('/authors', 'App\Http\Controllers\AuthorsController@store');

Route::post('/checkout/{book}', 'App\Http\Controllers\CheckoutBookController@store');
Route::post('/checkin/{book}', 'App\Http\Controllers\CheckinBookController@store');
