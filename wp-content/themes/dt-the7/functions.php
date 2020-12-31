<?php
/**
 * The7 theme.
 *
 * @since   1.0.0
 *
 * @package The7
 */

defined('ABSPATH') || exit;

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since 1.0.0
 */
if (!isset($content_width)) {
    $content_width = 1200; /* pixels */
}

/**
 * Initialize theme.
 *
 * @since 1.0.0
 */
require trailingslashit(get_template_directory()) . 'inc/init.php';

add_action('after_setup_theme', 'remove_admin_bar');

function remove_admin_bar()
{
    if (!current_user_can('administrator') && !is_admin()) {
        show_admin_bar(false);
    }
}
function ajax_login_init()
{

    wp_register_script('ajax-login-script', get_template_directory_uri() . '/ajax-login-script.js', array('jquery'));
    wp_enqueue_script('ajax-login-script');

    wp_localize_script('ajax-login-script', 'ajax_login_object', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'redirecturl' => home_url(),
        'loadingmessage' => __('Sending user info, please wait...'),
    ));

    // Enable the user with no privileges to run ajax_login() in AJAX
    add_action('wp_ajax_nopriv_ajaxlogin', 'ajax_login');
}

// Execute the action only if the user isn't logged in
if (!is_user_logged_in()) {
    add_action('init', 'ajax_login_init');
}
function ajax_login()
{

    // First check the nonce, if it fails the function will break
    check_ajax_referer('ajax-login-nonce', 'security');

    // Nonce is checked, get the POST data and sign user on
    $info = array();
    $info['user_login'] = $_POST['username'];
    $info['user_password'] = $_POST['password'];
    $info['remember'] = true;

    $user_signon = wp_signon($info, false);
    if (is_wp_error($user_signon)) {
        echo json_encode(array('loggedin' => false, 'message' => __('Wrong username or password.')));
    } else {
        echo json_encode(array('loggedin' => true, 'message' => __('Login successful, redirecting...')));
    }

    die();
}

add_action('wp_ajax_resett_pwd', 'resett_pwd');
add_action('wp_ajax_nopriv_resett_pwd', 'resett_pwd');
function resett_pwd()
{ 
    ob_start();
    global $wpdb;
    $email = $_POST['email'];
    if (empty($email)) {
        $error = 'Enter a username or e-mail address..';
    } else if (!is_email($email)) {
        $error = 'Invalid username or e-mail address.';
    } else if (!email_exists($email)) {
            
            $url = "https://reg.mktgm.com/INTERACT/connect-login-api.php?email=".$email."&CP=1&site_id=2";
            $ch = curl_init();
    $headers = array(
    'Accept: application/json',
    'Content-Type: application/json',

    );
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $body = '{}';

    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET"); 
    curl_setopt($ch, CURLOPT_POSTFIELDS,$body);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Timeout in seconds
    // curl_setopt($ch, CURLOPT_TIMEOUT, 30);

    $authToken = curl_exec($ch);
            curl_close($ch);

             $resdecoded = json_decode($authToken);

             if ($resdecoded->status == 1) {
                $name = $resdecoded->name;
                $fname = $resdecoded->fname;
                $lname = $resdecoded->lname;
                $fullname = $fname.' '.$lname;

                $userMail = $resdecoded->email;
               // $user = email_exists($userMail);
                $names = $name.rand ( 10000 , 99999 );


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
                        
                    }else{
                        update_user_meta( $user, 'simple-restrict-paid', 'no' );
                    }

                    $error = "";
               }else{
            $error = 'There is no user registered with that email address.';        
               } 

        
    } 

    if(empty($error)){
        //$random_password = wp_generate_password( 12, false );
        $user = get_user_by('email', $email);
        $user_login = $user->user_login;
        $user_data = get_user_meta($user->ID);
        // print_r($user_data);
        $first_name = $user_data['first_name'][0];
        $last_name = $user_data['last_name'][0];
        
        $key = $wpdb->get_var($wpdb->prepare("SELECT user_activation_key FROM $wpdb->users WHERE user_login = %s", $user_login));
        if (empty($key)) {
            // Generate something random for a key...
            $key = wp_generate_password(20, false);
            do_action('retrieve_password_key', $user_login, $key);
            // Now insert the new md5 key into the db
            $wpdb->update($wpdb->users, array('user_activation_key' => $key), array('user_login' => $user_login));
        }
        $fullname = $first_name.' '.$last_name;
        // echo $fullname;exit;
        $message = sprintf(__('Dear  %s'), $fullname) . "\r\n\r\n";
        $message .= __('Thank you for participating at the EMAS Virtual Schools
') . "\r\n\r\n";
        $message .= __('Please find below the link to create your password:') . "\r\n\r\n";
        $message .= '<' . network_site_url("createpassword?&key=$key&login=" . rawurlencode($user_login), 'login') . ">\r\n\r\n";
        $message .= __('This link takes you to a secure page where you can set-up your password') . "\r\n\r\n";
        $message .= __('If you have any concerns, please contact us at support@provirtualmeeting.com') . "\r\n\r\n";
        $message .= __('Kind regards,') . "\r\n\r\n";
        $message .= __('EMAS Conference Secretariat') . "\r\n\r\n";
        $blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);

        $title = sprintf(__('[%s] Password Reset'), $blogname);

        $success = "";
        // if ($message && wp_mail($email, $title, $message)) {
        wp_mail($email, $title, $message);
            $success = 'Check your email address for your new password.';
        // }
         
        

    }
