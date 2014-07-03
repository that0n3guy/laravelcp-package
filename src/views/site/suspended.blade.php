@extends(Theme::path('site/layouts/default'))

@section('title')
{{{ Lang::get('Laravelcp::site.permission_denied') }}} ::
@parent
@stop
@section('content')
<div class="page-header">
	<h3>{{{ Lang::get('Laravelcp::site.no_longer_active') }}}</h3>
</div>
{{{ Lang::get('Laravelcp::site.no_longer_active_reason') }}}
@stop
