@extends('layouts.master')
@section('content')

<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="panel panel-headline">
                <div class="panel-heading">
                    <h3 class="panel-title">Edit Profile</h3>
                </div>
                <div class="panel-body">
                <form action="/user/update_profile/{{$user->id}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                    <div class="form-group">
                        <label for="name">Name : </label>
                        <input type="text" name="name" value="{{$user->name}}" class="form-control">
                        @if($errors->has('name'))
                            <div class="text-danger">{{$errors->first('name')}}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="email">Email : </label>
                        <input type="email" name="email" value="{{$user->email}}" class="form-control"> 
                        @if($errors->has('email'))
                            <div class="text-danger">{{$errors->first('email')}}</div>
                        @endif                     
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