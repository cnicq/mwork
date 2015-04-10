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


function Titles()
{
    $PageTitle = 'MAPPING';
    $NickName = 'TODO';
    $BigTitle = '桌面';
    $SmallTitle = '';
    $Menu1 = '';
    $Menu2 = '';
    return compact('PageTitle', 'NickName', 'BigTitle', 'SmallTitle', 'Menu1', 'Menu2');
}

Route::group(array('before' => 'auth'), function(){
    Route::get('/', function()
    {
        return View::make('mwork/index', Titles());
    });

    // candidate
    Route::get('/candidate', 'CandidateController@getIndex');
    Route::get('/candidate/add', function()
    {
        return View::make('mwork/candidate/add', Titles());
    });
    Route::get('/candidate/admin', function()
    {
        return View::make('mwork/candidate/admin', Titles());
    });

    // manage - get
    Route::get('/manage/company', 'CompanyController@getIndex');
    Route::get('/manage/position', 'PositionController@getIndex');
    Route::get('/manage/user', 'HUserController@getIndex');

    // manage - post
    Route::post('/manage/company', 'CompanyController@postCreate');

    // client
    Route::get('/client', 'ClientController@getIndex');
    // project
    Route::get('/project', 'ProjectController@getIndex');
    // team
    Route::get('/team', 'TeamController@getIndex');


});

Route::controller('user', 'UserController');
