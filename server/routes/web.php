
<?php

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

Route::get('login', 'LoginController@getLogin');
Route::post('login', 'LoginController@postLogin');
Route::get('sai-gon-tech/home','HomeController@index')->name('home.index');
Route::group(['prefix'=>'admin', 'middleware'=>'adminLogin'], function(){
    //Book route
    Route::get('/book/list','BookController@index')->name('book.list');
    Route::get('/book/update/{id}','BookController@edit')->name('book.edit')->middleware('signed');
    Route::post('book/update','BookController@update')->name('book.update');
    Route::post('/book/create','BookController@store')->name('book.store');
    Route::get('/search/book','BookController@search')->name('book.search');
    Route::get('/book/delete/{id}','BookController@destroy')->name('book.delete')->middleware('signed');
    Route::resource('/book','BookController');
    Route::get('/book/{foldername}/{filename}', 'BookController@getFile')->where('filename', '^[^/]+$');
    //Account route
    Route::get('/accounts/list','AccountController@index')->name('account.list');
    Route::get('/accounts/create','AccountController@create')->name('account.create');
    Route::post('/accounts/create','AccountController@store')->name('account.store');
    Route::get('/accounts/update/{id}','AccountController@edit')->name('account.edit')->middleware('signed');
    Route::post('/accounts/update','AccountController@update')->name('account.update');
    Route::get('/search/account','AccountController@search')->name('account.search');
    Route::get('/accounts/delete/{id}','AccountController@destroy')->name('account.delete')->middleware('signed');
    Route::resource('/accounts','AccountController');
    //Logout route  
    Route::get('logout', 'LoginController@getLogout');
});


