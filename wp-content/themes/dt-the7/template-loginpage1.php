<?php /* Template Name: Loginpage1 */ ?>
 
<?php get_header();
global $wpdb, $user_ID;  
/*if(isset($_POST['user_login'])){

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
    
     
    
    if ( is_wp_error($user_verify) )   
    {  
        $loginError='<p style="color:red; text-aling:left;"><strong>Error</strong>: Invalid Login details<br /></p>'; 

       // Note, I have created a page called "Error" that is a child of the login page to handle errors. This can be anything, but it seemed a good way to me to handle errors.  
     } else
    {   
    $site_url=get_site_url();
    $url=$site_url."/lobby-2/";
       echo "<script type='text/javascript'>window.location.href='". $url ."'</script>";  
       exit();  
     }  
    }else{
      $loginError='<p style="color:red; text-aling:left;"><strong>Error</strong>: Invalid Login details<br /></p>'; 
    }
}*/
?>

<style type="text/css">
  html, body{
    overflow: hidden;
  }

  @media screen and (max-width: 1024px){
    html, body{
      overflow: auto;
    }
  }
</style>

<div id="create--pwd--modal" class="modal">
  <div class="modal-content">
      <span class="close">&times;</span>
      <h2>Create Password</h2>
  <div class="create--email--address">
    <span><i class="fa fa-lock" aria-hidden="true"></i>Enter your email address and we will send you a link to create your password</span>
    <label class="floatingName--one">Email Address:</label>
    <input type="email" name="email" id="create-email" required>
  </div>
  <div class="create--email--sbmt">
    <a id="createpwd" href="javascript:void(0)">Send</a>
  </div>
  <p class="response"></p>
  <!-- <div id="Loading">Loading....</div> -->
  </div>
</div>

<div id="forgot--pwd--modal" class="modal popup-overlay">
  <div class="modal-content popup-content">
      <span class="close">&times;</span>
      <h2>Forgot your password</h2>
  <div class="create--email--address frgt--eml--add">
    <span><i class="fa fa-lock" aria-hidden="true"></i>Enter your email address and we will send you a link to reset your password</span>
    <label class="floatingName--one">Email Address:</label>
    <input type="email" name="email" id="forgot-email" required>
  </div>
  <div id="reset--pwd" class="create--email--sbmt">   
    <a id="forgot-pwd" href="javascript:void(0)">Reset Password</a>
  </div>
  <p class="response"></p>
  </div>
</div>
<?php 
//if ( !is_user_logged_in() ) { 
  ?>
<div class="row login--popup--card">
  <div class="login--popup">
    <div class="login--img">
      <img src="https://live.emas-online.org/wp-content/uploads/2020/11/live-banner-v.png" width="200" height="200">
    </div>
    <?php if(!is_user_logged_in()){ ?>
    <div class="login--cntnt">
      <?php if(isset($loginError)){echo '<div>'.$loginError.'</div>';}?>
        <form id="login1" name="login_form" action="" method="post">
          
      <div class="email--accnt col-md-12">
        <i class="fa fa-envelope" aria-hidden="true"></i>
        <input type="username" name="userName" id="username" required>
        <label class="eml floatingName">Email<span>*</span></label>
        <span class="err" id="username_err"></span>
      </div>
      <div class="pswrd--accnt col-md-12">
        <i class="fa fa-lock" aria-hidden="true"></i>
        <input id="password" type="password" name="regID" required>
        <label class="eml floatingName">Password<span>*</span></label>
        <span id="password_err" class="err"></span>
      </div>
      <div class="chckbx col-md-12">
        <label class="rm--me">Remember Me
            <input  id="remember"  name="rememberme" type="checkbox">
              <span class="checkmark"></span>
          </label>
      </div>
      <div class="chckbx accept--chkbx col-md-12">
        <span class="err" id="terms_err"></span>
        <label class="rm--me">I have read and accept both the <a target="_blank" href="https://live.emas-online.org/wp-content/uploads/2020/11/EMAS_Terms-of-Use_V1.pdf">Terms of use</a> and <a href="https://live.emas-online.org/wp-content/uploads/2020/11/EMAS_2020_privacy-policy.pdf" target="_blank"> Privacy Policy</a>.
            <input  id="termsandpolicy"  name="rememberme" type="checkbox">
              <span class="checkmark"></span>
          </label>
      </div>
      <div class="sbmt--btn col-md-12">
          <input type="submit" id="submit" name="userLogin" value="LOGIN" />
        <!-- <a href="#">Login</a> -->
      </div>
    
    </form>
      <div class="col-md-12 pwd--btn">
        <div class="cr--pwd--btn">
          <button id="crt--pwd-btn" class="crt--pwd--lnk">Create Password</button>
        </div>
      </div>
      <div class="col-md-12 not--reg--frgt--pwd">
        <div class="col-md-6 not--reg--btn">
          <a href="https://virtualmeeting.emas-online.org/registration/" class="not--reg--lnk">Not Registered?</a>
        </div>
        <div class="col-md-6 frg--accnt--btn">
          <button id="frgt--pwd--btn" class="frgt--pwd--lnk">Forgot Password?</button>
        </div>
      </div>
      <?php }else{ 
        $locationHref = wp_logout_url(get_permalink());
      ?>
            <input  class="userLogOut" type="button" onclick="window.location ='<?php echo $locationHref ; ?>'" value="Log Out" /><style>input.userLogOut {
    border-radius: 5px;
    margin-top: 15%;
    line-height: 1;
    font-size: 15px;
}</style>
    <?php } ?>
    </div>
  </div>
</div>
<?php
//}
?>

<?php
get_footer(); ?>
<script type="text/javascript">
  jQuery(document).ready(function(){
    var modal = document.getElementById("create--pwd--modal");

    var btn = document.getElementById("crt--pwd-btn");

    var span = document.getElementsByClassName("close")[0];

    btn.onclick = function() {
        modal.style.display = "block";
    }

    span.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
          modal.style.display = "none";
        }
    }


jQuery("#frgt--pwd--btn").on("click", function() {
  jQuery(".popup-overlay, .popup-content").addClass("active");
});


jQuery(".close").on("click", function() {
  jQuery(".popup-overlay, .popup-content").removeClass("active");
});

  });
</script>
<script type="text/javascript">
            jQuery(document).ready(function($){
              //$('.floatingName').floatingLabel();
   
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
  if (!$('#termsandpolicy').is(':checked')) {
              $("#terms_err").text("Please agree to the terms and policy");
             $('#termsandpolicy').focus(); 
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
                 $("#createpwd").click(function(e){
                  $("#createpwd").text('Loading...');
    e.preventDefault(); // if the clicked element is a link
$("#create--pwd--modal .response").text();
   var email=$("#create-email").val();
    var data = { 'action':'resett_pwd', 'email':email };

    $.post('<?php echo admin_url('admin-ajax.php'); ?>', data, function(response) {
    $("#createpwd").text('Send');
      if(response.indexOf('success') > -1){

        
        $("#create--pwd--modal .response").text("Check your email for your new password");  
        setTimeout(function() {$(".close").trigger("click");}, 3000);
      //$(".close").trigger("click");
        
    }
    else{
      $("#create--pwd--modal .response").text(response);
    }
    });

});
                 $("#forgot-pwd").click(function(e){
                  $("#forgot-pwd").text('Loading...');

    e.preventDefault(); // if the clicked element is a link
$("#forgot--pwd--modal .response").text("");  
   var email=$("#forgot-email").val();
    var data = { 'action':'forgot_pwd', 'email':email };

    $.post('<?php echo admin_url('admin-ajax.php'); ?>', data, function(response) {
      $("#forgot-pwd").text('Send');
      if(response.indexOf('success') > -1){

         $("#forgot--pwd--modal .response").text("Check your email for your new password");  
        setTimeout(function() {$(".close").trigger("click");}, 3000);
     // $(".close").trigger("click");
        /*$("#forgot--pwd--modal .response").text("Check your email for your new password");*/
       // $(".close").trigger("click");
        
    }
    else{
      $("#forgot--pwd--modal .response").text(response);
    }
    });

});
               });
         
           </script>
           <style type="text/css">
             input.userLogOut, input.userLogOut:focus {
   border-bottom: 0;
   margin-top: 0 !important;
   display: inline-block;
   padding: 10px !important;
   background: #00bfa5!important;
   width: 50% !important;
   margin: 0 auto !important;
   text-align: center !important;
   color: #fff !important;
   font-size: 20px;
   font-weight: 600;
}

input.userLogOut:hover {
   background: #00bfa5c9!important;
}
           </style>
