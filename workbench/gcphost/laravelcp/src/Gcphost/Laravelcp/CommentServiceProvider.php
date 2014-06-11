<?php namespace Gcphost\Laravelcp;

use Illuminate\Support\ServiceProvider;

class CommentServiceProvider extends ServiceProvider {

	public function register()
	{
		$this->app->bind(
			'Gcphost\Laravelcp\Comment\CommentRepository',
			'Gcphost\Laravelcp\Comment\EloquentCommentRepository',
			'Gcphost\Laravelcp\Comment\CommentService'
		);
	}
}
