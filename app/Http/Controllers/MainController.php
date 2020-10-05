<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Helpers\Contracts\HelperContract; 
use Auth;
use Session; 
use Cookie;
use Validator; 
use Carbon\Carbon; 
//use Codedge\Fpdf\Fpdf\Fpdf;
use PDF;

class MainController extends Controller {

	protected $helpers; //Helpers implementation
    
    public function __construct(HelperContract $h)
    {
    	$this->helpers = $h;                      
    }

	/**
	 * Show the application home page.
	 *
	 * @return Response
	 */
	public function getIndex(Request $request)
    {
		$hasUnpaidOrders = null;
		$user = null;
		if(Auth::check())
		{
			$user = Auth::user();
		}
		$req = $request->all();
		$gid = isset($_COOKIE['gid']) ? $_COOKIE['gid'] : "";
		$cart = $this->helpers->getCart($user,$gid);
		$c = $this->helpers->getCategories();
		//dd($bs);
		$signals = $this->helpers->signals;
		
		$ads = $this->helpers->getAds("wide-ad");
		$banners = $this->helpers->getBanners();
		$plugins = $this->helpers->getPlugins();
		
		#dd($hasUnpaidOrders);
		
		shuffle($ads);
		shuffle($banners);
		$ad = count($ads) < 1 ? "images/inner-ad-2.png" : $ads[0]['img'];

    	return view("index",compact(['user','cart','c','banners','hasUnpaidOrders','ad','signals','plugins']));
    }
	
	/**
	 * Show the test page.
	 *
	 * @return Response
	 */
	public function getTemp(Request $request)
    {
		$user = null;
		if(Auth::check())
		{
			$user = Auth::user();
		}
		$req = $request->all();
		$gid = isset($_COOKIE['gid']) ? $_COOKIE['gid'] : "";
		$cart = $this->helpers->getCart($user,$gid);
		$c = $this->helpers->getCategories();
		//dd($bs);
		$signals = $this->helpers->signals;
		
		$ads = $this->helpers->getAds("wide-ad");
		$banners = $this->helpers->getBanners();
		$plugins = $this->helpers->getPlugins();
		
		#dd($hasUnpaidOrders);
		
		shuffle($ads);
		shuffle($banners);
		$ad = count($ads) < 1 ? "images/inner-ad-2.png" : $ads[0]['img'];

    	return view("temp",compact(['user','cart','c','banners','ad','signals','plugins']));
    }

	/**
	 * Show the about page.
	 *
	 * @return Response
	 */
	public function getAbout(Request $request)
    {
		$user = null;
		if(Auth::check())
		{
			$user = Auth::user();
		}
		$req = $request->all();
		$gid = isset($_COOKIE['gid']) ? $_COOKIE['gid'] : "";
		$cart = $this->helpers->getCart($user,$gid);
		$c = $this->helpers->getCategories();
		//dd($bs);
		$signals = $this->helpers->signals;
		
		$ads = $this->helpers->getAds("wide-ad");
		$plugins = $this->helpers->getPlugins();
		
		#dd($hasUnpaidOrders);
		
		shuffle($ads);
		$ad = count($ads) < 1 ? "images/inner-ad-2.png" : $ads[0]['img'];

    	return view("about",compact(['user','cart','c','ad','signals','plugins']));
    }
	
	/**
	 * Show the dashboard.
	 *
	 * @return Response
	 */
	public function getDashboard(Request $request)
    {
		$user = null;
		if(Auth::check())
		{
			$user = Auth::user();
		}
		else
		{
			return redirect()->intended('/');
		}
		
		$req = $request->all();
		
		$gid = isset($_COOKIE['gid']) ? $_COOKIE['gid'] : "";
		$cart = $this->helpers->getCart($user,$gid);
		#dd($user);
		$c = $this->helpers->getCategories();
		//dd($bs);
		$signals = $this->helpers->signals;
		
		$ads = $this->helpers->getAds("wide-ad");
		$plugins = $this->helpers->getPlugins();
		
		shuffle($ads);
		$ad = count($ads) < 1 ? "images/inner-ad-2.png" : $ads[0]['img'];
        
		$cpt = []; $v = "errors.404";
		
		if($user->mode == "host")
		{
			$cpt = ['user','cart','c','ad','signals','plugins'];
			$v = "host-dashboard";
		}
		else if($user->mode == "guest")
		{
			$cpt = ['user','cart','c','ad','signals','plugins'];
			$v = "guest-dashboard";
		}
		
    	return view($v,compact($cpt));
    }
	
