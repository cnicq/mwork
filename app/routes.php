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
    Route::get('/candidate/addProject/{projId}/{caId}', 'CandidateController@addProject');
    Route::get('/candidate/comment/{caId}/{content}/{projId?}', 'CandidateController@addComment');
    Route::post('/candidate/comment', 'CandidateController@postComment');
    Route::get('/candidate/detail/{caId}/{projId?}', 'CandidateController@getDetail');
    Route::get('/candidate/project/{caId}', 'CandidateController@getProjectList');
    Route::get('/candidate/add', 'CandidateController@getAdd');
    Route::get('/candidate/manage', 'CandidateController@getManage');
    Route::get('/candidate/my', 'CandidateController@getMy');
    Route::get('/candidate/addOwn/{caId}', 'CandidateController@addOwn');
    Route::get('/candidate/deleteOwn/{caId}', 'CandidateController@deleteOwn');
    
    //Route::get('/candidate/search/{keywords?}', 'CandidateController@getSearch');
    Route::post('/candidate/add', 'CandidateController@postCreate');
    Route::post('/candidate/search/{mode}', 'CandidateController@postSearch');

    // manage - get
    Route::get('/manage/company', 'CompanyController@getManage');
    Route::get('/manage/company/delete/{id}', 'CompanyController@getDelete');
    
    Route::get('/manage/team', 'TeamController@getManage');
    Route::get('/manage/datavalue/{type?}', 'DatavalueController@getList');
    //Route::get('/manage/datavalue', 'DatavalueController@getList');

    // user 
    Route::get('/user/profile/{userId}', 'UserController@getProfile');
    Route::get('/user/project/{userId}', 'UserController@getProject');
    Route::get('/user/kpi/{userId}/{year?}/{month?}', 'UserController@getKpi');
    Route::post('/user/profile', 'UserController@postProfile');

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

    // position / title
    Route::get('/manage/position/{GUID?}', 'PositionController@getList');
    Route::post('/manage/position/update', 'PositionController@postEditPosition');
    Route::post('/manage/title/update', 'PositionController@postEditTitle');

    // client
    Route::get('/client', 'ClientController@getIndex');
    Route::get('/client/manage', 'ClientController@getCreate');
    Route::post('/client', 'ClientController@postCreate');

    // project
    Route::get('/project', 'ProjectController@getIndex');
    Route::get('/project/detail/{id}', 'ProjectController@getShow');
    Route::get('/project/manage', 'ProjectController@getCreate');
    Route::get('/project/state/{projId}/{stateName}', 'ProjectController@changeState');
    Route::get('/project/step/{projId}/{caId}/{stepVal}/{content?}', 'ProjectController@changeStep');

    Route::post('/project/manage', 'ProjectController@postCreate');
    
    // team
    Route::get('/team', 'TeamController@getIndex');
    Route::get('/team/manage', 'TeamController@getCreate');
    Route::get('/team_{id}', 'TeamController@getShow');
    Route::get('/team_user_{id}', 'TeamController@getUser');
    Route::post('/team/manage', 'TeamController@postCreate');
});

Route::controller('user', 'UserController');
