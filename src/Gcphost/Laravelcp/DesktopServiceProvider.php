<?php namespace Gcphost\Laravelcp;

use Illuminate\Support\ServiceProvider;

class DesktopServiceProvider extends ServiceProvider {

	public function register()
	{
		$this->app->bind(
			'Gcphost\Laravelcp\Services\DesktopService'
		);
	}
}
