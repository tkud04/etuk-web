<?php
namespace App\Helpers;

use App\Helpers\Contracts\HelperContract; 
use Crypt;
use Carbon\Carbon; 
use Mail;
use Auth;
use Illuminate\Http\Request;
use App\User;
use App\Carts;
use App\Categories;
use App\Apartments;
use App\ApartmentAddresses;
use App\ApartmentData;
use App\ApartmentMedia;
use App\ApartmentTerms;
use App\ApartmentFacilities;
use App\ApartmentTips;
use App\Reviews;
use App\ReviewStats;
use App\Ads;
use App\Banners;
use App\Senders;
use App\Settings;
use App\Plugins;
use App\Services;
use App\Comparisons;
use App\Socials;
use App\Messages;
use App\SavedPayments;
use App\Orders;
use App\OrderItems;
use App\SavedApartments;
use App\ApartmentPreferences;
use App\Transactions;
use App\Preferences;
use App\PreferenceAddresses;
use App\PreferenceData;
use App\PreferenceMedia;
use App\PreferenceTerms;
use App\PreferenceFacilities;
use App\Tickets;
use App\TicketItems;
use App\Faqs;
use App\FaqTags;
use App\Posts;
use App\PostTags;
use App\Comments;
use App\Tags;
use App\ReservationLogs;
use App\Plans;
use App\UserPlans;
use App\Activities;
use App\Leads;
use App\BankDetails;
use App\Guests;
use \Swift_Mailer;
use \Swift_SmtpTransport;
use \Cloudinary\Api;
use \Cloudinary\Api\Response;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use Codedge\Fpdf\Fpdf\Fpdf;


class Helper implements HelperContract
{

 public $signals = ['okays'=> [
                     //SUCCESS NOTIFICATIONS
					 "login-status" => "Welcome back!",            
                     "update-profile-status" => "Profile updated.",
                     "switch-mode-status" => "You have now switched your account mode.",
					 "valid-mode-status-error" => "Access denied. Try switching your account mode to access the resource.",
					 "sci-status" => "Cover image updated.",
					 "cover-image-status-error" => "You cannot delete the cover image.",
					 "ri-status" => "Image deleted.",
					 "delete-avatar-status" => "Avatar removed.",
					 "delete-apartment-status" => "Apartment removed.",
					 "update-apartment-status" => "Apartment information updated.",
					 "oauth-sp-status" => "Welcome to Etuk NG! You can now use your new account.",
					 "add-review-status" => "Thanks for your review! It will be displayed after review by our admins.",
					 "add-to-cart-status" => "Added to your cart.",
					 "remove-from-cart-status" => "Removed from your cart.",
					 "pay-card-status" => "Payment successful. Have a lovely stay!",
					 "save-apartment-status" => "Apartment saved.",
					 "save-duplicate-apartment-status" => "You have saved this apartment already.",
					 "remove-saved-apartment-status" => "Apartment removed from your list.",
					 "remove-saved-payment-status" => "Payment details removed from your account.",
					 "add-ticket-status" => "Ticket created.",
					 "update-ticket-status" => "Ticket updated.",
					 "add-reservation-status" => "Reservation made.",
					 "update-reservation-status" => "Reservation log updated.",
					 "remove-reservation-status" => "Reservation log removed.",
					 "respond-to-reservation-status" => "Response sent.",
					 "contact-status" => "Message sent! Our officials will get back to you shortly.",
					 "subscribe-status" => "You are now subscribed!",
						
					 //ERROR NOTIFICATIONS
					 "invalid-apartment-id-status-error" => "Apartment not found.",
					 "add-review-status-error" => "Please sign in to add a review.",
					 "duplicate-review-status-error" => "You have added a review already.",
					 "duplicate-reservation-status-error" => "You have made a reservation already.",
					 "oauth-status-error" => "Social login failed, please try again.",
					 "checkout-auth-status-error" => "Please sign in to book an apartment.",
					 "cart-auth-status-error" => "Please sign in to view your cart.",
					 "save-apartment-auth-status-error" => "Please sign in to save an apartment.",
					 "save-payment-auth-status-error" => "Please sign in to save payment details.",
					 "validation-status-error" => "Please fill all required fields.",
					 "add-to-cart-host-status-error" => "You cannot book your own apartment.",
					 "no-cart-status-error" => "Your cart is empty.",
					 "pay-card-status-error" => "Your payment could not be processed, please try again.",
					 "save-apartment-status-error" => "Apartment could not be saved, please try again.",
					 "remove-saved-apartment-status-error" => "Apartment could not be removed, please try again.",
					 "remove-saved-payment-status-error" => "Payment details could not be removed, please try again.",
					 "no-results-status-error" => "No results found!",
					 "add-ticket-status-error" => "Ticket could not be created, please try again",
					 "update-ticket-status-error" => "Ticket could not be updated, please try again.",
					 "add-reservation-status-error" => "Reservation could not be created, please try again",
					 "update-reservation-status-error" => "Reservation could not be updated, please try again.",
					 "remove-reservation-status-error" => "Reservation could not be removed, please try again.",
					 "contact-status-error" => "Message could not be updated, please try again.",
					 "subscribe-status-error" => "Subscription could not be activated, please try again.",
					 "duplicate-subscribe-status-error" => "You are already subscribed.",
                     ],
                     'errors'=> ["login-status-error" => "Wrong username or password, please try again.",
					 "signup-status-error" => "There was a problem creating your account, please try again.",
					 "update-profile-status-error" => "There was a problem updating your profile, please try again.",
                    ]
                   ];
  
  public $states = [
			                       'abia' => 'Abia',
			                       'adamawa' => 'Adamawa',
			                       'akwa-ibom' => 'Akwa Ibom',
			                       'anambra' => 'Anambra',
			                       'bauchi' => 'Bauchi',
			                       'bayelsa' => 'Bayelsa',
			                       'benue' => 'Benue',
			                       'borno' => 'Borno',
			                       'cross-river' => 'Cross River',
			                       'delta' => 'Delta',
			                       'ebonyi' => 'Ebonyi',
			                       'enugu' => 'Enugu',
			                       'edo' => 'Edo',
			                       'ekiti' => 'Ekiti',
			                       'gombe' => 'Gombe',
			                       'imo' => 'Imo',
			                       'jigawa' => 'Jigawa',
			                       'kaduna' => 'Kaduna',
			                       'kano' => 'Kano',
			                       'katsina' => 'Katsina',
			                       'kebbi' => 'Kebbi',
			                       'kogi' => 'Kogi',
			                       'kwara' => 'Kwara',
			                       'lagos' => 'Lagos',
			                       'nasarawa' => 'Nasarawa',
			                       'niger' => 'Niger',
			                       'ogun' => 'Ogun',
			                       'ondo' => 'Ondo',
			                       'osun' => 'Osun',
			                       'oyo' => 'Oyo',
			                       'plateau' => 'Plateau',
			                       'rivers' => 'Rivers',
			                       'sokoto' => 'Sokoto',
			                       'taraba' => 'Taraba',
			                       'yobe' => 'Yobe',
			                       'zamfara' => 'Zamfara',
			                       'fct' => 'FCT'  
			];  



 public $banks = [
      'access' => "Access Bank", 
      'citibank' => "Citibank", 
      'diamond-access' => "Diamond-Access Bank", 
      'ecobank' => "Ecobank", 
      'fidelity' => "Fidelity Bank", 
      'fbn' => "First Bank", 
      'fcmb' => "FCMB", 
      'globus' => "Globus Bank", 
      'gtb' => "GTBank", 
      'heritage' => "Heritage Bank", 
      'jaiz' => "Jaiz Bank", 
      'keystone' => "KeyStone Bank", 
      'polaris' => "Polaris Bank", 
      'providus' => "Providus Bank", 
      'stanbic' => "Stanbic IBTC Bank", 
      'standard-chartered' => "Standard Chartered Bank", 
      'sterling' => "Sterling Bank", 
      'suntrust' => "SunTrust Bank", 
      'titan-trust' => "Titan Trust Bank", 
      'union' => "Union Bank", 
      'uba' => "UBA", 
      'unity' => "Unity Bank", 
      'wema' => "Wema Bank", 
      'zenith' => "Zenith Bank"
 ];			

  public $countries = [
'afghanistan' => "Afghanistan",
'albania' => "Albania",
'algeria' => "Algeria",
'andorra' => "Andorra",
'angola' => "Angola",
'antigua-barbuda' => "Antigua and Barbuda",
'argentina' => "Argentina",
'armenia' => "Armenia",
'australia' => "Australia",
'austria' => "Austria",
'azerbaijan' => "Azerbaijan",
'bahamas' => "The Bahamas",
'bahrain' => "Bahrain",
'bangladesh' => "Bangladesh",
'barbados' => "Barbados",
'belarus' => "Belarus",
'belgium' => "Belgium",
'belize' => "Belize",
'benin' => "Benin",
'bhutan' => "Bhutan",
'bolivia' => "Bolivia",
'bosnia' => "Bosnia and Herzegovina",
'botswana' => "Botswana",
'brazil' => "Brazil",
'brunei' => "Brunei",
'bulgaria' => "Bulgaria",
'burkina-faso' => "Burkina Faso",
'burundi' => "Burundi",
'cambodia' => "Cambodia",
'cameroon' => "Cameroon",
'canada' => "Canada",
'cape-verde' => "Cape Verde",
'caf' => "Central African Republic",
'chad' => "Chad",
'chile' => "Chile",
'china' => "China",
'colombia' => "Colombia",
'comoros' => "Comoros",
'congo-1' => "Congo, Republic of the",
'congo-2' => "Congo, Democratic Republic of the",
'costa-rica' => "Costa Rica",
'cote-divoire' => "Cote DIvoire",
'croatia' => "Croatia",
'cuba' => "Cuba",
'cyprus' => "Cyprus",
'czech' => "Czech Republic",
'denmark' => "Denmark",
'djibouti' => "Djibouti",
'dominica' => "Dominica",
'dominica-2' => "Dominican Republic",
'timor' => "East Timor (Timor-Leste)",
'ecuador' => "Ecuador",
'egypt' => "Egypt",
'el-salvador' => "El Salvador",
'eq-guinea' => "Equatorial Guinea",
'eritrea' => "Eritrea",
'estonia' => "Estonia",
'ethiopia' => "Ethiopia",
'fiji' => "Fiji",
'finland' => "Finland",
'france' => "France",
'gabon' => "Gabon",
'gambia' => "The Gambia",
'georgia' => "Georgia",
'germany' => "Germany",
'ghana' => "Ghana",
'greece' => "Greece",
'grenada' => "Grenada",
'guatemala' => "Guatemala",
'guinea' => "Guinea",
'guinea-bissau' => "Guinea-Bissau",
'guyana' => "Guyana",
'haiti' => "Haiti",
'honduras' => "Honduras",
'hungary' => "Hungary",
'iceland' => "Iceland",
'india' => "India",
'indonesia' => "Indonesia",
'iran' => "Iran",
'iraq' => "Iraq",
'ireland' => "Ireland",
'israel' => "Israel",
'italy' => "Italy",
'jamaica' => "Jamaica",
'japan' => "Japan",
'jordan' => "Jordan",
'kazakhstan' => "Kazakhstan",
'kenya' => "Kenya",
'kiribati' => "Kiribati",
'nk' => "Korea, North",
'sk' => "Korea, South",
'kosovo' => "Kosovo",
'kuwait' => "Kuwait",
'kyrgyzstan' => "Kyrgyzstan",
'laos' => "Laos",
'latvia' => "Latvia",																																																																																							
'lebanon' => "Lebanon",
'lesotho' => "Lesotho",
'liberia' => "Liberia",
'libya' => "Libya",
'liechtenstein' => "Liechtenstein",
'lithuania' => "Lithuania",
'luxembourg' => "Luxembourg",
'macedonia' => "Macedonia",
'madagascar' => "Madagascar",
'malawi' => "Malawi",
'malaysia' => "Malaysia",
'maldives' => "Maldives",
'mali' => "Mali",
'malta' => "Malta",
'marshall' => "Marshall Islands",
'mauritania' => "Mauritania",
'mauritius' => "Mauritius",
'mexico' => "Mexico",
'micronesia' => "Micronesia, Federated States of",
'moldova' => "Moldova",
'monaco' => "Monaco",
'mongolia' => "Mongolia",
'montenegro' => "Montenegro",
'morocco' => "Morocco",
'mozambique' => "Mozambique",
'myanmar' => "Myanmar (Burma)",
'namibia' => "Namibia",
'nauru' => "Nauru",
'nepal' => "Nepal",
'netherlands' => "Netherlands",
'nz' => "New Zealand",
'nicaragua' => "Nicaragua",
'niger' => "Niger",
'nigeria' => "Nigeria",
'norway' => "Norway",
'oman' => "Oman",
'pakistan' => "Pakistan",
'palau' => "Palau",
'panama' => "Panama",
'png' => "Papua New Guinea",
'paraguay' => "Paraguay",
'peru' => "Peru",
'philippines' => "Philippines",
'poland' => "Poland",
'portugal' => "Portugal",
'qatar' => "Qatar",
'romania' => "Romania",
'russia' => "Russia",
'rwanda' => "Rwanda",
'st-kitts' => "Saint Kitts and Nevis",
'st-lucia' => "Saint Lucia",
'svg' => "Saint Vincent and the Grenadines",
'samoa' => "Samoa",
'san-marino' => "San Marino",
'sao-tome-principe' => "Sao Tome and Principe",
'saudi -arabia' => "Saudi Arabia",
'senegal' => "Senegal",
'serbia' => "Serbia",
'seychelles' => "Seychelles",
'sierra-leone' => "Sierra Leone",
'singapore' => "Singapore",
'slovakia' => "Slovakia",
'slovenia' => "Slovenia",
'solomon-island' => "Solomon Islands",
'somalia' => "Somalia",
'sa' => "South Africa",
'ss' => "South Sudan",
'spain' => "Spain",
'sri-lanka' => "Sri Lanka",
'sudan' => "Sudan",
'suriname' => "Suriname",
'swaziland' => "Swaziland",
'sweden' => "Sweden",
'switzerland' => "Switzerland",
'syria' => "Syria",
'taiwan' => "Taiwan",
'tajikistan' => "Tajikistan",
'tanzania' => "Tanzania",
'thailand' => "Thailand",
'togo' => "Togo",
'tonga' => "Tonga",
'trinidad-tobago' => "Trinidad and Tobago",
'tunisia' => "Tunisia",
'turkey' => "Turkey",
'turkmenistan' => "Turkmenistan",
'tuvalu' => "Tuvalu",
'uganda' => "Uganda",
'ukraine' => "Ukraine",
'uae' => "United Arab Emirates",
'uk' => "United Kingdom",
'usa' => "United States of America",
'uruguay' => "Uruguay",
'uzbekistan' => "Uzbekistan",
'vanuatu' => "Vanuatu",
'vatican' => "Vatican City",
'venezuela' => "Venezuela",
'vietnam' => "Vietnam",
'yemen' => "Yemen",
'zambia' => "Zambia",
'zimbabwe' => "Zimbabwe"
];

  public $ip = "";
   
  public $def = [
  'avb' => "available",
  'city' => "",
  'lga' => "",
  'state' => "none",
  'amount' => "0",
  'rating' => "4",
  'category' => "",
  'property_type' => "none",
  'rooms' => "none",
  'units' => "none",
  'bedrooms' => "none",
  'bathrooms' => "none",
  'children' => "none",
  'pets' => "no",
  'max_adults' => "4",
  'max_children' => "0",
  'facilities' => []
];

public $contacts = [
								  ['tag' => "admin",'name' => "Olajide Tayo",'designation' => "Administrative/IT",'phone' => "08057318627", 'email' => "tayo.olajide@etuk.ng"],
								  ['tag' => "marketing",'name' => "Paul Adejoh",'designation' => "Sales & Marketing",'phone' => "07019982345", 'email' => "adejoh.paul@etuk.ng"],
								  ['tag' => "pro",'name' => "Oje Adesola",'designation' => "Customer & Communications",'phone' => "08168923876", 'email' => "adesola.oje@etuk.ng"],
								];
   
  
  public $adminEmail = "aquarius4tkud@yahoo.com";
  public $suEmail = "kudayisitobi@gmail.com";
  
  public $admin = [
			    'id' => "admin",
			    'fname' => "Admin",
			    'lname' => "",
			    'phone' => "08168923876",
			    //'email' => "adesola.oje@etuk.ng",
			    'email' => "aquarius4tkud@yahoo.com",
			  ];

  public $su = [
			    'id' => "admin",
			    'fname' => "Admin",
			    'lname' => "",
			    'phone' => "07054291601",
			    'email' => "kudayisitobi@gmail.com",
			  ];
   
           
		   #{'msg':msg,'em':em,'subject':subject,'link':link,'sn':senderName,'se':senderEmail,'ss':SMTPServer,'sp':SMTPPort,'su':SMTPUser,'spp':SMTPPass,'sa':SMTPAuth};
           function sendEmailSMTP($data,$view,$type="view")
           {
           	    // Setup a new SmtpTransport instance for new SMTP
                $transport = "";
if($data['sec'] != "none") $transport = new Swift_SmtpTransport($data['ss'], $data['sp'], $data['sec']);

else $transport = new Swift_SmtpTransport($data['ss'], $data['sp']);

   if($data['sa'] != "no"){
                  $transport->setUsername($data['su']);
                  $transport->setPassword($data['spp']);
     }
// Assign a new SmtpTransport to SwiftMailer
$smtp = new Swift_Mailer($transport);

// Assign it to the Laravel Mailer
Mail::setSwiftMailer($smtp);

$se = $data['se'];
$sn = $data['sn'];
$to = $data['em'];
$subject = $data['subject'];
                   if($type == "view")
                   {
                     Mail::send($view,$data,function($message) use($to,$subject,$se,$sn){
                           $message->from($se,$sn);
                           $message->to($to);
                           $message->subject($subject);
                          if(isset($data["has_attachments"]) && $data["has_attachments"] == "yes")
                          {
                          	foreach($data["attachments"] as $a) $message->attach($a);
                          } 
						  $message->getSwiftMessage()
						  ->getHeaders()
						  ->addTextHeader('x-mailgun-native-send', 'true');
                     });
                   }

                   elseif($type == "raw")
                   {
                     Mail::raw($view,$data,function($message) use($to,$subject,$se,$sn){
                            $message->from($se,$sn);
                           $message->to($to);
                           $message->subject($subject);
                           if(isset($data["has_attachments"]) && $data["has_attachments"] == "yes")
                          {
                          	foreach($data["attachments"] as $a) $message->attach($a);
                          } 
                     });
                   }
           }