ob_end_clean();
    if (!empty($error)) {
        echo $error;
    }

    if (!empty($success)) {
        echo $success;
    }

    exit;
}

add_action('wp_ajax_forgot_pwd', 'forgot_pwd');
add_action('wp_ajax_nopriv_forgot_pwd', 'forgot_pwd');
function forgot_pwd()
{
    global $wpdb;
    $email = $_POST['email'];
    if (empty($email)) {
        $error = 'Enter a username or e-mail address..';
    } else if (!is_email($email)) {
        $error = 'Invalid username or e-mail address.';
    } else if (!email_exists($email)) {
        $error = 'There is no user registered with that email address.';
    } else {
        //$random_password = wp_generate_password( 12, false );
        $user = get_user_by('email', $email);
        $user_login = $user->user_login;
        $user_data = get_user_meta($user->ID);
        $first_name = $user_data['first_name'][0];
        $last_name = $user_data['last_name'][0];

        // print_r($user_data);exit;
        $key = $wpdb->get_var($wpdb->prepare("SELECT user_activation_key FROM $wpdb->users WHERE user_login = %s", $user_login));
        if (empty($key)) {
            // Generate something random for a key...
            $key = wp_generate_password(20, false);
            do_action('retrieve_password_key', $user_login, $key);
            // Now insert the new md5 key into the db
            $wpdb->update($wpdb->users, array('user_activation_key' => $key), array('user_login' => $user_login));
        }
         $fullname = $first_name.' '.$last_name;
         // echo $fullname;exit;
        $message = sprintf(__('Dear  %s'), $fullname ) . "\r\n\r\n";
        $message .= __('Thank you for participating at the EMAS Virtual Schools
') . "\r\n\r\n";
        $message .= __('Please find below the link to reset your password:') . "\r\n\r\n";
        $message .= '<' . network_site_url("createpassword?&key=$key&login=" . rawurlencode($user_login), 'login') . ">\r\n\r\n";
        $message .= __('This link takes you to a secure page where you can set-up your password') . "\r\n\r\n";
        $message .= __('If you have any concerns, please contact us at support@provirtualmeeting.com') . "\r\n\r\n";
        $message .= __('Kind regards,') . "\r\n\r\n";
        $message .= __('EMAS Conference Secretariat') . "\r\n\r\n";
        $blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);

        $title = sprintf(__('[%s] Password Reset'), $blogname);

        $success = "";
        // if ($message && wp_mail($email, $title, $message)) {
        wp_mail($email, $title, $message);
            $success = 'Check your email address for you new password.';
        // }

    }

    if (!empty($error)) {
        echo $error;
    }

    if (!empty($success)) {
        echo "success";
    }

    exit;
}

add_action('wp_ajax_save_pwdd', 'save_pwdd');
add_action('wp_ajax_nopriv_save_pwdd', 'save_pwdd');
function save_pwdd()
{
    global $wpdb;

    if (isset($_POST['password'])) {
        $password = $_POST['password'];
        $userId = $_POST['userId'];
        if (wp_update_user(array('ID' => $userId, 'user_pass' => $password))) {
            echo "success";
        } else {
            echo "failure";
        }

    }
    exit;
}
/*add_filter( 'wp_nav_menu_items', 'wti_loginout_menu_link', 10, 2 );

function wti_loginout_menu_link( $items, $args ) {
global $wpdb;
if ($args->theme_location == 'primary') {
$user = wp_get_current_user();
echo $user->ID;
if ( !empty($user->ID) ) {
$items .= '<li class="right"><a href="'. wp_logout_url(get_site_url()) .'">'. __("Log Out") .'</a></li>';
}
else {
$items .= '<li class="right"><a href="'. get_site_url() .'">'. __("Log In") .'</a></li>';
}
}
return $items;
}*/
