<?php namespace Gcphost\Laravelcp;

use Illuminate\Support\ServiceProvider;

class TodoServiceProvider extends ServiceProvider {

	public function register()
	{
		$this->app->bind(
			'Gcphost\Laravelcp\Repositories\TodoRepository',
			'Gcphost\Laravelcp\Repositories\EloquentTodoRepository',
			'Gcphost\Laravelcp\Services\TodoService'
		);
	}
}