	/**
	 * Show the profile.
	 *
	 * @return Response
	 */
	public function getProfile(Request $request)
    {
		$user = null;
		if(Auth::check())
		{
			$user = Auth::user();
		}
		else
		{
			return redirect()->intended('/');
		}
		
		$req = $request->all();
		
		$gid = isset($_COOKIE['gid']) ? $_COOKIE['gid'] : "";
		$cart = $this->helpers->getCart($user,$gid);
		#dd($user);
		$c = $this->helpers->getCategories();
		//dd($bs);
		$signals = $this->helpers->signals;
		
		$ads = $this->helpers->getAds("wide-ad");
		$plugins = $this->helpers->getPlugins();
		
		$u = $this->helpers->getUser($user->id);
		shuffle($ads);
		$ad = count($ads) < 1 ? "images/inner-ad-2.png" : $ads[0]['img'];
        
    	return view("profile",compact(['user','cart','c','ad','u','signals','plugins']));
    }
	
	/**
	 * Handle profile update.
	 *
	 * @return Response
	 */
	public function postProfile(Request $request)
    {
		$user = null;
		if(Auth::check())
		{
			$user = Auth::user();
		}
		else
		{
			return redirect()->intended('/');
		}

		$req = $request->all();
       dd($req);
	    
		$validator = Validator::make($req,[
		                    'xf' => 'required',
		                    'fname' => 'required',
		                    'lname' => 'required',
		                    'email' => 'required',
		                    'phone' => 'required',
		]);
		
		if($validator->fails())
         {
             return redirect()->back()->withInput()->with('errors',$messages);
         }
		 else
		 {
			$this->helpers->updateProfile($req);
			session()->flash("update-profile-status","ok");
			return redirect()->intended('profile');
		 }
    }

	/**
	 * Switch user mode (host/guest).
	 *
	 * @return Response
	 */
	public function getSwitchMode(Request $request)
    {
		$user = null;
		if(Auth::check())
		{
			$user = Auth::user();
		}
		else
		{
			return redirect()->intended('/');
		}
		
		$req = $request->all();
		
		$validator = Validator::make($req, [
                             'm' => 'required'
         ]);
         
         if($validator->fails())
         {
             return redirect()->back();
         }
		 else
		 {
			 $m = $req['m'];
			 switch($m)
			 {
				 case 'guest':
				   $user->update(['mode' => 'host']);
				 break;
				 
				 case 'host':
				   $user->update(['mode' => 'guest']);
				 break;
			 }
			 session()->flash("switch-mode-status","ok");
			 return redirect()->intended('/');
		 }
    }
	
	/**
	 * Show host apartments.
	 *
	 * @return Response
	 */
	public function getMyApartments(Request $request)
    {
		$user = null;
		if(Auth::check())
		{
			$user = Auth::user();
			
			if($user->mode != "host")
			{
				session()->flash("valid-mode-status-error","ok");
			    return redirect()->intended('/');
			}
		}
		else
		{
			return redirect()->intended('/');
		}
		
		$req = $request->all();
		
		$gid = isset($_COOKIE['gid']) ? $_COOKIE['gid'] : "";
		$cart = $this->helpers->getCart($user,$gid);
		
		$c = $this->helpers->getCategories();
		//dd($bs);
		$signals = $this->helpers->signals;
		
		$ads = $this->helpers->getAds("wide-ad");
		$plugins = $this->helpers->getPlugins();
		
		$apartments = $this->helpers->getApartments($user);
		#dd($apartments);
		shuffle($ads);
		$ad = count($ads) < 1 ? "images/inner-ad-2.png" : $ads[0]['img'];
        
    	return view("my-apartments",compact(['user','cart','c','ad','apartments','signals','plugins']));
    }
	
	/**
	 * Show the profile.
	 *
	 * @return Response
	 */
	public function getAddApartment(Request $request)
    {
		$user = null;
		if(Auth::check())
		{
			$user = Auth::user();
			
			if($user->mode != "host")
			{
				session()->flash("valid-mode-status-error","ok");
			    return redirect()->intended('/');
			}
		}
		else
		{
			return redirect()->intended('/');
		}
		
		$req = $request->all();
		
		$gid = isset($_COOKIE['gid']) ? $_COOKIE['gid'] : "";
		$cart = $this->helpers->getCart($user,$gid);
		#dd($user);
		$c = $this->helpers->getCategories();
		//dd($bs);
		$signals = $this->helpers->signals;
		$states = $this->helpers->states;
		
		$ads = $this->helpers->getAds("wide-ad");
		$plugins = $this->helpers->getPlugins();
		
		shuffle($ads);
		$ad = count($ads) < 1 ? "images/inner-ad-2.png" : $ads[0]['img'];
        
    	return view("add-apartment",compact(['user','cart','c','ad','states','signals','plugins']));
    }
	