           function bomb($data) 
           {
             $url = $data['url'];
               
			       $client = new Client([
                 // Base URI is used with relative requests
                 'base_uri' => 'http://httpbin.org',
                 // You can set any number of default request options.
                 //'timeout'  => 2.0,
				 'headers' => $data['headers']
                 ]);
                  
				 
				 $dt = [
				    
				 ];
				 
				 if(isset($data['data']))
				 {
					if(isset($data['type']) && $data['type'] == "raw")
					{
					  $dt = ['body' => $data['data']];
					}
					else
					{
					  $dt['multipart'] = [];
					  foreach($data['data'] as $k => $v)
				      {
					    $temp = [
					      'name' => $k,
						  'contents' => $v
					     ];
						 
					     array_push($dt['multipart'],$temp);
				      }
					}
				   
				 }
				 
				 try
				 {
					if($data['method'] == "get") $res = $client->request('GET', $url);
					else if($data['method'] == "post") $res = $client->request('POST', $url,$dt);
			  
                   $ret = $res->getBody()->getContents(); 
			       //dd($ret);

				 }
				 catch(RequestException $e)
				 {
					 $mm = (is_null($e->getResponse())) ? null: Psr7\str($e->getResponse());
					 $ret = json_encode(["status" => "error","message" => $mm]);
				 }
			     $rett = json_decode($ret);
           return $ret; 
           }
		   
		   function text($data) 
           {
           	//form query string
              // $qs = "sn=".$data['sn']."&sa=".$data['sa']."&subject=".$data['subject'];

               $lead = $data['to'];
			   
			   if($lead == null || $lead == "")
			   {
				    $ret = json_encode(["status" => "ok","message" => "Invalid number"]);
			   }
			   else
			    { 
                  
			      //Send request to nodemailer
			     // $url = "https://radiant-island-62350.herokuapp.com/?".$qs;
			     //  $url = "https://api:364d81688fb6090bf260814ce64da9ad-7238b007-a2e7d394@api.mailgun.net/v3/mailhippo.tk/messages";
			       $url = "https://smartsmssolutions.com/api/";
			   
			
			     $client = new Client([
                 // Base URI is used with relative requests
                 'base_uri' => 'http://httpbin.org',
                 // You can set any number of default request options.
                 //'timeout'  => 2.0,
				 'headers' => [
                     'MIME-Version' => '1.0',
                     'Content-Type'     => 'text/html; charset=ISO-8859-1',           
                    ]
                 ]);
                  
				
				 $dt = [
				    'multipart' => [
					   [
					      'name' => 'sender',
						  'contents' => "Etuk NG"
					   ],
					   [
					      'name' => 'token',
						  'contents' => env('SMARTSMS_API_X_KEY', '')
					   ],
					   [
					      'name' => 'to',
						  'contents' => $data['to']
					   ],
					   [
					      'name' => 'message',
						  'contents' => $data['msg']
					   ],
					   [
					      'name' => 'routing',
						  'contents' => "3"
					   ],
					   [
					      'name' => 'type',
						  'contents' => "0"
					   ]
					]
				 ];
				 
				 
				 try
				 {
			       //$res = $client->request('POST', $url,['json' => $dt]);
			       $res = $client->request('POST', $url,$dt);
			  
                   $ret = $res->getBody()->getContents(); 
			       
				 /*******************
				 """
{
  "id": "<20191212163843.1.FF7C9DD921606F44@mg.btbusinesss.com>",
  "message": "Queued. Thank you."
}
				 ********************/
				 }
				 catch(RequestException $e)
				 {
					 $mm = (is_null($e->getResponse())) ? null: Psr7\str($e->getResponse());
					 $ret = json_encode(["status" => "error","message" => $mm]);
				 }
				 dd($ret);
				 
			     $rett = json_decode($ret);
			     if($rett->status == "queued" || $rett->status == "ok")
			     {
					 $nb = $user->balance - 1;
					 $user->update(['balance' => $nb]);
					//  $this->setNextLead();
			    	//$lead->update(["status" =>"sent"]);					
			     }
			     /**
				 
				 else
			     {
			    	// $lead->update(["status" =>"pending"]);
			     }**/
			    }
				
              return $ret; 
           }
		   
		   
           function createUser($data)
           {
			   $avatar = isset($data['avatar']) ? $data['avatar'] : "";
			   $avatarType = isset($data['avatar_type']) ? $data['avatar_type'] : "cloudinary";
			   $pass = (isset($data['pass']) && $data['pass'] != "") ? bcrypt($data['pass']) : "";
			   
           	   $ret = User::create(['fname' => $data['fname'], 
                                                      'lname' => $data['lname'], 
                                                      'email' => $data['email'], 
                                                      'phone' => $data['phone'], 
                                                      'role' => $data['role'], 
                                                      'mode' => $data['mode'], 
                                                      'mode_type' => $data['mode_type'], 
                                                      'avatar' => $avatar, 
                                                      'avatar_type' => $avatarType, 
                                                      'currency' => $data['currency'], 
                                                      'status' => $data['status'], 
                                                      'verified' => $data['verified'], 
                                                      'password' => $pass, 
                                                      ]);
                                                      
                return $ret;
           }
		   
		   	function getSetting($id)
	{
		$temp = [];
		$s = Settings::where('id',$id)
		             ->orWhere('name',$id)->first();
 
              if($s != null)
               {
				      $temp['name'] = $s->name; 
                       $temp['value'] = $s->value;                  
                       $temp['id'] = $s->id; 
                       $temp['date'] = $s->created_at->format("jS F, Y"); 
                       $temp['updated'] = $s->updated_at->format("jS F, Y"); 
                   
               }      
       return $temp;            	   
   }
		   
   
		   
		 function getUser($id)
           {
           	$ret = [];
			if($id == "admin" || $id == "su")
			{
			  if($id == "admin")
			  {
				  $ret = $this->admin;
			  }
			  else if($id == "su")
			  {
				  $ret = $this->su;
			  }
			  
			  $ret['avatar'] = "";
			}
			else
			{
				$u = User::where('email',$id)
			            ->orWhere('id',$id)->first();
              
              if($u != null)
               {
                   	$temp['fname'] = $u->fname; 
                       $temp['lname'] = $u->lname; 
                       //$temp['wallet'] = $this->getWallet($u);
                       $temp['phone'] = $u->phone; 
                       $temp['email'] = $u->email; 
                       $temp['role'] = $u->role; 
                       $temp['status'] = $u->status;
					   $temp['mode'] = $u->mode; 
                       $temp['mode_type'] = $u->mode_type; 
					   $temp['avatar'] = $this->getCloudinaryMedia([[ 'url' => $u->avatar,'src_type' => $u->avatar_type ]]);
                       $temp['verified'] = $u->verified; 
                       $temp['id'] = $u->id; 
                       $temp['date'] = $u->created_at->format("jS F, Y"); 
                       $temp['updated'] = $u->updated_at->format("jS F, Y h:i A"); 
                       $ret = $temp; 
               }
			}                                      
            
			return $ret;
           }
		   
		   
		   function getShippingDetails($user)
           {
           	$ret = [];
			$uid = isset($user->id) ? $user->id: $user;
               $sdd = ShippingDetails::where('user_id',$uid)->get();
 
              if($sdd != null)
               {
				   foreach($sdd as $sd)
				   {
				      $temp = [];
                   	   $temp['company'] = $sd->company; 
                       $temp['address'] = $sd->address; 
                       $temp['city'] = $sd->city;
                       $temp['state'] = $sd->state; 
                       $temp['zipcode'] = $sd->zipcode; 
                       $temp['id'] = $sd->id; 
                       $temp['date'] = $sd->created_at->format("jS F, Y"); 
                       array_push($ret,$temp); 
				   }
               }                         
                                                      
                return $ret;
           }
		   
		   
		   function updateProfile($data)
           {  
              $ret = 'error'; 
         
              if(isset($data['xf']))
               {
               	$u = User::where('id', $data['xf'])->first();
                   
                        if($u != null)
                        {
							$role = $u->role;
							if(isset($data['role'])) $role = $data['role'];
							$status = $u->status;
							if(isset($data['status'])) $status = $data['status'];
							$avatar = isset($data['avatar']) ? $data['avatar'] : "";
							
                        	$u->update(['fname' => $data['fname'],
                                              'lname' => $data['lname'],
                                              'email' => $data['email'],
                                              'phone' => $data['phone'],
                                              'role' => $role,
                                              'avatar' => $avatar,
                                              'status' => $status,
                                              #'verified' => $data['verified'],
                                           ]);
										   
							//$this->updateShippingDetails($user,$data);
                                           
                                           $ret = "ok";
                        }                                    
               }                                 
                  return $ret;                               
           }

           function updateShippingDetails($user, $data)
           {		
				$company = isset($data['company']) ? $data['company'] : "";

				$ss = ShippingDetails::where('user_id', $data['xf'])->first();
				
				if(is_null($ss))
				{
					$shippingDetails =  ShippingDetails::create(['user_id' => $user->id,                                                                                                          
                                                      'company' => $company, 
                                                      'address' => $data['address'],
                                                     'city' => $data['city'],
                                                'state' => $data['state'],
                                              'zipcode' => $data['zip'] 
                                                      ]);	
				}
				else
				{
					$ss->update(['company' => $company, 
                                                      'address' => $data['address'],
                                                     'city' => $data['city'],
                                                'state' => $data['state'],
                                              'zipcode' => $data['zip'] 
                                                      ]);	
				}
					
           }


function isDuplicateUser($data)
	{
		$ret = false;

		$dup = User::where('email',$data['email'])
		           ->orWhere('phone',$data['phone'])->get();

       if(count($dup) > 0) $ret = true;		
		return $ret;
	}
	
	function isValidUser($data)
	{
		$ret = false;
        $email = isset($data['email']) ? $data['email'] : "none";
        $phone = isset($data['phone']) ? $data['phone'] : "none";
		
		$dup = User::where('email',$email)
		           ->orWhere('phone',$phone)->get();

       if(count($dup) == 1) $ret = true;		
		return $ret;
	}

	function isOAuthSP($em)
	{
		$ret = false;
		
		$u = User::where('email',$em)->first();

       if($u->password == "") $ret = true;		
		return $ret;
	}
	
	function getPasswordResetCode($user)
           {
           	$u = $user; 
               
               if($u != null)
               {
               	//We have the user, create the code
                   $code = bcrypt(rand(125,999999)."rst".$u->id);
               	$u->update(['reset_code' => $code]);
               }
               
               return $code; 
           }
           
           function verifyPasswordResetCode($code)
           {
           	$u = User::where('reset_code',$code)->first();
               
               if($u != null)
               {
               	//We have the user, delete the code
               	$u->update(['reset_code' => '']);
               }
               
               return $u; 
           }
	
	
	 function getSender($id)
           {
           	$ret = [];
               $s = Senders::where('id',$id)->first();
 
              if($s != null)
               {
                   	$temp['ss'] = $s->ss; 
                       $temp['sp'] = $s->sp; 
                       $temp['se'] = $s->se;
                       $temp['sec'] = $s->sec; 
                       $temp['sa'] = $s->sa; 
                       $temp['su'] = $s->su; 
                       $temp['current'] = $s->current; 
                       $temp['spp'] = $s->spp; 
					   $temp['type'] = $s->type;
                       $sn = $s->sn;
                       $temp['sn'] = $sn;
                        $snn = explode(" ",$sn);					   
                       $temp['snf'] = $snn[0]; 
                       $temp['snl'] = count($snn) > 0 ? $snn[1] : ""; 
					   
                       $temp['status'] = $s->status; 
                       $temp['id'] = $s->id; 
                       $temp['date'] = $s->created_at->format("jS F, Y"); 
                       $ret = $temp; 
               }                          
                                                      
                return $ret;
           }
		   
		    function getCurrentSender()
		   {
			   $ret = [];
			   $s = Senders::where('current',"yes")->first();
			   
			   if($s != null)
			   {
				   $ret = $this->getSender($s['id']);
			   }
			   
			   return $ret;
		   }
		   
		    function getPlugins()
   {
	   $ret = [];
	   
	   $plugins = Plugins::where('id','>',"0")->get();
	   
	   if(!is_null($plugins))
	   {
		   foreach($plugins as $p)
		   {
			 if($p->status == "enabled")
			 {
				$temp = $this->getPlugin($p->id);
		        array_push($ret,$temp); 
			 }
	       }
	   }
	   
	   return $ret;
   }
   
   function getPlugin($id)
           {
           	$ret = [];
               $p = Plugins::where('id',$id)->first();
 
              if($p != null)
               {
                   	$temp['name'] = $p->name; 
                       $temp['value'] = $p->value; 	   
                       $temp['status'] = $p->status; 
                       $temp['id'] = $p->id; 
                       $temp['date'] = $p->created_at->format("jS F, Y"); 
                       $temp['updated'] = $p->updated_at->format("jS F, Y"); 
                       $ret = $temp; 
               }                          
                                                      
                return $ret;
           }
		   
		    function isAdmin($user)
           {
           	$ret = false; 
               if($user->role === "admin" || $user->role === "su") $ret = true; 
           	return $ret;
           }
		   
		   function generateSKU()
           {
           	$ret = "ETUK".rand(1,9999)."GN".rand(1,999);
                                                      
                return $ret;
           }
		   
	   function createApartment($data)
           {
           	$apartment_id = $this->generateSKU();
               
           	$ret = Apartments::create(['name' => $data['name'],                                                                                                          
                                                      'apartment_id' => $apartment_id, 
                                                      'user_id' => $data['user_id'],                                                       
                                                      'avb' => $data['avb'],                                                       
                                                      'url' => $data['url'],                                                       
                                                      'in_catalog' => "no", 
                                                      'status' => "pending", 
                                                      ]);
                                                      
                 $data['apartment_id'] = $ret->apartment_id;                         
                $adt = $this->createApartmentData($data);
                $aa = $this->createApartmentAddress($data);
                $at = $this->createApartmentTerms($data);
				$facilities = json_decode($data['facilities']);
				
				foreach($facilities as $f)
				{
					$af = $this->createApartmentFacilities([
					    'apartment_id' => $data['apartment_id'],
					    'facility' => $f->id,
					    'selected' => "true",
					]);
				}
                
				$ird = "none";
				$irdc = 0;
				if(isset($data['ird']) && count($data['ird']) > 0)
				{
					foreach($data['ird'] as $i)
                    {
                    	$this->createApartmentMedia([
						           'apartment_id' => $data['apartment_id'],
								   'url' => $i['public_id'],
								   'delete_token' => $i['delete_token'],
								   'deleted' => $i['deleted'],
								   'cover' => $i['ci'],
								   'type' => $i['type'],
								   'src_type' => ""
                         ]);
                    }
				}
                
                return $ret;
           }
		   
		   function createApartmentAddress($data)
           {
           	$ret = ApartmentAddresses::create(['apartment_id' => $data['apartment_id'], 
                                                      'address' => $data['address'],                                                       
                                                      'city' => $data['city'],                                                       
                                                      'lga' => $data['lga'],                                                       
                                                      'state' => $data['state'],
                                                      'country' => $data['country']
                                                      ]);
                              
                return $ret;
           }
		   
		   function createApartmentData($data)
           {
           	$ret = ApartmentData::create(['apartment_id' => $data['apartment_id'], 
                                                      'description' => $data['description'],													  
                                                      'category' => $data['category'],                                                       
                                                      'property_type' => $data['property_type'],                                                       
                                                      'rooms' => $data['rooms'],                                                       
                                                      'units' => $data['units'],                                                       
                                                      'bathrooms' => $data['bathrooms'],                                                       
                                                      'bedrooms' => $data['bedrooms'],                                                
                                                      'amount' => $data['amount']                                                       
                                                      ]);
                              
                return $ret;
           }
		   
		   function createApartmentFacilities($data)
           {
           	$ret = ApartmentFacilities::create(['apartment_id' => $data['apartment_id'], 
                                                      'facility' => $data['facility'],                                                       
                                                      'selected' => "true"                                                       
                                                      ]);
                              
                return $ret;
           }
		   
		   function createApartmentTerms($data)
           {
           	$ret = ApartmentTerms::create(['apartment_id' => $data['apartment_id'], 
                                                      'max_adults' => $data['max_adults'],                                                       
                                                      'max_children' => $data['max_children'],                                                      
                                                      'children' => $data['children'],                                                      
                                                      'pets' => $data['pets'],                                                      
                                                      'payment_type' => $data['payment_type']                                                      
                                                      ]);
                              
                return $ret;
           }
		   
		   function createApartmentMedia($data)
           {
           	$ret = ApartmentMedia::create(['apartment_id' => $data['apartment_id'], 
                                                      'url' => $data['url'],                                                       
                                                      'cover' => $data['cover'],                                                    
                                                      'type' => $data['type'],                                                      
                                                      'src_type' => $data['src_type'],                                                      
                                                      'delete_token' => $data['delete_token'],                                                 
                                                      'deleted' => $data['deleted']                                                      
                                                      ]);
                              
                return $ret;
           }
		   
