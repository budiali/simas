@extends('layouts.master')

@section('content')

<div class="main">
    <div class="main-content">
        <div class="container-fluid">
                            <nav aria-label="breadcrumb">
                              <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/division" ><span class="lnr lnr-arrow-left-circle"> Back</span></a></li>
                              </ol>
                            </nav>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3>Edit Divison</h3>
                        </div>
                        <div class="panel-body">
                            <form action="/division/update/{{ $editDivision -> id }}" method="post">
                                
                                {{ csrf_field() }}

                                <div class="form-group">
                                    <label for="name">{{__('division.name_division')}} :</label>
                                    <input type="text" name="name" placeholder="fill in the name of the new division" class="form-control" value="{{ $editDivision -> name }}">

                                    @if($errors -> has('name'))
                                        <div class="text-danger">
                                            {{ $errors -> first('name') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="descriptions">{{__('division.description')}} :</label>
                                    <input type="text" name="descriptions" placeholder="fill in the descriptions" class="form-control" value="{{ $editDivision -> descriptions }}">

                                    @if($errors -> has('descriptions'))
                                        <div class="text-danger">
                                            {{ $errors -> first('descriptions') }}
                                        </div>
                                    @endif
                                </div>
                                @role('administrator')
                                @can('Update Division')
                                <button type="submit" class="btn btn-primary">Update!</button>
                                @endcan
                                @endrole
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection