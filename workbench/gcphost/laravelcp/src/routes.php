<?php
Route::model('user', 'Gcphost\Laravelcp\User');
Route::model('profile', 'Gcphost\Laravelcp\UserProfile');
Route::model('comment', 'Gcphost\Laravelcp\Comment');
Route::model('id', 'id');
Route::model('post', 'Gcphost\Laravelcp\Post');
Route::model('todo', 'Gcphost\Laravelcp\Todos');
Route::model('role', 'Gcphost\Laravelcp\Role');

Route::pattern('comment', '[0-9]+');
Route::pattern('post', '[0-9]+');
Route::pattern('user', '[0-9]+');
Route::pattern('todo', '[0-9]+');
Route::pattern('profile', '[0-9]+');
Route::pattern('role', '[0-9]+');
Route::pattern('id', '[0-9]+');
Route::pattern('token', '[0-9a-z]+');
Route::pattern('any', '[0-9a-z].+');

$prefix = Request::segment(1);

if(in_array($prefix, array('admin','json', 'xml'))){
	if(in_array($prefix, array('json', 'xml'))){
		$before = $prefix.'|auth.basic|checkuser';
		$newprefix = $prefix.'/admin';
	} else {
		$before='auth|checkuser';
		$newprefix='admin';
	}

	Route::group(array('prefix' => $newprefix, 'suffix' => array('.json', '.xml', '*'), 'before' => $before), function()
	{
		Event::fire('page.admin');

		# Search
		Search::AddTable('users', array('email', 'displayname', 'id'), array('id' => array('method'=>'modal', 'action'=>'admin/users/?/edit')));
		Search::AddTable('posts', array('title','slug','content','meta_title','meta_description','meta_keywords'), array('id' => array('method'=>'modal', 'action'=>'admin/slugs/?/edit')));
		Search::AddTable('todos', array('title','description'), array('id' => array('method'=>'modal', 'action'=>'admin/todos/?/edit')));
		
		Route::controller('search/{postSlug}', 'Gcphost\Laravelcp\AdminSearchController');

		# Settings Management
		Route::controller('settings', 'Gcphost\Laravelcp\AdminSettingsController');

		# Comment Management
		Route::controller('comments/{comment}', 'Gcphost\Laravelcp\AdminCommentsController');
		Route::controller('comments', 'Gcphost\Laravelcp\AdminCommentsController');

		# Slug Management
		Route::controller('slugs/{post}', 'Gcphost\Laravelcp\AdminBlogsController');
		Route::controller('slugs', 'Gcphost\Laravelcp\AdminBlogsController');

		# User Mass Management
		Route::get('user/mass/email', 'Gcphost\Laravelcp\AdminEmailController@getEmailMass');
		Route::post('user/mass/email', 'Gcphost\Laravelcp\AdminEmailController@postIndex');
		
		Route::delete('user/mass', 'Gcphost\Laravelcp\AdminUsersController@postDeleteMass');

		Route::get('user/mass/merge', 'Gcphost\Laravelcp\AdminMergeController@getMassMergeConfirm');
		Route::post('user/mass/merge', 'Gcphost\Laravelcp\AdminMergeController@postMerge');


		# User Profile Management
		Route::controller('users/{user}/profile/{profile}', 'Gcphost\Laravelcp\AdminProfileController');

		# User Email Management
		Route::controller('users/{user}/email', 'Gcphost\Laravelcp\AdminEmailController');
		Route::controller('users/email', 'Gcphost\Laravelcp\AdminEmailController');
		Route::get('users/{user}/emails', 'Gcphost\Laravelcp\AdminEmailController@getEmails');

		# User Management
		Route::controller('users/{user}', 'Gcphost\Laravelcp\AdminUsersController');
		Route::controller('users', 'Gcphost\Laravelcp\AdminUsersController');
		

		# User Role Management
		Route::controller('roles/{role}', 'Gcphost\Laravelcp\AdminRolesController');
		Route::controller('roles', 'Gcphost\Laravelcp\AdminRolesController');

		# Todos
		Route::controller('todos/{todo}', 'Gcphost\Laravelcp\AdminTodosController');
		Route::controller('todos', 'Gcphost\Laravelcp\AdminTodosController');
	   
		# Admin Dashboard
		Route::controller('/', 'Gcphost\Laravelcp\AdminDashboardController');	
	
	});
} else {

	Route::group(array('prefix' => 'client', 'suffix' => array('.json', '.xml', '*'), 'before' => 'auth|checkuser'), function()
	{
		Event::fire('page.client');
		
		Route::controller('/', 'Gcphost\Laravelcp\ClientController');

	});



	Route::get('private/cron',  function()
	{
		header('Content-Type: application/json');
		die(json_encode(CronWrapper::Run()));
	});

	Event::fire('page.site');

	Route::get('invalidtoken', 'Gcphost\Laravelcp\UserController@invalidtoken');
	Route::get('nopermission', 'Gcphost\Laravelcp\UserController@noPermission');
	Route::get('suspended', 'Gcphost\Laravelcp\UserController@suspended');

	Route::get('user/reset/{token}', 'Gcphost\Laravelcp\UserController@getReset');
	Route::post('user/reset/{token}', 'Gcphost\Laravelcp\UserController@postReset');

	Route::controller('user/{user}/profile/{profile}', 'Gcphost\Laravelcp\UserController');
	Route::controller('user/{user}', 'Gcphost\Laravelcp\UserController');
	Route::controller('user', 'Gcphost\Laravelcp\UserController');

	Route::when('contact-us','detectLang');

	Route::post('contact-us', 'Gcphost\Laravelcp\BlogController@postContactUs');
	Route::get('contact-us', 'Gcphost\Laravelcp\BlogController@getContactUs');

	Route::get('{postSlug}', 'Gcphost\Laravelcp\BlogController@getView');
	Route::post('{postSlug}', 'Gcphost\Laravelcp\BlogController@postView');

	Route::get('/', array('before' => 'detectLang','uses' => 'Gcphost\Laravelcp\BlogController@getIndex'));
}