		   function deleteCloudImage($imgId)
          {
			  $ret = [];
			  $img = ApartmentMedia::where('id',$imgId)->first();
          	  # dd($img);
			 //https://api.cloudinary.com/v1_1/demo/delete_by_token -X POST --data 'token=delete_token'

			   if($img == null)
			   {
				    $ret = json_encode(["status" => "ok","message" => "Invalid ID"]);
			   }
			   else
			    {  
			       $url = "https://api.cloudinary.com/v1_1/etuk-ng/delete_by_token";
			   
			     $client = new Client([
                 // Base URI is used with relative requests
                 'base_uri' => 'http://httpbin.org',
                 // You can set any number of default request options.
                 //'timeout'  => 2.0,
				 'headers' => [
                     'MIME-Version' => '1.0',
                     'Content-Type'     => 'text/html; charset=ISO-8859-1',           
                    ]
                 ]);
                  
				
				 $dt = [
				   //'auth' => [env('TWILIO_SID', ''),env('TWILIO_TOKEN', '')],
				    'multipart' => [
					   [
					      'name' => 'public_id',
						  'contents' => substr($img->url,8)
					   ],
					   [
					      'name' => 'token',
						  'contents' => $img->delete_token
					   ]
					]
				 ];
				 
				 #dd($dt);
				 try
				 {
			       //$res = $client->request('POST', $url,['json' => $dt]);
			       $res = $client->request('POST',$url,$dt);
			  
                   $ret = $res->getBody()->getContents(); 
			       
				 }
				 catch(RequestException $e)
				 {
					 $mm = (is_null($e->getResponse())) ? null: Psr7\str($e->getResponse());
					 $ret = json_encode(["status" => "error","message" => $mm]);
				 }
				 dd($ret);
			     $rett = json_decode($ret);
			     if($rett->status == "queued" || $rett->status == "ok")
			     {
					 //$nb = $user->balance - 1;
					 //$user->update(['balance' => $nb]);
					//  $this->setNextLead();
			    	//$lead->update(["status" =>"sent"]);					
			     }
			     /**
				 
				 else
			     {
			    	// $lead->update(["status" =>"pending"]);
			     }
				 **/
			    }
				
              return $ret; 
         }
		 
		 function resizeImage($res,$size)
		 {
			  $ret = Image::make($res)->resize($size[0],$size[1])->save(sys_get_temp_dir()."/upp");			   
              // dd($ret);
			   $fname = $ret->dirname."/".$ret->basename;
			   $fsize = getimagesize($fname);
			  return $fname;		   
		 }
		   
		    function uploadCloudImage($path)
          {
          	$ret = [];
          	$dt = ['cloud_name' => "etuk-ng"];
              $preset = "uwh1p75e";
			  
          	try
			  {
				$rett = \Cloudinary\Uploader::unsigned_upload($path,$preset,$dt);  
			  }
			  catch(Throwable $e)
			  {
				  $rett = ['status' => "error",'message' => "network"];
			  }   
			  
             return $rett; 
         }
		 
		 
		   
		   

     function getPopularApartments()
           {
           	$ret = [];
              $apartments = Apartments::where('id',">","0")
			                       ->where('status',"approved")->get();
								   
				$apartments = $apartments->sortByDesc('created_at');				   
 
              if($apartments != null)
               {
				  foreach($apartments as $a)
				  {
					     $aa = $this->getApartment($a->id);
					     array_push($ret,$aa); 
				  }
               }                         
                                                      
                return $ret;
           }
	 
	 function getApartments($user)
           {
           	$ret = [];
              if($user == null)
			  {
				   $apartments = Apartments::where('id',">","0")
			                       ->where('status',"approved")->get();
				   
				   $apartments = $apartments->sortByDesc('created_at');				   
 
                  if($apartments != null)
                   {
				      foreach($apartments as $a)
				      {
					     $aa = $this->getApartment($a->id,['host' => true,'imgId' => true]);
					     array_push($ret,$aa); 
				      }
                   }  
			  }
			  else
			  {
				 $apartments = Apartments::where('user_id',$user->id)
			                       ->where('status',"approved")->get();
								   
				  $apartments = $apartments->sortByDesc('created_at');				   
 
                  if($apartments != null)
                   {
				      foreach($apartments as $a)
				      {
					     $aa = $this->getApartment($a->id);
					     array_push($ret,$aa); 
				      }
                   }  
			  }
			                           
                                                      
                return $ret;
           }


    function getApartment($id,$optionalParams=[])
           {
			   $imgId = isset($optionalParams['imgId']) ? $optionalParams['imgId'] : false;
			   $host = isset($optionalParams['host']) ? $optionalParams['host'] : false;
           	  
			  $ret = [];
              $apartment = Apartments::where('id',$id)
			                 ->orWhere('apartment_id',$id)
			                 ->orWhere('url',$id)
			                 ->where('status',"approved")->first();
 
              if($apartment != null)
               {
				  $temp = [];
				  $temp['id'] = $apartment->id;
				  $temp['apartment_id'] = $apartment->apartment_id;
				  if($host) $temp['host'] = $this->getUser($apartment->user_id);
				  $temp['name'] = $apartment->name;
				  $temp['avb'] = $apartment->avb;
				  $temp['url'] = $apartment->url;
				  $temp['in_catalog'] = $apartment->in_catalog;
				  $temp['status'] = $apartment->status;
				  //$temp['discounts'] = $this->getDiscounts($product->sku);
				  $temp['data'] = $this->getApartmentData($apartment->apartment_id);
				  $temp['address'] = $this->getApartmentAddress($apartment->apartment_id);
				  $temp['terms'] = $this->getApartmentTerms($apartment->apartment_id);
				  $temp['facilities'] = $this->getApartmentFacilities($apartment->apartment_id);
				  $media = $this->getMedia(['apartment_id'=>$apartment->apartment_id,'type' => "all"]);
				  if($imgId) $temp['media'] = $media;
				  
				  $temp['cmedia'] = [
				    'images' => $this->getCloudinaryMedia($media['images']),
				    'video' => $this->getCloudinaryMedia($media['video']),
				  ];
				  $reviews = $this->getReviews($apartment->apartment_id);
				  $temp['reviews'] = $reviews;
				  $temp['rating'] = $this->getRating($reviews);
				   $temp['date'] = $apartment->created_at->format("jS F, Y h:i A");
				  $ret = $temp;
               }                         
                                                      
                return $ret;
           }


    function getApartmentData($id)
           {
           	$ret = [];
              $adt = ApartmentData::where('id',$id)
			                 ->orWhere('apartment_id',$id)->first();
 
              if($adt != null)
               {
				  $temp = [];
				  $temp['id'] = $adt->id;
				  $temp['apartment_id'] = $adt->apartment_id;
     			  $temp['description'] = $adt->description;
				  $temp['category'] = $adt->category;
     			  $temp['property_type'] = $adt->property_type;
     			  $temp['rooms'] = $adt->rooms;
     			  $temp['units'] = $adt->units;
     			  $temp['bathrooms'] = $adt->bathrooms;
     			  $temp['bedrooms'] = $adt->bedrooms;
     			  $temp['amount'] = $adt->amount;
				  $temp['landmarks'] = $adt->landmarks;
				  $ret = $temp;
               }                         
                                                      
                return $ret;
           }			   
	
	function getApartmentAddress($id)
           {
           	$ret = [];
              $aa = ApartmentAddresses::where('id',$id)
			                 ->orWhere('apartment_id',$id)->first();
 
              if($aa != null)
               {
				  $temp = [];
				  $temp['id'] = $aa->id;
				  $temp['apartment_id'] = $aa->apartment_id;
     			  $temp['address'] = $aa->address;
				  $temp['city'] = $aa->city;
				  $temp['lga'] = $aa->lga;
				  $temp['state'] = $aa->state;
				  $temp['country'] = $aa->country;
				  $ret = $temp;
               }                         
                                                      
                return $ret;
           }
	
	function getApartmentTerms($id)
           {
           	$ret = [];
              $at = ApartmentTerms::where('id',$id)
			                 ->orWhere('apartment_id',$id)->first();
 
              if($at != null)
               {
				  $temp = [];
				  $temp['id'] = $at->id;
				  $temp['apartment_id'] = $at->apartment_id;
     			  $temp['max_adults'] = $at->max_adults;
     			  $temp['max_children'] = $at->max_children;
     			  $temp['children'] = $at->children;
     			  $temp['pets'] = $at->pets;
     			  $temp['payment_type'] = $at->payment_type;
				  $ret = $temp;
               }                         
                                                      
                return $ret;
           }
		   
	function getApartmentFacilities($id)
           {
           	$ret = [];
              $afs = ApartmentFacilities::where('id',$id)
			                 ->orWhere('apartment_id',$id)->get();
 
              if($afs != null)
               {
				   foreach($afs as $af)
				   {
					   $temp = $this->getApartmentFacility($af->id);
					   array_push($ret,$temp);
				   }
               }                         
                                                      
                return $ret;
           }

	function getApartmentFacility($id)
           {
           	$ret = [];
              $af = ApartmentFacilities::where('id',$id)
			                 ->orWhere('apartment_id',$id)->first();
              #dd($af);
              if($af != null)
               {
				  $temp = [];
				  $temp['id'] = $af->id;
				  $temp['apartment_id'] = $af->apartment_id;
     			  $temp['facility'] = $af->facility;
				  $temp['selected'] = $af->selected;
				  $ret = $temp;
               }                         
                                                      
                return $ret;
           }

     function getApartmentMedia($dt)
           {
           	$ret = [];
			if($dt['type'] == "all")
			{
				$ams = ApartmentMedia::where('apartment_id',$dt['apartment_id'])->get();
			}
			else
			{
				$ams = ApartmentMedia::where('apartment_id',$dt['apartment_id'])
			                       ->where('type',$t['type'])->get();
			}
            
              if($ams != null)
               {
				  foreach($ams as $am)
				  {
				    $temp = [];
				    $temp['id'] = $am->id;
				    $temp['apartment_id'] = $am->apartment_id;
					$temp['cover'] = $am->cover;
					$temp['type'] = $am->type;
					$temp['src_type'] = $am->src_type;
				    $temp['url'] = $am->url;
				    $temp['deleted'] = $am->deleted;
				    $temp['delete_token'] = $am->delete_token;
				    array_push($ret,$temp);
				  }
               }                         
                                                      
                return $ret;
           }
		   
		   function isCoverImage($img)
		   {
			   return $img['cover'] == "yes";
		   }

		   
		   function getMedia($dt)
		   {
			   $ret = ['images' => [],'video' => []];
			   $records = collect($this->getApartmentMedia($dt));
			
			   $coverImage = $records->where('apartment_id',$dt['apartment_id'])
			                              ->where('cover',"yes")
										  ->where('type',"image")->first();
										  
               $otherImages = $records->where('apartment_id',$dt['apartment_id'])
			                              ->where('cover',"!=","yes")
										  ->where('type',"image");
				
  			   
	           if($dt['type'] == "all") $video = $records->where('apartment_id',$dt['apartment_id'])
			                              ->where('type',"video")->first();
			  
               if($coverImage != null)
			   {
				   array_push($ret['images'],$coverImage);
			   }

               if($otherImages != null)
			   {
				   foreach($otherImages as $oi)
				   {
				       array_push($ret['images'],$oi);
				   }
			   }
			   
			   if($video != null)
			   {
				   $ret['video'] = $video;
			   }
			   
			   return $ret;
		   }
		   
		   function getCloudinaryMedia($dt)
		   {
			   $ret = [];
                  
				  if(count($dt) < 1) { $ret = ["img/no-image.png"]; }
               
			   else
			   {
                   $ird = $dt[0]['url'];
				   if($ird == "none")
					{
					   $ret = ["img/no-image.png"];
					}
					else if($ird == "")
					{
						$ret = "";
					}
				   else
					{
                       for($x = 0; $x < count($dt); $x++)
						 {
							 $ix = $dt[$x];
							 $ird = $ix['url'];
							 
							 $st = $ix['src_type'];
							 #dd($type);
                            if($st == "cloudinary")
							{
								$imgg = "https://res.cloudinary.com/etuk-ng/image/upload/v1585236664/".$ird;
							}
                            else
							{
								$imgg = $ird;
							}							
                            array_push($ret,$imgg); 
                         }
					}
                }
				
				return $ret;
		   }
		   
		   function getCloudinaryImage($dt)
		   {
			   $ret = [];
                  //dd($dt);       
               if(is_null($dt)) { $ret = "img/no-image.png"; }
               
			   else
			   {
				    $ret = "https://res.cloudinary.com/etuk-ng/image/upload/v1585236664/".$dt;
                }
				
				return $ret;
		   }


function updateApartment($data)
           {
			   $apartment_id = $data['apartment_id'];
           	$apartment = Apartments::where('apartment_id',$apartment_id)->first();
			
			if($apartment != null)
			{
			  //Basic information
              $apartment->update([
			      'name' => $data['name'],                                                                                                          
                  'apartment_id' => $apartment_id, 
                  'user_id' => $data['user_id'],                                                       
                  'avb' => $data['avb'],                                                       
                  'url' => $data['url'],   
			  ]);			  
			}
                              
                $this->updateApartmentData($data);
                $this->updateApartmentAddress($data);
                $this->updateApartmentTerms($data);
				$facilities = json_decode($data['facilities']);
				ApartmentFacilities::where('apartment_id',$apartment_id)->delete();
				foreach($facilities as $f)
				{
					$af = $this->createApartmentFacilities([
					    'apartment_id' => $apartment_id,
					    'facility' => $f->id,
					    'selected' => "true",
					]);
				}
                
				if(isset($data['ird']) && count($data['ird']) > 0)
				{
					foreach($data['ird'] as $i)
                    {
                    	$this->createApartmentMedia([
						           'apartment_id' => $apartment_id,
								   'url' => $i['public_id'],
								   'delete_token' => $i['delete_token'],
								   'deleted' => $i['deleted'],
								   'cover' => $i['ci'],
								   'type' => $i['type']
                         ]);
                    }
				}
                
           }
		   
          function updateApartmentAddress($data)
           {
			   $apartment_id = $data['apartment_id'];
           	   $aa = ApartmentAddresses::where('apartment_id',$apartment_id)->first();
			
			   if($aa != null)
			   {
           	       $aa->update([
                                                      'address' => $data['address'],                                                       
                                                      'city' => $data['city'],                                                       
                                                      'lga' => $data['lga'],                                                       
                                                      'state' => $data['state'],
                                                      'country' => $data['country'],
                                                      ]);
			   }               
           }
		   
		   function updateApartmentData($data)
           {
			   $apartment_id = $data['apartment_id'];
           	   $adt = ApartmentData::where('apartment_id',$apartment_id)->first();
			
			   if($adt != null)
			   {
				   $mc = isset($data['max_children']) ? $data['max_children'] : "";
				   $landmarks = isset($data['landmarks']) ? $data['landmarks'] : "";
				   
           	       $adt->update([
                                                     'description' => $data['description'], 
                                                     'category' => $data['category'], 
                                                     'property_type' => $data['property_type'], 
                                                     'rooms' => $data['rooms'], 
                                                     'units' => $data['units'], 
                                                     'bathrooms' => $data['bathrooms'], 
                                                     'bedrooms' => $data['bedrooms'],                                                      
                                                      'amount' => $data['amount'],                                                      
                                                      'landmarks' => $landmarks,                                                      
                                                       ]);
			   }
           }
		   

		   function updateApartmentTerms($data)
           {
			    $apartment_id = $data['apartment_id'];
           	   $at = ApartmentTerms::where('apartment_id',$apartment_id)->first();
			   
           	if($at != null)
			   {
           	       $at->update([
                                                      'max_adults' => $data['max_adults'],                                                       
                                                      'max_children' => $data['max_children'],  
                                                      'children' => $data['children'],                                                      
                                                      'pets' => $data['pets'],                                                      
                                                      'payment_type' => $data['payment_type']                                                      
                                                      ]);
                }
           }


  function deleteApartment($id)
  {
	  $apartment = Apartments::where('id',$id)
	                         ->orWhere('apartment_id',$id)->first();
	  
	  if($apartment != null)
	  {
		  $aa = ApartmentAddresses::where('id',$id)
	                         ->orWhere('apartment_id',$id)->first();
		  $af = ApartmentFacilities::where('id',$id)
	                         ->orWhere('apartment_id',$id)->get();
		  $ad = ApartmentData::where('id',$id)
	                         ->orWhere('apartment_id',$id)->first();
		  $am = ApartmentMedia::where('id',$id)
	                         ->orWhere('apartment_id',$id)->get();
		  $at = ApartmentTerms::where('id',$id)
	                         ->orWhere('apartment_id',$id)->first();
		  
          if($aa != null) $aa->delete();		  
          if($af != null)
		  {
		    foreach($af as $aff) $aff->delete();  
		  }		  
          if($ad != null) $ad->delete();		  
          if($am != null)
		  {
			 #dd($am);
			foreach($am as $amm) $amm->update(['deleted' => "yes"]);  
		  }		  
          if($at != null) $at->delete();
		  
		  $apartment->delete();
	  }
  }

  function deleteApartmentImage($dt)
  {
	  $ret = "ok";
	  
	  $img = ApartmentMedia::where('id',$dt['xf'])
	                     ->where('apartment_id',$dt['apartment_id'])->first();
	  
	  if($img != null)
	  {
		  if($img->cover == "yes")
		  {
			  $ret = "isCover";
		  }
		  else
		  {
			$img->delete();  
		  }
		  
	  }
	  return $ret;
  }  

  function setCoverImage($dt)
  {
	  $img = ApartmentMedia::where('id',$dt['xf'])
	                     ->where('apartment_id',$dt['apartment_id'])->first();
	  
	  $currentCover = ApartmentMedia::where('cover',"yes")
	                     ->where('apartment_id',$dt['apartment_id'])->first();
	  
	  if($img != null && $currentCover != null && $img != $currentCover)
	  {
		  $currentCover->update(['cover' => "no"]);
		  $img->update(['cover' => "yes"]);
	  }
  }  
		   
		   
  function createReview($data)
           {
			   $ret = Reviews::create(['user_id' => $data['user_id'], 
                                                      'apartment_id' => $data['apartment_id'], 
                                                      'service' => $data['service'],
                                                      'location' => $data['location'],
                                                      'security' => $data['security'],
                                                      'cleanliness' => $data['cleanliness'],
                                                      'comfort' => $data['comfort'],
                                                      'comment' => $data['comment'],
                                                      'status' => "pending",
                                                      ]);
                
				$data['review_id'] = $ret->id;
			    $rstats = $this->createReviewStats($data);
                return $ret;
           }
		   
