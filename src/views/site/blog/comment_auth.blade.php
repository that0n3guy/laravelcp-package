	<div class="alert alert-danger alert-block">
		<p>{{{ Lang::get('Laravelcp::site.login_to_comment') }}}</p>
		<p>{{ Lang::get('Laravelcp::site.comment_login', array('login' => URL::to('user/login'), 'create' => URL::to('user/create'))) }}</p>
	</div>
