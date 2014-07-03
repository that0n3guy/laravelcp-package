@extends(Theme::path('site/layouts/default'))

@section('title')
{{{ Lang::get('Laravelcp::site.permission_denied') }}} ::
@parent
@stop
@section('content')
<div class="page-header">
	<h3>{{{ Lang::get('Laravelcp::site.no_permission') }}}</h3>
</div>
{{ Lang::get('Laravelcp::site.login_link', array('link' => URL::to('user/login'))) }}
@stop
