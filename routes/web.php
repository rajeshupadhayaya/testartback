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

//Admin routes

//All Admin get request routes
Route::get('/admin', 'Admincontroller@showlogin' )->name('login');
Route::get('/createuser', 'Admincontroller@showcreateuserform' )->name('createuser')->middleware('auth');
Route::get('/createarticle/{id?}', 'Admincontroller@createarticle' )->name('createarticle')->middleware('auth');
Route::get('/inpress', 'Admincontroller@showinpressarticle' )->name('inpress')->middleware('auth');
Route::get('/issued', 'Admincontroller@showissuedarticle' )->name('issued')->middleware('auth');
Route::get('/archive', 'Admincontroller@showarchivearticle' )->name('archive')->middleware('auth');
Route::get('/dashboard', 'Admincontroller@showdashboard' )->name('dashboard')->middleware('auth');
Route::get('/addarticle', 'Admincontroller@showarticleform' )->name('addarticle')->middleware('auth');
Route::get('/addcategory/{id?}', 'Admincontroller@showcategoryaddform' )->name('addcategory')->middleware('auth');
Route::get('/draft', 'Admincontroller@draft' )->name('draft')->middleware('auth');
Route::get('/listcategory', 'Admincontroller@listcategory' )->name('listcategory')->middleware('auth');
Route::get('/listmenuscript', 'Admincontroller@showmenuscript' )->name('listmenuscript')->middleware('auth');
Route::get('/users', 'Admincontroller@showusers' )->name('users')->middleware('auth');
Route::get('/edituser/{id?}', 'Admincontroller@edituserform' )->name('edituser')->middleware('auth');


//All Admin Post request routes
Route::post('/admin', 'Admincontroller@login' );
Route::post('/createuser', 'Admincontroller@createuser' )->middleware('auth');
Route::post('/addcategory', 'Admincontroller@addcategory' )->middleware('auth');
Route::post('/createarticle', 'Admincontroller@postarticle' )->middleware('auth');
Route::post('/logout', 'Auth\LoginController@logout' )->name('logout')->middleware('auth');
Route::post('/addarticle', 'Admincontroller@addarticle' )->middleware('auth');
Route::post('/inpress', 'Admincontroller@movearticle' )->middleware('auth');
Route::post('/issued', 'Admincontroller@movearticle' )->middleware('auth');
Route::post('/archive', 'Admincontroller@movearticle' )->middleware('auth');
Route::post('/draft', 'Admincontroller@deletedraft' )->name('draft')->middleware('auth');
Route::post('/edituser', 'Admincontroller@edituser' )->middleware('auth');
Route::post('/deleteuser', 'Admincontroller@deleteuser' )->name('deleteuser')->middleware('auth');

// Route::get('/home', 'HomeController@index')->name('home');
//public routes
Route::get('/', 'publicController@showhome') -> name('home');
Route::get('/journal', 'publicController@getjournal')->name('journal');
Route::get('/guidelines', 'publicController@getguidelines')->name('guidelines');
Route::get('/menuscript', 'publicController@getmenuscriptform')->name('menuscript');
Route::get('/contactus', 'publicController@getcontactusform')->name('contactus');
Route::get('/article/{title?}', 'publicController@getarticle')->name('article');
Route::get('/{journal}', 'publicController@showjournal') -> name('showjournal');
Route::post('/submitmenuscript', 'publicController@submitmenuscript') -> name('submitmenuscript');