@extends('layouts.master')
@section('content')

<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="panel panel-profile">
                    <div class="clearfix">
							<!-- LEFT COLUMN -->
							<div class="profile-left">
								<!-- PROFILE HEADER -->
								<div class="profile-header">
									<div class="overlay"></div>
									<div class="profile-main">
										<img src="{{asset('admin/assets/img/user-medium.png')}}" class="img-circle" alt="Avatar">
                                        <h3 class="name">{{Auth::user()->name}}</h3>
                                        
										
                                            @if($userProfile->isOnline())
                                            <span class="label label-success">
                                                    Online
                                            </span>
                                            @else
                                            <span class="label label-default">
                                                    Offline
                                            </span> 
                                            @endif
                                        
									</div>
									<!-- <div class="profile-stat">
										<div class="row">
											<div class="col-md-4 stat-item">
												45 <span>Projects</span>
											</div>
											<div class="col-md-4 stat-item">
												15 <span>Awards</span>
											</div>
											<div class="col-md-4 stat-item">
												2174 <span>Points</span>
											</div>
										</div>
									</div> -->
								</div>
								<!-- END PROFILE HEADER -->
								<!-- PROFILE DETAIL -->
								<div class="profile-detail">
									<div class="profile-info">
										<h4 class="heading">Basic Info</h4>
										<ul class="list-unstyled list-justify">
											<li>Name <span>{{Auth::user()->name}}</span></li>
											<li>Role <span>{{Auth::user()->roles->first()->name}}</span></li>
                                            <li>Company <span>{{$company}}</span></li>
											<li>Email <span>{{Auth::user()->email}}</span></li>
											
										</ul>
									</div>
								
									<div class="profile-info">
										<h4 class="heading">About</h4>
										<p>Interactively fashion excellent information after distinctive outsourcing.</p>
									</div>
									<div class="text-center"><a href="/user/edit_profile/{{Auth::user()->id}}" class="btn btn-xs btn-warning">Edit Profile</a></div>
								</div>
								<!-- END PROFILE DETAIL -->
							</div>
							<!-- END LEFT COLUMN -->
							<!-- RIGHT COLUMN -->
							<div class="profile-right">
								<h4 class="heading">{{Auth::user()->name}} Awards</h4>
								<!-- AWARDS -->
								<div class="awards">
									<div class="row">
										<div class="col-md-3 col-sm-6">
											<div class="award-item">
												<div class="hexagon">
													<span class="lnr lnr-sun award-icon"></span>
												</div>
												<span>Most Bright Idea</span>
											</div>
										</div>
										<div class="col-md-3 col-sm-6">
											<div class="award-item">
												<div class="hexagon">
													<span class="lnr lnr-clock award-icon"></span>
												</div>
												<span>Most On-Time</span>
											</div>
										</div>
										<div class="col-md-3 col-sm-6">
											<div class="award-item">
												<div class="hexagon">
													<span class="lnr lnr-magic-wand award-icon"></span>
												</div>
												<span>Problem Solver</span>
											</div>
										</div>
										<div class="col-md-3 col-sm-6">
											<div class="award-item">
												<div class="hexagon">
													<span class="lnr lnr-heart award-icon"></span>
												</div>
												<span>Most Loved</span>
											</div>
										</div>
									</div>
									<div class="text-center"><a href="#" class="btn btn-default">See all awards</a></div>
								</div>
								<!-- END AWARDS -->
								<!-- TABBED CONTENT -->
								
								<!-- END TABBED CONTENT -->
							</div>
							<!-- END RIGHT COLUMN -->
						</div>
					                
            </div>
        </div>
    </div>
</div>

@endsection