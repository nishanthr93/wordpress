<?php /* Template Name: createpassword */ ?>
 
<?php get_header();
global $wpdb, $user_ID;  
$username=$_GET['login'];
/*if(isset($_POST['password'])){
	$password=$_POST['password'];
	if(wp_set_password($password, $_POST['user_id']))
	$success="Password saved successfully";
else
	$success="dsfsd";
}
*/


$user = get_userdatabylogin($username);
if($user){
$userId=$user->ID;
}

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

<div class="row create--pwd--popup--card">
	<div class="create--pwd--popup">
		<?php 
		if(isset($username)&&(!empty($username))){
		?>
		<form id="create_pwdd" name="create_pwdd" action="" method="post">
		<div class="create--pwd--cntnt">
			
			
			<div class="email--accnt col-md-12">
				<label class="eml">New Password<span>*</span></label>
				<input type="password" name="password" id="password" placeholder="Enter a new password" required>
				<span class="err" id="password_err"></span>
			</div>
			<div class="pswrd--accnt col-md-12">
				<label class="eml">Confirm New Password<span>*</span></label>
				<input id="password_confirmation" type="password" name="password_confirmation" placeholder="Re-enter your new password" 
				required>
				<span id="password_confirmation_err" class="err"></span>
			</div>
			<input id="user_id" type="hidden" name="user_id" value="<?php echo $userId; ?>">
		</div>
			
			<div class="col-md-12 create--pwd--parent">
				<div class="col-md-6 cancel--btn">
					<button class="cancel--lnk">Cancel</button>
				</div>
				<div class="col-md-6 save--btn">
					<!-- <button id="sve--btn" class="save--lnk">Save</button> -->
					<input type="button" id="submit" name="create_password" value="Save" />

				</div>
				<p class="success"></p>
			
			</div>
			</form>
			<?php
		}else{
			?>
			<h3>This is not a valid link for creating password.</h3>
			<?php
		}
		?>
		</div>
	</div>
<script type="text/javascript">
	  jQuery(document).ready(function($){
	$("#submit").click(function(){

$(".err").text("");
var error=0;
	var password=$("#password").val();
  var password_confirmation=$("#password_confirmation").val();
	 if(password==""){
    $("#password_err").text("Please enter password");
    error=1;
  }else
  if(password.length < 6){
    $("#password_err").text("Password should have atleast 6 characters");
    error=1;
  }
  if(password_confirmation==""){
    $("#password_confirmation_err").text("Please enter password to confirm");
    error=1;
  }else
  if(password != password_confirmation){
    $("#password_confirmation_err").text("This is not match with password value");
    error=1;
  }
  if(error==1)
  {
   return false;
  }else{
  	$(".success").text("Loading...");  
  	var userId="<?php echo $userId ?>"; 
   
    var data = { 'action':'save_pwdd', 'password':password,'userId':userId };

    $.post('<?php echo admin_url('admin-ajax.php'); ?>', data, function(response) {
    	if(response.indexOf('success') > -1){
    		$(".success").text("Password updated successfully");   

        window.location.replace("<?php echo get_site_url(); ?>");
    }
    
  });

}
});
});
</script>
<style>
 	.err{
 		color:red;
 	}
 	.success{
 		color:green;
 		font-size: x-large;
 	}
 </style>
<?php


get_footer(); ?>