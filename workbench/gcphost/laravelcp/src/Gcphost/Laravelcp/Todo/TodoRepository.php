<?php namespace Gcphost\Laravelcp\Todo;

interface TodoRepository
{

	public function all();
	public function find($id, $columns = array('*'));
	public function delete($id);
}