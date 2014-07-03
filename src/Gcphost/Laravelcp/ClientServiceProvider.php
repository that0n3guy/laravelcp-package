<?php namespace Gcphost\Laravelcp;

use Illuminate\Support\ServiceProvider;

class ClientServiceProvider extends ServiceProvider {

	public function register()
	{
		$this->app->bind(
			'Gcphost\Laravelcp\Services\ClientService'
		);
	}
}
