<?php namespace Gcphost\Laravelcp;

use Illuminate\Support\ServiceProvider;

class ProfileServiceProvider extends ServiceProvider {

	public function register()
	{
		$this->app->bind(
			'Gcphost\Laravelcp\Services\ProfileService'
		);
	}
}
