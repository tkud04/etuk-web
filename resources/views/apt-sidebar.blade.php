<?php
$img = ""; $ii = "images";
$imgs = []; $video = [];

if(count($media) > 0)
{
	$rawImgs = $media['images'];
$imgs = $cmedia['images'];
$video = $cmedia['video'];
  $img = $imgs[0];
  if(count($imgs) == 1) $ii = "image";
}

?>
<div class="checkout-side">
							
								<div class="booking-short">
									<img src="{{$img}}" class="img-fluid" alt="" />
									<h4>Cover Image</h4>
									<span>{{count($imgs)." ".$ii}}</span>
								</div>
								
								<div class="booking-short-side">
									<div class="accordion" id="accordionExample">
										<div class="card">
											<div class="card-header" id="bookinDet">
											  <h2 class="mb-0">
												<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#bookinSer" aria-expanded="true" aria-controls="bookinSer">
												  Terms
												</button>
											  </h2>
											</div>

											<div id="bookinSer" class="collapse show" aria-labelledby="bookinDet" data-parent="#accordionExample">
												<div class="card-body">
													<ul class="booking-detail-list">
														<li>Check in from: <span id="apt-sidebar-checkin"></span></li>
														<li>Check out by: <span id="apt-sidebar-checkout"></span></li>
														<li>Max adults: <span id="apt-sidebar-max-adults"></span></li>
														<li>Max children: <span id="apt-sidebar-max-children"></span></li>
														<li>Payment type: <span id="apt-sidebar-payment-type"></span></li>
														<li>ID required on check-in: <span id="apt-sidebar-id-required"></span></li>
														<li>Children: <span id="apt-sidebar-children"></span></li>
														<li>Pets allowed: <span id="apt-sidebar-pets"></span></li>
													</ul>
												</div>
											</div>
										</div>
										
										<div class="card">
											<div class="card-header" id="extraFeat">
											  <h2 class="mb-0">
												<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#extraSer" aria-expanded="false" aria-controls="extraSer">
												 Facilities
												</button>
											  </h2>
											</div>
											<div id="extraSer" class="collapse" aria-labelledby="extraFeat" data-parent="#accordionExample">
												<div class="card-body">
													<ul class="booking-detail-list" id="apt-sidebar-facilities">
														<li>None specified</li>
													</ul>
												</div>
											</div>
										  </div>
										
									</div>
								</div>
								
							</div>