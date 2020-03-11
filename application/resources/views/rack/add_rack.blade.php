@extends('layouts.master')
@section('content')

<div class="main">
	<div class="main-content">
		<div class="container-fluid">
		<nav aria-label="breadcrumb">
                              <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/dashboard" ><span class="lnr lnr-home"> Home</span></a></li>
                                <li class="breadcrumb-item"><a href="/rack" ><span class="lnr lnr-exit-up"> {{ __('master.data_racks')}}</span></a></li>
                              </ol>
                            </nav>
			<div class="panel panel-headline">
				<div class="panel-heading">
					<h3 class="panel-title">{{ __('master.create_new_racks') }}</h3>
				</div>
				<div class="panel-body">
					<form action="{{ route('rack.store')}}" method="post">
						
						{{csrf_field()}}
						<div class="form-group">
							<label>{{ __('rack.rack_number')}} :</label>
							<input type="text" class="form-control" name="rack_number" value="{{$printRack}}" readonly="true">
							@if($errors->has('rack_number'))
								<div class="text-danger">
									{{$errors->first('rack_number')}}
								</div>
							@endif
						</div>
						<div class="form-group">
							<label>{{ __('rack.capacity')}} :</label>
							<input type="text" class="form-control" name="capacity" >
							@if($errors->has('capacity'))
								<div class="text-danger">
									{{$errors->first('capacity')}}
								</div>
							@endif
						</div>
						<div class="form-group">
							<label>{{ __('Division :')}}</label>
							<select class="form-control" name="division">
								@foreach($division as $d)
									<option value="{{$d->id}}">{{$d->name}}</option>
								@endforeach								
							</select>
							@if($errors->has('division'))
								<div class="text-danger">
									{{$errors->first('division')}}
								</div>
							@endif
						</div>
						<br>
						@hasanyrole('administrator|manager')
							@can('Create Racks')
								<button type="submit" class="btn btn-primary btn-xs"><span class="lnr lnr-location"> Save</span></button>
							@endcan
						@endhasanyrole
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

@stop
@section('js')



@endsection
