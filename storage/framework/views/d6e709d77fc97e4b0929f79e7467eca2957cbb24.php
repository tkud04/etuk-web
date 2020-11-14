<?php
$def = [
  'avb' => "available",
  'city' => "",
  'state' => "none",
  'amount' => "0",
  'rating' => "4",
  'id_required' => "yes",
  'children' => "none",
  'pets' => "no",
  'max_adults' => "4",
  'max_children' => "0",
  'facilities' => []
];

if(count($apf) < 1) $apf = $def;
?>
<div class="order-2 col-lg-4 col-md-12 order-lg-1 order-md-2">
						
							<!-- property Sidebar -->
							<div class="exlip-page-sidebar">
								
								<!-- Find New Property -->
								<div class="sidebar-widgets">
									
									<div style=" margin-bottom: 5px;">
									<div class="form-group">
									   <label>Availability:</label>
										<div class="input-with-icon">
											<select id="guest-apt-sidebar-avb" class="form-control">
												<option value="">Select availability</option>
												<?php
												$avbs = ['available' => "Available",'occupied' => "Occupied",'booked' => "Booked"];
												foreach($avbs as $k => $v)
												{
												  $ss = $apf['avb'] == $k ? " selected='selected'" : "";
												?>
												<option value="<?php echo e($k); ?>"<?php echo e($ss); ?>><?php echo e(ucwords($v)); ?></option>
												<?php
												}
												?>
											</select>
											<i class="ti-briefcase"></i>
										</div>
									</div>
									
									<div class="form-group">
									   <label>City:</label>
										<div class="input-with-icon">
											<input id="guest-apt-sidebar-city" value="<?php echo e($apf['city']); ?>" type="text" class="form-control" placeholder="City">
											<i class="ti-location-pin"></i>
										</div>
									</div>
									
									<div class="form-group">
									   <label>State:</label>
										<div class="input-with-icon">
											<select id="guest-apt-sidebar-state" class="form-control">
												<option value="">Select state</option>
												<?php
												foreach($states as $k => $v)
												{
												  $ss = $apf['state'] == $k ? " selected='selected'" : "";
												?>
												<option value="<?php echo e($k); ?>"<?php echo e($ss); ?>><?php echo e(ucwords($v)); ?></option>
												<?php
												}
												?>
											</select>
											<i class="ti-briefcase"></i>
										</div>
									</div>
									
									<div class="form-group">
									   <label>Min. price (&#8358;)</label>
										<div class="input-with-icon">
											<input id="guest-apt-sidebar-amount" value="<?php echo e($apf['amount']); ?>" type="number" class="form-control" placeholder="Amount (NGN)">
											<i class="ti-credit-card"></i>
										</div>
									</div>
									
									<div class="form-group">
									   <label>ID Required:</label>
										<div class="input-with-icon">
											<select id="guest-apt-sidebar-id-required" class="form-control">
												<option value="none">ID Required?</option>
												   <?php
												   $ir = ['yes' => "Yes",'no' => "No"];
												   foreach($ir as $key => $value)
												   {
													   $ss = $apf['id_required'] == $key ? " selected='selected'" : "";
												  ?>
												    <option value="<?php echo e($key); ?>"<?php echo e($ss); ?>><?php echo e($value); ?></option>
												  <?php
												   }
												  ?>
											</select>
											<i class="ti-briefcase"></i>
										</div>
									</div>
									
									<div class="form-group">
									   <label>Children allowed:</label>
										<div class="input-with-icon">
											<select id="guest-apt-sidebar-children" class="form-control">
												  <option value="none"></option>
												   <?php
												   $ic = ['none' => "No children allowed",
												          '1-5yrs' => "1-5yrs",
														  '6-10yrs' => "6-10yrs",
														  '11-20yrs' => "11-20yrs",
														  '>20yrs' => ">20yrs",
														  'all' => "All children allowed",
														 ];
												   foreach($ic as $key => $value)
												   {
													   $ss = $apf['children'] == $key ? " selected='selected'" : "";
												  ?>
												    <option value="<?php echo e($key); ?>"<?php echo e($ss); ?>><?php echo e($value); ?></option>
												  <?php
												   }
												  ?>
											</select>
											<i class="ti-briefcase"></i>
										</div>
									</div>
									
									<div class="form-group">
									   <label>Pets allowed:</label>
										<div class="input-with-icon">
											<select id="guest-apt-sidebar-pets" class="form-control">
												<option value="none"></option>
												<?php
												   $ipt = ['yes' => "Pets allowed",
														  'no' => "No pets allowed",
														 ];
												   foreach($ipt as $key => $value)
												   {
													   $ss = $apf['pets'] == $key ? " selected='selected'" : "";
												  ?>
												    <option value="<?php echo e($key); ?>"<?php echo e($ss); ?>><?php echo e($value); ?></option>
												  <?php
												   }
												  ?>
											</select>
											<i class="ti-briefcase"></i>
										</div>
									</div>
									
									<div class="form-group">
									   <label>Max. adults</label>
										<div class="input-with-icon">
											<input id="guest-apt-sidebar-max-adults" value="<?php echo e($apf['max_adults']); ?>" type="number" class="form-control" placeholder="Max. adults allowed">
											<i class="ti-user"></i>
										</div>
									</div>
									
									<div class="form-group">
									   <label>Max. children</label>
										<div class="input-with-icon">
											<input id="guest-apt-sidebar-max-children" value="<?php echo e($apf['max_children']); ?>" type="number" class="form-control" placeholder="Max. children allowed">
											<i class="ti-user"></i>
										</div>
									</div>
									
									<div class="ameneties-features mt-5">
										<label>Show apartments with:</label>
										<ul class="no-ul-list">
										   <?php
										    foreach($services as $s)
											{
												$cc = "";
												foreach($facilities as $ff)
												{
													if($ff['facility'] == $s['tag']) $cc = " checked"; 
												}
										   ?>
											<li>
												<input id="guest-apt-sidebar-<?php echo e($s['tag']); ?>" class="guest-apt-sidebar-facility" data-tag="<?php echo e($s['tag']); ?>" class="checkbox-custom" name="guest-apt-sidebar-<?php echo e($s['tag']); ?>" type="checkbox"<?php echo e($cc); ?>>
												<label for="guest-apt-sidebar-<?php echo e($s['tag']); ?>" class="checkbox-custom-label"><?php echo e(ucwords($s['name'])); ?></label>
											</li>
											<?php
											}
											?>
										</ul>
									
									</div>
									
									<div class="range-slider mt-5">
										<label>Show apartments with</label>
										<div class="distance-title">a rating of at least <span class="theme-cl"></span> stars</div>
										<input id="guest-apt-sidebar-rating" class="distance-radius rangeslider--horizontal" type="range" min="1" max="5" step="1" value="<?php echo e($apf['rating']); ?>" data-title="Rating of at least">
									</div>
									<form method="get" id="guest-apt-sidebar-form" action="search">
									  <input type="hidden" name="dt" id="guest-apt-sidebar-dt">
									</form>
									</div>
									<center>
									<a class="btn btn-theme" href="javascript:void(0)" id="guest-apt-sidebar-submit">SUBMIT</a>
							        </center>
								</div>
							</div>
						</div>
						<!-- Sidebar End --><?php /**PATH C:\bkupp\lokl\repo\etuk-web\resources\views/guest-apt-sidebar.blade.php ENDPATH**/ ?>