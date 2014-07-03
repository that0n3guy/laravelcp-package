<?php namespace Gcphost\Laravelcp;

use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider {

	public function register()
	{
		$this->app->bind(
			'Gcphost\Laravelcp\Repositories\UserRepository',
			'Gcphost\Laravelcp\Repositories\EloquentUserRepository',
			'Gcphost\Laravelcp\Services\UserService'
		);
	}
}
