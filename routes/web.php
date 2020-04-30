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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/{extension}', 'HomeController@findbyextension')->name('home.extension');
Route::get('/listing/{file_id}','HomeController@list')->name('list.file');
Route::get('/download/page/{id}','HomeController@downloadPage')->name('download.page');
Route::post('/file/download','HomeController@download')->name('file.download');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();  
// Admin:: Files Routes 
Route::get('/files','FileController@index')->name('file.index');
Route::get('/files/create','FileController@create')->name('file.create');
Route::post('/files/store','FileController@store')->name('file.store');
Route::get('/files/delete/{id}','FileController@delete')->name('file.delete');

});
