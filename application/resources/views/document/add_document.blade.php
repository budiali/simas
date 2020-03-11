@extends('layouts/master')

@section('content')

<div class="main">
	<div class="main-content">
		<div class="container-fluid">
			
					<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title">{{ __('master.create_new_document') }}</h3>
						</div>
						<div class="panel-body">
							<form action="/document/store" method="post" enctype="multipart/form-data">
								{{csrf_field()}}
						<div class="form-group">
							<label>{{ __('document.job_number') }} : </label>
							<input type="text" class="form-control" name="job_number">
							@if($errors -> has('job_number'))
							<div class="text-danger">
								{{ $errors -> first('job_number') }}
							</div>
							@endif
						</div>
						<strong>{{ __('document.contains') }} :</strong>
						<div class="form-group">
							{{-- @foreach($contains as $key => $value)
							<label class="checkbox-inline" for="inlineCheckbox{{$value -> id}}">
								<input class="form-check-input" type="checkbox" name="contain[]" value="{{$value -> id}}" id="inlineCheckbox{{$value -> id}}">{{$value -> name}}
							</label>
							@endforeach --}}
							<select class="form-control" name="contain[]" id="js-tokenizer" multiple="multiple">
								@foreach($contains as $key => $value)
							<option value="{{$value->id}}">{{$value->name}}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<label>{{ __('document.date') }} : </label>
							<div class='input-group date' id='datetimepicker1'>
								<input type="text" name="date" class="form-control">
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
						<div class="form-group">
							<label>{{ __('document.box_number') }} : </label>
							<select class="boxInput form-control" id="boxInput" name="box_id">

							</select>
							@if($errors -> has('box_id'))
							<div class="text-danger">
								{{ $errors -> first('box_id') }}
							</div>
							@endif
						</div>
						<div class="form-group">
							<label for="description">{{ __('document.description') }} : </label>
							<textarea name="description" class="form-control" rows="4"></textarea>
							@if($errors -> has('description'))
							<div class="text-danger">
								{{ $errors -> first('description') }}
							</div>
							@endif
						</div>
						
						<div class="form-group">
							<!-- <label>User Create Document : </label> -->
							<input type="hidden" name="user_id" class="form-control" value="{{ $user }}">
						</div>
						<br>

						<div class="input-group control-group increment form-group" >
							<div class="custom-file" >
							
							<input type="file" name="filename[]"  class="custom-file-input" multiple="true" >
							
								
							</div>			
							 
							<div class="input-group-btn"> 
							  <button class="btn btn-success btn-xs" type="button"><i class="glyphicon glyphicon-plus"></i>  {{ __('document.add_file') }}</button>
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
									<input type="file" name="filename[]"  class="custom-file-input" multiple>
								</div>
								
								
								<div class="input-group-btn"> 
									<button class="btn btn-danger btn-xs" type="button"><i class="
									glyphicon glyphicon-remove"></i>  {{ __('document.delete_file') }}</button>
								</div>
							</div>
							
						</div>
						
						<br>
						
							<button type="submit" class="btn btn-primary">Save!</button>
					
						
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

		$("#js-tokenizer").select2({
			tags: true,
			tokenSeparators: [',', ' ']
		});

		$('#datetimepicker1').datetimepicker({
			format: "YYYY/MM/DD"
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