@extends('layouts/master')

@section('content')

<style type='text/css'>
th{text-align : center;}
</style>

<div class="main">
	<div class="main-content">
		<div class="container-fluid">
		<div class="row">
				<div class="col-md-12">
					<div class="panel">
						<div class="panel-heading">
							<h3 class="panel-title">{{ __('master.trash_document') }}</h3>
						</div>
								<div class="panel-body">
									<table class="table table-hover">
									@role('administrator')
									@can('Restore All Documents')
									<a href="/document/restore_all" class="btn btn-info btn-sm" style="margin-right: 5px"><span class="lnr lnr-sync"></span> {{ __('document.restore_all') }}</a> 
									@endcan
									
									@can('Delete Permanently All Documents')
									<a href="#" document-ids="/document/delete_permanently_all" class="btn btn-danger btn-sm delete_all"><span class="lnr lnr-trash"></span> {{ __('document.delete_permanently_all') }}</a>
									@endcan  
									@endrole
									<br><br>
										<thead>
											<tr>
												<th>{{ __('document.reference_number') }}</th>
												<th>{{ __('document.job_number') }}</th>
												<th>{{ __('document.date') }}</th>
												<th>{{ __('document.box_number') }}</th>
												<th>{{ __('document.description') }}</th>
												<th>{{ __('document.contains') }}</th>
												<th>{{ __('document.file') }}</th>
												<th>ACTION</th>
											</tr>
										</thead>
										<tbody>
										@foreach($document as $doc)
											<tr>
												<td>{{ $doc -> reference_number }}</td>
												<td>{{ $doc -> job_number }}</td>
												<td>{{ $doc -> date }}</td>
												<td>{{ '[ '.$doc->box->box_number.' ] / [ '.$doc->box->rack->rack_number.' ] / [ '.$doc->box->rack->division->name.' ]' }}</td>
												<td>{{ $doc -> description }}</td>
												<td>
													<ul>
													@foreach($doc -> contain as $doc_contain)
														<li>{{ $doc_contain -> name }}</li>
													@endforeach
													</ul>
												</td>
												<td>
													<ul>
														@foreach($doc->file as $key => $value)
															<li><a href="/data_file/{{ $value->filename}}">{{$value->filename}}</a></li>
														@endforeach
													</ul>
												</td>
												<td>
													@role('administrator|manager')
													@can('Restore Documents')	
													<a href="/document/restore/{{$doc -> id}}" class="btn btn-info btn-xs"><span class="lnr lnr-sync"></span></a> 
													@endcan
													@can('Delete Permanently Documents')
													<a href="#" document-id="{{$doc->id}}" class="btn btn-danger btn-xs delete"><span class="lnr lnr-trash"></span></a>
													@endcan
													@endrole

												</td>
											</tr>
											@endforeach

										</tbody>
									</table>		
								</div>			
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@stop


@section('js')

<script type="text/javascript">
	
	$(document).ready(function(){

		$('.delete').click(function(){

			var doc_id = $(this).attr('document-id');
			swal({
			  title: "{{__('document.sure')}}",
			  text: "The document will be permanently deleted!",
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
			})
			.then((willDelete) => {

			  if (willDelete) {
			  	window.location = "/document/delete_permanently/"+doc_id+"";
			  } 

			});

		});

		$('.delete_all').click(function(){

			var doc_ids = $(this).attr('document-ids');
			swal({
			  title: "{{__('document.sure')}}",
			  text: "{{__('document.del_permanently_all')}}",
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
			})
			.then((willDelete) => {

			  if (willDelete) {
			  	window.location = "/document/delete_permanently_all";
			  } 

			});


		});

	});


</script>


@endsection

