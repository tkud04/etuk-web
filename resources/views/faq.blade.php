<?php
$title = "FAQ";
$subtitle = "Frequently Asked Questions";

$name = "";
$em = "";

if($user != null)
{
	$name = $user->fname." ".$user->lname;
	$em = $user->email;
}
?>
@extends('layout')

@section('title',$title)

@section('top-header')
@include('top-header')
@stop

@section('content')
@include('banner-2',['title' => $subtitle,'subtitle' => $subtitle])

<!-- ================= FAQ ================= -->
			<section>
				<div class="container">
				
					<div class="row">
						
						<?php
								
								foreach($contacts as $ct)
								{
								?>
						    <div class="col-lg-4 col-md-4">
							<div class="contact-box">
								
								
								<h4>{{$ct['designation']}}</h4>
								{{$ct['name']}}<br>
								<i class="ti-email"></i> <a style="margin-bottom: 10px;" href="mailto:{{$ct['email']}}">{{$ct['email']}}</a><br>
								<i class="ti-headphone"></i> <a style="margin-bottom: 10px;" href="tel:{{$ct['phone']}}">{{$ct['phone']}}</a>
							</div>
						</div>
						  <?php
								}
						  ?>
						
					</div>
					
					<div class="row">
						
						<div class="col-lg-10 col-md-12 col-sm-12">
							
							<div class="block-header">
								<ul class="nav nav-tabs customize-tab" id="myTab" role="tablist">
								  <li class="nav-item">
									<a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true">General</a>
								  </li>
								  
								  <li class="nav-item">
									<a class="nav-link" id="payment-tab" data-toggle="tab" href="#payment" role="tab" aria-controls="payment" aria-selected="false">Payment</a>
								  </li>
								  
								  <li class="nav-item">
									<a class="nav-link" id="upgrade-tab" data-toggle="tab" href="#upgrade" role="tab" aria-controls="upgrade" aria-selected="false">Upgrade</a>
								  </li>
								  
								</ul>
							</div>
							
							<div class="tab-content" id="myTabContent">
								
								<!-- general Query -->
								<div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
									
									<div class="accordion" id="generalac">
										<div class="card">
											<div class="card-header" id="headingOne">
											  <h2 class="mb-0">
												<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
												  How To Install Rikada Theme?
												</button>
											  </h2>
											</div>

											<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#generalac">
											  <div class="card-body">
												<p class="ac-para">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
											  </div>
											</div>
										</div>
										<div class="card">
											<div class="card-header" id="headingTwo">
											  <h2 class="mb-0">
												<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
												  What is main Requirements For Rikada?
												</button>
											  </h2>
											</div>
											<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#generalac">
											  <div class="card-body">
												<p class="ac-para">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
											  </div>
											</div>
										</div>
										<div class="card">
											<div class="card-header" id="headingThree">
											  <h2 class="mb-0">
												<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
												  Why Choose Rikada Theme?
												</button>
											  </h2>
											</div>
											<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#generalac">
											  <div class="card-body">
												<p class="ac-para">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
											  </div>
											</div>
										</div>
									</div>
									
								</div>
								
								<!-- general Query -->
								<div class="tab-pane fade" id="payment" role="tabpanel" aria-labelledby="payment-tab">
									
									<div class="accordion" id="paymentac">
										<div class="card">
											<div class="card-header" id="headingOne1">
											  <h2 class="mb-0">
												<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#paymentcollapse" aria-expanded="true" aria-controls="paymentcollapse">
												  May I Request For Refund?
												</button>
											  </h2>
											</div>

											<div id="paymentcollapse" class="collapse show" aria-labelledby="headingOne1" data-parent="#paymentac">
											  <div class="card-body">
												<p class="ac-para">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
											  </div>
											</div>
										</div>
										<div class="card">
											<div class="card-header" id="headingTwo1">
											  <h2 class="mb-0">
												<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#paymentcollapseTwo" aria-expanded="false" aria-controls="paymentcollapseTwo">
												  May I Get Any Offer in Future?
												</button>
											  </h2>
											</div>
											<div id="paymentcollapseTwo" class="collapse" aria-labelledby="headingTwo1" data-parent="#paymentac">
											  <div class="card-body">
												<p class="ac-para">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
											  </div>
											</div>
										</div>
										<div class="card">
											<div class="card-header" id="headingThree1">
											  <h2 class="mb-0">
												<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#paymentcollapseThree" aria-expanded="false" aria-controls="paymentcollapseThree">
												  How Much Time It will Take For refund?
												</button>
											  </h2>
											</div>
											<div id="paymentcollapseThree" class="collapse" aria-labelledby="headingThree1" data-parent="#paymentac">
											  <div class="card-body">
												<p class="ac-para">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
											  </div>
											</div>
										</div>
									</div>
									
								</div>
								
								<!-- general Query -->
								<div class="tab-pane fade" id="upgrade" role="tabpanel" aria-labelledby="upgrade-tab">
									
									<div class="accordion" id="upgradeac">
										<div class="card">
											<div class="card-header" id="headingOne2">
											  <h2 class="mb-0">
												<button class="btn btn-link" type="button" data-toggle="collapse" data-target="#upgradecollapseOne" aria-expanded="true" aria-controls="upgradecollapseOne">
												  How To Upgrade Rikada Theme?
												</button>
											  </h2>
											</div>

											<div id="upgradecollapseOne" class="collapse show" aria-labelledby="headingOne2" data-parent="#upgradeac">
											  <div class="card-body">
												<p class="ac-para">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
											  </div>
											</div>
										</div>
										<div class="card">
											<div class="card-header" id="headingTwo2">
											  <h2 class="mb-0">
												<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#upgradecollapseTwo" aria-expanded="false" aria-controls="upgradecollapseTwo">
												  Rikada available for WordPress Version?
												</button>
											  </h2>
											</div>
											<div id="upgradecollapseTwo" class="collapse" aria-labelledby="headingTwo2" data-parent="#upgradeac">
											  <div class="card-body">
												<p class="ac-para">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
											  </div>
											</div>
										</div>
										<div class="card">
											<div class="card-header" id="headingThree2">
											  <h2 class="mb-0">
												<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#upgradecollapseThree" aria-expanded="false" aria-controls="upgradecollapseThree">
												  Why We need to upgrade Rikada?
												</button>
											  </h2>
											</div>
											<div id="upgradecollapseThree" class="collapse" aria-labelledby="headingThree2" data-parent="#upgradeac">
											  <div class="card-body">
												<p class="ac-para">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
											  </div>
											</div>
										</div>
									</div>
									
								</div>
							
							</div>
							
						</div>
						
					</div>
				</div>
			</section>
			<!-- ================= FAQ ================= -->
@stop