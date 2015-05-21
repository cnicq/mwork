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

    Route::controller('roles', 'AdminRolesController');
    Route::controller('users', 'AdminUsersController');

    // desktop
    Route::get('/', 'DesktopController@getIndex');

    // candidate
    Route::get('/candidate', 'CandidateController@getIndex');
    Route::get('/candidate/add', 'CandidateController@getAdd');
    Route::get('/candidate/manage', 'CandidateController@getManage');

    // manage - get
    Route::get('/manage/company', 'CompanyController@getManage');
    Route::get('/manage/company/delete/{id}', 'CompanyController@getDelete');
    Route::get('/manage/position', 'PositionController@getManage');
    
    Route::get('/manage/team', 'TeamController@getManage');
    Route::get('/manage/datavalue/{type?}', 'DatavalueController@getList');
    //Route::get('/manage/datavalue', 'DatavalueController@getList');

    // user
    Route::get('/user/{userId}/{tab}/{year}/{month}', 'UserController@getShow');

    Route::get('/manage/user', 'AdminUsersController@getCreate');
    Route::get('/manage/user/{id}', 'AdminUsersController@getData');
    Route::post('/manage/user/edit/{user}', 
        array('as'=>'post_user_edit', 'uses'=>'AdminUsersController@postEdit'));
    Route::post('/manage/user/create', 
        array('as'=>'post_user_create', 'uses'=>'AdminUsersController@postCreate'));
    Route::get('/manage/user/delete/{user}', 'AdminUsersController@getDelete');

    // role
    Route::get('/manage/role', 'AdminRolesController@getCreate');
    Route::get('/manage/role/{id}', 'AdminRolesController@getData');
    Route::post('/manage/role/edit/{role}', 
        array('as'=>'post_role_edit', 'uses'=>'AdminRolesController@postEdit'));
    Route::post('/manage/role/create', 
        array('as'=>'post_role_create', 'uses'=>'AdminRolesController@postCreate'));
    Route::get('/manage/role/delete/{role}', 'AdminRolesController@getDelete');

    // manage - post
    Route::post('/manage/company', 'CompanyController@postCreate');
    Route::post('/manage/datavalue/update', 'DatavalueController@postEdit');
    Route::post('/manage/datavalue/delete', 'DatavalueController@postDelete');

    // client
    Route::get('/client', 'ClientController@getIndex');
    Route::get('/client/manage', 'ClientController@getCreate');
    Route::post('/client', 'ClientController@postCreate');

    // project
    Route::get('/project', 'ProjectController@getIndex');
    Route::get('/project_{id}', 'ProjectController@getShow');
    Route::get('/project/manage', 'ProjectController@getCreate');
    Route::post('/project/manage', 'ProjectController@postCreate');
    
    // team
    Route::get('/team', 'TeamController@getIndex');
    Route::get('/team/manage', 'TeamController@getCreate');
    Route::get('/team_{id}', 'TeamController@getShow');
    Route::get('/team_user_{id}', 'TeamController@getUser');
    Route::post('/team/manage', 'TeamController@postCreate');


});

Route::controller('user', 'UserController');
