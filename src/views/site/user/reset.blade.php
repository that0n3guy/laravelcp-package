@extends(Theme::path('site/layouts/default'))

@section('title')
{{{ Lang::get('Laravelcp::user/user.forgot_password') }}} ::
@parent
@stop

@section('content')
<div class="page-header">
	<h1>{{{ Lang::get('Laravelcp::user/user.forgot_password') }}}</h1>
</div>
{{ Confide::makeResetPasswordForm($token)->render() }}
@stop