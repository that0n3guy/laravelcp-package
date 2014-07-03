<h4>{{ Lang::get('Laravelcp::core.merge_users') }}</h4>
<hr/>
{{ Lang::get('Laravelcp::core.merge_from') }}
<ul class="list-group">
	<li class="list-group-item">{{{ $mergefrom }}}</li>
</ul>
<hr/>
{{ Lang::get('Laravelcp::core.merge_to') }}
<ul class="list-group">
	@foreach($mergelist as $email)
		<li  class="list-group-item">{{{ $email }}}</li>
	@endforeach
</ul>