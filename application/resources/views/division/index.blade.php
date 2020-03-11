@extends('layouts.master')

@section('content')

<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{__('master.data_divisi')}}</h3>
                        </div>
                        <div class="panel-body">
                            <table class="table table-hover">
                                <tr>

                                    <th>NO</th>
                                    <th>{{ __('division.name_division') }}</th>
                                    <th>{{ __('division.description') }}</th>
                                    <th>ACTION</th>
                                </tr>
                                <?php $no = 1; ?>
                                @foreach($divisions as $key => $value)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $value -> name }}</td>
                                    <td>{{ $value -> descriptions }}</td>
                                    <td>
                                    @role('administrator')
                                    @can('Edit Division')
                                    <a href="/division/edit/{{ $value->id }}" class="btn btn-warning btn-xs"><span class="lnr lnr-pencil"> {{ __('division.edit_division') }}</span></a>
                                    @endcan
                                    @can('Delete Division')
                                    <a href="#" division-id="{{ $value->id }}" class="btn btn-danger btn-xs delete"><span class="lnr lnr-trash"> {{ __('division.delete_division') }}</span></a>
                                    @endcan
                                    @endrole
                                    </td>
                                </tr>
                                @endforeach
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

                var div_id = $(this).attr('division-id');
                swal({
                  title: "{{__('document.sure')}}",
                  text: "{{__('division.sentence_del_division')}}",
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
                })
                .then((willDelete) => {

                  if (willDelete) {
                    window.location = "/division/delete/"+div_id+"";
                  } 

                });

            });

        });
    </script>
@stop
