<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group(['middleware' => 'api'], function(){
	Route::get('getcategory/{query?}', 'API\CategoryController@getCategory')->name('getcategory');
	Route::get('getsubcategory/{query?}', 'API\CategoryController@getSubCategory')->name('getsubcategory');
	Route::get('getarticletitle/{query?}', 'API\ArticleController@getArticleTitle')->name('getarticletitle');
	Route::post('autosave', 'API\ArticleController@autoSave')->name('autosave');
	Route::get('refreshcaptcha', 'API\ArticleController@refreshCaptcha');
});