@extends('layouts.master')
@section('content')

<div class="main">
	<div class="main-content">
		<div class="container-fluid">
			<div class="panel panel-headline">
				<div class="panel-heading">
					<h3 class="panel-title">Edit Profile User</h3>
				</div>
				<div class="panel-body">
					<form action="/user/update/{{$userEdit->id}}" method="post" enctype="multipart/form-data">
						{{ csrf_field() }}

						<img src="">
						<input type="file" name="avatar" >
						
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection