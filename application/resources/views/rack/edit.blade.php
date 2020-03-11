@extends('layouts.master')
@section('content')

<div class="main">
	<div class="main-content">
		<div class="container-fluid">
			<div class="panel panel-headline">
				<div class="panel-heading">
					<div class="panel-title">Edit Rack</div>
				</div>
				<div class="panel-body">
					<form action="/rack/update/{{$edit->id}}" method="post">
						{{csrf_field()}}
						<div class="form-group">
							<label>{{__('rack.rack_number')}} :</label>
							<input type="text" name="rack_number" value="{{$edit->rack_number}}" class="form-control" readonly="readonly">
						</div>
						<div class="form-group">
							<label>{{__('rack.capacity')}} :</label>
							<input type="text" name="capacity" value="{{$edit->capacity}}" class="form-control">
						</div>
						<div class="form-group">
							<label>Division</label>
							<select name="division" class="form-control">
								@foreach($division as $div)
									<option class="form-control" value="{{$div->id}}" @if($div->id == $edit->id) ? selected : '' @endif >{{$div->name}}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-xs btn-primary"><span class="lnr lnr-location"> Update</span></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection