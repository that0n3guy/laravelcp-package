<?php namespace Gcphost\Laravelcp;

use Illuminate\Support\ServiceProvider;

class BlogServiceProvider extends ServiceProvider {

	public function register()
	{
		$this->app->bind(
			'Gcphost\Laravelcp\Blog\BlogRepository',
			'Gcphost\Laravelcp\Blog\EloquentBlogRepository',
			'Gcphost\Laravelcp\Blog\BlogService'
		);
	}
}
