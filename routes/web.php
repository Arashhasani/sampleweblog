<?php

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


Route::prefix('')->namespace('App\Http\Controllers')->middleware(['web'])->group(function (){
    Route::resource('articles','ArticleController');
    Route::post('statusUpdate','ArticleController@statusUpdate')->name('statusUpdate');
    Route::get('/', function () {
        return redirect(\route('articles.index'));
    });
});

