<?php namespace Gcphost\Laravelcp;

use Illuminate\Support\ServiceProvider;

class CommentServiceProvider extends ServiceProvider {

	public function register()
	{
		$this->app->bind(
			'Gcphost\Laravelcp\Repositories\CommentRepository',
			'Gcphost\Laravelcp\Repositories\EloquentCommentRepository',
			'Gcphost\Laravelcp\Services\CommentService'
		);
	}
}
