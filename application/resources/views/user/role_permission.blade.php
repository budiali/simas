@extends('layouts.master')

@section('title')
	<title>Manajemen Permission</title>
@endsection

@section('css')
	   
	   <style type="text/css">
        .tab-pane{
            height:150px;
            overflow-y:scroll;
        }
    	</style>

@endsection

@section('content')
	
<div class="main">
	<div class="main-content">
		<div class="container-fluid">
			<div class="row">
				<!-- <div class="col-md-4">
					<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title"> Add New Permission</h3>
						</div>
						<div class="panel-body">
							                    
                         
                            <form action="{{ route('user.add_permission') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}" required>
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-sm">
                                        Add New
                                    </button>
                                </div>
                            </form>
                            @slot('footer')
​
                            @endslot
              
                            
						</div>
					</div>
				</div> -->
				<div class="col-md-8">
					<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title">{{__('role.set_permission_to_role')}}</h3>
						</div>
						<div class="panel-body">
						<!-- 	  @if ($message = Session::get('success'))
                                <div class="alert alert-success">
                                	<button type="button" class="close" data-dismiss="alert">x</button>
                                	{{ $message }}
                                </div>
                            @endif -->
                            
                            <form action="{{ route('user.roles_permission') }}" method="GET">
                                <div class="form-group">
                                    <label for="">{{__('master.roles')}}</label>
                                    <div class="input-group">
                                        <select name="role" class="form-control">
                                            @foreach ($roles as $value)
                                                <option value="{{ $value }}" {{ request()->get('role') == $value ? 'selected':'' }}>{{ $value }}</option>
                                            @endforeach
                                        </select>
                                        <span class="input-group-btn">
                                            <button class="btn btn-danger"><span class="lnr lnr-spell-check"></span> {{__('role.check_permissions')}}</button>
                                        </span>
                                    </div>
                                </div>
                            </form>

                              {{-- jika $permission tidak bernilai kosong --}}
                            @if (!empty($permissions))
                                <form action="{{ route('user.setRolePermission', request()->get('role')) }}" method="post">
                                    @csrf
                                    <input type="hidden" name="_method" value="PUT">
                                   
                                <form action="{{ route('user.setRolePermission', request()->get('role')) }}" method="post">
                                    @csrf
                                    <input type="hidden" name="_method" value="PUT">
                                    <div class="form-group">
                                        <div class="nav-tabs-custom">
                                            <ul class="nav nav-tabs">
                                                <li class="active">
                                                    <a href="#tab_1" data-toggle="tab">{{__('role.permissions')}}</a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="tab_1">
                                                    @php $no = 1; @endphp
                                                    @foreach ($permissions as $key => $row)
                                                        <input type="checkbox" 
                                                            name="permission[]" 
                                                            class="minimal-red" 
                                                            value="{{ $row }}"
                                                          
                                                            {{ in_array($row, $hasPermission) ? 'checked':'' }}
                                                            > {{ $row }} <br>
                                                        @if ($no++%4 == 0)
                                                        <br>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    @role('administrator')
                                 
                                    <div class="pull-right">
                                        <button class="btn btn-primary btn-sm">
                                            <i class="fa fa-send"></i> {{__('role.set_permissions')}}
                                      </button>
                                    </div>
                                
                                    @endrole
                                </form>
                            @endif
                            @slot('footer')
                               
                        
                               
                            @endslot
                        
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection