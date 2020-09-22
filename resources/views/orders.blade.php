@extends('layout')

@section('title',"Orders")

@section('styles')
  <!-- DataTables CSS -->
  <link href="lib/datatables/css/buttons.bootstrap.min.css" rel="stylesheet" /> 
  <link href="lib/datatables/css/buttons.dataTables.min.css" rel="stylesheet" /> 
  <link href="lib/datatables/css/dataTables.bootstrap.min.css" rel="stylesheet" /> 
@stop

@section('content')
<?php
$legendText = count($orders) > 0 ? "enter your reference number below" : "sign in to view your orders OR enter your reference number below";
?>
   <!--start of middle sec-->
<div class="middle-sec wow fadeIn animated animated" data-wow-offset="10" data-wow-duration="2s" style="visibility: visible; animation-duration: 2s;">
    <div class="page-header">
      <div class="container text-center">
        <h2 class="text-primary text-uppercase">your orders</h2>
		@if(isset($wext) && !is_null($wext))
        <h3 class="text-info">Your request has been received, you will be notified via email shortly if your payment has been cleared.</h3>
	    @endif
      </div>
    </div>
    <section class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="row">
            <div class="col-sm-12">
              <div class="inner-ad">
                <figure>
                  <figure><img class="img-responsive" src="{{$ad}}" width="1170" height="100" alt=""></figure>
                </figure>
              </div>
            </div>
            <div class="col-sm-12">
              <ol class="breadcrumb dashed-border row">
                <li><a href="{{url('/')}}">Home</a></li>
                <li class="active">your orders</li>
              </ol>
            </div>
			<div class="col-sm-12">
			      <form role="form" action="{{url('anon-order')}}" method="get">
					
					  <fieldset class="col-md-12">
                        <legend>{{$legendText}}</legend>
                        
                        <!-- Name -->
                         <div class="row">
                          <div class="col-sm-12 form-group">
                            <label class="control-label" for="ref">Reference #</label>
                            <input type="text" id="ref" name="ref" placeholder="Enter your reference number" class="form-control">
						  </div>
						 
                         </div>
					 </fieldset>
					 
					 <div class="row" style="margin-bottom: 20px;">
					  <div class="col-sm-12">
					    <input type="submit" class="btn btn-primary" value="Submit">
					  </div>
					</div>
				  </form>
			    </div>
			@if(count($orders) > 0)
				<br>
            <!--start of columns-->
            <div class="col-sm-12">
              <div class="row extra-btm-padding">
                <div class="table-responsive m-t-40 wow fadeInUp">
                	   <table class="table ace-table">
				   <thead>
                        <tr>
                                    <th>Date</th>
                                    <th>Reference #</th>
                                    <th>Items</th>
                                    <th>Amount</th>
                                    <th>Payment code</th>
                                    <th>Status</th>                                                                       
                                    <th>Actions</th>                                                                       
                                </tr>
                       </thead>
					<tbody>
					<?php
					  if(count($orders) > 0)
					  {
						 foreach($orders as $o)
						 {
							 $items = $o['items'];
							 $totals = $o['totals'];
							 $statusClass = $o['status'] == "paid" ? "success" : "danger";
							 $uu = "#";
							 $vpu = url('confirm-payment')."?oid=".$o['reference'];
							 $tru = url('track')."?o=".$o['reference'];
							 $iu = url('receipt')."?r=".$o['reference'];
				    ?>
					 <tr>
					   <td>{{$o['date']}}</td>
					   <td>{{$o['reference']}}</td>
					    <td>
						<?php
						 foreach($items as $i)
						 {
							   $product = $i['product'];
							   $sku = $product['sku'];
							   $name = $product['name'];
							   $pu = url('product')."?sku=".$product['sku'];
							   $img = $product['imggs'][0];
							 
							 $qty = $i['qty'];
						 ?>
						 
						 <a href="{{$pu}}" target="_blank">
						   <img class="img img-fluid" src="{{$img}}" alt="{{$sku}}" height="80" width="80" style="margin-bottom: 5px;"/>
							   {{$name}}
						 </a> (x{{$qty}})<br>
						 <?php
						 }
						?>
					   </td>
					   <td>&#8358;{{number_format($o['amount'],2)}}</td>		  
					   <td>{{$o['payment_code']}}</td>
					   <td><span class="label label-{{$statusClass}}">{{strtoupper($o['status'])}}</span></td>
					   <td>
					     @if($o['status'] == "unpaid")
							 <a class="btn btn-primary" href="{{$vpu}}">Verify payment</a>
						 @endif
					     <a class="btn btn-info" href="{{$iu}}" target="_blank">Receipt</a>
						 <a class="btn btn-primary" href="{{$tru}}">Track</a>					     						 
					   </td>
					 </tr>
					<?php
						 }  
					  }
                    ?>						  
					</tbody>
				  </table>
				</div>
              </div>
            
            </div>
            <!--end of columns--> 
			@endif
			
          </div>
        </div>
      </div>
    </section>
  </div>
  <!--end of middle sec--> 
    
@stop

@section('scripts')
    <!-- DataTables js -->
       <script src="lib/datatables/js/datatables.min.js"></script>
    <script src="lib/datatables/js/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="lib/datatables/js/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="lib/datatables/js/cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="lib/datatables/js/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="lib/datatables/js/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="lib/datatables/js/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="lib/datatables/js/cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <script src="lib/datatables/js/datatables-init.js"></script>
@stop