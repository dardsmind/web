<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', function () {
//		return view('frontend.index');
//});
Route::group(['middleware' => ['visitorlog']], function() {
	Route::get('/', ['uses' => 'FrontendController@index','as' => 'index']);	  
	Route::get('/article/{slug}', ['uses' => 'FrontendController@article','as' => 'blog.slug']);	
});


// Authentication Routes...
Route::get('login', 'Auth\AuthController@showLoginForm');
Route::post('login', 'Auth\AuthController@login');
Route::get('logout', 'Auth\AuthController@logout');
// Registration Routes...
Route::get('register', 'Auth\AuthController@showRegistrationForm');
Route::post('register', 'Auth\AuthController@register');
Route::get('pending', 'Auth\AuthController@pending');
Route::get('signupdone', 'Auth\AuthController@signupdone');
Route::get('blocked', 'Auth\AuthController@blocked');
// Password Reset Routes...
Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
Route::post('password/reset', 'Auth\PasswordController@reset');


Route::group(['middleware' => 'auth'], function() {
	Route::get('/dashboard', 'HomeController@index');
	Route::get('/dashboard/help', 'HomeController@apihelp');
	
	//--- User ---
	Route::get('/dashboard/user/new', 'UserController@create');  
	Route::post('/dashboard/user/new', 'UserController@store');  
	Route::get('/dashboard/user/{id}', 'UserController@edit');  
	Route::post('/dashboard/user/{id}', 'UserController@update');  
	Route::post('/dashboard/user/avatar/{id}/', ['uses' => 'UserController@avatar','as' => 'user.avatar']);
	Route::post('/dashboard/user/{id}/role', 'UserController@set_role');  
	
	Route::get('/dashboard/profile/{id}', 'UserController@profile');  
	
	
    Route::get('/dashboard/users', 'UserController@users');  
	Route::get('/dashboard/users/data', ['uses' => 'UserController@data','as' => 'user.data']);	  
	Route::delete('/dashboard/users/delete', ['uses' => 'UserController@delete','as' => 'user.delete']);
	//Route::post('user/avatar/{id}/', ['uses' => 'UserController@avatar','as' => 'user.avatar']);
	
	//-- BLOG -----
	Route::get('/dashboard/blog/index', ['uses' => 'BlogController@index','as' => 'dashboard.blog.index']);	
	Route::get('/dashboard/blog/new', ['uses' => 'BlogController@new_blog','as' => 'dashboard.blog.new']);	
	Route::post('/dashboard/blog/new', ['uses' => 'BlogController@store','as' => 'dashboard.blog.new']);	
	Route::get('/dashboard/blog/data', ['uses' => 'BlogController@data','as' => 'dashboard.blog.data']);	
	Route::post('/dashboard/blog/update', ['uses' => 'BlogController@update','as' => 'dashboard.blog.update']);	
	Route::get('/dashboard/blog/{id}', ['uses' => 'BlogController@edit','as' => 'dashboard.blog.edit']);	
	Route::post('/dashboard/blog/titlesearch', ['uses' => 'BlogController@titlesearch','as' => 'dashboard.blog.titlesearch']);	
	Route::post('/dashboard/blog/data/reorder', ['uses' => 'BlogController@reorder','as' => 'dashboard.blog.reorder']);	

	Route::delete('/dashboard/blog/delete', ['uses' => 'BlogController@destroy','as' => 'dashboard.blog.delete']);	

	//-- Category -----
	Route::get('/dashboard/category', ['uses' => 'CategoryController@index','as' => 'dashboard.category']);	
	Route::get('/dashboard/category/data', ['uses' => 'CategoryController@data','as' => 'dashboard.category.data']);	
	Route::post('/dashboard/category/save', ['uses' => 'CategoryController@store','as' => 'dashboard.category.save']);	
	Route::delete('/dashboard/category/delete', ['uses' => 'CategoryController@destroy','as' => 'dashboard.category.delete']);	

	//-- Tags -----
	Route::get('/dashboard/tags', ['uses' => 'TagsController@index','as' => 'dashboard.tags']);	
	Route::get('/dashboard/tags/data', ['uses' => 'TagsController@data','as' => 'dashboard.tags.data']);	
	Route::post('/dashboard/tags/save', ['uses' => 'TagsController@store','as' => 'dashboard.tags.save']);	
	Route::delete('/dashboard/tags/delete', ['uses' => 'TagsController@destroy','as' => 'dashboard.tags.delete']);	
	Route::get('/dashboard/tags/search', ['uses' => 'TagsController@search','as' => 'dashboard.tags.search']);	


	//--- SETTINGS -----

	//documents
	Route::get('/dashboard/documents', ['uses' => 'DocumentController@index','as' => 'dashboard.documents']); 
	Route::get('/dashboard/documents/data',['uses' => 'DocumentController@data','as' => 'dashboard.documents.data']); 
	Route::delete('/dashboard/documents/delete',['uses' => 'DocumentController@destroy','as' => 'delete.document']); 
	Route::post('/dashboard/documents/upload', ['uses' => 'DocumentController@store','as' => 'upload.document']);	
	// config
	Route::group(['middleware' => ['role:super_admin']], function() {	
		Route::get('/dashboard/settings/configuration', 'ConfigController@config'); 
		Route::post('/dashboard/settings/configuration', 'ConfigController@save_config'); 
		
		// roles
		Route::get('/dashboard/settings/roles', 'RoleController@index');  
		Route::get('/dashboard/settings/roles/data', 'RoleController@data'); 
		Route::get('/dashboard/settings/role/{id}', 'RoleController@edit');			
		Route::post('/dashboard/settings/role', 'RoleController@store');  
		Route::post('/dashboard/settings/role/update', 'RoleController@update');  
		Route::delete('/dashboard/settings/role/delete', 'RoleController@destroy'); 		

		Route::get('/dashboard/settings/permission', 'PermissionController@index');
		Route::get('/dashboard/settings/permission/data', 'PermissionController@data');
		Route::get('/dashboard/settings/permission/{id}', 'PermissionController@edit');		
		Route::post('/dashboard/settings/permission', 'PermissionController@store');
		Route::delete('/dashboard/settings/permission/delete', 'PermissionController@destroy'); 

		// Routes
		Route::get('/dashboard/routes', 'HomeController@routes');			
	});		
	
	Route::get('/dashboard/apilog', 'VisitorController@api_log');	
	Route::get('/dashboard/api', 'VisitorController@index');	
	Route::get('/dashboard/api/data', 'VisitorController@data');	
	Route::post('/dashboard/api', 'VisitorController@store');	
	Route::delete('/dashboard/api/delete', 'VisitorController@destroy');
	

});

