<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Helpers\Contracts\HelperContract; 
use Auth;
use Session; 
use Validator; 
use Carbon\Carbon; 
use Paystack; 
use App\Orders;

class PaymentController extends Controller {

	protected $helpers; //Helpers implementation
    
    public function __construct(HelperContract $h)
    {
    	$this->helpers = $h;                     
    }
    
	
	 /**
	 * Redirect GET requests to /pay.
	 * This could happen due to an expired page or network issues
	 *
	 * @return Response
	 */
	public function getPay()
    {
       return redirect()->intended('checkout');
    }
    
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postRedirectToGateway(Request $request)
    {
		$user = null;
		$messages = [];
		
    	if(Auth::check())
		{
			$user = Auth::user();
			$messages = $this->helpers->getMessages(['user_id' => $user->id]);
		}
		
		
		$req = $request->all();
		#dd($req);
		$metadata = json_decode($req['metadata']);
		
		if(isset($metadata->pid))
		{
			$p = $this->helpers->getPlan($metadata->pid);
			//you are here
			#dd($p);
			if($metadata->pt == "card")
			{
				 $request->reference = Paystack::genTranxRef();
                    $request->key = config('paystack.secretKey');
                   $request->plan = $p['ps_id'];			 
			        try{
				      return Paystack::getAuthorizationUrl()->redirectNow(); 
			        }
			        catch(Exception $e)
			        {
				      $request->session()->flash("pay-card-status-error","ok");
			          return redirect()->intended("checkout");
			        }
			}
			else
			{
				$sp = $this->helpers->getSavedPayment($metadata->pt);
				 $ret = [];
				 
				 if(count($sp) > 0)
				 {
					 $spdt = $sp['data'];
					
				  $rr = [
                  'data' => [
		             'authorization' => trim($spdt->authorization_code),
					'customer' => trim($spdt->auth_email),
					'plan' => $p['ps_id'],
			      ],
                  'headers' => [
		            'Authorization' => "Bearer ".env("PAYSTACK_SECRET_KEY")
		          ],
                  'url' => "https://api.paystack.co/subscription",
                  'method' => "post",
                  'type' => "multipart"
                 ];
				  
		           $rett = $this->helpers->bomb($rr);
                   $ret = json_decode($rett);
				   
				   
				   #dd($ret);
				   $psdata = $ret->data;
					  $successLocation = "add-apartment";
                      $failureLocation = "my-apartments";
			
			         if($psdata->status == "active")
			         {
						 /**
						 $md = $payStackData['metadata'];
			   $sps = $md['sps'];
			   $ref = $payStackData['reference'];
			   $plan = $this->getPlan($payStackData['plan']);
						 **/
						 $pd = [
						   'metadata' => ['sps' => "no"],
						   'reference' => $psdata->subscription_code,
						   'plan' => $p['ps_id'],
						   'npd' => $psdata->next_payment_date
						 ];
						 
				       $this->helpers->subscribe($user,$pd);
				       $request->session()->flash("subscribe-status","ok");
			           return redirect()->intended($successLocation);
			         }
			         else
                     {
        	           //Payment failed, redirect to orders
                       $request->session()->flash("subscribe-status","error");
			           return redirect()->intended($failureLocation);
                     }
				   
				 }
			}
			 
		}
		else
		{
		 /**********/
         
		
        $validator = Validator::make($req, [
							 'amount' => 'required',
                             'email' => 'required|email|filled'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {			 
			 if($metadata->pt == "card")
			 {
				 if($req['amount'] < 1)
			      {
				    $err = "error";
				    session()->flash("no-cart-status-error","ok");
				    return redirect()->back();
			      }
			      else
			      {
			        //$paystack = new Paystack();
			        #dd($request);
			        $request->reference = Paystack::genTranxRef();
                    $request->key = config('paystack.secretKey');
                   #dd($request);
			        try{
				      return Paystack::getAuthorizationUrl()->redirectNow(); 
			        }
			        catch(Exception $e)
			        {
				      $request->session()->flash("pay-card-status-error","ok");
			          return redirect()->intended("checkout");
			        } 
			      } 
			 }
			 else
			 {
				 #dd($metadata);
				 $sp = $this->helpers->getSavedPayment($metadata->pt);
				 
				 if(count($sp) > 0)
				 {
					 $spdt = $sp['data'];
					 
					 $rr = [
                  'data' => json_encode([
				    'authorization_code' => trim($spdt->authorization_code),
					'email' => trim($spdt->auth_email),
					'amount' => $req['amount'],
					'split' => $split
				  ]),
                  'headers' => [
		           'Authorization' => "Bearer ".env("PAYSTACK_SECRET_KEY")
		           ],
                  'url' => "https://api.paystack.co/transaction/charge_authorization",
                  'type' => "raw",
                  'method' => "post",
                 ];
      
                  $dt = [];
		           #dd($rr);
			       $rett = $this->helpers->bomb($rr);
                   $ret = json_decode($rett);
				   
				   
				   #dd($ret);

                    
                    if($ret->status == 'success')
                     {
						 $paymentData = $ret->data;	
			           $id = $metadata->ref;
			 
			           #dd($paymentData);
					   $au = [];
					   
					   $rep = [
					     'metadata' => [
						   'type' => "checkout",
						   'ref' => $metadata->ref,
						   'sps' => "no",
						   'notes' => $metadata->notes,
						 ],
					     'amount' => $paymentData->amount,
					     'reference' => $paymentData->reference,
						 'authorization' => $au
					   ];
        	           $this->helpers->checkout($user,$rep);
			
			   
                    $request->session()->flash("pay-card-status","ok");
			
			         $gid = isset($_COOKIE['gid']) ? $_COOKIE['gid'] : "";
		            $cart = $this->helpers->getCart($user,$gid);
		            $c = $this->helpers->getCategories();
	             	$ads = $this->helpers->getAds();
		            $plugins = $this->helpers->getPlugins();
		            shuffle($ads);
		            $ad = count($ads) < 1 ? "images/inner-ad-2.png" : $ads[0]['img'];
	        	    $signals = $this->helpers->signals;
					$banner = $this->helpers->getBanner();
			
			        return view("cps",compact(['user','cart','c','messages','ad','signals','plugins','banner']));
               }
               else
               {
        	      //Payment failed, redirect to orders
                  $request->session()->flash("pay-card-status-error","ok");
			      return redirect()->back();
                }					
				 }
				 else
				 {
					 session()->flash("pay-card-status-error","ok");
					 return redirect()->back();
				 }
				  
			 }
			        
         }		 
		 /**********/	
		}
               
        
        
    }
    
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getPaymentCallback(Request $request)
    {
		$user = null;
		$messages = [];
		#dd($request);
		
		$paymentDetails = Paystack::getPaymentData();

        dd($paymentDetails);     
		if(Auth::check())
		{
			$user = Auth::user();
			$messages = $this->helpers->getMessages(['user_id' => $user->id]);
		}
		else
		{
			return redirect()->intended('/');
		}
		
          
        
        $paymentData = $paymentDetails['data'];
        
		if(isset($paymentData['plan']))
		{
			//host subscription
			$successLocation = "add-apartment";
            $failureLocation = "my-apartments";
			
			if($paymentData['status'] == 'success')
			{
				$this->helpers->subscribe($user,$paymentData);
				$request->session()->flash("subscribe-status","ok");
			    return redirect()->intended($successLocation);
			}
			else
            {
        	  //Payment failed, redirect to orders
              $request->session()->flash("subscribe-status","error");
			  return redirect()->intended($failureLocation);
            }
		}
		else
		{
		  //guest checkout
		  $md = $paymentData['metadata'];
		
		  #dd($md);       
		  $successLocation = "";
          $failureLocation = "";
        
          switch($md['type'])
          {
        	case 'checkout':
              $successLocation = "orders";
             $failureLocation = "checkout";           
            break; 
            
          }
          //status, reference, metadata(order-id,items,amount,ssa), type
          if($paymentData['status'] == 'success')
          {
			#dd($md);
			$id = $md['ref'];
			 
			#dd($paymentData);
        	$this->helpers->checkout($user,$paymentData);
			   
            $request->session()->flash("pay-card-status","ok");
			//return redirect()->intended($successLocation);
			
		   $gid = isset($_COOKIE['gid']) ? $_COOKIE['gid'] : "";
		   $cart = $this->helpers->getCart($user,$gid);
		   $c = $this->helpers->getCategories();
		   $ads = $this->helpers->getAds();
		   $plugins = $this->helpers->getPlugins();
		   shuffle($ads);
		   $ad = count($ads) < 1 ? "images/inner-ad-2.png" : $ads[0]['img'];
		   $signals = $this->helpers->signals;
		   $banner = $this->helpers->getBanner();
			
			return view("cps",compact(['user','cart','c','messages','ad','signals','plugins','banner']));
          }
          else
          {
        	//Payment failed, redirect to orders
            $request->session()->flash("pay-card-status","error");
			return redirect()->intended($failureLocation);
          }
		}
		
    }
    
}
