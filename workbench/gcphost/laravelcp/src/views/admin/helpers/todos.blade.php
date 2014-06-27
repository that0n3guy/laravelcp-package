@include(Theme::path('admin/dt-loading'))

<div id="todos-container" class="dt-wrapper">
	<table id="todos" class="table table-responsive table-striped table-hover table-bordered">
		<thead>
			<tr>
				<th></th>
				<th>{{{ Lang::get('Laravelcp::table.title') }}}</th>
				<th>{{{ Lang::get('Laravelcp::table.status') }}}</th>
				<th>{{{ Lang::get('Laravelcp::table.description') }}}</th>
				<th>{{{ Lang::get('Laravelcp::table.created_at') }}}</th>
				<th>{{{ Lang::get('Laravelcp::core.due_at') }}}</th>
				<th>{{{ Lang::get('Laravelcp::core.assigned_to') }}}</th>
				<th style="width: 40px;">{{{ Lang::get('Laravelcp::table.actions') }}}</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>

<script src="{{{ asset('packages/gcphost/laravelcp/js/jquery.dataTables.min.js') }}}"></script>
<script src="{{{ asset('packages/gcphost/laravelcp/js/datatables.js') }}}"></script>

<script type="text/javascript">
	@if(isset($type) && $type == "widget")
		dtLoad('#todos', "{{URL::to('admin/todos/data') }}", '','', 'td:eq(2), th:eq(2),td:eq(4), th:eq(4),td:eq(6), th:eq(6),td:eq(7), th:eq(7), td:eq(5), th:eq(5)', 'false', 'true',[null,null,null,null,null,null,null,{ "bSortable": false }]);
	@else
		dtLoad('#todos', "{{URL::to('admin/todos/data') }}", 'td:eq(2), th:eq(2)', 'td:eq(1), th:eq(1),td:eq(4), th:eq(4)','', 'false', 'true',[null,null,null,null,null,null,null,{ "bSortable": false }]);
	@endif
</script>