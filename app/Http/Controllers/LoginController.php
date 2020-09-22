<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Helpers\Contracts\HelperContract; 
use Auth;
use Session; 
use Validator; 
use Carbon\Carbon; 
use App\User;

class LoginController extends Controller {

	protected $helpers; //Helpers implementation
    
    public function __construct(HelperContract $h)
    {
    	$this->helpers = $h;            
    }
	
		/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getRegister(Request $request)
    {
		 $user = null;
		$cart = [];
		if(Auth::check())
		{
			return redirect()->intended('dashboard');
		}
		$cart = $this->helpers->getCart($user,$request);
		$c = $this->helpers->getCategories();
		$ads = $this->helpers->getAds();
		shuffle($ads);
		$ad = count($ads) < 1 ? "images/inner-ad.jpg" : $ads[0]['img'];
		$signals = $this->helpers->signals;
		$plugins = $this->helpers->getPlugins();
		$states = $this->helpers->states;
		return view("register",compact(['user','cart','c','ad','signals','plugins','states']));
    }
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	 
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getLogin(Request $request)
    {
       $user = null;
		$cart = [];
		if(Auth::check())
		{
			return redirect()->intended('dashboard');
		}
		
		$cart = $this->helpers->getCart($user,$request);
		$c = $this->helpers->categories;
		$signals = $this->helpers->signals;
		$plugins = $this->helpers->getPlugins();
		return view("login",compact(['user','cart','c','signals','plugins']));	
    }

  
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postLogin(Request $request)
    {
        $req = $request->all();
        //dd($req);
        
        $validator = Validator::make($req, [
                             'pass' => 'required|min:6',
                             'id' => 'required'
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             return redirect()->back()->withInput()->with('errors',$messages);
             //dd($messages);
         }
         
         else
         {
         	$remember = true; 
             $return = isset($req['u']) ? $req['u'] : '/';
             
         	//authenticate this login
            if(Auth::attempt(['email' => $req['id'],'password' => $req['pass'],'status'=> "enabled"],$remember) || Auth::attempt(['phone' => $req['id'],'password' => $req['pass'],'status'=> "enabled"],$remember))
            {
            	//Login successful               
               $user = Auth::user();          
                #dd($user); 
				
             #  if($this->helpers->isAdmin($user)){return redirect()->intended('/');}
               #else{
                  $rex = isset($req['u']) ? $req['u'] : '/';
                  if($user->verified == "vendor") $rex = "my-store";
                  return redirect()->back();
              # }
            }
			
			else
			{
				session()->flash("login-status","error");
				return redirect()->back();
			}
         }        
    }


    
    
	
    public function postRegister(Request $request)
    {
        $req = $request->all();
       #dd($req);
        
        $validator = Validator::make($req, [
                             'pass' => 'required|min:7|confirmed',
                             'email' => 'required|email',                            
                             'phone' => 'required|numeric',
                             'fname' => 'required',
                             'lname' => 'required',
                             'address' => 'required',
                             'city' => 'required',
                             'state' => 'required',
							 //'terms' => "required"
         ]);
         
         if($validator->fails())
         {
             $messages = $validator->messages();
             //dd($messages);
             
             return redirect()->back()->withInput()->with('errors',$messages);
         }
         
         else
         {
			 $isNew = !$this->helpers->isDuplicateUser(['email' => $req['email'], 'phone' => $req['phone']]);
			 
            $req['role'] = "user";    
            $req['status'] = "enabled";           
            $req['verified'] = "yes";           
            
            # dd($isNew);            

            $user =  $this->helpers->createUser($req); 
			Auth::login($user);
			$req['user_id'] = $user->id;
			$req['company'] = "";
            $shippingDetails =  $this->helpers->createShippingDetails($req); 
			
			if($isNew)
			{
				$newDiscount = $this->helpers->getSetting('nud');
				$this->helpers->giveDiscount($user,['type' => "flat", 'amount' => $newDiscount]);
			}
           // $wallet =  $this->helpers->createWallet($req); 
           
                                                    
             //after creating the user, send back to the registration view with a success message
             #$this->helpers->sendEmail($user->email,'Welcome To Disenado!',['name' => $user->fname, 'id' => $user->id],'emails.welcome','view');
             session()->flash("signup-status", "ok");
			 $rex = isset($req['u']) ? $req['u'] : '/';
             return redirect()->back();
          }
    }

   
	public function getForgotUsername()
    {
		$layoutAd = $this->helpers->getAds();
		$plugins = $this->helpers->getPlugins();
         return view('forgot_username',compact(['layoutAd','plugins']));
    }
    
    /**
     * Send username to the given user.
     * @param  \Illuminate\Http\Request  $request
     */
    public function postForgotUsername(Request $request)
    {
    	$req = $request->all(); 
        $validator = Validator::make($req, [
                             'email' => 'required|email'
                  ]);
                  
        if($validator->fails())
         {
             $messages = $validator->messages();
             //dd($messages);
             
             return redirect()->back()->withInput()->with('errors',$messages);
         }
         
         else{
         	$ret = $req['email'];

                $user = User::where('email',$ret)->first();

                if(is_null($user))
                {
                        return redirect()->back()->withErrors("This user doesn't exist!","errors"); 
                }
                
                #$this->helpers->sendEmail($user->email,'Your Username',['username' => $user->username],'emails.username','view');                                                         
            session()->flash("username-status","success");           
            return redirect()->intended('forgot-username');

      }
                  
    }    
    
    
    public function getForgotPassword()
    {
    	$user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
			return redirect()->intended('/');
		}
		$signals = $this->helpers->signals;
		$plugins = $this->helpers->getPlugins();
		$layoutAd = $this->helpers->getAds();
         return view('forgot-password', compact(['layoutAd','user','signals','plugins']));
    }
    
