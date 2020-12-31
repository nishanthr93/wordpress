<?php /* Template Name: Login */ ?>
 
<?php get_header();
global $wpdb, $user_ID;  
if ( !is_user_logged_in() ) {  
if(isset($_POST['user_login'])){

 $username = $_POST['username'];
    $password = $_POST['password'];
     $rememberme=$_POST['rememberme'];
    if (filter_var($username, FILTER_VALIDATE_EMAIL)) { //Invalid Email
        $user = get_user_by('email', $username);
    } else {
    $user = get_user_by('login', $username);
    }
    if(isset($rememberme) && !empty($rememberme)){
    	$remember="true";
    }else{
    	$remember="false";
    }
     
    if ($user && wp_check_password( $password, $user->data->user_pass, $user->ID)) {
        $creds = array('user_login' => $user->data->user_login, 'user_password' => $password,'remember' => $remember  );
      $user_verify = wp_signon( $creds, false );   
      $user_data=get_user_by('id',$user->ID);
      $user_roles = $user_data->roles;
    
       if ( in_array( 'staff_member', $user_roles, true ) ){
            // redirect them to the default place
           echo "<script type='text/javascript'>window.location.href='". get_site_url() ."/my-appointments/'</script>";  
       exit();  
        } else if ( in_array( 'administrator', $user_roles, true )){
            echo "<script type='text/javascript'>window.location.href='". get_site_url() ."/wp-admin/'</script>";  
       exit();  
        }
    
    if ( is_wp_error($user_verify) )   
    {  
        $loginError='<p style="color:red; text-aling:left;"><strong>Error</strong>: Invalid Login details<br /></p>'; 

       // Note, I have created a page called "Error" that is a child of the login page to handle errors. This can be anything, but it seemed a good way to me to handle errors.  
     } else
    {    
       echo "<script type='text/javascript'>window.location.href='". home_url() ."'</script>";  
       exit();  
     }  
    }else{
    	$loginError='<p style="color:red; text-aling:left;"><strong>Error</strong>: Invalid Login details<br /></p>'; 
    }
}
?>
 
<div id="page-content" class="page-content">
	<div class="container">
		<div class="row">
			<div class="login_form_overall">
				<h1>Login</h2>

					<form id="login1" name="login_form" action="" method="post">  
				<div class="form_section">
					<?php if(isset($loginError)){echo '<div>'.$loginError.'</div>';}?>
					<div class="input name">
						<label>Username or email address<span>*</span><span class="err" id="username_err"></span></label>
						<input id="username" type="text" name="username">
					</div>
					<div class="input password">
						<label>Password<span>*</span><span id="password_err" class="err"></span></label>
						<input id="password" type="password" name="password">
					</div>
					<div class="button_section">
						<label><input id="remember" type="checkbox" name="rememberme">Remember me</label>
						<input type="submit" id="submit" name="user_login" value="LOGIN" />
					</div>
					<div class="lost_password">
						<?php $site_url=get_site_url(); 
            $register=$site_url."/register/";
						$lost=$site_url."/my-account/lost-password/";
						?>
						Lost your password?<a href="<?php echo $lost ?>"> Click here to reset it</a>  <br /><br /> Don't have an account? <a href="<?php echo $register ?>">Click here to create one</a> 
					</div>
				</div>
			</form>
			</div>
		</div>
	</div>
</div>
 <style>
 	.err{
 		color:red;
 	}
 </style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
  <script type="text/javascript">
            jQuery(document).ready(function($){
   
            $("#submit").click(function(){

$(".err").text("");
  var username=$("#username").val();
  var password=$("#password").val();
  
 
  var error="";
  if(username==""){
    $("#username_err").text("Please enter username/email");
    error=1;
  }
  
  if(password==""){
    $("#password_err").text("Please enter password");
    error=1;
  }  

  if(error==1)
  {
     $(".err").each(function(){
      if($(this).text() != ""){
         $('html, body').animate({
        scrollTop: $(this).offset().top
    }, 500);
        return false;
      }
    })
   return false;
  }
  else
    return true;
            });

            $('input[type=text]').keypress(function(e){
            	//alert("dsfs");
var parent=$(this).parent("div");
$(parent).find(".err").text("");
            });
             
               });
           </script>
<?php 
}  
else {  
   wp_redirect( home_url() ); exit;  
}

get_footer(); ?>