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
    return view('vue.template.app-vue');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/* TAGS */
Route::get('/tags', 'TagController@index')->name('tags');
Route::get('/api/tags', 'TagController@get');
Route::post('/tags', 'TagController@store');
Route::delete('/tags/{id}', 'TagController@destroy');

Route::get('/api/tags', 'TagController@get');
Route::get('/repositories', 'RepositoryController@index');
Route::post('/repositories', 'RepositoryController@store');
Route::delete('/tags/{id}', 'TagController@destroy');

Route::post('/tagRepository', 'RepositoryController@associateTagRepository');
