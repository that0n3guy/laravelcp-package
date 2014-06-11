<?php namespace Gcphost\Laravelcp;

use Illuminate\Support\ServiceProvider;

class MergeServiceProvider extends ServiceProvider {

	public function register()
	{
		$this->app->bind(
			'Gcphost\Laravelcp\Merge\MergeService'
		);
	}
}
