@extends('layouts/master')

@section('content')

<style type='text/css'>
	th {
		text-align: center;
	}
</style>

<div class="main">
	<div class="main-content">
		<div class="container-fluid">
			
					<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title">{{ __('master.data_document') }}</h3>
							
						</div>
						<div class="panel-body">
							@if( $message = Session::get('success'))
								<div class="alert alert-success">
									<button type="button" class="close" data-dismiss="alert">x</button>
									{{ $message }}
								</div>
							@endif
							@if( $message = Session::get('error'))
								<div class="alert alert-danger">
									<button type="button" class="close" data-dismiss="alert">x</button>
									{{ $message }}
								</div>
							@endif
							<table class="table table-hover" id="datatable">
								<thead>
									<tr>							
										<th>{{ __('document.reference_number') }}</th>
										<th>{{ __('document.job_number') }}</th>
										<th>{{ __('document.user_upload') }}</th>
										<th>{{ __('document.date') }}</th>
										<th>{{ __('document.box_number') }}</th>				
										<th>ACTION</th>
									</tr>
								</thead>
							</table>
						</div>
					</div>		
		</div>
	</div>
</div>

@stop

@section('js')

<script>
$(document).ready(function(){

	$('#datatable').DataTable({
		processing:true,
		serverside:true,
		ajax:"{{route('ajax.get.documents')}}",

		columns:[
			{data:'reference_number',name:'reference_number'},
			{data:'job_number',name:'job_number'},
			{data:'user_upload',name:'user_upload'},
			{data:'date',name:'date'},
			{data:'box_number',name:'box_id' },
			{data:'action'}
		]
	});
	$('[data-toggle="tooltip"]').tooltip();



});
</script>


@endsection