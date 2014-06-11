<?php namespace Gcphost\Laravelcp;

use Illuminate\Support\ServiceProvider;

class SiteBlogServiceProvider extends ServiceProvider {

	public function register()
	{
		$this->app->bind(
			'Gcphost\Laravelcp\SiteBlog\SiteBlogService'
		);
	}
}
