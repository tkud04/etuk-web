<?php
$date = date("m/d/Y");
$ddd = new DateTime($date);
$fmt = "m/d/Y";
$today = $ddd->format($fmt);
$ddd->add(new DateInterval('P1D'));
$tomorrow = $ddd->format($fmt);
?>
<!-- ======================= Start Banner ===================== -->
			<div class="main-banner full" style="background-image:url({{asset('img/banner.jpg')}});" data-overlay="7">
				<div class="container">
					<div class="col-md-12 col-sm-12">
					
						<div class="caption text-center cl-white mb-5">
							<span class="stylish">Rent An Apartment for Short Rest</span>
							<h1>Explore Choice Apartments</h1>
						</div>
						
						<form class="st-search-form-tour icon-frm withlbl" action="{{url('landing-search')}}" id="landing-search-form" method="post">
						{!! csrf_field() !!}
							<div class="g-field-search">
								<div class="row">
									<div class="col-lg-4 col-md-4 border-right mxnbr">
										<div class="form-group">
											<i class="ti-location-pin field-icon"></i>
											<label>Location</label>
											<input type="text" class="form-control" id="landing-search-location" name="location" placeholder="Where are you going?">
										</div>
									</div>
									
									<div class="col-lg-3 col-md-4 border-right mxnbr">
										<div class="form-group">
											<i class="ti-calendar field-icon"></i>
											<label>From - To</label>
											<input type="text" class="form-control check-in-out"id="landing-search-dates" name="dates" value="{{$today}} - {{$tomorrow}}" />
										</div>
									</div>
									
									<div class="col-lg-3 col-md-4 border-right dropdown form-select-guests mnbr">
										<div class="form-group">
											<i class="ti-user field-icon"></i>
											<div class="form-content dropdown-toggle" data-toggle="dropdown">
												<div class="wrapper-more">
													<label>Guests</label>
													<div class="render">
														<span class="adults"><span class="one ">1 Adult</span> <span class=" d-none  multi" data-html=":count Adults">1 Adults</span></span>-
														<span class="children">
															<span class="one " data-html=":count Child">0 Child</span>
															<span class="multi  d-none" data-html=":count Children">0 Children</span>
														</span>
													</div>
												</div>
											</div>
											<div class="dropdown-menu select-guests-dropdown">
												<input type="hidden" name="adults" id="landing-search-adults" value="1" min="1" max="20">
												<input type="hidden" name="children" id="landing-search-kids" value="0" min="0" max="20">
												<div class="dropdown-item-row">
													<div class="label">Adults</div>
													<div class="val">
														<span class="btn-minus" data-input="adults"><i class="ti-minus"></i></span>
														<span class="count-display">1</span>
														<span class="btn-add" data-input="adults"><i class="ti-plus"></i></span>
													</div>
												</div>
												<div class="dropdown-item-row">
													<div class="label">Children</div>
													<div class="val">
														<span class="btn-minus" data-input="children"><i class="ti-minus"></i></span>
														<span class="count-display">0</span>
														<span class="btn-add" data-input="children"><i class="ti-plus"></i></span>
													</div>
												</div>
											</div>
										</div>
									</div>
								
									<div class="col-lg-2 p-0 mp-15">
										<div class="form-group  search">
											<button class="btn btn-theme btn-search" id="landing-search-btn">Book Now</button>
										</div>
									</div>
								</div>
							</div>
						</form>
						
					</div>
				</div>
			</div>
			<!-- ======================= End Banner ===================== -->