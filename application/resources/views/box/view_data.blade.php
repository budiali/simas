@extends('layouts.master')

@section('content')

<div class="main">
    <div class="main-content">
        <div class="container-fluid">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/rack/detail/{{$box->id}}" ><span class="lnr lnr-arrow-left-circle"> Back</span></a></li>
                    </ol>
                </nav>
                    <div class="panel panel-headline">
                        <div class="panel-heading">
                            <div class="row col-md-6 pull-left">
                                <h3 class="panel-title">{{ __('master.data_box') }}</h3>
                                <p class="panel-subtitle">
                                   {{ __('document.box_number')}} {{ '[ ' . $box->box_number . ' ]' }} {{ __('rack.rack_number')}} {{' [ ' . $box->rack->rack_number . ' ] '}}  {{ '/ Division [ ' . $box->rack->division->name . ' ]'  }}
                                </p>
                                <p class="panel-subtitle">
                                    {{ __('box.period') }} : {{date('M d, Y', strtotime($box->from)) . ' - ' . date('M d, Y', strtotime($box->to)) }}
                                </p>   
                            </div>
                            <div class="row col-md-6 pull-right">

                               <p class="pull-right"><a href="/rack/qr_code/{{ $box->id }}" target="_blank" class="btn btn-xs btn-primary"><span class="lnr lnr-printer"> Generate QR-Code</span></a></p> 

                               <p class="pull-right" style="margin-right:3px;"><a href="/box/print_data_box/{{$box->id}}" class="btn btn-success btn-xs" target="_blank"><span class="lnr lnr-printer"> Export PDF</span></a></p>
                            </div>                                          
                        </div>
                        <div class="panel-body">
                            <table class="table table-hover" id="datatable">
                                <tr>
                                    <th>{{__('document.reference_number')}}</th>
                                    <th>{{__('document.job_number')}}</th>
                                    <th>{{__('document.date')}}</th>
                                    <th>{{__('document.description')}}</th>
                                    <th>Action</th>
                                </tr>
                                @foreach($box->document as $value)
                                <tr>
                                    <td>{{ $value->reference_number }}</td>
                                    <td>{{ $value->job_number }}</td>
                                    <td>{{ $value->date }}</td>
                                    <td>{{ $value->description }}</td>
                                    <td>
                                    <a href="/document/detail/{{ $value->id }}" class="btn btn-info btn-xs"><span class="lnr lnr-eye"> Detail Document</span></a>
											
									<a href="#" doc-id="{{$value->id}}" class="btn btn-danger btn-xs delete"><span class="lnr lnr-trash"> {{__('document.delete')}}</span></a>
											
                                    </td>
                                </tr>
                                @endforeach
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


