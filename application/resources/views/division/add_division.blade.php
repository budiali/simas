@extends('layouts.master');

@section('content')

<div class="main">
    <div class="main-content">
        <div class="container-fluid">
                            <nav aria-label="breadcrumb">
                              <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/dashboard" ><span class="lnr lnr-home"> Home</span></a></li>
                                <li class="breadcrumb-item"><a href="/division" ><span class="lnr lnr-exit-up"> {{__('master.data_divisi')}}</span></a></li>
                              </ol>
                            </nav>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{__('master.create_new_divisi')}}</h3>
                        </div>
                        <div class="panel-body">
                            <form action="/division/store" method="post">
                            
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="name">{{__('division.name_division')}} :</label>
                                    <input type="text" name="name"  class="form-control">

                                    @if($errors -> has('name'))
                                        <div class="text-danger">
                                            {{ $errors -> first('name') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="descriptions">{{__('division.description')}} :</label>
                                    <input type="text" name="descriptions"  class="form-control">

                                   @if($errors -> has('descriptions'))
                                        <div class="text-danger">
                                            {{ $errors -> first('descriptions') }}
                                        </div>
                                    @endif
                                </div>

                                <button type="submit" class="btn btn-primary">Save!</button>
                            
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection