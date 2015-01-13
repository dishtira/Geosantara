<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

// Route::get('/', function()
// {
// 	return View::make('index');
// });

Route::get('/', array(
	'as' => 'showGame',
	'uses' => 'GeosantaraController@showGame'
));

Route::get('admin', array(
	'as' => 'adminPanel',
	'uses' => 'GeosantaraController@showAdminPanel'
));

Route::get('admin/addClue', array(
	'as' => 'addClue',
	'uses' => 'GeosantaraController@showAddClue'
));

Route::post('admin/addClue', array(
	'as' => 'postAddClue',
	'uses' => 'GeosantaraController@addClue'
));

Route::get('admin/editClue/{clueID?}', array(
	'as' => 'editClue',
	'uses' => 'GeosantaraController@showEditClue'
));

Route::post('admin/editClue', array(
	'as' => 'postEditClue',
	'uses' => 'GeosantaraController@editClue'
));

Route::get('admin/deleteClue/{clueID?}', array(
	'as' => 'deleteClue',
	'uses' => 'GeosantaraController@deleteClue'
));

Route::post('postAnswer', array(
	'as' => 'postAnswer',
	'uses' => 'GeosantaraController@checkAnswer'
));

Route::post('checkAnswer', array(
	'as' => 'checkAnswer',
	'uses' => 'GeosantaraController@checkAnswer'
));

Route::get('aboutUs', function(){
	return View::make('aboutUs');
});