	/**
	 * Handle profile update.
	 *
	 * @return Response
	 */
	public function postAddApartment(Request $request)
    {
		$user = null;
		if(Auth::check())
		{
			$user = Auth::user();
			
			if($user->mode != "host")
			{
				session()->flash("valid-mode-status-error","ok");
			    return redirect()->intended('/');
			}
		}
		else
		{
			return redirect()->intended('/');
		}

		$req = $request->all();
        #dd($req);
		$ret = ['status' => "error",'message' => "nothing happened"];
	    
		$validator = Validator::make($req,[
		                    'name' => 'required',
		                    'description' => 'required',
		                    'checkin' => 'required',
		                    'checkout' => 'required',
		                    'id_required' => 'required',
		                    'amount' => 'required|numeric',
		                    'children' => 'required',
		                    'pets' => 'required',
		                    'address' => 'required',
		                    'city' => 'required',
		                    'state' => 'required',
		                    'facilities' => 'required',
		                    'img_count' => 'required|numeric',
		                    'cover' => 'required',
		]);
		
		if($validator->fails())
         {
             $ret = ['message' => "validation"];
         }
		 else
		 {
			    $ird = [];

                    for($i = 0; $i < $req['img_count']; $i++)
                    {
            		  $img = $request->file("add-apartment-image-".$i);
             	      $imgg = $this->helpers->uploadCloudImage($img->getRealPath());
					  $ci = ($req['cover'] != null && $req['cover'] == $i) ? "yes": "no";
					  $temp = ['public_id' => $imgg['public_id'],'ci' => $ci,'type' => "image"];
			          array_push($ird, $temp);
                    } 
					
					$req['avb'] = "Available";
					$req['payment_type'] = "card";
					$req['user_id'] = $user->id;
					$req['ird'] = $ird;
				 
			$this->helpers->createApartment($req);
			$ret = ['status' => "ok"];
		 }
		 
		 return json_encode($ret);
    }
	
	/**
	 * Show the profile.
	 *
	 * @return Response
	 */
	public function getMyApartment(Request $request)
    {
		$user = null;
		if(Auth::check())
		{
			$user = Auth::user();
			
			if($user->mode != "host")
			{
				session()->flash("valid-mode-status-error","ok");
			    return redirect()->intended('/');
			}
		}
		else
		{
			return redirect()->intended('/');
		}
		
		$req = $request->all();
		
		if(isset($req['xf']))
		{
			$gid = isset($_COOKIE['gid']) ? $_COOKIE['gid'] : "";
		    $cart = $this->helpers->getCart($user,$gid);
		    #dd($user);
		    $c = $this->helpers->getCategories();
		    //dd($bs);
		    $signals = $this->helpers->signals;
		    $states = $this->helpers->states;
		
	    	$ads = $this->helpers->getAds("wide-ad");
		    $plugins = $this->helpers->getPlugins();
		
		    $apartment = $this->helpers->getApartment($req['xf']);
			dd($apartment);
		    shuffle($ads);
		    $ad = count($ads) < 1 ? "images/inner-ad-2.png" : $ads[0]['img'];
        
    	    return view("my-apartment",compact(['user','cart','c','ad','states','signals','plugins']));
		}
		else
		{
			return redirect()->intended('my-apartments');
		}
		
    }
	
	/**
	 * Handle profile update.
	 *
	 * @return Response
	 */
	public function postMyApartment(Request $request)
    {
		$user = null;
		if(Auth::check())
		{
			$user = Auth::user();
			
			if($user->mode != "host")
			{
				session()->flash("valid-mode-status-error","ok");
			    return redirect()->intended('/');
			}
		}
		else
		{
			return redirect()->intended('/');
		}

		$req = $request->all();
        dd($req);
		$ret = ['status' => "error",'message' => "nothing happened"];
	    
		$validator = Validator::make($req,[
		                    'name' => 'required',
		                    'description' => 'required',
		                    'checkin' => 'required',
		                    'checkout' => 'required',
		                    'id_required' => 'required',
		                    'amount' => 'required|numeric',
		                    'children' => 'required',
		                    'pets' => 'required',
		                    'address' => 'required',
		                    'city' => 'required',
		                    'state' => 'required',
		                    'facilities' => 'required',
		                    'img_count' => 'required|numeric',
		                    'cover' => 'required',
		]);
		
		if($validator->fails())
         {
             $ret = ['message' => "validation"];
         }
		 else
		 {
			    $ird = [];

                    for($i = 0; $i < $req['img_count']; $i++)
                    {
            		  $img = $request->file("add-apartment-image-".$i);
             	      $imgg = $this->helpers->uploadCloudImage($img->getRealPath());
					  $ci = ($req['cover'] != null && $req['cover'] == $i) ? "yes": "no";
					  $temp = ['public_id' => $imgg['public_id'],'ci' => $ci,'type' => "image"];
			          array_push($ird, $temp);
                    } 
					
					$req['avb'] = "Available";
					$req['payment_type'] = "card";
					$req['user_id'] = $user->id;
					$req['ird'] = $ird;
				 
			$this->helpers->createApartment($req);
			$ret = ['status' => "ok"];
		 }
		 
		 return json_encode($ret);
    }
	
	
	

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getZoho()
    {
        $ret = "97916613";
    	return $ret;
    }
	
	

	
}