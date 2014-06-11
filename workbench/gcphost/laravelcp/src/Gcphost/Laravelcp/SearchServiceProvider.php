<?php namespace Gcphost\Laravelcp;

use Illuminate\Support\ServiceProvider;

class SearchServiceProvider extends ServiceProvider {

	public function register()
	{
		$this->app->bind(
			'Gcphost\Laravelcp\Search\SearchService'
		);
	}
}
