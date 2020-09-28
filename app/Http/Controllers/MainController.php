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

    	return view("dashboard",compact(['user','cart','c','ad','signals','plugins']));
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