<?php namespace Gcphost\Laravelcp\Services;

use Gcphost\Laravelcp\Repositories\UserRepository as User;
use Gcphost\Laravelcp\Helpers\Theme;

class ClientService {
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

	
    public function index()
    {
        list($user,$redirect) = $this->user->checkAuthAndRedirect('user');
        if($redirect) return $redirect;
		$profiles=$user->profiles;

        return Theme::make('site/user/index', compact('user', 'profiles'));
    }

}