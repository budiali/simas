@extends('layouts.master')
@section('content')

<div class="main">
    <div class="main-content">
        <div class="container-fluid">       
            <div class="row">
                <div class="col-md-8">
                    <div class="panel panel-headline">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{ __('role.list_roles') }}</h3>
                        </div>
                        <div class="panel-body">

                            @if( $message = Session::get('success'))
                                <div class="alert alert-success">
                                    <button type="button" class="close" data-dismiss="alert">x</button>
                                    {{ $message }}
                                </div>
                            @endif
                            
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <td>#</td>
                                            <td>{{ __('master.roles') }}</td>
                                            <td>Guard</td>
                                            <td>Created At</td>
                                            <!-- <td>Aksi</td> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1; @endphp
                                        @forelse ($role as $row)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $row->name }}</td>
                                            <td>{{ $row->guard_name }}</td>
                                            <td>{{ $row->created_at }}</td>
                                            <!-- <td>
                                                <a href="{{ route('role.destroy', $row->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                            </td> -->
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Tidak ada data</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        <div class="float-right">
                                {!! $role->links() !!}
                            </div>
                    </div>       
                </div>


                <!-- <div class="col-md-4">
                    <div class="panel panel-headline">
                        <div class="panel-heading">
                            <h3 class="panel-title">Manajemen Role</h3>
                        </div>
                        <div class="panel-body">
                            
                            @slot('title')
                            Tambah
                            @endslot
                            
                            @if (session('error'))
                                @alert(['type' => 'danger'])
                                    {!! session('error') !!}
                                @endalert
                            @endif
​
                            <form role="form" action="{{ route('role.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Role</label>
                                    <input type="text" 
                                    name="name"
                                    class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}" id="name" required>
                                </div>
                            
                                <div class="card-footer">
                                    <button class="btn btn-primary btn-xs">Save</button>
                                </div>
                            </form>
                            
                        
                        </div>
                    </div>
                </div>
 -->

            </div>
        </div>
    </div>
</div>

@endsection

   