<?php namespace Gcphost\Laravelcp;

use Illuminate\Support\ServiceProvider;

class EmailServiceProvider extends ServiceProvider {

	public function register()
	{
		$this->app->bind(
			'Gcphost\Laravelcp\Email\EmailService'
		);
	}
}
