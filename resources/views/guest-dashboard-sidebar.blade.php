<div class="col-lg-3 col-md-4 col-sm-12">
							<div class="dashboard-navbar">
								
								<div class="d-user-avater">
									<img src="{{asset('img/user-2.jpg')}}" class="img-fluid avater" alt="">
									<h4>{{$user->fname." ".$user->lname}}</h4>
									<span>{{strtoupper($user->role)}}</span>
								</div>
								
								<div class="d-navigation">
									<ul>
										<li class="active"><a href="dashboard.html"><i class="ti-dashboard"></i>Dashboard</a></li>
										<li><a href="{{url('profile')}}"><i class="ti-user"></i>My Profile</a></li>
										<li><a href="{{url('history')}}"><i class="ti-layers"></i>Transaction History</a></li>
										<li><a href="{{url('saved-items')}}"><i class="ti-heart"></i>Saved Items</a></li>
										<li><a href="{{url('change-password')}}"><i class="ti-unlock"></i>Change Password</a></li>
										<li><a href="{{url('logout')}}"><i class="ti-power-off"></i>Log Out</a></li>
									</ul>
								</div>
								
							</div>
						</div>