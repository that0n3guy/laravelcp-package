<?php
Route::model('user', 'User');
Route::model('profile', 'Gcphost\Laravelcp\Models\UserProfile');
Route::model('comment', 'Gcphost\Laravelcp\Models\Comment');
Route::model('id', 'id');
Route::model('post', 'Gcphost\Laravelcp\Models\Post');
Route::model('todo', 'Gcphost\Laravelcp\Models\Todos');
Route::model('role', 'Role');

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

		Route::controller('search/{postSlug}', 'Gcphost\Laravelcp\Controllers\AdminSearchController');

		# Settings Management
		Route::controller('settings', 'Gcphost\Laravelcp\Controllers\AdminSettingsController');

		# Comment Management
		Route::controller('comments/{comment}', 'Gcphost\Laravelcp\Controllers\AdminCommentsController');
		Route::controller('comments', 'Gcphost\Laravelcp\Controllers\AdminCommentsController');

		# Slug Management
		Route::controller('slugs/{post}', 'Gcphost\Laravelcp\Controllers\AdminBlogsController');
		Route::controller('slugs', 'Gcphost\Laravelcp\Controllers\AdminBlogsController');

		# User Mass Management
		Route::get('user/mass/email', 'Gcphost\Laravelcp\Controllers\AdminEmailController@getEmailMass');
		Route::post('user/mass/email', 'Gcphost\Laravelcp\Controllers\AdminEmailController@postIndex');

		Route::delete('user/mass', 'Gcphost\Laravelcp\Controllers\AdminUsersController@postDeleteMass');

		Route::get('user/mass/merge', 'Gcphost\Laravelcp\Controllers\AdminMergeController@getMassMergeConfirm');
		Route::post('user/mass/merge', 'Gcphost\Laravelcp\Controllers\AdminMergeController@postMerge');


		# User Profile Management
		Route::controller('users/{user}/profile/{profile}', 'Gcphost\Laravelcp\Controllers\AdminProfileController');

		# User Email Management
		Route::controller('users/{user}/email', 'Gcphost\Laravelcp\Controllers\AdminEmailController');
		Route::controller('users/email', 'Gcphost\Laravelcp\Controllers\AdminEmailController');
		Route::get('users/{user}/emails', 'Gcphost\Laravelcp\Controllers\AdminEmailController@getEmails');

		# User Management
		Route::controller('users/{user}', 'Gcphost\Laravelcp\Controllers\AdminUsersController');
		Route::controller('users', 'Gcphost\Laravelcp\Controllers\AdminUsersController');


		# User Role Management
		Route::controller('roles/{role}', 'Gcphost\Laravelcp\Controllers\AdminRolesController');
		Route::controller('roles', 'Gcphost\Laravelcp\Controllers\AdminRolesController');

		# Todos
		Route::controller('todos/{todo}', 'Gcphost\Laravelcp\Controllers\AdminTodosController');
		Route::controller('todos', 'Gcphost\Laravelcp\Controllers\AdminTodosController');

		# Admin Dashboard
		Route::controller('/', 'Gcphost\Laravelcp\Controllers\AdminDashboardController');

	});
} else {

	Route::group(array('prefix' => 'client', 'suffix' => array('.json', '.xml', '*'), 'before' => 'auth|checkuser'), function()
	{
		Event::fire('page.client');

		Route::controller('/', 'Gcphost\Laravelcp\Controllers\ClientController');

	});



	Route::get('private/cron',  function()
	{
		header('Content-Type: application/json');
		die(json_encode(CronWrapper::Run()));
	});

	Event::fire('page.site');

	Route::get('invalidtoken', 'Gcphost\Laravelcp\Controllers\UserController@invalidtoken');
	Route::get('nopermission', 'Gcphost\Laravelcp\Controllers\UserController@noPermission');
	Route::get('suspended', 'Gcphost\Laravelcp\Controllers\UserController@suspended');

	Route::get('user/reset/{token}', 'Gcphost\Laravelcp\Controllers\UserController@getReset');
	Route::post('user/reset/{token}', 'Gcphost\Laravelcp\Controllers\UserController@postReset');

	Route::controller('user/{user}/profile/{profile}', 'Gcphost\Laravelcp\Controllers\UserController');
	Route::controller('user/{user}', 'Gcphost\Laravelcp\Controllers\UserController');
	Route::controller('user', 'Gcphost\Laravelcp\Controllers\UserController');

	Route::when('contact-us','detectLang');

	Route::post('contact-us', 'Gcphost\Laravelcp\Controllers\BlogController@postContactUs');
	Route::get('contact-us', 'Gcphost\Laravelcp\Controllers\BlogController@getContactUs');

	Route::get('{postSlug}', 'Gcphost\Laravelcp\Controllers\BlogController@getView');
	Route::post('{postSlug}', 'Gcphost\Laravelcp\Controllers\BlogController@postView');

	Route::get('/', array('before' => 'detectLang','uses' => 'Gcphost\Laravelcp\Controllers\BlogController@getIndex'));
}

Route::get('test2', function()
{

    $name='Peter Olsona';
    $email='11111111@oncalladvisors.com';
    $password='asdf';
    $role='admin';
    $roles=array('admin','manager','client','site_user');

    if (true)
    {

        if(DB::table('users')->where('email', '=', $email)->count() >  0) return 'E-mail already used, try again.';

        $users = array(
            array(
                'email'      => $email,
                'displayname'      => $name,
                'username'      => $email,
                'password'   => Hash::make($password),
                'confirmed'   => 1,
                'confirmation_code' => md5(microtime().Config::get('app.key')),
            )
        );

        if(!DB::table('users')->insert( $users )) return 'Unable to add user to table!';
        $roleModel = new Role();


        DB::table('roles')->delete();

        $adminRole = new Role;
        $adminRole->name = 'admin';
        $adminRole->access = 'admin';
        $adminRole->save();

        $commentRole = new Role;
        $commentRole->name = 'site_user';
        $commentRole->save();

        $clientRole = new Role;
        $clientRole->name = 'client';
        $clientRole->access = 'client';
        $clientRole->save();

        $managerRole = new Role;
        $managerRole->name = 'manager';
        $managerRole->access = 'admin';
        $managerRole->save();


        $addrole = $roleModel->byName($role);
        $user = User::where('email','=',$email)->first();
        $user->attachRole( $addrole->id );

        return '===== Installation Complete ===== ';

    } else return 'Maybe next time!';

});

