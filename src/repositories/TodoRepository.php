<?php namespace Gcphost\Laravelcp\Repositories;

interface TodoRepository
{

	public function all();
	public function find($id, $columns = array('*'));
	public function delete($id);
}