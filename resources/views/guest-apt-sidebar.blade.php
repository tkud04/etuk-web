<div class="order-2 col-lg-4 col-md-12 order-lg-1 order-md-2">
						
							<!-- property Sidebar -->
							<div class="exlip-page-sidebar">
								
								<!-- Find New Property -->
								<div class="sidebar-widgets">
									
									<div class="form-group">
										<div class="input-with-icon">
											<input id="guest-apt-sidebar-city" type="text" class="form-control" placeholder="City">
											<i class="ti-location-pin"></i>
										</div>
									</div>
									
									<div class="form-group">
										<div class="input-with-icon">
											<select id="guest-apt-sidebar-state" class="form-control">
												<option value="">Select state</option>
												@foreach($states as $k => $v)
												<option value="{{$k}}">{{ucwords($v)}}</option>
												@endforeach
											</select>
											<i class="ti-briefcase"></i>
										</div>
									</div>
									
									<div class="form-group">
										<div class="input-with-icon">
											<input id="guest-apt-sidebar-dates" type="text" class="form-control check-in-out" name="dates" value="{{date('m/d/Y')}} - 01/15/2018" />
											<i class="ti-calendar"></i>
										</div>
									</div>
									
									
									<!--
									<div class="range-slider">
										<label>Radius</label>
										<div class="distance-title">around selected destination <span class="theme-cl"></span> km</div>
										<input class="distance-radius rangeslider--horizontal" type="range" min="1" max="100" step="1" value="1" data-title="Radius around selected destination">
									</div>
                                    -->
									<div class="ameneties-features mt-5">
										<label>Show apartments with:</label>
										<ul class="no-ul-list">
										   <?php
										    foreach($services as $s)
											{
										   ?>
											<li>
												<input id="guest-apt-sidebar-{{$s['tag']}}" class="guest-apt-sidebar-facility" data-tag="{{$s['tag']}}" class="checkbox-custom" name="guest-apt-sidebar-{{$s['tag']}}" type="checkbox">
												<label for="guest-apt-sidebar-{{$s['tag']}}" class="checkbox-custom-label">{{ucwords($s['name'])}}</label>
											</li>
											<?php
											}
											?>
										</ul>
									
									</div>
									
									<div class="range-slider mt-5">
										<label>Show apartments with</label>
										<div class="distance-title">a rating of at least <span class="theme-cl"></span> stars</div>
										<input id="guest-apt-sidebar-rating" class="distance-radius rangeslider--horizontal" type="range" min="1" max="5" step="1" value="1" data-title="Rating of at least">
									</div>
									<form method="get" id="guest-apt-sidebar-form" action="search">
									  <input type="hidden" name="dt" id="guest-apt-sidebar-dt">
									</form>
									<center>
									<a class="btn btn-theme" href="javascript:void(0)" id="guest-apt-sidebar-submit">SUBMIT</a>
							        </center>
								</div>
							</div>
						</div>
						<!-- Sidebar End -->