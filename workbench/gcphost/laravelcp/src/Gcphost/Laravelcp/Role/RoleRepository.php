<?php namespace Gcphost\Laravelcp\Role;

interface RoleRepository
{

	public function all();
	public function find($id, $columns = array('*'));
	public function delete($id);
}