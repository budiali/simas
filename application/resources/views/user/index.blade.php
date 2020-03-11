@extends('layouts.master')

@section('content')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                        <h3 class="panel-title">{{ __('master.data_user') }}</h3>
                        </div>
                        <div class="panel-body">
                           
                            <table class="table table-hover">
                                <tr>
                                    <th>{{ __('user.name') }}</th>
                                    <th>{{ __('user.email') }}</th>
                                    <th>{{ __('user.role') }}</th>
                                    <th>DIVISION</th>
                                    <th>{{ __('user.status') }}</th>
                                    <th>ACTION</th>
                                </tr>
                                @foreach($dataUser as $data)
                                <tr>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->email }}</td>
                                @foreach( $data->roles as $role )
                                    <td>{{ $role->name }}</td>
                                @endforeach
                                    <td>{{ $data->division->name }}</td>
                                    <td>
                                        @if($data->isOnline())
                                            <span class="label label-success">
                                                Online
                                            </span>
                                        @else 
                                        <span class="label label-default">
                                                Offline
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        
                                        @can('Show User Roles')
                                        <a href="{{ route('user.roles', $data->id) }}" class="btn btn-info btn-sm" style="margin-right: 5px;"><span class="lnr lnr-cog"> {{ __('user.setting_role') }}</span></a>
                                        @endcan
                                        <!-- <a href="#" id="edit" class="btn btn-sm btn-warning btn-xs" style="margin-right: 5px;"> <span class="lnr lnr-pencil"></span></a> -->
                                        
                                        @role('administrator')
                                        @can('Delete Users')
                                        <a href="#" class="btn btn-sm btn-danger btn-xs delete" user-id="{{$data->id}}"> <span class="lnr lnr-trash"> {{ __('user.delete_user') }}</span></a>
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
            var user_id = $(this).attr('user-id');
            swal({
              title: "{{__('document.sure')}}",
              text: "{{__('user.sentence_del_user')}}",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {

              if (willDelete) {
                window.location = "/user/delete/"+user_id+"";
              } 

            });
        });

    });
</script>

@stop