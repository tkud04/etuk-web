	<!-- ============================ Newsletter Start ================================== -->
			<section class="alert-wrap pt-5 pb-5" style="background:#be831d url(<?php echo e(asset('img/bg-new.png')); ?>);">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="jobalert-sec">
								<h3 class="mb-1 text-light">Find an apartment</h3>
								<p class="text-light">Filter your search by filling the form below:</p>
							</div>
						</div>
						
						<div class="col-lg-12 col-md-12">
						  <div class="row">
							<div class="col-lg-6 col-md-6">
							<div class="form-group">
							  <label class="mb-1 text-light" for="ssf-apt-type">Apartment type</label>
							  <select class="form-control" id="ssf-apt-type">
							    <option value="none">Select apartment type</option>
								<?php
								foreach($ssf['apartment_types'] as $k => $v)
								{
								?>
								 <option value="<?php echo e($k); ?>"><?php echo e($v); ?></option>
								<?php
								}
								?>
							  </select>
							  </div>
							  <div class="form-group">
							    <label class="mb-1 text-light" for="ssf-apt-type">Beds</label>
							    <input type="text" class="form-control" id="ssf-beds" placeholder="Number of beds">
							  </div>
							 </div>
							 <div class="col-lg-6 col-md-6">
							   <div class="form-group">
							    <label class="mb-1 text-light" for="ssf-apt-type">Location</label>
							    <select class="form-control" id="ssf-location">
							    <option value="none">Select location</option>
								<?php
								foreach($ssf['locations'] as $l)
								{
								?>
								 <option value="<?php echo e($l); ?>"><?php echo e($l); ?></option>
								<?php
								}
								?>
							  </select>
							   </div>
							    <div class="form-group">
							      <label class="mb-1 text-light" for="ssf-amount">Budget</label>
								  <?php
								   $lowest = $priceRange['lowest'];
								   $highest = $priceRange['highest'];
								  ?>
							      <p class="form-control-plaintext text-light">&#8358;<span id="ssf-amount-display"><?php echo e($lowest); ?></span></p>
								  <div class="row">
								    <div class="col-lg-2 col-md-2">
								      <label class="mt-3 text-light">&#8358;<span id="ssf-min"><?php echo e($lowest); ?></span></label>
									</div>
									<div class="col-lg-8 col-md-8">
							          <input type="range" class="form-control" id="ssf-amount" min="<?php echo e($lowest); ?>" max="<?php echo e($highest); ?>" value="<?php echo e($lowest); ?>" step="500">
								    </div>
									<div class="col-lg-2 col-md-2">
									  <label class="mt-3 text-light">&#8358;<span id="ssf-max"><?php echo e($highest); ?></span></label>
									</div>
							      </div>
							    </div>
							</div>
							<div class="col-lg-12 col-md-12">
							  <button type="button" class="btn btn-black black" id="ssf-btn">Submit</button>
							  
							</div>
						   </div>
						</div>
					</div>
				</div>
			</section>
			<!-- ============================ Newsletter End ================================== -->			
<?php /**PATH C:\bkupp\lokl\repo\etuk-web\resources\views/special-search-filter.blade.php ENDPATH**/ ?>