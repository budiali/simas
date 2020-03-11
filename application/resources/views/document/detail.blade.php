@extends('layouts/master')

@section('content')


<div class="main">
	<div class="main-content">
		<div class="container-fluid">
		
					<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title">{{ __('document.detail_document') }}</h3>
						</div>
								<div class="panel-body">
									<!-- @if( $message = Session::get('error'))
								<div class="alert alert-danger">
									<button type="button" class="close" data-dismiss="alert">x</button>
									{{ $message }}
								</div>
									@endif -->
									@hasanyrole('administrator|manager|staff')
										@can('Print Documents')
									<a href="/document/print_pdf/{{$detail->id}}" class="btn btn-primary btn-xs" target="_blank"><span class="lnr lnr-printer"> {{ __('document.export_pdf') }}</span></a>
										@endcan
										@can('Edit Documents')
									<a href="/document/edit/{{$detail->id}}" class="btn btn-warning btn-xs" data-placement="top"><span class="lnr lnr-pencil"> {{ __('document.edit') }}</span></a>
										@endcan
									@endhasanyrole
									@role('administrator')
										@can('Delete Documents')
									<a href="#" doc-id="{{$detail->id}}"  class="btn btn-danger btn-xs delete" data-toggle="tooltip" data-placement="top" title="Delete"><span class="lnr lnr-trash"> {{ __('document.delete') }}</span></a>
										@endcan
									@endrole
									<br>
									<br>
									<table class="table table-bordered">
										
										<tr>
											<th>{{ __('document.reference_number') }}</th>
											<td>{{ $detail -> reference_number }}</td>
										</tr>
										<tr>
											<th>{{ __('document.job_number') }}</th>
											<td>{{ $detail -> job_number }}</td>
										</tr>
										<tr>
											<th>{{ __('document.user_upload') }}</th>
											<td>{{ $detail->user->name }}</td>
										</tr>
										<tr>
											<th>{{ __('document.date') }}</th>
											<td>{{ date('M d, Y', strtotime($detail -> date)) }}</td>
										</tr>
										<tr>
											<th>{{ __('document.box_number') }}</th>
											<td>{{ 'Box Number [ '.$detail->box->box_number.' ] / Rack Number [ '.$detail->box->rack->rack_number.' ] / Division [ '.$detail->box->rack->division->name.' ]' }}</td>
										</tr>
										<tr>
											<th>{{ __('document.contains') }}</th>
											<td>
												<ul>
												@foreach($detail -> contain as $key => $value)
													<li>{{ $value -> name }}</li>
												@endforeach
												</ul>
											</td>
										</tr>
										<tr>
											<th>{{ __('document.file') }}</th>
											<th>
											
												<ul>
												@foreach($detail->file as $key => $value)
													<li><a href="/data_file/{{ $value->filename}}">{{$value->filename}}</a></li>
												@endforeach
												</ul>
												</th>
												
										</tr>
										<tr>
											<th>{{ __('document.description') }}</th>
											<td>{{ $detail -> description }}</td>
										</tr>

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

		$('.delete').click(function(){

			var doc_id = $(this).attr('doc-id');
			swal({
			  title: "{{__('document.sure')}}",
			  text: "{{__('document.trash')}}",
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
			})
			.then((willDelete) => {

			  if (willDelete) {
			  	window.location = "/document/delete/"+doc_id+"";
			  } 

			});
		});


	});

</script>
@endsection


