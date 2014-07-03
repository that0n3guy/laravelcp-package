<?php namespace Gcphost\Laravelcp\Services;

use Setting, Redirect, Lang, Input;
use Gcphost\Laravelcp\Helpers\Api;
use Gcphost\Laravelcp\Helpers\Theme;

class SettingService {
	public function index()
    {
		$settings=Setting::all();
        return Theme::make('admin/settings/index', compact('comments', 'settings'));
    }
   
	public function post()
	{
		$settings = Input::get('settings');
		if(isset($settings) && is_array($settings))
		{
			foreach($settings as $var => $val) Setting::set($var, $val);
			Setting::save();
		}

		return Api::to(array('success', Lang::get('Laravelcp::admin/settings/messages.update.success'))) ? : Redirect::to('admin/settings')->with('success', Lang::get('Laravelcp::admin/settings/messages.update.success'));
	}
}