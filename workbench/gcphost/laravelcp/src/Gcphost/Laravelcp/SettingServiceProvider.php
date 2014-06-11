<?php namespace Gcphost\Laravelcp;

use Illuminate\Support\ServiceProvider;

class SettingServiceProvider extends ServiceProvider {

	public function register()
	{
		$this->app->bind(
			'Gcphost\Laravelcp\Setting\SettingService'
		);
	}
}
