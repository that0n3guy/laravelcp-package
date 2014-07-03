<?php namespace Gcphost\Laravelcp;

use Illuminate\Support\ServiceProvider;

class BlogServiceProvider extends ServiceProvider {

	public function register()
	{
		$this->app->bind(
			'Gcphost\Laravelcp\Repositories\BlogRepository',
			'Gcphost\Laravelcp\Repositories\EloquentBlogRepository',
			'Gcphost\Laravelcp\Services\BlogService'
		);
	}
}
