@extends('layouts.master')
@section('content')

<div class="main">
    <div class="main-content">
        <div class="container-fluid">
                            <nav aria-label="breadcrumb">
                              <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/dashboard" ><span class="lnr lnr-home"> Home</span></a></li>
                                <li class="breadcrumb-item"><a href="/user" ><span class="lnr lnr-exit-up"> {{__('master.data_user')}}</span></a></li>
                              </ol>
                            </nav>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{ __('master.create_new_user') }}</h3>
                        </div>
                        <div class="panel-body">

                    <form method="POST" action="{{ route('user.create_user') }}">
                        @csrf
                        {{ csrf_field() }}

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('user.name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Fill in the name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('user.email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="example@email.com" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('user.role') }}</label>

                            <div class="col-md-6">
                                <select name="role" >
                                @role('administrator')
                                    @foreach($roleUser as $role)
                                <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach

                                </select>
                                @endrole
                                @role('manager')
                                    @foreach($getRole as $role)
                                <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach

                                </select>
                                @endrole

                                @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="division" class="col-md-4 col-form-label text-md-right">{{ __('Division') }}</label>
                            <div class="col-md-6">
                                <select name="division">
                                    @foreach($divisions as $division)
                                    <option value="{{$division->id}}">{{$division->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('user.password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('user.confirm_password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-xs"><span class="lnr lnr-location"> {{ __('user.register') }}</span></button>
                            </div>
                        </div>
                    </form>
            

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection