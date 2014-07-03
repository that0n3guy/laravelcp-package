<?php namespace Gcphost\Laravelcp\Services;

use Gcphost\Laravelcp\Repositories\UserRepository as User;
use Gcphost\Laravelcp\Repositories\RoleRepository as Role;
use Gcphost\Laravelcp\Helpers\Api;
use Lang, Permission;

// @todo I don't know if these should link to user repositories or to use models.

class ProfileService {
	protected $user;
    protected $role;
    protected $permission;
	private $email;

	public function __construct(User $user, Role $role, Permission $permission)
    {
        $this->user = $user;
        $this->role = $role;
        $this->permission = $permission;

    }

    public function delete($user, $profile)
    {
		return $this->user->deleteProfile($profile) ? Api::json(array('result'=>'success')) : Api::json(array('result'=>'error', 'error' =>Lang::get('Laravelcp::core.delete_error')));
	}

}