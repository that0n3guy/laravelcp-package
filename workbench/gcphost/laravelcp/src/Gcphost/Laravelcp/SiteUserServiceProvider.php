<?php namespace Gcphost\Laravelcp;

use Illuminate\Support\ServiceProvider;

class SiteUserServiceProvider extends ServiceProvider {

	public function register()
	{
		$this->app->bind(
			'Gcphost\Laravelcp\SiteUser\SiteUserService'
		);
	}
}
