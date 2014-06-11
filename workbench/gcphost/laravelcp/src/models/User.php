<?php namespace Gcphost\Laravelcp;

use Zizaco\Confide\ConfideUser;
use Zizaco\Confide\Confide;
use Zizaco\Confide\ConfideEloquentRepository;
use Zizaco\Entrust\HasRole;
use Carbon\Carbon;



class User extends ConfideUser {
    use HasRole;

	protected $table = 'users';

	public static $rules = array(
        'displayname' => 'required|min:4|max:70',
		'email' => 'unique:users|required|email|max:254',
        'password' => 'min:4|confirmed',
        'password_confirmation' => 'min:4',
    );

	public function profiles()
    {
        return $this->hasMany('Gcphost\Laravelcp\UserProfile');
    }

	public function notes()
    {
        return $this->hasMany('Gcphost\Laravelcp\UserNotes');
    }

	public function assignedroles()
    {
        return $this->hasMany('Gcphost\Laravelcp\AssignedRole');
    }
	public function posts()
    {
        return $this->hasMany('Gcphost\Laravelcp\Post');
    }

	public function deleteProfile($profile){
		$id=$profile->id;
		if(!$profile->delete()) return false;
		$profile=UserProfile::find($id);
        return empty($profile);
	}

    public function delete()
    {
        if ($this->id === $this->currentUser()->id)
        {
            return false;
        }

		$id=$this->id;

		Activity::log(array(
			'contentID'   => $this->id,
			'contentType' => 'account_deleted',
			'description' => $this->id,
			'details'     => '',
			'updated'     => $this->currentUser()->id ? true : false,
		));

		Event::fire('controller.user.delete', array($this));
       
		if(! parent::delete()) return false;
		return !$this->find($id) ? true : false;
    } 

	public function emails()
    {
		return Activity::whereRaw('user_id = ? AND content_type="email"', array($this->id))->select(array('user_id','description', 'details','ip_address', 'updated_at'))->orderBy('id', 'DESC');
	}

	public function lastlogin(){
		return Activity::whereRaw('user_id = ? AND content_type="login"', array($this->id))->select(array('details'))->orderBy('id', 'DESC')->first();

	}

	public function activity()
    {
		return Activity::whereRaw('user_id = ? AND content_type="activity"', array($this->id))->select(array('user_id','description', 'details','ip_address', 'updated_at'))->orderBy('id', 'DESC');
	}

	public function getnotes(){
		return UserNotes::leftjoin('users', 'users.id', '=', 'user_notes.admin_id')
					->select(array('user_notes.id', 'user_notes.note', 'user_notes.created_at', 'user_notes.updated_at', 'users.displayname'))->where('user_notes.user_id','=',$this->id)->orderBy('users.id');
	}

	public function merge($user){
		DB::update('UPDATE user_profiles set user_id = ? where user_id = ?', array($this->id, $user->id));
		DB::update('UPDATE posts set user_id = ? where user_id = ?', array($this->id, $user->id));
		DB::update('UPDATE comments set user_id = ? where user_id = ?', array($this->id, $user->id));
		DB::update('UPDATE activity_log set user_id = ? where user_id = ?', array($this->id, $user->id));
		DB::table('assigned_roles')->where('user_id', '=', $this->id)->delete();

		Event::fire('controller.user.merge', array($user));

		return $user->delete();
	}

    public function joined()
    {
        return String::date(Carbon::createFromFormat('Y-n-j G:i:s', $this->created_at));
    }

    public function saveRoles($inputRoles)
    {
        if(! empty($inputRoles)) {
            $this->roles()->sync($inputRoles);
        } else {
            $this->roles()->detach();
        }
    }

    public function saveProfiles($inputProfile)
    {
        if(! empty($inputProfile)) {
            $this->profiles()->sync($inputProfile);
        } else {
            $this->profiles()->detach();
        }
    }

	public function currentRoleIds()
    {
        $roles = $this->roles;
        $roleIds = false;
        if( !empty( $roles ) ) {
            $roleIds = array();
            foreach( $roles as &$role )
            {
                $roleIds[] = $role->id;
            }
        }
        return $roleIds;
    }

    public function currentUser()
    {
        return (new Confide(new ConfideEloquentRepository()))->user();
    }

	public function chart(){
		$chart = Lava::DataTable('activeusers');
		$chart->addColumn('string', 'Active', 'active');
		$chart->addColumn('string', 'Inactive', 'inactive');

		$chart->addRow(array('Active',DB::table('users')->where('confirmed', '=', '1')->count()));
		$chart->addRow(array('In-active',DB::table('users')->where('confirmed', '!=', '1')->count()));

		Lava::PieChart('activeusers')->addOption(array('chartArea' => array('width'=>'98%', 'height'=>'98%')))->addOption(array('backgroundColor' => 'none'))->addOption(array('is3D' => 'true'))->addOption(array('legend' => 'none'));
	}
	
	public function runCancel($job, $data){
		Event::fire('user.cancel', array($data));
		User::where('id', $data['id'])->update(array('confirmed' => false, 'cancelled' => true));
	}

	public function cancel($token){
		switch($token){
			case 'now':
				$this->runCancel('', array('id' => $this->id));
			break;
			case 'later':
				$date = Carbon::now()->addMinutes(15);
				Queue::later($date, 'UserController@runCancel', array('id' => $this->id));
			break;
			case 'tomorrow':
				$date = Carbon::tomorrow();
				Queue::later($date, 'UserController@runCancel', array('id' => $this->id));
			break;
			case 'disable':
				if($this->cancelled) DB::table('users')->where('id', $this->id)->update(array('confirmed' => true, 'cancelled' => false));
			break;
		}

		Activity::log(array(
			'contentID'   => $this->id,
			'contentType' => 'account_cancelled',
			'description' => $this->id,
			'details'     => '',
			'updated'     => $this->id,
		));
	}
}