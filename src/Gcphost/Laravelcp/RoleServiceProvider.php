<?php namespace Gcphost\Laravelcp;

use Illuminate\Support\ServiceProvider;

class RoleServiceProvider extends ServiceProvider {

	public function register()
	{
		$this->app->bind(
			'Gcphost\Laravelcp\Repositories\RoleRepository',
			'Gcphost\Laravelcp\Repositories\EloquentRoleRepository',
			'Gcphost\Laravelcp\Services\RoleService'

		);
	}
}
