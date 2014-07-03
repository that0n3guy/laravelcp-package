@extends(Theme::path('admin/layouts/default'))

@section('title')
	{{{ Lang::get('Laravelcp::core.todos') }}} :: @parent
@stop

@section('left-layout-nav')
	@include(Theme::path('admin/navigation/todos'))
@stop

@section('left-layout-content')



	<div class="page-header clearfix">		
		<div class="pull-left"><h3>{{{ Lang::get('Laravelcp::core.todos') }}}</h3></div>
		<div class="pull-right">
			<a href="{{{ URL::to('admin/todos/create') }}}" class="btn btn-info modalfy"><span class="fa fa-plus"></span> {{{ Lang::get('Laravelcp::button.create') }}}</a>
		</div>
	</div>

	@include(Theme::path('admin/helpers/todos'))
@stop
@include(Theme::path('admin/layouts/sidebar-left'))

@section('head-scripts')
	<script src="{{{ asset('packages/gcphost/laravelcp/js/moment.min.js') }}}"></script>
	<script src="{{{ asset('packages/gcphost/laravelcp/js/bootstrap-datetimepicker.min.js') }}}"></script>
@stop

@section('styles')
	<link rel="stylesheet" href="{{{ asset('packages/gcphost/laravelcp/css/bootstrap-datetimepicker.min.css') }}}"/>
@stop