		   function createReviewStats($dt)
           {
			   $ret = ReviewStats::create(['review_id' => $dt['review_id'], 
                                                      'user_id' => $dt['user_id'], 
                                                      'upvotes' => "0", 
                                                      'downvotes' => "0" 
                                                      ]);
                                                      
                return $ret;
           }
		   
		   function getReviews($apartment_id)
           {
           	$ret = [];
              $reviews = Reviews::where('apartment_id',$apartment_id)
			                    ->where('status',"approved")->get();
              $reviews = $reviews->sortByDesc('created_at');	
			  
              if($reviews != null)
               {
				  foreach($reviews as $r)
				  {
					  $temp = $this->getReview($r->id);
					  array_push($ret,$temp);
				  }
               }                         
                                  
                return $ret;
           }
		   
		   function getReviewStats($id)
           {
           	$ret = [];
              $r = ReviewStats::where('review_id',$id)->first();
 
              if($r != null)
               {
				  $temp = [];
				  $temp['id'] = $r->id;
				  $temp['review_id'] = $r->review_id;
				  $temp['user_id'] = $r->user_id;
				  $temp['upvotes'] = $r->upvotes;
     			  $temp['downvotes'] = $r->downvotes;
				  $temp['date'] = $r->created_at->format("jS F, Y");
				  $temp['last_updated'] = $r->updated_at->format("jS F, Y");
				  $ret = $temp;
               }                         
                                                      
                return $ret;
           }

		   function getReview($id,$optionalParams=[])
           {
           	$ret = [];
              $r = Reviews::where('id',$id)
			                 ->orWhere('apartment_id',$id)->first();
 
              if($r != null)
               {
				   $apt = isset($optionalParams['apartment']) ? $optionalParams['apartment'] : false;
				   
				  $temp = [];
				  $temp['id'] = $r->id;
				  $temp['apartment_id'] = $r->apartment_id;
				  if($apt) $temp['apartment'] = $this->getApartment($r->apartment_id,['host' => true]);
				  $temp['user'] = $this->getUser($r->user_id);
				  $temp['stats'] = $this->getReviewStats($r->id);
     			  $temp['service'] = $r->service;
     			  $temp['location'] = $r->location;
     			  $temp['security'] = $r->security;
     			  $temp['cleanliness'] = $r->cleanliness;
     			  $temp['comfort'] = $r->comfort;
     			  $temp['comment'] = $r->comment;
     			  $temp['status'] = $r->status;
				  $temp['date'] = $r->created_at->format("jS F, Y");
				  $ret = $temp;
               }                         
                                                      
                return $ret;
           }
		   
		   function hasReview($dt)
		   {
			   $ret = false;
			   $r = Reviews::where(['user_id' => $dt['user_id'],'apartment_id' => $dt['apartment_id']])->first();
			   if($r != null) $ret = true;
			   return $ret;
		   }
		   
		   function hasVotedReview($dt)
		   {
			   $ret = false;
			   $r = ReviewStats::where(['user_id' => $dt['user_id'],'review_id' => $dt['review_id']])->first();
			   if($r != null) $ret = true;
			   #dd($ret);
			   return $ret;
		   }
		   
		   function voteReview($dt)
		   {
			   $ret = ['u' => "0",'v' => "0"];
			   $r = ReviewStats::where(['user_id' => $dt['xf'],'review_id' => $dt['rxf']])->first();
			   #dd($r);
			   if($r == null)
			   {
				   $r = $this->createReviewStats(['review_id' => $dt['rxf'],'user_id' => $dt['xf']]);
			   }
				   $u = $r->upvotes; $d = $r->downvotes;
				   
				   switch($dt['type'])
				   {
					   case "up":
					    ++$u;
					   break;
					   
					   case "down":
					    ++$d;
					   break;
				   }
				   
				   $r->update(['upvotes' => $u,'downvotes' => $d]);
				   $ret = ['u' => $u,'d' => $d];
			   
			   return $ret;
		   }
		   
		   function getRating($reviews)
		   {
			   $ret = 0;
			   			   
			   if($reviews != null && count($reviews) > 0)
			   {
				  $reviewCount = 0;
				  $temp = 0;
				  
                  foreach($reviews as $r)
				  {
					  $sum = ($r['service'] + $r['location'] + $r['security'] + $r['cleanliness'] + $r['comfort']) / 5;
					  $temp += $sum;
					  ++$reviewCount;
				  }
                  
                  if($temp > 0 && $reviewCount > 0)
				  {
					  $ret = floor($temp / $reviewCount);
				  }				  
			   }
			   
			   return $ret;
		   }
		   
		    function createService($data)
           {
           	$ret = Services::create(['name' => $data['name'], 
                                                      'tag' => $data['tag'] 
                                                      ]);
                                                      
                return $ret;
           }
		   
		   function getServices()
		   {
			   $ret = [];
			   $services = Services::where('id','>',"0")->get();
			   
			   if($services != null)
			   {
				   foreach($services as $s)
				   {
					   $temp = [];
					   $temp['tag'] = $s->tag;
					   $temp['name'] = $s->name;
					   array_push($ret,$temp);
				   }
			   }
			   
			   return $ret;
		   }
		   
		   function populateServices()
		   {
			   $services = [
										  'air-conditioning' => "Air Conditioning",
										  'adequate-parking' => "Adequate Parking",
										  'bar' => "Bar",
										  'game-room' => "Game Room",
										  'inhouse-dining' => "In-house Dining",
										  'drycleaning' => "Drycleaning",
										  'iron' => "Clothing Iron",
										  'kitchen' => "Kitchen",
										  'pool' => "Swimming Pool",
										  'fitness-facilities' => "Fitness Facilities",
										  'room-service' => "Room Service",
										  'tv' => "TV",
										  'concierge' => "Concierge",
										  'security' => "Luggage Storage",
										  'electricity' => "24hrs Electricity",
										  'king-sized-bed' => "King-sized Bed"
										];
										
				foreach($services as $k => $v)
				{
					$this->createService([
					  'tag' => $k,
					  'name' => $v,
					]);
				}
		   }
		   
		   
		   function search($data)
		   {
				 /**
^ {#1264 ▼
  +"avb": "available"
  +"city": "lagos"
  +"lga": ""
  +"state": "lagos"
  +"category": ""
  +"property_type": "none"
  +"rooms": "none"
  +"units": "none"
  +"bedrooms": "none"
  +"bathrooms": "none"
  +"max_adults": "4"
  +"max_children": "0"
  +"amount": "0"
  +"children": "none"
  +"pets": "no"
  +"facilities": []
  +"rating": "4"
  +"kids": "0"
  +"adults": "1"
				 **/
				 
			   $dt = json_decode($data);
			 #dd($dt);
			 $avb = $dt->avb;
			 $city = $dt->city == "" ? $dt->state: $dt->city;
			 $lga = $dt->lga == "" ? $dt->state: $dt->lga;
			 $country = $dt->country == "" ? $dt->country: "nigeria";
			 $state = $dt->state;
			 $max_adults = $dt->max_adults;
			 $max_children = $dt->max_children;
			 
			 if(isset($dt->kids) && $dt->kids > 0)
			 {
				 if($dt->kids > $dt->max_children) $max_children = $dt->kids;
			 }
			 if(isset($dt->adults) && $dt->adults > 0)
			 {
				 if($dt->adults > $dt->max_adults) $max_adults = $dt->adults;
			 }
			 $amount = $dt->amount;
			 $category = $dt->category;
			 $property_type = $dt->property_type;
			 $rooms = $dt->rooms;
			 $units = $dt->units;
			 $bathrooms = $dt->bathrooms;
			 $bedrooms = $dt->bedrooms;
			 $children = $dt->children;
			 $pets = $dt->pets;
			 $rating = $dt->rating;
			 $facilities = $dt->facilities;
			 
			 //Location
			 $byAddress = ApartmentAddresses::where('city',"LIKE","%$city%")
				              ->where('state',"LIKE","%$state%")
			                  ->where('country',"LIKE","%$country%")->get();
			 
             //Apartment			 
			 $byApartment = Apartments::where('avb',"LIKE","%$avb%")->get();
			 
			 //Facilities
			 $byFacilities = ApartmentFacilities::whereIn('facility',$facilities)->get();
			 
			 //Terms
			 $byTerms = ApartmentTerms::where([
			                           'children' => $children,
			                           'pets' => $pets,
									   ])
									   ->where('max_adults',"<=",$max_adults)
			                           ->where('max_children',"<=",$max_children)->get();
			 
			 //Data
			 $byData = ApartmentData::where('category',"LIKE",$category)
			                        ->orWhere('property_type',"LIKE",$property_type)
			                        ->orWhere('rooms',"LIKE",$rooms)
			                        ->orWhere('units',"LIKE",$units)
			                        ->orWhere('bathrooms',"LIKE",$bathrooms)
			                        ->orWhere('bedrooms',"LIKE",$bedrooms)
									->orWhere('amount',"<=",$amount)->get();
									   
			 //collect all
			 $ret = [];
			 if($byAddress != null)
			 {
				 foreach($byAddress as $ba)
				 {
					 array_push($ret,$ba->apartment_id);
				 }
			 }
			 
			 if($byApartment != null)
			 {
				 foreach($byApartment as $bapt)
				 {
					 array_push($ret,$bapt->apartment_id);
				 }
			 }
			 
			 if($byFacilities != null)
			 {
				 foreach($byFacilities as $bf)
				 {
					 array_push($ret,$bf->apartment_id);
				 }
			 }
			 
			 if($byTerms != null)
			 {
				 foreach($byTerms as $bt)
				 {
					 array_push($ret,$bt->apartment_id);
				 }
			 }
			 if($byData != null)
			 {
				 $byData = $byData->where('amount',"<=",$amount);
				 
				 foreach($byData as $bd)
				 {
					 array_push($ret,$bd->apartment_id);
				 }
			 }
			 
			 $ret = array_unique($ret);
			 $ratings = [];
			 
			 //Get the reviews of each result and filter by rating
			 foreach($ret as $r)
			 {
				 $reviews = $this->getReviews($r);
				 $rr = $this->getRating($reviews);
				 $ratings[$r] = $rr;
			 }
			 
			 $finalIDs = [];
			 $finalResults = [];
			 
			 foreach($ratings as $k => $v)
			 {
				 if($v >= $rating)
				 {
					 array_push($finalIDs,$k);
				 }
			 }
			 
			 foreach($finalIDs as $fid)
			 {
				 $temp = $this->getApartment($fid,['imgId' => true]);
				 if($temp['status'] == "approved") array_push($finalResults,$temp);
			 }
			 #dd($finalResults);
			 return $finalResults;
		   }



function createSocial($data)
           {
			   $token = isset($data['token']) ? $data['token'] : "";
			   $ret = Socials::create(['name' => $data['name'], 
                                                      'email' => $data['email'],
                                                      'token' => $token,
                                                      'type' => $data['type']
                                                      ]);
                                                      
                return $ret;
           }
		   
		   function getSocials($em)
           {
           	$ret = [];
              $socials = Socials::where('email',$em)->get();
              $socials = $socials->sortByDesc('created_at');	
			  
              if($socials != null)
               {
				  foreach($socials as $s)
				  {
					  $temp = $this->getSocial($s->id);
					  array_push($ret,$temp);
				  }
               }                         
                                  
                return $ret;
           }
		   
		   function getSocial($id)
           {
           	$ret = [];
              $s = Socials::where('id',$id)
			                 ->orWhere('email',$id)->first();
 
              if($s != null)
               {
				  $temp = [];
				  $temp['id'] = $s->id;
				  $temp['name'] = $s->name;
				  $temp['token'] = $s->token;
     			  $temp['email'] = $s->email;
     			  $temp['type'] = $s->type;
				  $temp['date'] = $s->created_at->format("jS F, Y");
				  $ret = $temp;
               }                         
                                                      
                return $ret;
           }
		   
		   
		   function oauth($dt)
		   {
			   #dd($dt);
			   /**
^ array:5 [▼
  "name" => "Tobi Kudayisi"
  "type" => "google"
  "email" => "kudayisitobi@gmail.com"
  "img" => "https://lh5.googleusercontent.com/-4mnp7uOSAcQ/AAAAAAAAAAI/AAAAAAAAAAA/AMZuucnPGlNuP-mD3NeQ2yJaa3I_OzCrzQ/photo.jpg"
  "token" => "ya29.a0AfH6SMCXQrY-b4cp1DDLepffsJKBg7tHsoGTuDuXCGguKJ-IAuK3ZGCu2bSJ3MByO2H4YQmLDJ1T2z2QC5JiyZkASGWN_xc1gI4UBv9TOu4S15w5r4XdusffD_xKdo8P-BCvzX0Ti5pa4zTVUl3YDcZvw ▶"
]
			   **/
			    $ret = ['status' => "error",
					           'message' => "oauth"
							  ];
							  
			   if($dt != null && count($dt) > 0)
			   {
				    $s = [
					          'name' => $dt['name'],
					          'email' => $dt['email'],
					          'type' => $dt['type'],
					          'token' => $dt['token']
					        ];
							
				   //check if user exists in db
				   $userExists = $this->isValidUser($dt);
				   $social =  Socials::where('email',$dt['email'])
				                           ->where('type',$dt['type'])->first();
				   if($userExists)
				   {
					   //user exists. Log user in
					   $u = User::where('email',$dt['email'])->first();
					   if($u->password == "")
					   {
						   //User signed up via social and has not set password
						  
                            $ret = [
							   'status' => "ok",
					           'message' => "existing-user-no-pass",
							   'user' => $u
							  ];
					   }
					   else
					   {
						  //User exists and has password. Sign user in 
						  Auth::login($u);
					      $ret = [
						          'status' => "ok",
					              'message' => "existing-user",
					              'user' => $u
							     ];  
					   }
				   }
				   else
				   {
					   //user does not exist. create new user
                       $nn = explode(" ",$dt['name']);
                       $dt['fname'] = $nn[0];
                       $dt['lname'] = $nn[1];
                       $dt['phone'] = "";
                       $dt['pass'] = "";
                       $dt['role'] = "user";    
                       $dt['status'] = "enabled";           
                       $dt['mode'] = "guest";           
                       $dt['currency'] = "ngn";           
                       $dt['verified'] = "yes";
					  
                       $uu = $this->createUser($dt);
                       
					   //set avatar 
					  if($uu->avatar == "") $uu->update(['avatar' => $dt['img'],'avatar_type' => "social"]);
					  
                       //set password for new user
                       $ret = ['status' => "ok",
					           'message' => "new-user",
							   'user' => $uu
							  ];
						
				   }
				   
				   //save social profile
                   if($social == null) $s = $this->createSocial($s);
			   }
			   
			   return $ret;
		   }
		   
		   
		   function createMessage($dt)
		   {
			   $ret = Messages::create(['user_id' => $dt['user_id'], 
                                                      'host' => $dt['host'], 
                                                      'msg' => $dt['msg'], 
                                                      'sent_by' => $dt['sent_by'], 
                                                      'apartment_id' => $dt['apartment_id'], 
                                                      'status' => "unread", 
                                                      ]);
                                                      
                return $ret;
		   }
		   
		   function getMessage($id)
		   {
			   $ret = [];
			   $m = Messages::where('id',$id)->first();
			   
			   if($m != null)
               {
				  $temp = [];
				  $temp['id'] = $m->id;
				  $temp['guest'] = $this->getUser($m->user_id);
				  $temp['host'] = $this->getUser($m->host);
				  $temp['sent_by'] = $m->sent_by;
				  $temp['apartment_id'] = $m->apartment_id;
				  $temp['msg'] = $m->msg;
				  $temp['status'] = $m->status;
     			  $temp['date'] = $m->created_at->format("m/d/Y h:i A");
				  $ret = $temp;
               }

               return $ret;			   
		   }
		   
		   function getMessages($dt)
           {
           	$ret = [];
			  $messages = null;
			  $tt = isset($dt['type']) ? $dt['type'] : "inbox";
			  
			  switch($tt)
			  {
				  case "inbox":
				   $messages = Messages::where(['host' => $dt['user_id']])->get();
				  break;
				  
				  case "sent":
				   $messages = Messages::where(['user_id' => $dt['user_id']])->get();
				  break;
				  
				  case "all":
				   $messages = Messages::where(['user_id' => $dt['user_id']])
				                       ->orWhere(['host' => $dt['user_id']])->get();
				  break;
			  }
			  
              if($messages != null)
               {
				   $messages = $messages->sortByDesc('created_at');	
			  
				  foreach($messages as $m)
				  {
					  $temp = $this->getMessage($m->id);
					  array_push($ret,$temp);
				  }
               }                         
                                  
                return $ret;
           }
		   
		   function getChatHistory($dt)
		   {
			   $ret = [];
			   
			   if(isset($dt['user_id']) && isset($dt['apt']))
			   {
				   $apt = Apartments::where('apartment_id',$apt)->first();
				   
				   if($apt != null)
				   {
					   $ret = $this->getMessages(['user_id' => $dt['user_id'],'host' => $apt->user_id]);
				   }
			   }
			   
			   return $ret;
		   }
		   
		   function chat($dt)
		   {
			   $ret = null;
			    $apt = Apartments::where('apartment_id',$dt['apartment_id'])->first();
				
				if($apt != null)
				{
					$dt['host'] = $apt->user_id;
					$ret = $this->createMessage($dt);							   
				}
			   return $ret;
		   }


           function createApartmentTip($dt)
		   {
			   $ret = ApartmentTips::create(['title' => $dt['title'], 
                                                      'msg' => $dt['msg'] 
                                                      ]);
                                                      
                return $ret;
		   }
		   
		   function getApartmentTip($id)
		   {
			   $ret = [];
			   $t = ApartmentTips::where('id',$id)->first();
			   
			   if($t != null)
               {
				  $temp = [];
				  $temp['id'] = $t->id;
				  $temp['title'] = $t->title;
				  $temp['msg'] = $t->msg;
     			  $temp['date'] = $t->created_at->format("m/d/Y h:i A");
				  $ret = $temp;
               }

               return $ret;			   
		   }
		   
