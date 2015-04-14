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

/** ------------------------------------------
 *  Route model binding
 *  ------------------------------------------
 */
Route::model('user', 'User');
Route::model('comment', 'Comment');
Route::model('post', 'Post');
Route::model('role', 'Role');

/** ------------------------------------------
 *  Route constraint patterns
 *  ------------------------------------------
 */
Route::pattern('comment', '[0-9]+');
Route::pattern('post', '[0-9]+');
Route::pattern('user', '[0-9]+');
Route::pattern('role', '[0-9]+');
Route::pattern('token', '[0-9a-z]+');

Route::post('user/login', 'UserController@postLogin');
Route::post('user/create', 'UserController@postIndex');
Route::get('user/login', 'UserController@getLogin');
Route::get('user/logout', 'UserController@getLogout');


Route::group(array('before' => 'auth'), function(){
    // desktop
    Route::get('/', 'DesktopController@getIndex');

    // candidate
    Route::get('/candidate', 'CandidateController@getIndex');
    Route::get('/candidate/add', 'CandidateController@getAdd');
    Route::get('/candidate/manage', 'CandidateController@getManage');

    // manage - get
    Route::get('/manage/company', 'CompanyController@getManage');
    Route::get('/manage/position', 'PositionController@getManage');
    Route::get('/manage/user', 'HUserController@getManage');
    Route::get('/manage/team', 'TeamController@getManage');
    // manage - post
    Route::post('/manage/company', 'CompanyController@postCreate');

    // client
    Route::get('/client', 'ClientController@getIndex');
    Route::get('/client/manage', 'ClientController@getIndex');

    // project
    Route::get('/project', 'ProjectController@getIndex');
    Route::get('/project/manage', 'ProjectController@getIndex');
    
    // team
    Route::get('/team', 'TeamController@getIndex');
    Route::get('/team/manage', 'TeamController@getIndex');


});

Route::controller('user', 'UserController');
