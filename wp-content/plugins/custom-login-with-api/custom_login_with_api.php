<?php
/*
Plugin Name: WP User Login
Plugin URI: 
Description: Plugin to create login form with API.
Version: 0.1
Author: Abhishek Tomar
Author URI: 
License: GPL
*/

//add_action( 'template_redirect', 'redirect_if_user_not_logged_in' );

function redirect_if_user_not_logged_in() {

	if ( !is_page('3446') && ! is_user_logged_in() ) { //example can be is_page(23) where 23 is page ID

	$home_url = get_site_url();

      wp_redirect( $home_url); 
 
     exit;// never forget this exit since its very important for the wp_redirect() to have the exit / die
   
   }
   
}

function UserLoginProcess(){
	// print_r($_POST);exit;
	
	// if ( !is_user_logged_in() && !is_page('3446') ) {

	// $home_url = get_site_url();

 //      wp_redirect( $home_url); 
   
 //   exit;
 //   }

global $wp;
$mydb = new wpdb('stalboom@live.em','me6s6p:6{YPBG>Ue','live_emas','localhost');
 if(isset($_POST['userLogin'])){

 		$username = $field1 = isset($_POST['userName'])?$_POST['userName']:'';
 			
			$password = $field2 = isset($_POST['regID'])?$_POST['regID']:'';

     $rememberme=$_POST['rememberme'];

    if (filter_var($username, FILTER_VALIDATE_EMAIL)) { //Invalid Email
        $user = get_user_by('email', $username);
        // print_r($user);exit;

        if(isset($rememberme) && !empty($rememberme)){
      		$remember="true";
		    }else{
		      $remember="false";
		    }


		    if ($user && wp_check_password( $password, $user->data->user_pass, $user->ID)) {
		      //   $creds = array('user_login' => $user->data->user_login, 'user_password' => $password,'remember' => $remember  );
		      // $user_verify = wp_signon( $creds, false );   
		      // $user_data=get_user_by('id',$user->ID);
		      // $user_roles = $user_data->roles;
		    	wp_set_current_user( $user->ID, $user->data->user_login );
					wp_set_auth_cookie( $user->ID );
					do_action( 'wp_login', $user->data->user_login , $user );
		    
		     
		    
		    
		       
		    $site_url=get_site_url();
		    $url=$site_url."/lobby-2/";
		       echo "<script type='text/javascript'>window.location.href='". $url ."'</script>";  
		       exit();    
		    }else{
		      checkotherwebsite($field1,$field2);
		    }
    } 
    else
    {
    	echo '<script>
					   alert("Enter valid email");
					</script>';
    }
    
     
   
		}
		/*if(isset($_GET['redirect_to']) && !empty($_GET['redirect_to'])){
        	$redirectUrl = $_GET['redirect_to'];
    		echo '<script>
             			
					  
					</script>';
    	}*/
	}

	function checkotherwebsite($field1,$field2)
	{

			$url = "http://reg.mktgm.com/INTERACT/connect-login-api.php?email=".$field1."&redId=".$field2."&site_id=2";
			$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, $url);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
					$headResponse = curl_exec($ch);
					curl_close($ch);
 
			 $resdecoded = json_decode($headResponse);
			 // print_r($resdecoded); exit;
			 if ($resdecoded->status == 1) {
                $name = $resdecoded->name;
                $fname = $resdecoded->fname;
                $lname = $resdecoded->lname;
             	$userMail = $resdecoded->email;
				$user = email_exists($userMail);
				$names = $name.rand ( 10000 , 99999 );
				
             	$redirectString = '';
				if ($user != false) {
					ob_start();
					$user = get_user_by( 'ID',$user );
					$user_id = $user->ID;
					// print_r($user);exit;
                	if($resdecoded->payment_status == 'paid'){
                        update_user_meta( $user_id, 'simple-restrict-paid', 'yes' );
                        $redirectString = 'lobby-2';
                    }
					wp_set_current_user( $user_id, $user->user_login );
					wp_set_auth_cookie( $user_id );
					do_action( 'wp_login', $user->user_login , $user );
					ob_end_flush();
				}
				else {
					$mydb = new wpdb('stalboom@live.em','me6s6p:6{YPBG>Ue','live_emas','localhost');
                	$existingUser =  $mydb->get_results("SELECT * FROM tbl_admins WHERE email='".$userMail."'");
                	if(!empty($existingUser)){
                    	$mydb->query("DELETE FROM tbl_admins  WHERE email='".$userMail."'");
                    }
					$userdata = array(
						'user_login' => $names,
                    	'first_name' => $fname,
                    	'last_name' => $lname,
						'user_pass' => 'mypass',
						'user_email' => $userMail,
						'user_registered' => date_i18n('Y-m-d H:i:s', time()),
						'role' => 'subscriber'
					);

					$user = wp_insert_user($userdata);
                	if($resdecoded->payment_status == 'paid'){
                    	update_user_meta( $user, 'simple-restrict-paid', 'yes' );
                    	$redirectString = 'lobby-2';
                    }
					$user = get_user_by( 'ID',$user );
					$user_id = $user->ID;
					wp_set_current_user( $user_id, $user->user_login );
					wp_set_auth_cookie( $user_id );
					do_action( 'wp_login', $user->user_login , $user);
				}
				echo '<script>
					   window.location.hash = "";
					   window.location.href = "'.get_site_url().'/'.$redirectString.'";
					</script>';
			}else{
            	echo '<script>
					   alert("Email or Reg Id is incorrect");
					</script>';
            }
	}


add_action('init', 'UserLoginProcess');
add_shortcode( 'ULWAP', 'user_login_with_api' );

function user_login_with_api(){
	if(!is_user_logged_in()){		
		$formLogin = '<div class="log_form_container"><form method="post" action="" name="signup-form" id="apiLogForm">
				<div class="form-element">
					<!--<label>Email</label>-->
                    <i class="fa fa-envelope-o icon"></i>
					<input type="text" name="userName" placeholder="Email" required value="" />
				</div>
				<div class="form-element">
					<!--<label>Registration ID</label>-->
                    <i class="fa fa-key icon"></i>
					<input type="text" placeholder="Registration ID"  name="regID" required />
				</div>
                <div class="submitButton">
					<button type="submit" name="userLogin" value="login">Login</button>
                </div>
			</form></div>
            <style>.log_form_container {
    padding: 20px;
    background-color: darkgrey;
    border-radius: 15px;
}.log_form_container:after {
    content: "";
    display: block;
    clear: both;
    width: 0;
    height: 0;
}#apiLogForm .form-element label {
    float: left;
}
#apiLogForm .form-element input {
    clear: both;
    float: left;
    background-color: palegoldenrod;
    width: 100%;
    border-radius: 5px;
    padding-left: 40px;
}
i.fa {
    position: absolute;
    padding: 13px;
}
#apiLogForm .form-element {
    float: left;
    width: 100%;
}
#apiLogForm button {
        clear: both;
    border-radius: 5px;
    padding: 10px 20px;
    background: slategrey;
    box-shadow: 0px 0px 5px;
    border: navajowhite;
    color: #000000;
}.submitButton {
    text-align: center;
}</style>';
			
		return $formLogin;
	}
else{
	$locationHref ="'".wp_logout_url(get_permalink())."'";
	return '<input  class="userLogOut" type="button" onclick="location.href='.$locationHref.';" value="Log Out" /><style>input.userLogOut {
    border-radius: 5px;
    margin-top: 15%;
    line-height: 1;
    font-size: 15px;
}</style>';
}
	return;
}
?>
