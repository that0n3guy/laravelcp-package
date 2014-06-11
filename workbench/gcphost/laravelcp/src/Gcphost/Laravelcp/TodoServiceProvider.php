<?php namespace Gcphost\Laravelcp;

use Illuminate\Support\ServiceProvider;

class TodoServiceProvider extends ServiceProvider {

	public function register()
	{
		$this->app->bind(
			'Gcphost\Laravelcp\Todo\TodoRepository',
			'Gcphost\Laravelcp\Todo\EloquentTodoRepository',
			'Gcphost\Laravelcp\Todo\TodoService'
		);
	}
}
