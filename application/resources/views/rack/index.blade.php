@extends('layouts.master')
@section('content')

<div class="main">
    <div class="main-content">
        <div class="container-fluid">
                <div class="panel panel-headline">

                        <div class="panel-heading">
                            <h3 class="panel-title">{{ __('master.data_racks') }}</h3>
                        </div>
            
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <th>{{ __('rack.rack_number') }}</th>
                                    <th>{{ __('rack.amount_of_box') }}</th>
                                    <th>{{ __('rack.max_capacity') }}</th>
                                    <th>{{ __('rack.name_division') }}</th>
                                    <th>ACTION</th>
                                </tr>
                                @foreach($div as $divs)
                                <tr>
                                    <td>{{ $divs->rack_number }}</td>
                                    <td>{{ $divs->box->count() . " Box" }}</td>
                                    <td>{{ $divs->capacity." Box" }}</td>
                                    <td>{{ $divs->division->name }}</td>
                                    <td>
                                    <a href="/rack/detail/{{$divs -> id}}" class="btn btn-info btn-xs" style="margin-right: 5px;"><span class="lnr lnr-eye" style="font-size: 11px;"> {{ __('rack.detail_rack') }}</span></a>

                                    @hasanyrole('administrator|manager')                                    
                                        @can('Edit Racks')
                                    <a href="/rack/edit/{{$divs -> id}}" class="btn btn-warning btn-xs" style="margin-right: 5px;"><span class="lnr lnr-pencil" style="font-size: 11px;"> {{ __('rack.edit_rack') }}</span></a>
                                        @endcan
                                    @endhasanyrole
                                        @can('Delete Racks')
                                    <a href="#" rack-id="{{$divs->id}}" class="btn btn-xs btn-danger delete"><span class="lnr lnr-trash"> {{ __('rack.delete_rack') }}</span></a>
                                        @endcan
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

        var rack_id = $(this).attr('rack-id');
        swal({
			  title: "{{ __('document.sure') }}",
			  text: "{{ __('rack.sentence_del_rack') }}",
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
			})
			.then((willDelete) => {

			  if (willDelete) {
			  	window.location = "/rack/delete/"+rack_id+"";
			  } 

			});



    });

});

</script>

@endsection
