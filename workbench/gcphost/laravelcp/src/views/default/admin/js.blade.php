	<script type="text/javascript">
		var lang_areyousure='{{ Lang::get('Laravelcp::site.areyousure') }}';
		var lang_unable_to_exec='{{ Lang::get('Laravelcp::core.unable_to_exec') }}';
		var lang_user_logged_in='{{ Lang::get('Laravelcp::core.user_logged_in') }}';
		var lang_success='{{ Lang::get('Laravelcp::core.success') }}';
	</script>
	<script src="{{{ asset('packages/gcphost/laravelcp/js/jquery.min.js') }}}"></script>
	<script src="{{{ asset('packages/gcphost/laravelcp/js/bootstrap.min.js') }}}"></script>
	<script src="{{{ asset('packages/gcphost/laravelcp/js/site.js') }}}"></script>
	<script type="text/javascript">
		$.fn.poller({'url':'{{{ URL::to("admin/polling") }}}'});
	</script>