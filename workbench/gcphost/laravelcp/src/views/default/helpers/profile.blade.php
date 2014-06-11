{{ Form::input_group('text', 'user_profiles['. ( isset($profile) ? $profile->id : 'new' ).'][title]', 
	Lang::get('Laravelcp::admin/users/profile.Profile_Name'), isset($profile) ? $profile->title : null, $errors, array('maxlength'=>'70')) }} 

{{ Form::input_group('text', 'user_profiles['. ( isset($profile) ? $profile->id : 'new' ).'][displayname]', 
	Lang::get('Laravelcp::admin/users/profile.Full_Name'), isset($profile) ? $profile->displayname : null, $errors, array('maxlength'=>'70')) }} 

{{ Form::input_group('text', 'user_profiles['. ( isset($profile) ? $profile->id : 'new' ).'][address]', 
	Lang::get('Laravelcp::admin/users/profile.address'), isset($profile) ? $profile->address : null, $errors, array('maxlength'=>'254')) }} 

{{ Form::input_group('text', 'user_profiles['. ( isset($profile) ? $profile->id : 'new' ).'][city]', 
	Lang::get('Laravelcp::admin/users/profile.city'), isset($profile) ? $profile->city : null, $errors, array('maxlength'=>'254')) }} 

{{ Form::input_group('text', 'user_profiles['. ( isset($profile) ? $profile->id : 'new' ).'][state]', 
	Lang::get('Laravelcp::admin/users/profile.state'), isset($profile) ? $profile->state : null, $errors, array('maxlength'=>'254')) }} 

{{ Form::input_group('text', 'user_profiles['. ( isset($profile) ? $profile->id : 'new' ).'][zip]', 
	Lang::get('Laravelcp::admin/users/profile.zip'), isset($profile) ? $profile->zip : null, $errors, array('maxlength'=>'254')) }} 

{{ Form::input_group('text', 'user_profiles['. ( isset($profile) ? $profile->id : 'new' ).'][country]', 
	Lang::get('Laravelcp::admin/users/profile.country'), isset($profile) ? $profile->country : null, $errors, array('maxlength'=>'254')) }} 

{{ Form::input_group('text', 'user_profiles['. ( isset($profile) ? $profile->id : 'new' ).'][phone]', 
	Lang::get('Laravelcp::admin/users/profile.phone'), isset($profile) ? $profile->phone : null, $errors, array('maxlength'=>'70')) }} 

{{ Form::input_group('text', 'user_profiles['. ( isset($profile) ? $profile->id : 'new' ).'][mobile]', 
	Lang::get('Laravelcp::admin/users/profile.mobile'), isset($profile) ? $profile->mobile : null, $errors, array('maxlength'=>'70')) }} 

{{ Form::input_group('text', 'user_profiles['. ( isset($profile) ? $profile->id : 'new' ).'][taxcode]', 
	Lang::get('Laravelcp::admin/users/profile.taxcode'), isset($profile) ? $profile->taxcode : null, $errors, array('maxlength'=>'70')) }} 

{{ Form::input_group('text', 'user_profiles['. ( isset($profile) ? $profile->id : 'new' ).'][website]', 
	Lang::get('Laravelcp::admin/users/profile.website'), isset($profile) ? $profile->website : null, $errors, array('maxlength'=>'254')) }} 
