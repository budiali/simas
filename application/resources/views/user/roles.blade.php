@extends('layouts.master')
@section('title')
	<title>{{__('user.setting_role')}}</title>
@endsection

@section('content')

<div class="main">
	<div class="main-content">
		<div class="container-fluid">
                            <nav aria-label="breadcrumb">
                              <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/user" ><span class="lnr lnr-arrow-left-circle"> Back</span></a></li>
                              </ol>
                            </nav>
			<div class="panel panel-headline">
				<div class="panel-heading">
					<h3 class="panel-title">{{__('user.setting_role')}}</h3>
				</div>
				<div class="panel-body">
					<form action="{{ route('user.set_role', $user->id) }}" method="post">
                            @csrf

                            <input type="hidden" name="_method" value="PUT" >
                        
                            @slot('title')
                            @endslot
                            
                            
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>{{__('user.name')}}</th>
                                            <td>:</td>
                                            <td>{{ $user->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{__('user.email')}}</th>
                                            <td>:</td>
                                            <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                                        </tr>
                                        <tr>
                                            <th>{{__('user.role')}}</th>
                                            <td>:</td>
                                            <td>
                                                @foreach ($roles as $row)
                                                <input type="radio" name="role" 
                                                    {{ $user->hasRole($row) ? 'checked':'' }}
                                                    value="{{ $row }}"> {{  $row }} <br>
                                                @endforeach
                                            </td>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            @role('administrator')
                            @can('Set User Roles')
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary btn-sm float-right"><i class="fa fa-send"></i> 
                                        Set Role
                                    </button>
                                </div>
                            @endcan
                            @endrole
                        
                        </form>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection