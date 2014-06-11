@extends(Theme::path('admin/layouts/modal'))

@section('title')
	{{{ $title }}}
@stop

@section('styles')
	<style type="text/css"> 
		#editor {
			height: 200px;
			overflow: auto;
		}
	</style>
@stop

@section('scripts')
	<script type="text/javascript">
		$('.template-dropdown a').on('click', function(e){
			e.preventDefault();   
			$('#email-template').val($(this).attr('href'));
			$('.email-template-tag').html($(this).html());
		});
	</script>
@stop


@section('content')

	@if ($message = Session::get('success'))
	<script type="text/javascript">
		closeModel();
	</script>
	@else


@if (isset($user))
	{{ Form::open_horizontal(array('url' => array('admin/users/' . $user->id . '/email'), 'files'=>true,'class' => 'form-ajax', 'onsubmit' => "$('#wysiwyg-body').html($('#editor').html());")) }}
@else
	{{ Form::open_horizontal(array('url' => array('admin/user/mass/email'), 'files'=>true,'class' => 'form-ajax', 'onsubmit' => "$('#wysiwyg-body').html($('#editor').html());")) }}
@endif

	@if(isset($multi) && count($multi) > 0)
		{{ Form::select_group('to[]', '', $multi, $selected, $errors,array('multiple'=>'multiple','required'=>'required', 'style'=>'width: 100%; height: 40px;'), '',false) }} 	
	@endif

	{{ Form::input_group('text', 'subject', '', '', $errors, array('maxlength'=>'256','required'=>'required', 'placeholder'=>Lang::get('Laravelcp::core.subject')), '', false) }} 

	<div class="form-group">
		<div class="col-md-12">
			@include(Theme::path('wysiwyg'))
		</div>
	</div>
	<div class="modal-footer">
			<div class="pull-left">
				{{ Form::reset(Lang::get('Laravelcp::button.cancel'), array('class' => 'btn btn-responsive btn-danger', 'onclick'=>"$('#site-modal').modal('hide')")) }} &nbsp;
				{{ Form::reset(Lang::get('Laravelcp::button.reset'), array('class' => 'btn btn-responsive btn-default')) }} 
			</div>

			<div class="pull-right">
					<div class="btn btn-responsive btn-default btn-file">
					   <span class="fa fa-lg fa-paperclip"> </span> <input type="file" name="email_attachment" multiple>
					</div>
					<div class="btn-group dropup">
						<button type="button" class="btn-responsive btn btn-default dropdown-toggle" data-toggle="dropdown">
							<span class="email-template-tag">Template</span>
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu template-dropdown">
							<li><a href="emails.default">Default</a></li>
							@foreach($templates as $id=>$var)
								@if($var->getFilename() != 'default.blade.php')
									<li>
										<a href="emails.{{{ str_replace(DIRECTORY_SEPARATOR, '.',preg_replace('/.blade.php/i', '',$var->getRelativePathname())) }}}">{{{ str_replace(DIRECTORY_SEPARATOR, '.',rtrim($var->getRelativePathname(),'.blade.php')) }}}</a>
									</li>
								@endif
							@endforeach
						</ul>
					</div>
				{{ Form::submit(Lang::get('Laravelcp::button.send'), array('class' => 'btn-responsive btn btn-success')) }} 
			</div>

			<input type="hidden" id="email-template" name="template" value="emails.default"/>
			<textarea class="hide" id="wysiwyg-body" name="body"></textarea>
	</div>
	<script type="text/javascript">
		initToolbarBootstrapBindings();  
		$('#editor').wysiwyg({ fileUploadError: showErrorAlert, hotKeys: {}} );
	</script>

	{{ Form::close() }}
	@endif
@stop