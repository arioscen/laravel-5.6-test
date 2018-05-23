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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('groups', 'GroupController');

Route::resource('posts', 'PostController');

Route::resource('comments', 'CommentController');

Route::group(['middleware' => 'auth', 'namespace' => 'User', 'prefix' => 'user'], function() {
    Route::get('/', 'HomeController@index');
    Route::resource('groups', 'GroupController');
    Route::post('groups/join', 'GroupController@join');
    Route::post('groups/leave', 'GroupController@leave');
    Route::resource('posts', 'PostController');
});

Route::group(['prefix' => 'admin','namespace' => 'Admin'],function ($router)
{
    $router->get('login', 'LoginController@showLoginForm')->name('admin.login');
    $router->post('login', 'LoginController@login');
    $router->post('logout', 'LoginController@logout')->name('admin.logout');
    $router->get('dash', 'DashboardController@index');
});

Route::get('lang/{lang}', ['as'=>'lang.switch', 'uses'=>'LanguageController@switchLang']);