		   function getApartmentTips()
           {
           	$ret = [];
			 
			$tips = ApartmentTips::where('id','>','0')->get();
			  
              if($tips != null)
               {
				   $tips = $tips->sortByDesc('created_at');	
			  
				  foreach($tips as $t)
				  {
					  $temp = $this->getApartmentTip($t->id);
					  array_push($ret,$temp);
				  }
               }                         
                                  
                return $ret;
           }
		   
		   function populateTips()
		   {
			     $tips = [
								      ['title' => "Tip 1",'msg' => "Experience with the responsive and adaptive design is strongly preferred. Also, an understanding of the entire web development process, including design, development, and deployment is preferred."],
								      ['title' => "Tip 2",'msg' => "Experience with the responsive and adaptive design is strongly preferred. Also, an understanding of the entire web development process, including design, development, and deployment is preferred."],
								      ['title' => "Tip 3",'msg' => "Experience with the responsive and adaptive design is strongly preferred. Also, an understanding of the entire web development process, including design, development, and deployment is preferred."],
								  ];
				foreach($tips as $t) $this->createApartmentTip($t);
		   }
		 
		   
		   function addToCart($data)
           {
			  $xf = $data['user_id'];
			 $axf = $data['axf'];
			 $ret = "error";
			 
			 $a = Apartments::where(['user_id' => $xf,'id' => $axf])->first();
			 #dd($a);
			 if($a == null)
			 {
				 $aa = Apartments::where(['id' => $axf])->first();
			    $c = Carts::where(['user_id' => $xf,'apartment_id' => $aa->apartment_id])->first();

			    if(is_null($c))
			    {
				    $c = Carts::create(['user_id' => $xf, 
                                                      'apartment_id' => $aa->apartment_id, 
                                                      'checkin' => $data['checkin'],
                                                      'checkout' => $data['checkout'],
                                                      'guests' => $data['guests'],
                                                      'kids' => $data['kids']
                                                      ]); 
				
				     $ret = "ok";
			    }	 
			 }
			 else
			 {
				$ret = "host"; 
			 }
			 
             return $ret;
           }
		   
		    function updateCart($dt)
           {
			  dd($dt);
           	   $userId = $dt['user_id'];
			 $ret = "error";
			 
			 $c = Carts::where('user_id',$userId)
			           ->where('sku',$dt['sku'])->first();
             $p = Products::where('sku',$dt['sku'])->first();
			 
			if($c != null && $p != null && $p->qty >= $dt['qty'])
			{
                $c->update(['qty' => $dt['qty']]);				
				$ret = "ok";
			}        
                                                      
                return $ret;
           }	
           function removeFromCart($data)
           {
           	   $xf = $data['user_id'];
			   $axf = $data['axf'];
			   $c = Carts::where(['user_id' => $xf,'apartment_id' => $axf])->first();
			
			if(!is_null($c))
			{
			  $c->delete(); 
            }
			                                          
            return "ok";
           }
		   
		    function getCart($user,$r="")
           {
           	$ret = ['data' => [],'subtotal' => 0];
			$uu = ""; $rett = [];		
			
			  if(is_null($user))
			  {
				$uu = $r;
			  }
              else
			  {
				$uu = $user->id;

                //check if guest mode has any cart items
                $guestCart = Carts::where('user_id',$r)->get();
                //dd($guestCart);
                if(count($guestCart) > 0)
				{
					foreach($guestCart as $gc)
					{
						/**
						$temp = ['user_id' => $uu,'sku' => $gc->sku,'qty' => $gc->qty];
						$this->addToCart($temp);
						$gc->delete();
						**/
					}
				}				
			  }

			  $carts = Carts::where('user_id',$uu)->get();
			  #dd($uu);
              if($carts != null)
               {
				   $carts = $carts->sortByDesc('created_at');
				   
               	foreach($carts as $c) 
                    {
                    	$temp = []; 
               	     $temp['id'] = $c->id; 
               	     $temp['user_id'] = $c->user_id; 
               	     $temp['apartment_id'] = $c->apartment_id; 
                        $apt = $this->getApartment($c->apartment_id,['host' => true]); 
                        $temp['apartment'] = $apt;
                        $adata = $apt['data'];						
						
						$checkin = Carbon::parse($c->checkin);
						$checkout = Carbon::parse($c->checkout);
                        $temp['checkin'] = $checkin->format("jS F, Y");
                        $temp['checkout'] = $checkout->format("jS F, Y");
                        $c1 = new \DateTime($temp['checkin']);
						$c2 = new \DateTime($temp['checkout']);
						$cdiff = $c1->diff($c2);
						$duration = $cdiff->format("%r%a");		
                        $ret['subtotal'] += ($adata['amount'] * $duration);						
                        $temp['guests'] = $c->guests; 
                        $temp['kids'] = $c->kids; 
                        array_push($rett, $temp); 
                   }
               }                                 
              			  
                $ret['data'] = $rett;
				return $ret;
           }
           function clearCart($user)
           {
			  if(is_null($user))
			  {
				  $uu = isset($_COOKIE['gid']) ? $_COOKIE['gid'] : "";;
			  }
              else
			  {
				$uu = $user->id;  
			  }
			   
           	$ret = [];
               $cart = Carts::where('user_id',$uu)->get();
 
              if($cart != null)
               {
               	foreach($cart as $c) 
                    {
                    	$c->delete(); 
                   }
               }                                 
           }
           
           
           function getRandomString($length_of_string) 
           { 
  
              // String of all alphanumeric character 
              $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; 
  
              // Shufle the $str_result and returns substring of specified length 
              return substr(str_shuffle($str_result),0, $length_of_string); 
            }
            
            
           function createSavedPayment($dt)
		   {
			   $ret = SavedPayments::create(['user_id' => $dt['user_id'], 
                                             'type' => $dt['type'],
                                             'gateway' => $dt['gateway'],
                                             'data' => $dt['data'],
                                             'status' => $dt['status'],
                                            ]);
                                                      
                return $ret;
		   }
		   
		   function getSavedPayment($id)
		   {
			   $ret = [];
			   $t = SavedPayments::where('id',$id)->first();
			   
			   if($t != null)
               {
				  $temp = [];
				  $temp['id'] = $t->id;
				  $temp['user_id'] = $t->user_id;
				  $temp['type'] = $t->type;
				  $temp['gateway'] = $t->gateway;
				  $temp['data'] = json_decode($t->data);
				  $temp['status'] = $t->status;
     			  $temp['date'] = $t->created_at->format("m/d/Y h:i A");
     			  $temp['updated'] = $t->updated_at->format("m/d/Y h:i A");
				  $ret = $temp;
               }

               return $ret;			   
		   }
		   
		   function getSavedPayments($dt)
           {
           	$ret = [];
			$uid = "";
			
			if(isset($dt['user_id'])) $uid = $dt['user_id'];
			else if(isset($dt->id)) $uid = $dt->id;
			else $uid = $dt;
			
			$sps = SavedPayments::where('user_id',$uid)->get();
			  
              if($sps != null)
               {
				   $sps = $sps->sortByDesc('created_at');	
			  
				  foreach($sps as $sp)
				  {
					  $temp = $this->getSavedPayment($sp->id);
					  array_push($ret,$temp);
				  }
               }                         
                                  
                return $ret;
           }
		   
		   function removeSavedPayment($id)
		   {
			   $ret = "error";
			   $ret = [];
			   $t = SavedPayments::where('id',$id)->first();
			   
			   if($t != null)
               {
				  $t->delete();
				  $ret = "ok";
               }

               return $ret;			   
		   }
		   
		   
		   function checkout($u,$data,$type="paystack")
		   {
			  //dd($data);
			   $ret = [];
			   
			   switch($type)
			   {
				  case "paystack":
                 	$ret = $this->payWithPayStack($u, $data);
                  break;
			   }
			   
			   return $ret;
		   }
		   
		   function subscribe($user,$payStackData)
		   {
			   $md = $payStackData['metadata'];
			   $sps = $md['sps'];
			   $ref = $payStackData['reference'];
			   $plan = $this->getPlan($payStackData['plan']);
			   #dd($payStackData);
			   $ret = "error";
			   
			   if(count($plan) > 1)
			   {
				   $ret = "ok";
				   
				   $this->createUserPlan([
					  'user_id' => $user->id,
					  'plan_id' => $plan['id'],
					  'ps_ref' => $ref,
					  'status' => "enabled"
					]);
				   
                    //add to saved payments
			        if($sps == "yes")
			        {
				      $authorization = $payStackData['authorization'];
				      $authorization['auth_email'] = $user->email;
				  
				      $sp = SavedPayments::where([
				        'user_id' => $user->id,
					    'data' => json_encode($authorization)
				      ])->first();
				  
				      if($sp == null)
				      {
					     $this->createSavedPayment([
		                   'user_id' => $user->id,
		                   'type' => "subscribe",
		                   'gateway' => "paystack",
		                   'data' => json_encode($authorization),
		                   'status' => "enabled"
	    	             ]);  
				      }
		            }				   
			   }
			   
			   return $ret;
		   }
		   
		   function payWithPayStack($user, $payStackResponse)
           { 
              $md = $payStackResponse['metadata'];
			  #dd($md);
              $amount = $payStackResponse['amount'] / 100;
              $psref = $payStackResponse['reference'];
              $ref = $md['ref'];
              $type = $md['type'];
              $sps = $md['sps'];
              $dt = [];
              
              if($type == "checkout"){
               	$dt['amount'] = $amount;
				$dt['ref'] = $ref;
				$dt['notes'] = isset($md['notes']) ? $md['notes'] : "";
				$dt['ps_ref'] = $psref;
				$dt['type'] = "card";
				$dt['status'] = "paid";
				
              }
              
              //create order
              $this->addOrder($user,$dt);
			  
			  //add to saved payments
			  if($sps == "yes")
			  {
				  $authorization = $payStackResponse['authorization'];
				  $authorization['auth_email'] = $user->email;
				  
				  $sp = SavedPayments::where([
				    'user_id' => $user->id,
					'data' => json_encode($authorization)
				  ])->first();
				  
				  if($sp == null)
				  {
					 $this->createSavedPayment([
		               'user_id' => $user->id,
		               'type' => "checkout",
		               'gateway' => "paystack",
		               'data' => json_encode($authorization),
		               'status' => "enabled"
	    	         ]);  
				  }
		            
			  }
		      
                return ['status' => "ok",'dt' => $dt];
           }
		   
		   
		   function addOrder($user,$data,$gid=null)
           {
           	#dd($data);
			   $cart = [];
			   $gid = isset($_COOKIE['gid']) ? $_COOKIE['gid'] : "";  
           	   $order = $this->createOrder($user, $data);
			   
                $cart = $this->getCart($user,$gid);
			#dd($cart);
			 $cartt = $cart['data'];
			 
               #create order details
               foreach($cartt as $c)
               {
				   $temp = []; 
               	     $temp['apartment_id'] = $c['apartment_id']; 
                        $temp['checkin'] = $c['checkin'];
                        $temp['checkout'] = $c['checkout']; 
                        $temp['guests'] = $c['guests']; 
                        $temp['kids'] = $c['kids']; 
                       $temp['order_id'] = $order->id;
				    $oi = $this->createOrderItems($temp);
					
					//create host transaction
                    $host = $c['apartment']['host']; 
                    $this->createTransaction([
					  'user_id' => $host['id'],
					  'item_id' => $oi->id,
					  'apartment_id' => $c['apartment_id']
					]);
                    					
               }

               #send transaction email to admin
               //$this->sendEmail("order",$order);  
               
			   
			   //clear cart
			   $this->clearCart($user);
			   
			   //if new user, clear discount
			   //$this->clearNewUserDiscount($user);
			   return $order;
           }

           function createOrder($user, $dt)
		   {
			   #dd($dt);
			   $psref = isset($dt['ps_ref']) ? $dt['ps_ref'] : "";
			   
		
				 $ret = Orders::create(['user_id' => $user->id,
			                          'reference' => $dt['ref'],
			                          'ps_ref' => $psref,
			                          'amount' => $dt['amount'],
			                          'type' => $dt['type'],
			                          'notes' => $dt['notes'],
			                          'status' => $dt['status'],
			                 ]);   
			   
			  return $ret;
		   }

		   function createOrderItems($dt)
		   {
			   $ret = OrderItems::create(['order_id' => $dt['order_id'],
			                          'apartment_id' => $dt['apartment_id'],
			                          'checkin' => $dt['checkin'],
			                          'checkout' => $dt['checkout'],
			                          'guests' => $dt['guests'],
			                          'kids' => $dt['kids'],
			                 ]);
			  return $ret;
		   }
		   
		    function getOrders($user)
           {
           	$ret = [];

			  $orders = Orders::where('user_id',$user->id)->get();
			  $orders = $orders->sortByDesc('created_at');
			  
			  #dd($uu);
              if($orders != null)
               {
               	  foreach($orders as $o) 
                    {
                    	$temp = $this->getOrder($o->reference);
                        array_push($ret, $temp); 
                    }
               }                                 
              			  
                return $ret;
           }
		   
		   
		   
		   function getOrder($ref)
           {
           	$ret = [];

			  $o = Orders::where('id',$ref)
			                  ->orWhere('reference',$ref)->first();
			  #dd($o);
              if($o != null)
               {
				  $temp = [];
                  $temp['id'] = $o->id;
                  $temp['user_id'] = $o->user_id;
                  $temp['reference'] = $o->reference;
                  $temp['amount'] = $o->amount;
                  $temp['type'] = $o->type;
                  $temp['notes'] = $o->notes;
                  $temp['status'] = $o->status;
                  $temp['items'] = $this->getOrderItems($o->id);
                  $temp['date'] = $o->created_at->format("jS F, Y");
                  $ret = $temp; 
               }                                 
              			  
                return $ret;
           }
		   
		   function getOrderItems($id)
           {
           	$ret = ['data' => [],'subtotal' => 0];

			  $items = OrderItems::where('order_id',$id)->get();
			  #dd($uu);
              if($items != null)
               {
               	  	foreach($items as $i) 
                    {
                    	$temp = $this->getOrderItem($i->id);
                        array_push($ret['data'], $temp); 
						$ret['subtotal'] += $temp['amount'];						
                   }
               }			   
              			  
                return $ret;
           }
		   
		   function getOrderItem($id)
		   {
			   $temp = [];
			    $i = OrderItems::where('id',$id)->first();
				
				if($i != null)
				{
					$temp['id'] = $i->id; 
                    $o = Orders::where('id',$i->order_id)->first();					 
                     $temp['order_id'] = $o->reference;
               	     $temp['apartment_id'] = $i->apartment_id; 
                        $apt = $this->getApartment($i->apartment_id,['host' => true]); 
                        $temp['apartment'] = $apt;
                        $adata = $apt['data'];	
                        $checkin = Carbon::parse($i->checkin);
						$checkout = Carbon::parse($i->checkout);
                        $temp['checkin'] = $checkin->format("jS F, Y");
                        $temp['checkout'] = $checkout->format("jS F, Y");
                        $c1 = new \DateTime($temp['checkin']);
						$c2 = new \DateTime($temp['checkout']);
						$cdiff = $c1->diff($c2);
						$duration = $cdiff->format("%r%a");						
                        $temp['amount'] = $adata['amount'] * $duration;
						$temp['guests'] = $i->guests; 
                        $temp['kids'] = $i->kids;
				}
			    
				return $temp;
		   }
		   
		   function createSavedApartment($dt)
		   {
			   $ret = SavedApartments::create(['user_id' => $dt['user_id'], 
                                             'apartment_id' => $dt['apartment_id']
                                            ]);
                                                      
                return $ret;
		   }
		   
		   function getSavedApartment($id)
		   {
			   $ret = [];
			   $a = SavedApartments::where('id',$id)->first();
			   
			   if($a != null)
               {
				  $temp = [];
				  $temp['id'] = $a->id;
				  $temp['user_id'] = $a->user_id;
				  $temp['apartment_id'] = $a->apartment_id;
				  $temp['apartment'] = $this->getApartment($a->apartment_id);
				  $temp['date'] = $a->created_at->format("m/d/Y h:i A");
     			  $ret = $temp;
               }

               return $ret;			   
		   }
		   
		   function getSavedApartments($user)
           {
           	$ret = [];
			$sapts = SavedApartments::where('user_id',$user->id)->get();
			  
              if($sapts != null)
               {
				   $sps = $sapts->sortByDesc('created_at');	
			  
				  foreach($sapts as $sa)
				  {
					  $temp = $this->getSavedApartment($sa->id);
					  array_push($ret,$temp);
				  }
               }                         
                                  
                return $ret;
           }
		   
		   function removeSavedApartment($dt)
		   {
			   $ret = "error";
			   $a = SavedApartments::where([
			                          'user_id' => $dt['user_id'],
									  'apartment_id' => $dt['xf']
									 ])->first();
			   
			   if($a != null)
               {
				  $a->delete();
				  $ret = "ok";
               }

               return $ret;			   
		   }
		   
		   function isApartmentSaved($xf,$axf)
		   {
			   $ret = false;
			   $sapt = SavedApartments::where(['user_id' => $xf,'apartment_id' => $axf])->first();
			   if($sapt != null) $ret = true;
			   
			   return $ret;
		   }
		   
		   function createTransaction($dt)
		   {
			   $ret = Transactions::create(['user_id' => $dt['user_id'], 
                                             'apartment_id' => $dt['apartment_id'],
                                             'item_id' => $dt['item_id'],
                                            ]);
                                                      
                return $ret;
		   }
		   
		   function getTransaction($id)
		   {
			   $ret = [];
			   $t = Transactions::where('id',$id)->first();
			   
			   if($t != null)
               {
				  $temp = [];
				  $temp['id'] = $t->id;
				  $temp['user_id'] = $t->user_id;
				  $temp['apartment_id'] = $t->apartment_id;
				  $temp['item'] = $this->getOrderItem($t->item_id);
				  $temp['date'] = $t->created_at->format("m/d/Y h:i A");
     			  $ret = $temp;
               }

               return $ret;			   
		   }
		   
