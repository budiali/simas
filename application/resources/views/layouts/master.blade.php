<!DOCTYPE html>
<html lang="en">

<head>
	@yield('title')

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">

	<link rel="stylesheet" href="{{asset('admin/assets/vendor/bootstrap/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('admin/assets/vendor/font-awesome/css/font-awesome.min.css')}}">
	<link rel="stylesheet" href="{{asset('admin/assets/vendor/linearicons/style.css')}}">
	<link rel="stylesheet" href="{{asset('admin/assets/vendor/chartist/css/chartist-custom.css')}}">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="{{asset('admin/assets/css/main.css')}}">
	
	
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="{{asset('admin/assets/css/demo.css')}}">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="{{asset('admin/assets/img/apple-icon.png')}}">
	<link rel="icon" type="image/png" sizes="96x96" href="{{asset('admin/assets/img/favicon.ico')}}">
	<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

        
	@yield('css')

</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="brand">
				<a href="{{ route('document.index') }}"><img src="{{asset('admin/assets/img/logo-khz3.png')}}" alt="Klorofil Logo" class="img-responsive logo"></a>
			</div>
			<div class="container-fluid">
				<div class="navbar-btn">
					<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
				</div>

				<div id="navbar-menu">
					
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="{{asset('admin/assets/img/user.png')}}" class="img-circle" alt="Avatar"> <span>{{ Auth::user()->name }}</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
							<ul class="dropdown-menu">
						@hasanyrole('administrator|manager|staff')
							<li><a href="/user/profile/{{Auth::user()->id}}"><i class="lnr lnr-user"></i> <span>My Profile</span></a></li>
								<li><a href="{{route('user.changePasswordForm')}}"><i class="lnr lnr-lock"></i><span>Change Password</span></a></li>
								<li><a href="/user/edit/{{Auth::user()->id}}"><i class="lnr lnr-cog"></i> <span>Settings Profile</span></a></li>

								<li><a href="{{ route('logout') }}"  onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="lnr lnr-exit"></i> <span>{{ __('Logout') }} </span></a><form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form></li>
							</ul>
						</li>
						@endhasanyrole
					</ul>
				</div>



			</div>
		</nav>
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
		<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						<li><a href="{{route('dashboard.index')}}" class="active"><i class="lnr lnr-home"></i> <span>DASHBOARD</span></a></li>
						@hasanyrole('administrator|manager|staff')
                        <li>
							<a href="#subPagesDocument" data-toggle="collapse" class="collapsed"><i class="lnr lnr-list"></i> <span>{{ __('master.documents')}}</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPagesDocument" class="collapse ">
								<ul class="nav">
									@can('Show Documents')
									<li><a href="{{route('document.index')}}" class="">{{ __('master.data_document') }}</a></li>
									@endcan
									@can('Create Documents')
									<li><a href="/document/add_document" class="">{{ __('master.create_new_document') }}</a></li>
									@endcan
									@can('Show Trash Documents')
                                    <li><a href="/document/trash" class="">{{ __('master.trash_document') }}</a></li>
                                    @endcan
                                </ul>
							</div>
						</li>
					
						<li>
							<a href="#subPagesRack" data-toggle="collapse" class="collapsed"><i class="lnr lnr-dice"></i> <span>{{ __('master.racks')}}</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPagesRack" class="collapse ">
								<ul class="nav">
									@can('Show Racks')
									<li><a href="{{route('rack.index')}}" class="">{{ __('master.data_racks') }}</a></li>
									@endcan
									@hasanyrole('administrator|manager')
										@can('Create Racks')
									<li><a href="/rack/add_rack" class="">{{ __('master.create_new_racks') }}</a></li>
										@endcan
									@endhasanyrole
                                </ul>
							</div>
						</li>

						<li>
							<a href="#subPagesBox" data-toggle="collapse" class="collapsed"><i class="lnr lnr-license"></i> <span>{{ __('master.box')}}</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPagesBox" class="collapse ">
								<ul class="nav">
								@can('Show Box')
								<li><a href="{{route('box.index')}}" class="">{{ __('master.data_box') }}</a></li>
								@endcan
									<!-- <li><a href="#" class="">Add New Box</a></li> -->
                                </ul>
							</div>
						</li>
                        @endhasanyrole

                        @hasanyrole('administrator|manager')
						<li>
							<a href="#subPagesUsers" data-toggle="collapse" class="collapsed"><i class="lnr lnr-users"></i> <span>{{ __('master.users')}}</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPagesUsers" class="collapse ">
								<ul class="nav">
									@can('Show Users')
									<li><a href="{{ route('user.index') }}" class="">{{ __('master.data_user')}}</a></li>
									@endcan
									@can('Create Users')
	                                <li><a href="{{ route('user.create') }}" class="">{{ __('master.create_new_user')}}</a></li>
	                                @endcan
                                </ul>
							</div>
						</li>
						@endhasanyrole
						@role('administrator')
						<li>
							<a href="#subPagesDivision" data-toggle="collapse" class="collapsed"><i class="lnr lnr-license"></i> <span>{{ __('master.division')}}</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPagesDivision" class="collapse ">
								<ul class="nav">
									@can('Show Division')
									<li><a href="{{route('division.index')}}" class="">{{ __('master.data_divisi')}}</a></li>	
									@endcan
									@can('Create Division')
									<li><a href="/division/add_division" class="">{{ __('master.create_new_divisi')}}</a></li>
									@endcan
                                </ul>
							</div>
						</li>
                        <li>
							<a href="#subPagesRoles" data-toggle="collapse" class="collapsed"><i class="lnr lnr-license"></i> <span style="font-size: 14px;">{{ __('master.permission_settings')}}</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPagesRoles" class="collapse ">
								<ul class="nav">

								<li><a href="{{route('role.index')}}" class="">{{ __('master.roles')}}</a></li>
							
								<li><a href="{{ route('user.roles_permission') }}" class="">{{ __('master.roles_permissions')}}</a></li>
					
                                </ul>
							</div>
						</li>
						@endrole
					</ul>
				</nav>
			</div>
		</div>
		<!-- END LEFT SIDEBAR -->
		<!-- MAIN Content-->
		@yield('content')
		<!-- END MAIN Content-->
		<div class="clearfix"></div>
		<footer>
			<div class="container-fluid">
				<p class="copyright">Shared by <i class="fa fa-love"></i><a href="https://bootstrapthemes.co">BootstrapThemes</a>
</p>
			</div>
		</footer>
	</div>
	<!-- END WRAPPER -->
	<!-- Javascript -->
	<script src="{{asset('admin/assets/vendor/jquery/jquery.min.js')}}"></script>
	<script src="{{asset('admin/assets/vendor/moment/moment.min.js')}}"></script>
	<script src="{{asset('admin/assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script>

	<script src="{{asset('admin/assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
	<script src="{{asset('admin/assets/scripts/klorofil-common.js')}}"></script>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
	
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	<script>
		@if(Session::has('success'))
			toastr.success("{{Session::get('success')}}", "Success!")
		@endif

		@if(Session::has('error'))
			toastr.error("{{Session::get('error')}}", 'Whoops!')
		@endif
	</script>
	

	
	@yield('js')


</body>

</html>
