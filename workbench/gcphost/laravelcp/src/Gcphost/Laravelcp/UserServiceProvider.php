<?php namespace Gcphost\Laravelcp;

use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider {

	public function register()
	{
		$this->app->bind(
			'Gcphost\Laravelcp\User\UserRepository',
			'Gcphost\Laravelcp\User\EloquentUserRepository',
			'Gcphost\Laravelcp\User\UserService'
		);
	}
}
