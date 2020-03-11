@extends('layouts.master')
@section('content')

<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <!-- OVERVIEW -->
            <div class="panel panel-headline">
                <div class="panel-heading">
                    <h3 class="panel-title">Weekly Overview</h3>
                    <p class="panel-subtitle">Period: Oct 14, 2016 - Oct 21, 2016</p>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="metric">
                                <span class="icon"><i class="fa fa-map"></i></span>
                                <p>
                                <span class="number">{{$document->count()}}</span>
                                <span class="title"><a href="{{route('document.index')}}">Amount Of Doc</a></span>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="metric">
                                <span class="icon"><i class="fa fa-shopping-bag"></i></span>
                                <p>
                                    <span class="number">{{$box->count()}}</span>
                                <span class="title"><a href="{{route('box.index')}}">Amount Of Box</a></span>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="metric">
                                <span class="icon"><i class="fa fa-database"></i></span>
                                <p>
                                    <span class="number">{{$rack->count()}}</span>
                                <span class="title"><a href="{{route('rack.index')}}">Amount Of Rack</a></span>
                                </p>
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="metric">
                                <span class="icon"><i class="fa fa-bar-chart"></i></span>
                                <p>
                                    <span class="number">{{$division->count()}}</span>
                                    <span class="title"><a href="{{route('division.index')}}">Amount Of Division</a></span>
                                </p>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
            </div>
           
        </div>
    </div>
</div>
<div class="clearfix">
   
</div>


@endsection