@extends('layouts.master')
@section('content')

<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            
                            <nav aria-label="breadcrumb">
                              <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/rack" ><span class="lnr lnr-arrow-left-circle"> Back</span></a></li>
                                @hasanyrole('administrator|manager')
                                @can('Create Box')
                                <li class="breadcrumb-item"><a href="/rack/add_box/{{$rack->id}}"><span class="lnr lnr-file-add"> {{ __('master.create_new_box') }}</span></a></li>
                                @endhasanyrole
                                @endcan
                                <!-- <li class="breadcrumb-item active" aria-current="page">Data</li> -->
                              </ol>
                            </nav>
                        
                    <div class="panel panel-headline">

                        <div class="panel-heading">
                        <h3 class="panel-title">{{ __('rack.detail_rack') }}</h3>
                        <p class="panel-subtitle">{{ __('rack.rack_number') }} {{ ' [ '.$rack ->rack_number.' ] / Division [ '.$rack->division->name.' ]' }}</p>
                            <div class="right">
                                <button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
                            </div>			
                        </div>
                        
                        <div class="panel-body">
                            
                            <table class="table">
                                <tr>
                                    <th>No</th>
                                    <th>{{ __('document.box_number') }}</th>
                                    <th>{{ __('box.amount_of_document') }}</th>
                                    <th>{{ __('box.from') }}</th>
                                    <th>{{ __('box.to') }}</th>
                                    <th>ACTION</th>
                                </tr>
                                <?php $no = 1; ?>
                                @foreach($rack->box as $dataBox)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $dataBox->box_number }}</td>
                                    <td>{{ $dataBox->document->count().' Documents' }}</td>
                                    <td>{{ date('M d, Y', strtotime($dataBox->from )) }}</td>
                                    <td>{{ date('M d, Y', strtotime($dataBox->to)) }}</td>
                                    <td>
                                    @hasanyrole('administrator|manager|staff')
                                        @can('Show Box')
                                    <a href="/box/view_data/{{ $dataBox->id }}" class="btn btn-info btn-xs"><span class="lnr lnr-eye"> {{ __('box.detail_box') }}</span></a>
                                        @endcan
                                    @endhasanyrole
                                    @hasanyrole('administrator|manager')
                                    @can('Edit Box')
                                    <a href="/box/edit_box/{{ $dataBox->id }}" class="btn btn-warning btn-xs"><span class="lnr lnr-pencil"> {{ __('box.edit_box') }}</span></a>
                                    @endcan
                                    @endhasanyrole
                                        @can('Delete Box')
                                    <a href="#" box-id="{{ $dataBox->id }}" class="btn btn-xs btn-danger delete"><span class="lnr lnr-trash"> {{ __('box.delete_box') }}</span></a>
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </br>
                        
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

        var box_id = $(this).attr('box-id');
			swal({
			  title: "{{ __('document.sure') }}",
			  text: "{{ __('box.sentence_del_box') }}",
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
			})
			.then((willDelete) => {

			  if (willDelete) {
			  	window.location = "/box/delete/"+box_id+"";
			  } 

			});

    });

});

</script>

@endsection