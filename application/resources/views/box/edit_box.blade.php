@extends('layouts.master')
@section('content')

<div class="main">
	<div class="main-content">
		<div class="container-fluid">
			<nav aria-label="breadcrumb">
                              <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/rack/detail/{{$box->rack->id}}"><span class="lnr lnr-arrow-left-circle"> Back</span></a></li>
                              </ol>
                            </nav>

			            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                
                                {{ __('box.edit_box')}} :{{ __('rack.rack_number')}} {{' [ '.$box -> rack -> rack_number.' ] / Division [ '.$box -> rack -> division -> name.' ]' }}
                            </h3>
                        </div>
                        <div class="panel-body">
                            <form action="/box/update/{{$box->id}}" method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="box_number">{{__('document.box_number')}}</label>
                                <input type="text" name="box_number" value="{{$box->box_number}}" class="form-control" readonly="">
                                    @if($errors -> has('box_number'))
                                        <div class="text-danger">
                                            {{ $errors -> first('box_number') }}
                                        </div>
                                    @endif
                                </div>
                             	<div class="form-group">
                             		<label for="from">{{__('box.from')}}</label>

                             		<div class="input-group date" id="datetimepicker2">	
                                      <input type="text" name="from" class="form-control" value="{{$box->from}}">
                                    @if($errors -> has('from'))
                                        <div class="text-danger">
                                            {{ $errors -> first('from') }}
                                        </div>
                                    @endif
                                    <span class="input-group-addon">
										<span class="glyphicon glyphicon-calendar"></span>
									</span>	
                             		</div>
                                </div>

                                <div class="form-group">
                                    <label for="to">{{__('box.to')}}</label>
                                    <div class="input-group date" id="datetimepicker3">
                                    	
                                    <input type="text" name="to" class="form-control" value="{{$box->to}}">
                                    @if($errors -> has('to'))
                                        <div class="text-danger">
                                            {{ $errors -> first('to') }}
                                        </div>
                                    @endif
                                    
                                    <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                    <span>
                                    </div>
                                </div>
                                <div class="form-group">
                                  
                                <input type="hidden" name="rack_id" value="{{$box -> rack -> id}}" class="form-control" readonly>
                                    @if($errors -> has('rack_id'))
                                        <div class="text-danger">
                                            {{ $errors -> first('rack_id') }}
                                        </div>
                                    @endif
                                </div>

                                @hasanyrole('administrator|manager')
                                @can('Update Box')
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-xs"><span class="lnr lnr-location"> Update</span></button>
                                </div>
                                @endcan
                                @endhasanyrole

                            </form>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>

@stop

@section('js')

<script type="text/javascript">
	
	$(document).ready(function(){

		$('#datetimepicker2').datetimepicker({
			format: "YYYY/MM/DD"
		});

		$('#datetimepicker3').datetimepicker({
			format: "YYYY/MM/DD"
		});

	});

</script>

@endsection