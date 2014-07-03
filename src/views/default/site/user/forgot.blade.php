@extends(Theme::path('site/layouts/default'))

{{-- Web site Title --}}
@section('title')
{{{ Lang::get('Laravelcp::user/user.forgot_password') }}} ::
@parent
@stop

{{-- Content --}}
@section('content')
<div class="page-header">
    <h1>{{{ Lang::get('Laravelcp::user/user.forgot_password') }}}</h1>
</div>
{{ Confide::makeForgotPasswordForm() }}
@stop
