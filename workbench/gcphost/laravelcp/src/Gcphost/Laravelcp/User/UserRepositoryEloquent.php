<?php namespace Gcphost\Laravelcp\User;

use Setting,Redirect,Session,Event,Activity,Auth,Confide,UserNotes,Input, DB;
use Gcphost\Laravelcp\User;

class EloquentUserRepository implements UserRepository
{
	public $modelClassName="User";
	public $id;
	public $user;

	public function __construct(User $user)
    {
        $this->user = $user;
    }

	public function createOrUpdate($id = null)
    {
        if(is_null($id)) {
            $user = new User;
			$user->displayname = Input::get( 'displayname' );
			$user->email = Input::get( 'email' );
			$user->password = Input::get( 'password' );
			$user->password_confirmation = Input::get( 'password_confirmation' );
			$user->confirmed = Input::get( 'confirm' );
			$user->updateUniques();

			if ( $user->id )
			{
				$this->id=$user->id;
				$user->saveRoles(Input::get( 'roles' ));
				$pro=Input::get('user_profiles');
				$profile = new UserProfile($pro['new']);
				$user = $user->find($user->id);
				$user->profiles()->save($profile);
			} 
			return $user;
        } else {
			$user = User::find($id);
			$oldUser = clone $user;
            $user->displayname = Input::get( 'displayname' );
            $user->email = Input::get( 'email' );
            $user->confirmed = Input::get( 'confirm' );
            
            $user->prepareRules($oldUser, $user);

			if($user->confirmed == null) $user->confirmed = $oldUser->confirmed;
            $pw=Input::get( 'password' );
            if(!empty($pw)) {
				$user->password = Input::get( 'password' );
				$user->password_confirmation = Input::get( 'password_confirmation' );
            } else {
                unset($user->password);
                unset($user->password_confirmation);
            }

            if(!$user->updateUniques()) return $user;

            $user->saveRoles(Input::get( 'roles' ));

			foreach(Input::get('user_profiles') as $id=>$profile){
				$pro = UserProfile::find($id);
				if(!empty($pro)){
					$pro->fill($profile)->push();
				} else {
					$pro = new UserProfile($profile);
					if($pro->title) $user->profiles()->save($pro);
				}
			}
			
			$notes=array_merge(array(Input::get('new_note')),(is_array(Input::get('user_notes')) ? Input::get('user_notes') : array()));
			foreach($notes as $id=>$note){
				$not = UserNotes::find($id);
				if(!empty($not)){
					if($note){
						$not->fill(array('id'=>$id,'note'=>$note))->push();
					} else $not->delete();
				} elseif($note) {
					
					$not = new UserNotes(array('id'=>$id,'note'=>$note, 'admin_id' =>Confide::user()->id));
					$user->notes()->save($not);
				}
			}
			
			Event::fire('controller.user.create', array($this->user));
			Activity::log(array(
				'contentID'   => $this->user->id,
				'contentType' => 'account_created',
				'description' => $this->user->id,
				'details'     => 'account_created',
				'updated'     => Confide::user()->id ? true : false,
			));


			return $user;
        }
    }

	public function publicCreateOrUpdate($id = null)
    {
        if(is_null($id)) {
            $user = new User;
			$user->displayname = Input::get( 'displayname' );
			$user->email = Input::get( 'email' );
			$user->password = Input::get( 'password' );
			$user->password_confirmation = Input::get( 'password_confirmation' );
			$user->updateUniques();

			if ( $user->id )
			{
				$this->id=$user->id;
				$user->saveRoles(array(Setting::get('users.default_role_id')));
			} 

			Activity::log(array(
				'contentID'   => $user->id,
				'contentType' => 'account_created',
				'description' => $user->id,
				'details'     => 'Created from site',
				'updated'     => false,
			));

			Event::fire('user.create', array($user));

			return $user;
        } else {
			$user = User::find($id);
			$oldUser = clone $user;
            $user->displayname = Input::get( 'displayname' );
            $user->email = Input::get( 'email' );
            
            $user->prepareRules($oldUser, $user);

            $pw=Input::get( 'password' );
            if(!empty($pw)) {
				$user->password = Input::get( 'password' );
				$user->password_confirmation = Input::get( 'password_confirmation' );
            } else {
                unset($user->password);
                unset($user->password_confirmation);
            }

            if(!$user->updateUniques()) return $user;

			foreach(Input::get('user_profiles') as $id=>$profile){
				$pro = UserProfile::find($id);
				if(!empty($pro)){
					$pro->fill($profile)->push();
				} else {
					$pro = new UserProfile($profile);
					if($pro->title) $user->profiles()->save($pro);
				}
			}
			
			Event::fire('user.edit', array($user));

			return $user;
        }
	}

	public function all($type=null){
		$results=User::leftjoin('assigned_roles', 'assigned_roles.user_id', '=', 'users.id')
                    ->leftjoin('roles', 'roles.id', '=', 'assigned_roles.role_id')
                    ->select('users.id', 'users.displayname','users.email', DB::raw('group_concat(roles.name SEPARATOR \', \') as rolename'))
					->groupBy('users.id' , 'users.displayname' , 'users.email');
		if($type === false || $type == true) $results->where('roles.name', $type ? '=' : '!=', 'admin');

		return $results;
	}

	public function find($id, $columns = array('*'))
	{
		return User::find($id);
	}
	
	public function delete($id)
	{
		return User::delete($id);
	}


	public function __call($method, $args)
    {
        return call_user_func_array([$this->user, $method], $args);
    }


	public function clients($query=false, $limit='10', $page='0', $id=false, $admins=null){
		$users=self::all($admins)->select(DB::raw('users.displayname as text'),'users.id');
		if($query) $users->where('displayname', 'LIKE', '%'.$query.'%');
		if($id){
			if(preg_match('/,/s', $id)) return $users->whereIn('users.id', explode(',',$id))->get();
			return $users->where('users.id', '=', $id)->first();
		}
		return $users->paginate($limit);
	}

}