		   function getTransactions($user)
           {
           	$ret = [];
			$transactions = Transactions::where('user_id',$user->id)->get();
			  
              if($transactions != null)
               {
				   $transactions = $transactions->sortByDesc('created_at');	
			  
				  foreach($transactions as $t)
				  {
					  $temp = $this->getTransaction($t->id);
					  array_push($ret,$temp);
				  }
               }                         
                                  
                return $ret;
           }
		   
		   function getTransactionData($user,$dt=[])
           {
			 $month = isset($dt['month']) ? $dt['month'] : date("m");
			 $year = isset($dt['year']) ? $dt['year'] : date("Y");
			 $ret = [];
			 #dd([$month,$year]);
			
			 $transactions = Transactions::whereMonth('created_at',$month)
			                             ->whereYear('created_at',$year)->get();
										 
              if($transactions != null)
               {   
				   $transactions = $transactions->sortByDesc('created_at');	
			  
				  foreach($transactions as $t)
				  {
					  $temp = $this->getTransaction($t->id);
					  array_push($ret,$temp);
				  }
               }                         
                                  
                return $ret;
           }
		   
		   function getBestSellingApartments($user,$dt=[])
           {
			 $month = isset($dt['month']) ? $dt['month'] : date("m");
			 $year = isset($dt['year']) ? $dt['year'] : date("Y");
			 $ret = [];
			 #dd([$month,$year]);
			 
			 /**
				[
                    { value: 70, label: 'foo' },
                    { value: 15, label: 'bar' },
                    { value: 10, label: 'baz' },
                    { value: 5, label: 'A really really long label' }
                ]
				**/
			 $apartments = Apartments::where('user_id',$user->id)->get();
			 							 
              if($apartments != null)
               {   
		          foreach($apartments as $a)
				  {
				     $transactions = Transactions::where('apartment_id',$a->apartment_id)
				                         ->whereMonth('created_at',$month)
			                             ->whereYear('created_at',$year)->get();
				
			        $sum = 0;
				    foreach($transactions as $t)
				    {
					   $tt = $this->getTransaction($t->id);
					   $temp = [];
					   $item = $tt['item'];
					   $sum += $item['amount'];
				    }
					$temp = ['label' => $a->name,'value' => number_format($sum)];
					array_push($ret,$temp);
				  }
               }                         
                                  
                return $ret;
           }
		   
		    function createPreference($dt)
		   {
			   $p = Preferences::where('user_id',$dt['user_id'])->first();
			   $facilities = json_decode($dt['facilities']);
			   
			   if($p == null)
			   {
	 
				   $p = Preferences::create(['user_id' => $dt['user_id'], 
                                             'avb' => $dt['avb'],
                                             'rating' => $dt['rating']
                                            ]);
					
					$dt['preference_id'] = $p->id;
					
					$this->createPreferenceAddress($dt);
					$this->createPreferenceData($dt);
					$this->createPreferenceTerms($dt);	
			   }
			   else
			   {
				   $p->update(['avb' => $dt['avb'],
                                             'rating' => $dt['rating']
                                            ]);
											
					$dt['preference_id'] = $p->id;						
				   PreferenceFacilities::where('preference_id',$dt['preference_id'])->delete();
				   $this->updatePreferenceAddress($dt);
					$this->updatePreferenceData($dt);
					$this->updatePreferenceTerms($dt);
			   }
			   
			   foreach($facilities as $f)
				{
					$af = $this->createPreferenceFacilities([
					    'preference_id' => $dt['preference_id'],
					    'facility' => $f->id
					]);
				}
                                               
                return $p;
		   }
		   
		   function createPreferenceAddress($data)
           {
			   $address = isset($data['address']) ? $data['address'] : "";
			   $city = isset($data['city']) ? $data['city'] : "";
			   $lga = isset($data['lga']) ? $data['lga'] : "";
			   $state = isset($data['state']) ? $data['state'] : "";
			   
           	$ret = PreferenceAddresses::create(['preference_id' => $data['preference_id'], 
                                                      'address' => $address,                                                       
                                                      'city' => $city,                                                       
                                                      'lga' => $lga,                                                       
                                                      'state' => $state
                                                      ]);
                              
                return $ret;
           }
		   
		   function createPreferenceData($data)
           {
           	$ret = PreferenceData::create(['preference_id' => $data['preference_id'], 
                                                      'category' => $data['category'],                                                       
                                                      'property_type' => $data['property_type'],                                                       
                                                      'rooms' => $data['rooms'],                                                       
                                                      'units' => $data['units'],                                                       
                                                      'bathrooms' => $data['bathrooms'],                                                       
                                                      'bedrooms' => $data['bedrooms'],                                                
                                                      'amount' => $data['amount']                                                       
                                                      ]);
                              
                return $ret;
           }
		   
		   
		   function createPreferenceTerms($data)
           {
           	$ret = PreferenceTerms::create(['preference_id' => $data['preference_id'], 
                                                      'max_adults' => $data['max_adults'],                                                       
                                                      'max_children' => $data['max_children'],                                                      
                                                      'children' => $data['children'],                                                      
                                                      'pets' => $data['pets'],                                                      
                                                      'payment_type' => $data['payment_type']                                                      
                                                      ]);
                              
                return $ret;
           }
		   
		   function createPreferenceFacilities($dt)
		   {
			   $ret = PreferenceFacilities::create(['preference_id' => $dt['preference_id'], 
                                                      'facility' => $dt['facility'],                                                       
                                                      'selected' => "true"                                                       
                                                      ]);
                              
                return $ret;
		   }
		   
		    function getPreference($user)
           {
			   $imgId = true;
			   $host = true;
           	  
			  $ret = [];
              $p = Preferences::where('user_id',$user->id)->first();
              #dd($p);
              if($p != null)
               {
				  $data = $this->getPreferenceData($p->id);
				  $address = $this->getPreferenceAddress($p->id);
				  $terms = $this->getPreferenceTerms($p->id);
				  #dd($address);
				  
				  $temp = [];
				  $temp['id'] = $p->id;
				  $temp['user_id'] = $p->user_id;
				  $temp['avb'] = $p->avb;
				  $temp['rating'] = $p->rating;
				  $temp['city'] = $address['city'];
				  $temp['lga'] = $address['lga'];
				  $temp['state'] = $address['state'];
				  $temp['amount'] = $data['amount'];
				  $temp['property_type'] = $data['property_type'];
				  $temp['rooms'] = $data['rooms'];
				  $temp['units'] = $data['units'];
				  $temp['bedrooms'] = $data['bedrooms'];
				  $temp['bathrooms'] = $data['bathrooms'];
				  $temp['category'] = $data['category'];
				  $temp['children'] = $terms['children'];
				  $temp['max_adults'] = $terms['max_adults'];
				  $temp['max_children'] = $terms['max_children'];
				  $temp['pets'] = $terms['pets'];
				  $temp['payment_type'] = $terms['payment_type'];
				  $temp['facilities'] = $this->getPreferenceFacilities($p->id);	  
				  
				   $temp['date'] = $p->created_at->format("jS F, Y h:i A");
				  $ret = $temp;
               }                         
                                                      
                return $ret;
           }
		   
    function getPreferenceData($id)
           {
           	$ret = [];
              $pdt = PreferenceData::where('preference_id',$id)->first();
 
              if($pdt != null)
               {
				  $temp = [];
				  $temp['id'] = $pdt->id;
				  $temp['preference_id'] = $pdt->preference_id;
     			  $temp['category'] = $pdt->category;
     			  $temp['property_type'] = $pdt->property_type;
     			  $temp['rooms'] = $pdt->rooms;
     			  $temp['units'] = $pdt->units;
     			  $temp['bathrooms'] = $pdt->bathrooms;
     			  $temp['bedrooms'] = $pdt->bedrooms;
     			  $temp['amount'] = $pdt->amount;
				  $temp['landmarks'] = $pdt->landmarks;
				  $ret = $temp;
               }                         
                                                      
                return $ret;
           }			   
	
	function getPreferenceAddress($id)
           {
           	$ret = [];
               $pa = PreferenceAddresses::where('preference_id',$id)->first();
 
              if($pa != null)
               {
				  $temp = [];
				  $temp['id'] = $pa->id;
				  $temp['preference_id'] = $pa->preference_id;
     			  $temp['address'] = $pa->address;
				  $temp['city'] = $pa->city;
				  $temp['lga'] = $pa->lga;
				  $temp['state'] = $pa->state;
				  $ret = $temp;
               }                         
                                                      
                return $ret;
           }
	
	function getPreferenceTerms($id)
           {
           	$ret = [];
              $pt = PreferenceTerms::where('preference_id',$id)->first();
 
              if($pt != null)
               {
				  $temp = [];
				  $temp['id'] = $pt->id;
				  $temp['preference_id'] = $pt->preference_id;
     			  $temp['max_adults'] = $pt->max_adults;
     			  $temp['max_children'] = $pt->max_children;
     			  $temp['children'] = $pt->children;
     			  $temp['pets'] = $pt->pets;
     			  $temp['payment_type'] = $pt->payment_type;
				  $ret = $temp;
               }                         
                                                      
                return $ret;
           }		   
		   
		   function getPreferenceFacilities($id)
           {
           	$ret = [];
              $pfs = PreferenceFacilities::where('preference_id',$id)->get();
 
              if($pfs != null)
               {
				   foreach($pfs as $pf)
				   {
					   $temp = $this->getPreferenceFacility($pf->id);
					   array_push($ret,$temp);
				   }
               }                         
                                                      
                return $ret;
           }

	       function getPreferenceFacility($id)
           {
           	$ret = [];
              $pf = PreferenceFacilities::where('id',$id)->first();
              #dd($af);
              if($pf != null)
               {
				  $temp = [];
				  $temp['id'] = $pf->id;
				  $temp['user_id'] = $pf->user_id;
     			  $temp['facility'] = $pf->facility;
				  $temp['selected'] = $pf->selected;
				  $ret = $temp;
               }                         
                                                      
                return $ret;
           }
		   
		   function updatePreferenceAddress($data)
           {
			    $pa = PreferenceAddresses::where('preference_id',$data['preference_id'])->first();
			
			   if($pa != null)
			   {
           	       $pa->update([
                                                      'address' => $data['address'],                                                       
                                                      'city' => $data['city'],                                                       
                                                      'lga' => $data['lga'],                                                       
                                                      'state' => $data['state']
                                                      ]);
			   }               
           }
		   
		   function updatePreferenceData($data)
           {
			   $pdt = PreferenceData::where('preference_id',$data['preference_id'])->first();
			
			   if($pdt != null)
			   {
				   $landmarks = isset($data['landmarks']) ? $data['landmarks'] : "";
				   
           	       $pdt->update([
                                                     'category' => $data['category'], 
                                                     'property_type' => $data['property_type'], 
                                                     'rooms' => $data['rooms'], 
                                                     'units' => $data['units'], 
                                                     'bathrooms' => $data['bathrooms'], 
                                                     'bedrooms' => $data['bedrooms'],                                                      
                                                      'amount' => $data['amount'],                                                      
                                                      'landmarks' => $landmarks                                                    
                                                       ]);
			   }
           }
		   

		   function updatePreferenceTerms($data)
           {
            $pt = PreferenceTerms::where('preference_id',$data['preference_id'])->first();
			   
           	if($pt != null)
			   {
           	       $pt->update([
                                                      'max_adults' => $data['max_adults'],                                                       
                                                      'max_children' => $data['max_children'],  
                                                      'children' => $data['children'],                                                      
                                                      'pets' => $data['pets'],                                                      
                                                      'payment_type' => $data['payment_type']                                                      
                                                      ]);
                }
           }
		   
		   
		    function addTicket($dt)
		   {
			   #dd($dt);
			   if($dt['id'] == null) $dt['id'] = "";
			   $u = User::where('email',$dt['email'])->first();
			   $ret = "error";
			   
			   if($u != null)
			   {
				   $temp = [
				      'user_id' => $u->id,
				      'subject' => $dt['subject'],
				      'type' => $dt['type'],
				      'resource_id' => $dt['id'],
					  
				   ];

				   $tk = $this->createTicket($temp);
				   
				   if($tk != null)
				   {
					   $temp = [
					     'ticket_id' => $tk->ticket_id,
						 'msg' => $dt['msg'],
						 'added_by' => $dt['added_by']
					   ];
					   $ti = $this->createTicketItem($temp);
				   }
				   $ret = "ok";
			   }
			   
			   return $ret;
		   }
		   
		   function createTicket($dt)
		   {
			    $ret = Tickets::where('user_id',$dt['user_id'])
				                ->where('resource_id',$dt['resource_id'])
								->where('status',"unresolved")->first();
				
				if($ret == null)
				{
					$tid = "TKT_".$this->getRandomString(7);
					$ret = Tickets::create(['user_id' => $dt['user_id'], 
                                             'ticket_id' => $tid,
                                             'subject' => $dt['subject'],
                                             'type' => $dt['type'],
                                             'resource_id' => $dt['resource_id'],
                                             'status' => "unresolved",
                                            ]);
				}
			   
                                                      
                return $ret;
		   }
		   
		   function createTicketItem($dt)
		   {
					$ret = TicketItems::create(['ticket_id' => $dt['ticket_id'],
                                             'msg' => $dt['msg'],
                                             'added_by' => $dt['added_by']
                                            ]);
			          
                return $ret;
		   }
		   		   
		   function getTicket($id)
		   {
			   $ret = [];
			   $t = Tickets::where('id',$id)
			               ->orWhere('ticket_id',$id)->first();
			   
			   if($t != null)
               {
				  $temp = [];
				  $temp['id'] = $t->id;
				  $temp['user_id'] = $t->user_id;
				  $temp['user'] = $this->getUser($t->user_id);
				  $temp['ticket_id'] = $t->ticket_id;
				  $temp['subject'] = $t->subject;
				  $temp['type'] = $t->type;
				  $temp['items'] = $this->getTicketItems($t->ticket_id);
				  $temp['resource_id'] = $t->resource_id;
				  $temp['status'] = $t->status;

				    if($t->type == "apartment")
				    {
					  $temp['resource'] = $this->getApartment($t->resource_id);
				    }
				    else if($t->type == "billing")
				    {
					  $temp['resource'] = $this->getOrder($t->resource_id);  
				    }
					else
				    {
					  $temp['resource'] = [];  
				    }
					$temp['date'] = $t->created_at->format("jS F, Y");
				  }
				  
				  
     			  $ret = $temp;               

               return $ret;			   
		   }
		   
		   function getTicketItem($id)
		   {
			   $ret = [];
			   $ti = TicketItems::where('id',$id)->first();
			   
			   if($ti != null)
               {
				  $temp = [];
				  $temp['id'] = $ti->id;
				  $temp['ticket_id'] = $ti->ticket_id;
				  $temp['msg'] = $ti->msg;
				  $temp['added_by'] = $ti->added_by;
				  $temp['author'] = $this->getUser($ti->added_by);
				  $temp['date'] = $ti->created_at->format("jS F, Y");
     			  $ret = $temp;
               }

               return $ret;			   
		   }
		   
		   function getTicketItems($tid)
           {
           	$ret = [];
			$tis = TicketItems::where('ticket_id',$tid)->get();
			  
              if($tis != null)
               {
				   $tis = $tis->sortByDesc('created_at');	
			  
				  foreach($tis as $ti)
				  {
					  $temp = $this->getTicketItem($ti->id);
					  array_push($ret,$temp);
				  }
               }                         
                                  
                return $ret;
           }
		   
		   function getTickets($user)
           {
           	$ret = [];
			$ts = Tickets::where('user_id',$user->id)->get();
			  
              if($ts != null)
               {
				   $ts = $ts->sortByDesc('created_at');	
			  
				  foreach($ts as $t)
				  {
					  $temp = $this->getTicket($t->id);
					  array_push($ret,$temp);
				  }
               }                         
                                  
                return $ret;
           }

		   
		   function removeTicket($dt)
           {
           	$ret = [];
			$t = Tickets::where('ticket_id',$dt['ticket_id'])
			            ->where('user_id',$dt['user_id'])->first();
			  
              if($t != null)
               {
				   $tis = TicketItems::where('ticket_id',$id)->get();			  
                    if($tis != null)
					{
						foreach($tis as $ti)
				        {
					      $ti->delete();
					    }
					}
				   $t->delete(); 
               }                         
                                  
                return $ret;
           }
		   
		   
		   
		   
		   
		   
		   
/***************************************************************************************************** 
                                             OLD FUNCTIONS BELOW
******************************************************************************************************/
		   
		 

		   function createDiscount($data)
           {
			   $type = isset($data['type']) ? $data['type'] : "user";

           	$ret = Discounts::create(['sku' => $data['id'],                                                                                                          
                                                      'discount_type' => $data['discount_type'], 
                                                      'discount' => $data['discount'], 
                                                      'type' => $type, 
                                                      'status' => $data['status'], 
                                                      ]);
			return $ret;
           }

		   function getDiscounts($id,$type="product")
           {
           	$ret = [];
             if($type == "product")
			 {
				$discounts = Discounts::where('sku',$id)
			                 ->orWhere('type',"general")
							 ->where('status',"enabled")->get(); 
			 }
			 elseif($type == "user")
			 {
				 $discounts = Discounts::where('sku',$id)
			                 ->where('type',"user")
							 ->where('status',"enabled")->get();
             }
			 
              if($discounts != null)
               {
				  foreach($discounts as $d)
				  {
					$temp = [];
				    $temp['id'] = $d->id;
				    $temp['sku'] = $d->sku;
				    $temp['discount_type'] = $d->discount_type;
				    $temp['discount'] = $d->discount;
				    $temp['type'] = $d->type;
				    $temp['status'] = $d->status;
				    array_push($ret,$temp);  
				  }
               }                         
                                                      
                return $ret;
           }
		   
		   function getDiscountPrices($amount,$discounts)
		   {
			   $newAmount = 0;
						$dsc = [];
                     
					 if(count($discounts) > 0)
					 { 
						 foreach($discounts as $d)
						 {
							 $temp = 0;
							 $val = $d['discount'];
							 
							 switch($d['discount_type'])
							 {
								 case "percentage":
								   $temp = floor(($val / 100) * $amount);
								 break;
								 
								 case "flat":
								   $temp = $val;
								 break;
							 }
							 
							 array_push($dsc,$temp);
						 }
					 }
				   return $dsc;
		   }
		   
		   
		   
