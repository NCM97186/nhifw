<?php
// error_reporting(E_ALL); ini_set('display_errors', 1);
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
// ini_set('session.cookie_httponly', 1);
// session_start();
ini_set("log_errors" , "0");
ini_set("error_log" , "phperrors.log");
ini_set("display_errors" , "1");

//header('Set-Cookie: cross-site-cookie=name;  path : /; domain: http://localhost/nihfw/auth/adminPanel/index.php; SameSite=Lax;  secure');
// session_set_cookie_params(['SameSite' => 'None', 'Secure' => true]);
// header('Set-Cookie: cross-site-cookie=name; SameSite=none; secure');

// header('network.cookie.sameSite.noneRequiresSecure');
   
// header("Content-Security-Policy: script-src 'self'");
// header('Set-Cookie: cookie1=value1; SameSite=Lax', false);
// header('Set-Cookie: cookie2=value2; SameSite=None; Secure', false);

//header('X-Content-Type-Options: nosniff');
// header('Access-Control-Allow-Origin: *');
//header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
//header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, x_requested_with");
if ( "OPTIONS" === $_SERVER['REQUEST_METHOD'] ) {
    die();
}


// session_start();
// ini_set("log_errors" , "0");
// ini_set("error_log" , "phperrors.log");
// ini_set("display_errors" , "1");
// ini_set('session.cookie_samesite', 'NIHFW');

// // added on dated 18-07-2022
// ini_set("session. cookie_httponly", True); 
// ini_set('session.cookie_httponly', 0);
// ini_set('session.use_only_cookies', 1);
 

error_reporting(1);
// @extract($_GET);
// @extract($_POST);
// @extract($_SESSION);

// $HomeURL12 = "http://".$_SERVER['SERVER_NAME']."/nihfw";

require_once "connection.php";



 $HomeURL = "http://localhost/nihfw";


// $HomeURL=	"http://10.48.21.19";
//$HomeURL=	"http://117.239.180.196";
//$HomeURL12 = "http://".$_SERVER['SERVER_NAME'];

$ApplicationSettings['AdminURL']  = $HomeURL.'/auth/adminPanel';
$ApplicationSettings['PhysicalPath'] =str_replace("configure.php","",__FILE__);
$ApplicationSettings['ImageURL'] = $ApplicationSettings['HomeURL'] . "/images";
$postion=array("1" => "Header Menu","2" => "Bottom Menu","3" => "Footer Menu", "4"=>"Not show in menu");
$postion1=array("2" => "Left Menu");
$language=array("1"=>"English","2"=>"Hindi");
$status=array("2"=>"Inactive","1"=>"Active");
$status1=array("0"=>"Inactive","1"=>"Active");
$vacancytype= array("1"=>"Vacancy","2"=>"Notice","3"=>"Results");
$menutype= array("1"=>" Content ","2"=>"PDF file Upload","3"=>"Web Site Url","4"=>"Not show in menu");
$pageURL = $_SERVER["REQUEST_URI"];
$homepage_type= array("2"=>"Hon'ble Minister");
$media_type= array("1"=>"Photo Gallery","2"=>"Video Gallery");
$important_link_cat_hindi=array("10"=>"What's News" ,"11"=>"Circular","12"=>"Events");
$latest_category	= array("1"=>"Meeting & Events","2"=>"Workshop & Training");
$info_category	= array("1"=>"Important Circulars","2"=>"Daily Health News Bulletin");
$emp_type= array("1"=>"Internal User","2"=>"Public User");
$cat_type= array("2"=>"Circular","3"=>"Events","5"=>"News");

$archive_cat= array("1"=>"What's new","2"=>"Meetings/Events","3"=>"Important Circulars","4"=>"Daily Health News","5"=>"Tender","6"=>"Vacancy","7"=>"Employee Corner" , "8"=>"Training" , "9"=>"Publication");


$Institution_type=array("1"=>"Medical College","2"=>"Nursing College/School","3"=>"Sihfw","4"=>"Hfwtc","5"=>"Anmtc","6"=>"Other Training","7"=>"Ngo", "8"=>"Others" );

$Management=array("1"=>"Goverment","2"=>"Private","3"=>"Trust","4"=>"Society","5"=>"Others" );


//print_r($_SESSION);
$inactive = 300;
if(isset($_SESSION['timeout']) ) 
{       	
	 $session_life = time() - $_SESSION['timeout'];
	if($session_life > $inactive)
        {
			
				
			$resetflagqry 	= "update admin_login set flag_id='0',login_flag='0',login_count='0' where id='".$_SESSION['admin_auto_id_sess']."'";
		    @mysqli_query($conn, $resetflagqry); //exit;
				
				session_destroy();
				//exit;
				
				$qry 	= "SELECT id,login_name,user_pass,role_id,last_login_date from admin_login where flag_id='1'";
				$quer   = mysqli_query($conn, $qry);
				$data 	= mysqli_fetch_array($quer);
				//$upd 	= "update admin_login set flag_id='0',login_flag='0',login_count='0' where id='".$data['id']."'";
	

			if($pageURL==$ApplicationSettings['AdminURL']."/index.php")

			{ 
				header("Location:".$HomeURL.'/auth/adminPanel/logout.php');
			}
			else
			{
				header("Location:".$HomeURL.'/auth/adminPanel/index.php');
			}
		}
}
 $_SESSION['timeout'] = time();


// if($_SERVER['QUERY_STRING'] !='')
// 	{  
// 			if(preg_match("/^[a-zA-Z0-9&&=.&%_-]+$/",$_SERVER['QUERY_STRING']) === 0)
// 		{
// 			session_destroy();
// 			header('Location:error.php');
// 		exit();
// 		}
		
// 	}
	
function currenttime () 
{
	$timezone = new DateTimeZone("Asia/Kolkata" );
	$date = new DateTime();
	$date->setTimezone($timezone );
	echo $date->format( 'H:i:s A  /  D, M jS, Y' );
}
$folder="/nihfw";

$title="NIHFW";
$sitename="NIHFW";// change this variable to write site name
$sitenamehi="SITENAME"; // change this variable to write hindi site name
$header_msg="Welcome Admin";
$date=date('d, M y'); // display date
$time=date('H:i A'); // display time
$edit="Edit";
$change="Change password";
$logout="Logout";
$orgname="Organization Name";
?>
