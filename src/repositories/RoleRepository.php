<?php namespace Gcphost\Laravelcp\Repositories;

interface RoleRepository
{

	public function all();
	public function find($id, $columns = array('*'));
	public function delete($id);
}