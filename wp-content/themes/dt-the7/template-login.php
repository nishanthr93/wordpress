<?php /* Template Name: Login */ ?>
 
<?php get_header();
global $wpdb, $user_ID;  

?>
<style>
  form#login{
    display: none;
    background-color: #FFFFFF;
    position: fixed;
    top: 200px;
    padding: 40px 25px 25px 25px;
    width: 350px;
    z-index: 999;
    left: 50%;
    margin-left: -200px;
}

form#login p.status{
    display: none;
}

.login_overlay{
    height: 100%;
    width: 100%;
    background-color: #F6F6F6;
    opacity: 0.9;
    position: fixed;
    z-index: 998;
}
  </style>
  <form id="createpwdfrm" action="" method="post">
        <h1>Create password</h1>
        <p class="status"></p>
        <label for="email">Email</label>
        <input id="email" type="text" name="email">
        
        <input class="submit_button" type="button" value="Create passsword" id="createpwd" name="createpwd">
        <a class="close" href="">(close)</a>
       
    </form>
 <form id="login" action="login" method="post">
        <h1>Site Login</h1>
        <p class="status"></p>
        <label for="username">Username</label>
        <input id="username" type="text" name="username">
        <label for="password">Password</label>
        <input id="password" type="password" name="password">
        <a class="lost" href="<?php echo wp_lostpassword_url(); ?>">Lost your password?</a>
        <input class="submit_button" type="submit" value="Login" name="submit">
        <a class="close" href="">(close)</a>
        <?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?>
    </form>
<?php if (is_user_logged_in()) { ?>
    <a class="login_button" href="<?php echo wp_logout_url( home_url() ); ?>">Logout</a>
<?php } else { ?>
    <a class="login_button" id="show_login" href="">Login</a>
<?php }

?>
<script type="text/javascript">
  jQuery(document).ready(function($) {

    // Show the login dialog box on click
    $('a#show_login').on('click', function(e){
        $('body').prepend('<div class="login_overlay"></div>');
        $('form#login').fadeIn(500);
        $('div.login_overlay, form#login a.close').on('click', function(){
            $('div.login_overlay').remove();
            $('form#login').hide();
        });
        e.preventDefault();
    });

    // Perform AJAX login on form submit
    $('form#login').on('submit', function(e){
        $('form#login p.status').show().text(ajax_login_object.loadingmessage);
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajax_login_object.ajaxurl,
            data: { 
                'action': 'ajaxlogin', //calls wp_ajax_nopriv_ajaxlogin
                'username': $('form#login #username').val(), 
                'password': $('form#login #password').val(), 
                'security': $('form#login #security').val() },
            success: function(data){
                $('form#login p.status').text(data.message);
                if (data.loggedin == true){
                    document.location.href = ajax_login_object.redirecturl;
                }
            }
        });
        e.preventDefault();
    });
    $("#createpwd").click(function(e){

    e.preventDefault(); // if the clicked element is a link

   var email=$("#email").val();
    var data = { 'action':'resett_pwd', 'email':email };

    $.post('<?php echo admin_url('admin-ajax.php'); ?>', data, function(response) {
        console.log(response);
    });

});

});
  </script>
<?php
get_footer(); ?>