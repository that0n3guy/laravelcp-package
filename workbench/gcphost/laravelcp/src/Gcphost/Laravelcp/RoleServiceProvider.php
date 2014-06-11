<?php namespace Gcphost\Laravelcp;

use Illuminate\Support\ServiceProvider;

class RoleServiceProvider extends ServiceProvider {

	public function register()
	{
		$this->app->bind(
			'Gcphost\Laravelcp\Role\RoleRepository',
			'Gcphost\Laravelcp\Role\EloquentRoleRepository',
			'Gcphost\Laravelcp\Role\RoleService'

		);
	}
}
