@extends('layouts/master')

@section('content')

<div class="main">
	<div class="main-content">
		<div class="container-fluid">
					<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title">
								{{  __('document.edit') }}
							</h3>
						</div>

						<div class="panel-body">

							<form action="/document/update/{{$edit -> id}}" method="post" enctype="multipart/form-data">
								{{csrf_field()}}
							
								<div class="form-group">
									<label for="job_number">{{  __('document.job_number') }} : </label>
									<input type="text" name="job_number" class="form-control" value="{{ $edit -> job_number }}">

									@if($errors -> has('job_number'))
									<div class="text-danger">
										{{ $errors -> first('job_number') }}
									</div>
									@endif
								</div>
								<br>

								<div class="form-group">
									<label for="contains" >{{  __('document.contains') }} :</label>

									<select class="form-control" name="contain[]" id="js-tokenizer" multiple="multiple">
										@foreach($allContains as $key => $value)
											<option value="{{$value->id}}" {{in_array($value->id , $assignedContains) ? 'selected' : ''}}>{{$value->name}}</option>
										@endforeach
									</select>

									@if($errors -> has('contain'))
									<div class="text-danger">
										{{ $errors -> first('contain') }}
									</div>
									@endif
								</div>
								<br>

								<div class="form-group">
									<label for="date">{{  __('document.date') }} :</label>
									<div class='input-group date' id="datetimepicker1">
										<input type="text" name="date" class="form-control" value="{{ $edit -> date }}">

										@if($errors -> has('date'))
										<div class="text-danger">
											{{ $errors -> first('date') }}
										</div>
										@endif
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-calendar"></span>
										</span>
									</div>
								</div>
								<br>

								<div class="form-group">
									<label for="box_id">{{ __('document.box_number') }} : </label>
									<select name="box_id" id="boxInput" class="boxInput form-control">
										@foreach($edit_box as $key => $value)
										<option value="{{ $value -> id }}" @if($value->id == $edit -> box_id) ? selected="selected" @endif

											>{{ 'Box [ '.$value->box_number.' ] / Rack [ '.$value->rack->rack_number.' ] / Division [ '.$value->rack->division->name.' ]' }}</option>
										@endforeach
									</select>

									@if($errors -> has('box_id'))
									<div class="text-danger">
										{{ $errors -> first('box_id') }}
									</div>
									@endif
								</div>
								<br>

								<div class="form-group">
									<label for="description">{{  __('document.description') }} : </label>
									<textarea class="form-control" name="description" rows="4"> {{ $edit -> description }}
									</textarea>

									@if($errors -> has('description'))
									{{ $errors -> first('description') }}
									@endif
								</div>
								<div class="form-group">
									<!-- <label>User Edit Document : </label> -->
									<input type="hidden" name="user_id" class="form-control" value="{{ $edit->user->id }}" readonly="true">
								</div>
								<br>
								
								<ul>
									
							
								@foreach($edit->file()->get() as $file)
									<li><a href="/data_file/{{ $file->filename}}" style="margin-right: 50px;">{{$file->filename}}</a><a href="/document/delete_file/{{$file->id}}"><label class="label label-danger">{{ __('document.delete_file')}}</label></a></li>

								@endforeach
								</ul>
							


						<div class="input-group control-group increment form-group" >
					
							<div class="custom-file" >
							
							<input type="file" name="filename[]"  class="custom-file-input" multiple="true" >
								
							</div>			
							 
							<div class="input-group-btn"> 
							  <button class="btn btn-success btn-xs" type="button"><i class="glyphicon glyphicon-plus"></i>  {{ __('document.add_file')}}</button>
							</div>
						  
							@if($errors -> has('filename'))
							<div class="text-danger">
								<strong>Whoops!</strong> There were some problems with your input.<br>
								{{ $errors -> first('filename') }}
							</div>
							@endif
						</div>
						<div class="clone hide">
							<div class="control-group input-group" style="margin-top:10px">
								<div class="custom-file">
									<input type="file" name="filename[]" class="custom-file-input" multiple>
								</div>
								
								
								<div class="input-group-btn"> 
									<button class="btn btn-danger btn-xs" type="button"><i class="
									glyphicon glyphicon-remove"></i>  {{ __('document.delete_file')}}</button>
								</div>
							</div>
							
						</div>

						<br>

								<input class="btn btn-primary" type="submit" value="Update">

							</form>

						</div>
					</div>
		</div>
	</div>
</div>

@endsection

@section('js')

<script type="text/javascript">
	// CSRF Token
	var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
	// console.log(CSRF_TOKEN)
	$(document).ready(function() {

		$("#boxInput").select2({
			ajax: {
				url: "{{route('document.boxSearch')}}",
				type: "post",
				dataType: 'json',
				delay: 250,
				data: function(params) {
					return {
						_token: CSRF_TOKEN,
						box: params.term // search term
					};
				},
				processResults: function(response) {
					return {
						results: response
					};
				},
				cache: true
			}

		});

		$('#datetimepicker1').datetimepicker({
			format: "YYYY/MM/DD"
		});

		$('#js-tokenizer').select2({
			tags : true,
			tokenSeparators : [',','']
		});

		$(".btn-success").click(function(){
			var html = $(".clone").html();
			$(".increment").after(html);
		});

		$("body").on("click",".btn-danger",function(){
			$(this).parents(".control-group").remove();
		});

	


	});

</script>


@endsection