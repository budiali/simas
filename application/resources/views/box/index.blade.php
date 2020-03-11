@extends('layouts.master')

@section('content')

<div class="main">

    <div class="main-content">
        <div class="container-fluid">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/box" ><span class="lnr lnr-exit-up"> {{__('master.data_box')}}</span></a></li>
                </ol>
            </nav>
                    <div class="panel panel-headline">
                        <div class="panel-heading">
                  
                            <h3 class="panel-title">{{__('master.data_box')}}</h3>
                           
                                
                                    <form action="/box/search" method="get">
                                        <table border="0" >
                                            <tr>
                                                <td ><input type="submit" value="{{ __('box.search')}}" class="btn btn-xs btn-primary" style="margin-right: 5px;"></td>
                                                <td><input type="text" name="search" class="form-control" placeholder="{{ __('box.search_box')}}" value="{{old('search')}}"> </td>
                                            </tr>
                                        </table>
                                    </form>    
                                    
                            
                              
                        </div>
                        
                        <div class="panel-body" >
                          
                            <table id="databox" class="table table-hover" >
                                <tr>
                                    @hasanyrole('administrator|manager|staff')
                                    @can('Update Status Box')
                                    <th>{{ __('box.status_box') }}</th>
                                    @endcan
                                    @endhasanyrole
                                    <th>{{ __('document.box_number') }}</th>
                                    <th>{{ __('box.from') }}</th>
                                    <th>{{ __('box.to') }}</th>
                                    <th>{{ __('rack.rack_number') }}</th>
                                    <th>{{ __('box.status') }}</th>
                                    <th>NAME DIVISION</th>
                                </tr>
                                @foreach($box as $key => $value)
                                    <tr>
                                        @hasanyrole('administrator|manager|staff')
                                        @can('Update Status Box')
                                        <td>
                                            @if($value->status == 1)
                                               <a href="{{ url('box/update/status/'.$value->id) }}" class="btn btn-xs btn-success"><span class="fa fa-check-circle" > {{ __('box.take_the_box') }}</span></a>

                                            @elseif($value->status == 0)
                                                <a href="{{ url('box/update/status/'.$value->id) }}" class="btn btn-xs btn-danger"><i class="fa fa-spinner fa-spin"></i> {{ __('box.return_box') }}</a>
                                            @endif
                                        </td>
                                        @endcan
                                        @endhasanyrole
                                        <td>{{ $value->box_number }}</td>
                                        <td>{{ date('M d, Y',strtotime($value->from)) }}</td>
                                        <td>{{ date('M d, Y',strtotime($value->to)) }}</td>
                                        <td>{{ $value->rack->rack_number }}</td>
                                        <td><label class="label {{ ($value->status == 1) ? 'label-success' : 'label-danger' }}">{{ ($value->status == 1) ? 'Available' : 'Not Available' }}</label>
                                            
                                        </td>
                                        <td>{{ $value->rack->division->name }}</td>
                                    </tr>
                                @endforeach
                            </table>
                            <br>
                            {{ __('box.page') }} : {{ $box->currentPage() }}
                            <br>
                            {{ __('box.amount_of_data') }} : {{ $box->total() }}
                            <br>
                            {{ __('box.data_perPage') }} : {{ $box->perPage() }}
                            <br>
                            {{ $box->links() }}
                        </div>
                    </div>
               
        </div>
    </div>
</div>

@stop

@section('js')

<script >
  
$(document).ready(function(){
    $('#databox').DataTable();
});


</script>

@endsection