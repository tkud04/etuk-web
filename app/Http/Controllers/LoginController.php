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
use Laravel\Socialite\Facades\Socialite;

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
	public function getSignup(Request $request)
    {
		 $user = null;
		$cart = [];
		if(Auth::check())
		{
			return redirect()->intended('dashboard');
		}
		
		return redirect()->intended("/");
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
	public function getHello(Request $request)
    {
        $user = null;
		$cart = [];
		if(Auth::check())
		{
			return redirect()->intended('dashboard');
		}
		
		return redirect()->intended("/");
    }

  
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
    public function postHello(Request $request)
    {
		$req = $request->all();
       #dd($req);
	   $ret = ['status' => "error",'message' => "Nothing happened"];
        
		$reqValidator = Validator::make($req,[
		                    'dt' => 'required'
		]);
		
		if($reqValidator->fails())
         {
             $ret['message'] = "validation";
         }
		 else
		 {
			 $dt = json_decode($req['dt'],true);
		    $validator = Validator::make($dt, [
                             'pass' => 'required|min:6',
                             'id' => 'required'                  
         ]);
         
         if($validator->fails())
         {
             $ret['message'] = "validation";
         }
         
         else
         {
			$remember = true; 
             
         	//authenticate this login
            if(Auth::attempt(['email' => $dt['id'],'password' => $dt['pass'],'status'=> "enabled"],$remember) || Auth::attempt(['phone' => $dt['id'],'password' => $dt['pass'],'status'=> "enabled"],$remember))
            {
            	//Login successful               
               $user = Auth::user();   
               $ret = ['status' => "ok",'message' => "Signup successful"];			   
            }
			
			else
			{
				 $ret['message'] = "auth";
			}			
          }	 
		 }
		
        return json_encode($ret);
    }


    
    
	
    public function postSignup(Request $request)
    {
        $req = $request->all();
       #dd($req);
	   $ret = ['status' => "error",'message' => "Nothing happened"];
        
		$reqValidator = Validator::make($req,[
		                    'dt' => 'required'
		]);
		
		if($reqValidator->fails())
         {
             $ret['message'] = "validation";
         }
		 else
		 {
			 $dt = json_decode($req['dt'],true);
		    $validator = Validator::make($dt, [
                             'pass' => 'required|min:7|confirmed',
                             'email' => 'required|email',                            
                             'phone' => 'required|numeric',
                             'fname' => 'required',
                             'lname' => 'required'                  
         ]);
         
         if($validator->fails())
         {
             $ret['message'] = "validation";
         }
         
         else
         {
			 $isNew = !$this->helpers->isDuplicateUser(['email' => $dt['email'], 'phone' => $dt['phone']]);
			 
            $dt['role'] = "user";    
            $dt['status'] = "enabled";           
            $dt['mode'] = "guest";           
            $dt['currency'] = "ngn";           
            $dt['verified'] = "yes";           
            
            # dd($isNew);            
            
			if($isNew)
			{
				$user =  $this->helpers->createUser($dt);
				Auth::login($user);
				$ret = ['status' => "ok",'message' => "Signup successful"];			
			}
			else
			{
				$ret = ['status' => "error",'message' => "duplicate"];			
			}
            
            
          }	 
		 }
		
        return json_encode($ret);
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
	public function getOauth(Request $request)
    {
        $user = null;
		$cart = [];
		if(Auth::check())
		{
			return redirect()->intended('dashboard');
		}
		
		 $req = $request->all();
		 #dd($req);
		 if(isset($req['type']))
		 {
			 $type = $req['type'];
			 
			 return Socialite::driver($type)->redirect();
		 }
		 else
		 {
			return redirect()->intended("/"); 
		 }
		
    }
	
	
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getOAuthRedirect(Request $request,$type)
    {
        $user = null;
		$cart = [];
		if(Auth::check())
		{
			return redirect()->intended('dashboard');
		}
		
		 $req = $request->all();
		  $socialUser = Socialite::driver($type)->user();
		 
		 if($socialUser != null)
		 {
			 $dt = [
			   'name' => $socialUser->name,
			   'type' => $type,
			   'email' => $socialUser->email,
			   'img' => $socialUser->avatar,
			   'token' => $socialUser->token,
			 ];
			$auth = $this->helpers->oauth($dt);
			
			if($auth['status'] == "ok")
			{
				if($auth['message'] == "new-user")
				{
					//set password for new user
					$uu = $auth['user'];
					return redirect()->intended("oauth-sp?xf=".$uu->email);
				}
			}
			else
			{
				session()->flash("oauth-status-error","ok");
			}
		 }
		 else
		 {
			session()->flash("oauth-status-error","ok");
		 }
		 
		 return redirect()->intended("/"); 
		
    }
	
	 /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getOAuthSP(Request $request)
    {
       $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
		}
		$signals = $this->helpers->signals;
		$plugins = $this->helpers->getPlugins();
		$cart = [];
            $req = $request->all();
			#dd($req);
			if(isset($req['xf']))
            {
				$xf = $req['xf'];
				return view("oauth-sp",compact(['cart','user','xf','return','plugins']));
            }
            
            else
            {
            	return redirect()->intended('/');
            }
    }
    
    
    /**
     * Send username to the given user.
     * @param  \Illuminate\Http\Request  $request
     */
    public function postOAuthSP(Request $request)
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
         
         else
		 {
         	$id = $req['acsrf'];
             $ret = $req['pass'];

            $user = User::where('email',$id)->first();
			if($user != null)
			{
				$user->update(['password' => bcrypt($ret)]);
                Auth::login($user);
                session()->flash("oauth-sp-status","ok");                  
			}
            
            return redirect()->intended('/');

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
		$cart = [];
         return view('forgot-password', compact(['cart','user','signals','plugins']));
    }
    
    /**
     * Send username to the given user.
     * @param  \Illuminate\Http\Request  $request
     */
    public function postForgotPassword(Request $request)
    {
    	 $req = $request->all();
       #dd($req);
	   $ret = ['status' => "error",'message' => "Nothing happened"];
        
		$reqValidator = Validator::make($req,[
		                    'dt' => 'required'
		]);
		
		if($reqValidator->fails())
         {
             $ret['message'] = "dt-validation";
         }
		 else
		 {
			 $dt = json_decode($req['dt'],true);
			 $validator = Validator::make($dt, [
                             'email' => 'required|email'          
             ]);
         
            if($validator->fails())
            {
              $ret['message'] = "validation";
            }
         
            else
           {
         	  $id = $dt['email'];

                $user = User::where('email',$id)
                                  ->orWhere('phone',$id)->first();

                if(is_null($user))
                {
                         $ret['message'] = "auth";
                }
				else
				{
					//get the reset code 
                    $code = $this->helpers->getPasswordResetCode($user);
                    $user->update(['reset_code' => $code]);
                    $ret = $this->helpers->getCurrentSender();
				    $ret['code'] = $code;
				    $ret['name'] = $user->fname;
				    $ret['subject'] = "Reset your password";
		            $ret['em'] = $id;
		            $this->helpers->sendEmailSMTP($ret,"emails.forgot-password");
                    $ret = ['status' => "ok",'message' => "Link sent"];
				}
            }
	     }
	  
	  return json_encode($ret);               
    }    
    
  
    /**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function getPasswordReset(Request $request)
    {
       $user = null;
		
		if(Auth::check())
		{
			$user = Auth::user();
			return redirect()->intended('/');
		}
		$signals = $this->helpers->signals;
		$plugins = $this->helpers->getPlugins();
		$cart = [];
            $req = $request->all();
			#dd($req);
			if(isset($req['code']))
            {
				$user = $this->helpers->verifyPasswordResetCode($req['code']);
				#dd($user);
                if($user == null)   
                { 
                	return redirect()->back()->withErrors("The code is invalid or has expired. ","errors"); 
                }
                $v = ($user->role == "user") ? 'reset' : 'admin.reset';
				return view($v,compact(['cart','user','return','plugins']));
            }
            
            else
            {
            	return redirect()->intended('/');
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

   
    
    public function getBye()
    {
        if(Auth::check())
        {  
           Auth::logout();       	
        }
        
        return redirect()->intended('/');
    }

}