		   function getDeliveryFee($u=null,$type="user")
		   {
			   $ret = 2000;
			   $state = "";
			   
			   switch($type)
			   {
				 case "user":
				 if(!is_null($u))
			     {
				   $shipping = $this->getShippingDetails($u);
                   $s = $shipping[0];				  
                   $state = $s['state'];
			     }
                 break;

                 case "state":
				  $state = $u;
                 break;				 
			   }
			   
			   if($state != null && $state != "")
			   {
				 if($state == "ekiti" || $state == "lagos" || $state == "ogun" || $state == "ondo" || $state == "osun" || $state == "oyo") $ret = 1000;   
			   }
			   
			    
			   return $ret;
		   }
			
		   
		   function addCategory($data)
           {
           	$category = Categories::create([
			   'name' => $data['name'],
			   'category' => $data['category'],
			   'special' => $data['special'],
			   'status' => $data['status'],
			]);                          
            return $ret;
           }
		   
		   function getCategories()
           {
           	$ret = [];
           	$categories = Categories::where('id','>','0')->get();
              // dd($cart);
			  
              if($categories != null)
               {           	
               	foreach($categories as $c) 
                    {
						$temp = [];
						$temp['name'] = $c->name;
						$temp['category'] = $c->category;
						$temp['special'] = $c->special;
						$temp['status'] = $c->status;
						array_push($ret,$temp);
                    }
                   
               }                                 
                                                      
                return $ret;
           }	
		   
		   function getFriendlyName($n)
           {
			   $rett = "";
           	  $ret = explode('-',$n);
			  //dd($ret);
			  if(count($ret) == 1)
			  {
				  $rett = ucwords($ret[0]);
			  }
			  elseif(count($ret) > 1)
			  {
				  $rett = ucwords($ret[0]);
				  
				  for($i = 1; $i < count($ret); $i++)
				  {
					  $r = $ret[$i];
					  $rett .= " ".ucwords($r);
				  }
			  }
			  return $rett;
           }
		   
		   function createAds($data)
           {
           	$ret = Ads::create(['img' => $data['img'], 
                                                      'type' => $data['type'], 
                                                      'status' => $data['status'] 
                                                      ]);
                                                      
                return $ret;
           }

           function getAds($type="wide-ad")
		   {
			   $ret = [];
			   $ads = Ads::where('status',"enabled")
			              ->where('type',$type)->get();
			   #dd($ads);
			   if(!is_null($ads))
			   {
				   foreach($ads as $ad)
				   {
					   $temp = [];
					   $temp['id'] = $ad->id;
					   $img = $ad->img;
					   $temp['img'] = $this->getCloudinaryImage($img);
					   $temp['type'] = $ad->type;
					   $temp['status'] = $ad->status;
					   array_push($ret,$temp);
				   }
			   }
			   
			   return $ret;
		   }	

             function getAd($id)
		   {
			   $ret = [];
			   $ad = Ads::where('id',$id)->first();
			   #dd($ads);

			   if(!is_null($ad))
			   {
					   $temp = [];
					   $temp['id'] = $ad->id;
					   $img = $ad->img;
					   $temp['img'] = $this->getCloudinaryImage($img);
					   $temp['type'] = $ad->type;
					   $temp['status'] = $ad->status;
					   $ret = $temp;
			   }
			   
			   return $ret;
		   }		   

           function contact($data)
		   {
			  # dd($data);
			   $ret = $this->getCurrentSender();
		       $ret['data'] = $data;
    		   $ret['subject'] = $data['name'].": ".$data['subject'];	
		       
			   try
		       {
			    $ret['em'] = $this->adminEmail;
		         $this->sendEmailSMTP($ret,"emails.contact");
		         $ret['em'] = $this->suEmail;
		         $this->sendEmailSMTP($ret,"emails.contact");
			     $s = "ok";
		       }
		
		       catch(Throwable $e)
		       {
			     #dd($e);
			     $s = "error";
		       }
		
		       return $s;
		   }	

             function getBanner($type="top-header")
		   {
			   $ret = "";
			   $temp = "";
			   $b = Banners::where('cover',"yes")
			                     ->where('status',"enabled")
			                     ->where('type',$type)->first();
			   #dd($ads);
			   if(!is_null($b))
			   {
				  $temp = $b['url'];
			   }
			   else
			   {
				   $banners = Banners::where('status',"enabled")
			                     ->where('type',$type)->get();
				   if($banners != null)
				   {
					   $b = $banners[0];
					   $temp = $b->url;
				   }
			   }
			   
			   if($temp != "") $ret = $this->getCloudinaryImage($temp);
			  # dd($ret);
			   return $ret;
		   }

           
		   
		   function clearNewUserDiscount($u)
		   {
			  # dd($user);
			  if(!is_null($u))
			  {
			     $d = Discounts::where('sku',$u->id)
			                 ->where('type',"user")
							 ->where('discount',$this->getSetting('nud'))->first();
			   
			     if(!is_null($d))
			     {
				   $d->delete();
			     }
			  }
		   }


          function getTrackings($reference="")
		   {
			   $ret = [];
			   if($reference == "") $trackings = Trackings::where('id','>',"0")->get();
			   else $trackings = Trackings::where('reference',$reference)->get();
			   $trackings = $trackings->sortByDesc('created_at');
			   
			   if(!is_null($trackings))
			   {
				   foreach($trackings as $t)
				   {
					   $temp = [];
					   $temp['id'] = $t->id;
					   $temp['user_id'] = $t->user_id;
					   $temp['reference'] = $t->reference;
					   $temp['description'] = $t->description;
					   $temp['status'] = $t->status;
					   $temp['date'] = $t->created_at->format("jS F, Y h:i A");
					   array_push($ret,$temp);
				   }
			   }
			   
			   return $ret;
		   }

         function createWishlist($dt)
		   {
			   $ret = null;
			   
			   $w = Wishlists::where('user_id',$dt['user_id'])
			                        ->where('sku',$dt['sku'])->first();
			   
			   if(is_null($w))
			   {
				 $ret = Wishlists::create(['user_id' => $dt['user_id'],
			                          'sku' => $dt['sku']
			                 ]);
			   }
			   
			   
			  return $ret;
		   }		   

       function getWishlist($user,$r)
		   {
			   $ret = [];
			   $uu = null;
			   
			   if(is_null($user))
			   {
				   $uu = $r;
			   }
			   else
			   {
				   $uu = $user->id;
				 //check if guest mode has any wishlist items
                $guestWishlists = Wishlists::where('user_id',$r)->get();
                //dd($guestCart);
                if(count($guestWishlists) > 0)
				{
					foreach($guestWishlists as $gw)
					{
						$temp = ['user_id' => $uu,'sku' => $gw->sku];
						$this->createWishlist($temp);
						$gw->delete();
					}
				}  
			   }
			   
			   
			   $wishlist = Wishlists::where('user_id',$uu)->get();
			   
			   if(!is_null($wishlist))
			   {
				   foreach($wishlist as $w)
				   {
					   $temp = [];
					   $temp['id'] = $w->id;
					   $temp['product'] = $this->getProduct($w->sku);
					   $temp['date'] = $w->created_at->format("jS F, Y h:i A");
					   array_push($ret,$temp);
				   }
			   }
			   //dd($ret);
			   return $ret;
		   }
		   
		function removeFromWishlist($dt)
		   {
			   $ret = [];
			   $w = Wishlists::where('user_id',$dt['user_id'])
			                        ->where('sku',$dt['sku'])->first();
			   
			   if(!is_null($w))
			   {
				  $w->delete();
			   }
		   }
		   
		   
	  function createComparison($dt)
		   {
			   $ret = null;
			   
			   $c = Comparisons::where('user_id',$dt['user_id'])
			                        ->where('sku',$dt['sku'])->first();
			   
			   if(is_null($c))
			   {
				 $ret = Comparisons::create(['user_id' => $dt['user_id'],
			                          'sku' => $dt['sku']
			                 ]);
			   }
			   
			  return $ret;
		   }
		   
       function getComparisons($user,$r)
		   {
			   $ret = [];
			   
			   $uu = null;
			   
			   if(is_null($user))
			   {
				   $uu = $r;
			   }
			   else
			   {
				   $uu = $user->id;
				 //check if guest mode has any compare items
                $guestComparisons = Comparisons::where('user_id',$r)->get();
                //dd($guestCart);
                if(count($guestComparisons) > 0)
				{
					foreach($guestComparisons as $gc)
					{
						$temp = ['user_id' => $uu,'sku' => $gc->sku];
						$this->createComparison($temp);
						$gc->delete();
					}
				}  
			   }
			   
			   $comparisons = Comparisons::where('user_id',$uu)->get();
			   
			   if(!is_null($comparisons))
			   {
				   foreach($comparisons as $c)
				   {
					   $temp = [];
					   $temp['id'] = $c->id;
					   $temp['product'] = $this->getProduct($c->sku);
					   $temp['date'] = $c->created_at->format("jS F, Y h:i A");
					   array_push($ret,$temp);
				   }
			   }
			   
			   return $ret;
		   }

     function removeFromComparisons($dt)
		   {
			   $ret = [];
			   $c = Comparisons::where('user_id',$dt['user_id'])
			                        ->where('sku',$dt['sku'])->first();
			   
			   if(!is_null($c))
			   {
				  $c->delete();
			   }
		   }	

   

    function confirmPayment($u,$data)
	{
		$o = $this->getOrder($data['o']);
		#dd([$u,$data]);
		//$ret = $this->smtp;
		$ret = $this->getCurrentSender();
		$ret['order'] = $o;
		$ret['user'] = is_null($u) ? $data['email'] : $u->email;
		$ret['subject'] = "URGENT: Confirm payment for order ".$o['payment_code'];
		$ret['acname'] = $data['acname'];
		$bname =  $data['bname'] == "other" ? $data['bname-other'] : $this->banks[$data['bname']];
		$ret['bname'] = $bname;
		$ret['acnum'] = $data['acnum'];
		
		try
		{
			$ret['em'] = $this->adminEmail;
		    $this->sendEmailSMTP($ret,"emails.admin-confirm-payment");
		    $ret['em'] = $this->suEmail;
		    $this->sendEmailSMTP($ret,"emails.admin-confirm-payment");
			$s = ['status' => "ok"];
		}
		
		catch(Throwable $e)
		{
			#dd($e);
			$s = ['status' => "error",'message' => "server error"];
		}
		
		return json_encode($s);
	}		   
	
	function testBomb($data)
	{
		
		//$ret = $this->smtp2;
		$ret = $this->getCurrentSender();
		$ret['subject'] = $data['subject'];
		$ret['em'] = $data['em'];
		$ret['msg'] = $data['msg'];
		
		$this->sendEmailSMTP($ret,$data['view']);
		
		return json_encode(['status' => "ok"]);
	}
	

    function checkForUnpaidOrders($u)
	{
		$ret = Orders::where('user_id',$u->id)
		                ->where('status','unpaid')->count();
		#dd($ret);
		return $ret > 0;
	}	
		   

	function giveDiscount($user,$dt)
	{
	    $ret = $this->createDiscount([
	       'id' => $user->id,                                                                                                          
           'discount_type' => $dt['type'], 
           'discount' => $dt['amount'], 
           'status' => "enabled",	   
		]);
		return $ret;
	}
	
	function getFAQs()
	      {
	   	   $ret = [];
	   
	   	   $faqs = Faqs::where('id','>',"0")->get();
	   
	   	   if(!is_null($faqs))
	   	   {
	   		   foreach($faqs as $f)
	   		   {
	   		     $temp = $this->getFAQ($f->id);
	   		     array_push($ret,$temp);
	   	       }
	   	   }
	   
	   	   return $ret;
	      }
		  
	 	 function getFAQ($id)
	            {
	            	$ret = [];
	                $f = Faqs::where('id',$id)->first();
 
	               if($f != null)
	                {
                                $temp['id'] = $f->id; 
	                    	$temp['tag'] = $f->tag; 
	                        $temp['question'] = $f->question; 
	                        $temp['answer'] = $f->answer;
	                        $temp['date'] = $f->created_at->format("jS F, Y"); 
	                        $ret = $temp; 
	                }                          
                                                      
	                 return $ret;
	            }
	
	         function getFAQTags()
		  	      {
		  	   	   $ret = [];
	   
		  	   	   $tags = FaqTags::where('id','>',"0")->get();
	   
		  	   	   if(!is_null($tags))
		  	   	   {
		  	   		   foreach($tags as $t)
		  	   		   {
		  	   		     $temp = $this->getFAQTag($t->id);
		  	   		     array_push($ret,$temp);
		  	   	       }
		  	   	   }
	   
		  	   	   return $ret;
		  	      }
				  
		 	 	 function getFAQTag($id)
		 	            {
		 	            	$ret = [];
		 	                $t = FaqTags::where('id',$id)->first();
 
		 	               if($t != null)
		 	                {
		 	                    	$temp['tag'] = $t->tag; 
                                                $temp['id'] = $t->id; 
		 	                        $temp['name'] = $t->name; 
		 	                        $temp['date'] = $t->created_at->format("jS F, Y"); 
		 	                        $ret = $temp; 
		 	                }                          
                                                      
		 	                 return $ret;
		 	            }
						
			 function getPosts()
	      {
	   	   $ret = [];
	   
	   	   $posts = Posts::where('id','>',"0")->get();
	   
	   	   if(!is_null($posts))
	   	   {
			   $posts = $posts->sortByDesc('created_at');	
	   		   foreach($posts as $p)
	   		   {
	   		     $temp = $this->getPost($p->id);
	   		     array_push($ret,$temp);
	   	       }
	   	   }
	   
	   	   return $ret;
	      }
		  
		  function parseBlogPostContent($c)
		  {
			  return $c;
		  }
		  
	 	 function getPost($id)
	            {
	            	$ret = [];
	                $p = Posts::where('id',$id)->first();
 
	               if($p != null)
	                {
                                $temp['id'] = $p->id; 
	                    	$temp['title'] = $p->title; 
	                    	$temp['url'] = $p->url; 
	                    	$temp['status'] = $p->status; 
	                        $temp['author'] = $this->getUser($p->author); 
	                        $temp['content'] = $this->parseBlogPostContent($p->content);
	                        $temp['img'] = $this->getCloudinaryImage($p->img);
	                        $temp['comments'] = $this->getComments($p->id);
	                        $temp['date'] = $p->created_at->format("jS F, Y h:i A"); 
	                        $temp['updated'] = $p->updated_at->format("jS F, Y h:i A"); 
	                        $ret = $temp; 
	                }                          
                                                      
	                 return $ret;
	            }
				
				
		  function getComments($post_id)
	      {
	   	   $ret = [];
	   
	   	   $comments = Comments::where(['type' => "post",
		                                'post_id' => $post_id])->get();
	   
	   	   if(!is_null($comments))
	   	   {
			  # $posts = $posts->sortByDesc('created_at');	
	   		   foreach($comments as $c)
	   		   {
	   		     $temp = $this->getComment($c->id);
	   		     array_push($ret,$temp);
	   	       }
	   	   }
		   
		   return $ret;
		  }
		  
		  function getCommentReplies($comment_id)
	      {
	   	   $ret = [];
	   
	   	   $comments = Comments::where(['type' => "comment",
		                                'parent_id' => $comment_id])->get();
	   
	   	   if(!is_null($comments))
	   	   {
			  # $posts = $posts->sortByDesc('created_at');	
	   		   foreach($comments as $c)
	   		   {
	   		     $temp = $this->getComment($c->id);
	   		     array_push($ret,$temp);
	   	       }
	   	   }
		   
		   return $ret;
		  }
		  
		  function getComment($id)
	            {
	            	$ret = [];
	                $c = Comments::where('id',$id)->first();
 
	               if($c != null)
	                {
                            $temp['id'] = $c->id; 
	                    	$temp['post_id'] = $c->post_id; 
	                    	$temp['parent_id'] = $c->parent_id; 
	                    	$temp['type'] = $c->type; 
	                    	$temp['status'] = $c->status; 
	                        $temp['author'] = $this->getUser($c->user_id); 
	                        $temp['content'] = $c->content;
	                        $temp['replies'] = $this->getCommentReplies($c->id);
	                        $temp['date'] = $c->created_at->format("jS F, Y h:i A"); 
	                        $ret = $temp; 
	                }                          
                                                      
	                 return $ret;
	            }
			
			function getAutoCompleteData($data)
			{
				$ret = [];
				$country = isset($data['country']) ? strtolower($data['country']) : "nigeria";
				
				switch($data['type'])
				{
					case "country":
					foreach($this->countries as $k => $v)
					  array_push($ret,['country' => $v]);
					break;
					
					case "state":
					
					   #$city = $data['city'];
					   $apts = ApartmentAddresses::where('country','like',"%$country")->get();
						
						if($apts != null)
						{
							foreach($apts as $a)
							{
								array_push($ret,['country' => $country,'state' => $a->state]);
							}
						}
					break;
					
					case "city":
					if(isset($data['state']))
					 {
					   $state = $data['state'];
					   $apts = ApartmentAddresses::where('country','like',"%$country")
					                             ->where('state','like',"%$state")->get();
						
						if($apts != null)
						{
							foreach($apts as $a)
							{
								array_push($ret,['country' => $country,'state' => $a->state,'city' => $a->city]);
							}
						}
					   
					 }
					break;
					
					
				}
		
				return $ret;
			}
			
			function getPriceRange()
			{
				$ret = [];
				$ret['highest'] = ApartmentData::where('amount','>',"0")->max('amount');
				$ret['lowest'] = ApartmentData::where('amount','>',"0")->min('amount');
				
				return $ret;
			}
			
			function getCities()
			{
				$ret = [];
				$apts = ApartmentAddresses::where('id','>',"0")->pluck('city');
				$ret = $apts->all();
				for($i = 0; $i < count($ret); $i++) $ret[$i] = ucwords($ret[$i]);
				sort($ret);
				$ret = array_unique($ret);
				#dd($ret);
				return $ret;
			}
			