    /**
     * Send username to the given user.
     * @param  \Illuminate\Http\Request  $request
     */
    public function postForgotPassword(Request $request)
    {
    	$req = $request->all(); 
        $validator = Validator::make($req, [
                             'id' => 'required'
                  ]);
                  
        if($validator->fails())
         {
             $messages = $validator->messages();
             //dd($messages);
             
             return redirect()->back()->withInput()->with('errors',$messages);
         }
         
         else{
         	$ret = $req['id'];

                $user = User::where('email',$ret)
                                  ->orWhere('phone',$ret)->first();

                if(is_null($user) || ($user->role == 'user'))
                {
                        return redirect()->back()->withErrors("No admin account exists with that email or phone number!","errors"); 
                }
                
                //get the reset code 
                $code = $this->helpers->getPasswordResetCode($user);
              
                //Configure the smtp sender
                $sender = $this->helpers->emailConfig;              
                $sender['sn'] = 'KloudTransact Support'; 
                #$sender['se'] = 'kloudtransact@gmail.com'; 
                $sender['em'] = $user->email; 
                $sender['subject'] = 'Reset Your Password'; 
                $sender['link'] = 'www.kloudtransact.com'; 
                $sender['ll'] = url('reset').'?code='.$code; 
                
                //Send password reset link
                $this->helpers->sendEmailSMTP($sender,'emails.password','view');                                                         
            session()->flash("forgot-password-status","ok");           
            return redirect()->intended('forgot-password');

      }
                  
    }    
    
  
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getPasswordReset(Request $request)
    {
       $user = null;
       $req = $request->all();
       $return = isset($req['return']) ? $req['return'] : '/';
	   $plugins = $this->helpers->getPlugins();
		
		if(Auth::check())
		{
			$user = Auth::user();
			$return = 'dashboard';
			if($this->helpers->isAdmin($user)) $return = 'cobra';
			return redirect()->intended($return);
		} 
       else
        {
			if(isset($req['code']))
            {
            	$user = $this->helpers->verifyPasswordResetCode($req['code']);
                if($user == null)   
                { 
                	return redirect()->back()->withErrors("The code is invalid or has expired. ","errors"); 
                }
                $v = ($user->role == "user") ? 'reset' : 'admin.reset';
				$layoutAd = $this->helpers->getAds();
            	return view($v,compact(['layoutAd','user','return','plugins']));
            }
            
            else
            {
            	return redirect()->intended($return);
            }
         	
          }
    }
    
    
    /**
     * Send username to the given user.
     * @param  \Illuminate\Http\Request  $request
     */
    public function postPasswordReset(Request $request)
    {
    	$req = $request->all(); 
        $validator = Validator::make($req, [
                             'pass' => 'required|min:6|confirmed',
                             'acsrf' => 'required'
                  ]);
                  
        if($validator->fails())
         {
             $messages = $validator->messages();
             //dd($messages);
             
             return redirect()->back()->withInput()->with('errors',$messages);
         }
         
         else{
         	$id = $req['acsrf'];
             $ret = $req['pass'];

            $user = User::where('id',$id)->first();
            $user->update(['password' => bcrypt($ret)]);
                
            session()->flash("reset-status","ok");  
            $v = ($user->role == "user") ? 'login' : 'admin';         
            return redirect()->intended($v);

      }
                  
    }    

   
    
    public function getLogout()
    {
        if(Auth::check())
        {  
           Auth::logout();       	
        }
        
        return redirect()->intended('/');
    }

}