			function searchSSF($data)
			{
				$city = $data['location'];
				$amount = $data['amount'];
				$beds = $data['beds'];
				$type = $data['apt-type'];
				
				//Location
			 $byCity = ApartmentAddresses::where('city',"LIKE","%$city%")->get();

			 //Data
			 $byData = ApartmentData::where('property_type',"LIKE","%$type%")
			                        ->orWhere('bedrooms',$beds)
									->orWhere('amount',$amount)->get();
									   
			 //collect all
			 $ret = [];
			 if($byCity != null)
			 {
				 foreach($byCity as $bc)
				 {
					 array_push($ret,$bc->apartment_id);
				 }
			 }
			 
			 if($byData != null)
			 {
				 foreach($byData as $bd)
				 {
					 array_push($ret,$bd->apartment_id);
				 }
			 }
			 
			 $finalIDs = array_unique($ret);
			 $finalResults = [];
			 
			 foreach($finalIDs as $fid)
			 {
				 $temp = $this->getApartment($fid,['imgId' => true]);
				 if($temp['status'] == "approved") array_push($finalResults,$temp);
			 }
			 #dd($finalResults);
			 return $finalResults;
			}
			
			function createReservationLog($data)
	        {
	   			   #dd($data);
	   			 $ret = null;
			     $ret = ReservationLogs::create(['user_id' => $data['user_id'], 
	                                   'apartment_id' => $data['apartment_id'], 
	                                   'status' => $data['status']
	                                  ]);
	   			 return $ret;
	         }

	      function getReservationLogs($user)
	      {
	   	   $ret = [];
	       
		   if($user != null)
		   {
	   	     $logs = ReservationLogs::where('user_id',$user->id)->get();
	   
	   	     if(!is_null($logs))
	   	     {
			   $logs = $logs->sortByDesc('created_at');	
	   		   foreach($logs as $l)
	   		   {
	   		     $temp = $this->getReservationLog($l->id);
	   		     array_push($ret,$temp);
	   	       }
			 }
	   	   }
	   
	   	   return $ret;
	      }
		  
		  
	 	 function getReservationLog($id)
	            {
	            	$ret = [];
	                $l = ReservationLogs::where('id',$id)->first();
 
	               if($l != null)
	                {
                            $temp['id'] = $l->id; 
	                    	$temp['status'] = $l->status; 
	                        //$temp['user'] = $this->getUser($p->user); 
	                        $temp['user_id'] = $l->user_id; 
	                        $temp['apartment'] = $this->getApartment($l->apartment_id,['host' => true,'imgId' => true]);
	                        $temp['date'] = $l->created_at->format("jS F, Y h:i A"); 
	                        $temp['updated'] = $l->updated_at->format("jS F, Y h:i A"); 
	                        $ret = $temp; 
	                }                          
                                                      
	                 return $ret;
	            }
   
  
		   
		   
	   		  function updateReservationLog($data)
	              {
	   			   #dd($data);
	   			 $ret = "error";
                 $l = ReservationLogs::where('id',$data['id'])->first();
			 
			 
	   			 if(!is_null($l))
	   			 {
					 $fields = [
					             'status' => $data['status']
	                           ];
					  $l->update($fields);
	   			   $ret = "ok";
	   			 }
           	
                                                      
	                   return $ret;
	              }

	   		   function removeReservationLog($xf)
	              {
	   			    #dd($data);
	   			    $ret = "error";
	   			     $l = ReservationLogs::where('id',$xf)->first();
			 
			 
	   			    if(!is_null($l))
	   			    {
	   				  $l->delete();
	   			      $ret = "ok";
	   			    }
           
	              }
				  
				function hasReservation($dt)
		        {
			      $ret = false;
				  
                  $l = ReservationLogs::where($dt)->first();
			      if($l != null) $ret = true;
                  
				  return $ret;
		        }
				
				function respondToReservation($dt)
		        {
					#dd($dt);
			        $ret = "error";
					
                  $l = ReservationLogs::where('id',$dt['id'])->first();
			      
				  if($l != null)
				  {
					  $type = $dt['type'];
					  
					  $apt = $this->getApartment($dt['apartment_id'],['host' => true,'imgId' => true]);
					  $h = $apt['host'];
					  $u = $this->getUser($dt['user_id']);
					  
					  #dd([$h,$dt]);
					  if($h['id'] == $dt['auth'])
					  {
						  $s = "";
						 if($type=="approve")
					     {
							 $s = "approved";
						   $l->update(['status' => $s]);
					   	   $subject = $h['fname']." ".$h['lname'].": ".$apt['name']." is available for booking!";
					       $adminSubject = $apt['name']." just approved a reservation from ".$u['fname']." ".$u['lname'];
					     }
					     else if($type=="decline")
					     {
							 $s = "declined";
						    $l->update(['status' => $s]);
						    $subject = $h['fname']." ".$h['lname'].": ".$apt['name']." is unavailable at the moment";
						    $adminSubject = $apt['name']." just declined a reservation from ".$u['fname']." ".$u['lname'];
					     }
						 
					     //send guest email
					     $ret = $this->getCurrentSender();
		               
			             try
		                 {
				           $ret['subject'] = $subject;
                           $ret['em'] = $u['email'];
                           $ret['a'] = $apt;
			               $ret['h'] = $h;
			               $ret['u'] = $u;
			               $ret['l'] = $l;
				           #dd($ret);
		                   $this->sendEmailSMTP($ret,"emails.respond-to-reservation");
		                   $ret['em'] = $this->suEmail;
						   $ret['subject'] = $adminSubject;
		                   $ret['admin'] = true;
		                   $this->sendEmailSMTP($ret,"emails.respond-to-reservation");
			             }
		
		                 catch(Throwable $e)
		                 {
			               #dd($e);
			               $s = "error";
		                 }
						 
						  //Add activities
			              //guest
			              $this->createActivity([
			                'type' => "reservation-update",
			                'mode' => "guest",
			                'user_id' => $dt['user_id'],
			                'data' => $dt['apartment_id'].",".$s
			              ]);
			   
			              //host
			              $this->createActivity([
			                'type' => "reservation-update",
			                'mode' => "host",
			                'user_id' => $h['id'],
			                'data' => $dt['apartment_id'].",".$s.",".$dt['user_id']
			              ]);
						 
					     $ret = "ok"; 
					  }
				  }
				  
				  return $ret;
		        }
				
				
		function getPlans()
	      {
	   	   $ret = [];
		    $plans = Plans::where('id','>',0)->get();
	   
	   	     if(!is_null($plans))
	   	     {
			   $plans = $plans->sortByDesc('created_at');	
	   		   foreach($plans as $p)
	   		   {
	   		     $temp = $this->getPlan($p->id);
	   		     array_push($ret,$temp);
	   	       }
			 }
	   
	   	   return $ret;
	      }
		  
		  
	 	 function getPlan($id)
	            {
	            	$ret = [];
	                $p = Plans::where('id',$id)
					          ->orWhere('ps_id',$id)->first();
 
	               if($p != null)
	                {
                            $temp['id'] = $p->id; 
	                    	$temp['status'] = $p->status; 
	                        $temp['added_by'] = $this->getUser($p->added_by); 
	                        $temp['user_id'] = $p->user_id; 
	                        $temp['name'] = $p->name; 
	                        $temp['description'] = $p->description; 
	                        $temp['amount'] = $p->amount; 
	                        $temp['pc'] = $p->pc; 
	                        $temp['frequency'] = $p->frequency; 
	                        $temp['ps_id'] = $p->ps_id;
	                        $temp['date'] = $p->created_at->format("jS F, Y h:i A"); 
	                        $temp['updated'] = $p->updated_at->format("jS F, Y h:i A"); 
	                        $ret = $temp; 
	                }                          
                                                      
	                 return $ret;
	            }
				
				
				
				function createUserPlan($data)
	        {
	   			   #dd($data);
	   			 $ret = null;
			     $ret = UserPlans::create(['user_id' => $data['user_id'], 
	                                   'plan_id' => $data['plan_id'], 
	                                   'ps_ref' => $data['ps_ref'], 
	                                   'status' => $data['status']
	                                  ]);
	   			 return $ret;
	         }

	      function getUserPlans($user,$optionalParams=[])
	      {
	   	   $ret = [];
	       if($user != null)
		   {
		     $plans = UserPlans::where('user_id',$user->id)->get();
			 if(isset($optionalParams['active']) && $optionalParams['active'])
			 {
				 $plans = UserPlans::where([
				                            'user_id' =>$user->id,
				                            'status' =>"enabled",
										   ])->get();
			 }
	   	     if(!is_null($plans))
	   	     {
			   $plans = $plans->sortByDesc('created_at');	
	   		   foreach($plans as $p)
	   		   {
	   		     $temp = $this->getUserPlan($p->id);
	   		     array_push($ret,$temp);
	   	       }
			 }
	       }
	   	   return $ret;
	      }
		  
		  
	 	 function getUserPlan($id)
	            {
	            	$ret = [];
	                $p = UserPlans::where('id',$id)->first();
 
	               if($p != null)
	                {
                            $temp['id'] = $p->id; 
	                    	$temp['status'] = $p->status; 
	                    	$temp['ps_ref'] = $p->ps_ref; 
	                        $temp['user'] = $this->getUser($p->user_id); 
	                        $temp['plan'] = $this->getPlan($p->plan_id); 
	                        $temp['stats'] = $this->getUserPlanStats($temp); 
	                        $temp['date'] = $p->created_at->format("jS F, Y"); 
	                        $temp['updated'] = $p->updated_at->format("jS F, Y"); 
	                        $ret = $temp; 
	                }                          
                                                      
	                 return $ret;
	            }
   
  
		   
		   
	   		  function getUserPlanStats($data)
	            {
	   			   #dd($data);
				   $u = $data['user'];
				   $p = $data['plan'];
	   			   $ret = [];
                   $ret['aptCount'] = Apartments::where('user_id',$u['id'])->count();
                   $ret['posts_left'] = $p['pc'] - $ret['aptCount'];
			       return $ret;
	            }

	   		   function removeUserPlan($xf)
	              {
	   			    #dd($data);
	   			    $ret = "error";
	   			     $p = UserPlans::where('id',$xf)->first();
			 
			 
	   			    if(!is_null($p))
	   			    {
	   				  $p->delete();
	   			      $ret = "ok";
	   			    }
           
	              }
				
		    function createActivity($data)
	        {
	   			   #dd($data);
	   			 $ret = null;
			     $ret = Activities::create(['user_id' => $data['user_id'], 
	                                   'type' => $data['type'], 
	                                   'data' => $data['data'], 
	                                   'mode' => $data['mode']	                               
	                                  ]);
	   			 return $ret;
	         }

	      function getActivities($user)
	      {
	   	   $ret = [];
	       $activities = Activities::where([
			                                 'user_id' => $user->id,
											 'mode' => $user->mode
			                               ])->get();
	   	     if(!is_null($activities))
	   	     {
			   $activities = $activities->sortByDesc('created_at');	
	   		   foreach($activities as $a)
	   		   {
	   		     $temp = $this->getActivity($a->id);
	   		     array_push($ret,$temp);
	   	       }
			 }
	   
	   	   return $ret;
	      }
		  
		  
	 	 function getActivity($id)
	            {
	            	$ret = [];
	                $a = Activities::where('id',$id)->first();
 
	               if($a != null)
	                {
                            $temp['id'] = $a->id; 
	                    	$temp['user'] = $this->getUser($a->user_id); 
	                        $temp['type'] = $a->type; 
							$temp['data'] = $a->data; 
	                        $temp['mode'] = $a->mode;
	                        $temp['date'] = $a->created_at->format("jS F, Y h:i A"); 
	                        $temp['updated'] = $a->updated_at->format("jS F, Y h:i A"); 
							$temp['msg'] = $this->getActivityMessage($temp); 
	                        $ret = $temp; 
	                }                          
                                                      
	                 return $ret;
	            }
   
				function getActivityMessage($data)
				{
					$u = $data['user'];
					$ret = ""; $icon = "";
					$dt = explode(",",$data['data']);
					$mode = $data['mode'];
					
					switch($data['type'])
					{
						case "checkout":
						break;
						
						case "review":
						//0 - review_id
						$r = $this->getReview($dt[0],['apartment' => true]);
						$sum = ($r['service'] + $r['location'] + $r['security'] + $r['cleanliness'] + $r['comfort']) / 5;
						$apt = $r['apartment'];
						$rc = $sum > 3.5 ? "high" : "low";
						$icon = "ti-home";
						
						if($mode == "guest")
						{
							$ret = "You left a review of <div class='numerical-rating ".$rc."' data-rating='".$sum."'></div> on <strong><a href='javascript:void(0)'>".$apt['name']."</a></strong>"; 
						}
						else if($mode == "host")
						{
							$u = $this->getUser($dt[1]);
							$ret = "<strong><a href='javascript:void(0)'>".$u['fname']." ".$u['lname']."</a></strong> left a review of <div class='numerical-rating ".$rc."' data-rating='".$sum."'></div> on <strong><a href='javascript:void(0)'>".$apt['name']."</a></strong>";
						}
						break;
						
						case "reservation":
						//0 - review_id
						$apt = $this->getApartment($dt[0],['host' => true]);
						$h = $apt['host'];
						$icon = "ti-announcement";
						$url = url('apartment')."?xf=".$apt['apartment_id'];
						
						if($mode == "guest")
						{
							$ret = "You made a reservation for <strong><a href='".$url."'>".$apt['name']."</a></strong>"; 
						}
						else if($mode == "host")
						{
							$u = $this->getUser($dt[1]);
							$ret = "<strong><a href='javascript:void(0)'>".$u['fname']." ".$u['lname']."</a></strong> made a reservation for <strong><a href='".$url."'>".$apt['name']."</a></strong>";
						}
						break;
						
						case "reservation-update":
						//0 - review_id
						$apt = $this->getApartment($dt[0],['host' => true]);
						$h = $apt['host']; $status = $dt[1];
						$icon = "ti-announcement";
						$url = url('apartment')."?xf=".$apt['apartment_id'];
						
						if($mode == "guest")
						{
							$ret = "Your reservation for <strong><a href='".$url."'>".$apt['name']."</a></strong> was ".$status; 
						}
						else if($mode == "host")
						{
							$u = $this->getUser($dt[2]);
							$ret = "You ".$status." a reservation from <strong><a href='javascript:void(0)'>".$u['fname']." ".$u['lname']."</a></strong> for <strong><a href='".$url."'>".$apt['name']."</a></strong>";
						}
						break;
					}
					
					return ['icon' => $icon,'msg' => $ret];
				}

	   		   function removeActivity($xf)
	              {
	   			    #dd($data);
	   			    $ret = "error";
	   			     $p = Activities::where('id',$xf)->first();
			 
			 
	   			    if(!is_null($p))
	   			    {
	   				  $p->delete();
	   			      $ret = "ok";
	   			    }
           
	              }
				  
				  
				 function createLead($data)
	        {
	   			   #dd($data);
	   			 $ret = null;
			     $ret = Leads::create(['email' => $data['email'], 
	                                   'status' => $data['status']                              
	                                  ]);
	   			 return $ret;
	         }

	      function getLeads()
	      {
	   	   $ret = [];
	       $leads = Leads::where('id','>',"0")->get();
	   	     if(!is_null($leads))
	   	     {
			   $leads = $leads->sortByDesc('created_at');	
	   		   foreach($leads as $l)
	   		   {
	   		     $temp = $this->getLead($l->id);
	   		     array_push($ret,$temp);
	   	       }
			 }
	   
	   	   return $ret;
	      }
		  
		  
	 	 function getLead($id)
	            {
	            	$ret = [];
	                $l = Leads::where('id',$id)->first();
 
	               if($l != null)
	                {
                            $temp['id'] = $l->id; 
	                    	$temp['email'] = $l->email; 
	                        $temp['status'] = $l->status; 
							$temp['date'] = $l->created_at->format("jS F, Y h:i A"); 
	                        $temp['updated'] = $l->updated_at->format("jS F, Y h:i A"); 
							$ret = $temp; 
	                }                          
                                                      
	                 return $ret;
	            }
				
         function isSubscribed($dt)
		        {
			      $ret = false;
				  
                  $l = Leads::where($dt)->first();
			      if($l != null) $ret = true;
                  
				  return $ret;
		        }

	     function createBankDetails($data)
	        {
	   			   #dd($data);
	   			 $ret = null;
			     $ret = BankDetails::create(['user_id' => $data['user_id'], 
	                                   'bname' => $data['bname'], 
	                                   'acname' => $data['acname'], 
	                                   'acnum' => $data['acnum']	                               
	                                  ]);
	   			 return $ret;
	         }
			 
		  function getBankDetails($user)
	      {
	   	   $ret = [];
	       $banks = BankDetails::where('id','>',"0")->get();
	   	     if(!is_null($banks))
	   	     {
			   $banks = $banks->sortByDesc('created_at');	
	   		   foreach($banks as $b)
	   		   {
	   		     $temp = $this->getBankDetail($b->id);
	   		     array_push($ret,$temp);
	   	       }
			 }
	   
	   	   return $ret;
	      }
		  
		  
	 	 function getBankDetail($id)
	            {
	            	$ret = [];
	                $b = BankDetails::where('id',$id)->first();
 
	               if($b != null)
	                {
                            $temp['id'] = $b->id; 
	                    	$temp['bname'] = $b->bname; 
	                        $temp['acname'] = $b->acname; 
	                        $temp['acnum'] = $b->acnum; 
							$temp['date'] = $b->created_at->format("jS F, Y h:i A"); 
	                        $temp['updated'] = $b->updated_at->format("jS F, Y h:i A"); 
							$ret = $temp; 
	                }                          
                                                      
	                 return $ret;
	            }
				
		 function removeBankDetails($xf)
	              {
	   			    #dd($data);
	   			    $ret = "error";
	   			     $b = BankDetails::where('id',$xf)->first();
			 
			 
	   			    if(!is_null($b))
	   			    {
	   				  $b->delete();
	   			      $ret = "ok";
	   			    }
           
	              }
   
}
?>
