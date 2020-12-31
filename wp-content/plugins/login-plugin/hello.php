<?php
/**
 * Plugin Name: React API
 * Plugin URI: https://www.google.com
 * Description: This plugin allows you to send processed woocommerce users data to React API.
 * Version: 1.0.0
 * Author: Daniyal Hasan
 * Author URI: http://www.google.com
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
function register_session()
{
    if (!session_id())
        session_start();
    if (is_admin() && !current_user_can('administrator') && !wp_doing_ajax()) {
        wp_redirect(home_url());
        exit;
    }
}

add_action('init', 'register_session');
add_action('wp_footer', 'wpse33008');
function wpse33008()
{
    if (!empty($_SESSION['pass']) && !empty($_SESSION['url'])) {
        ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script type="text/javascript">
            var data = '<?= $_SESSION['pass'] ?>';
            var url = '<?= $_SESSION['url'] ?>';
            jQuery.ajax({
                url: url,
                data: 'email=' + data,
                type: "POST",
                xhrFields: {withCredentials: true},
                success: function (result) {
                    console.log(data);
                    console.log(result);
                }
            }).fail(function (jqXHR, textStatus, error) {
                console.log(textStatus.error);
            });
        </script>
        <?php
        unset($_SESSION['pass']);
        unset($_SESSION['url']);
    } ?>
    <script>
        var data = {
            action: 'is_user_logged_in'
        };
        var ajaxurl = 'https://pafssh.provirtualmeeting.com/wp-admin/admin-ajax.php';
        jQuery.post(ajaxurl, data, function (response) {
            if (response.trim() == 'yes') {
                console.log("logged");
                jQuery(document).ready(function ($) {
                    $('#login_form14').hide();
                    $('#login_form13').hide();
                });
                // user is logged in, do your stuff here
            } else {
                console.log(response);
            }
        });
    </script>
    <?php
}

//after login, login at university
//function after_login($user_login=null, $user=null)
function after_login($user_login, $user)
{
if(!empty($user)){
    $username = $user_login;
    $data = $user->user_email;
    $_SESSION['pass'] = $data;
    $_SESSION['url'] = "https://pafssh.provirtualmeeting.com/video/calendar/public/api/log";
//    $_SESSION['url'] = "https://webhook.site/9f6d7801-15e6-4fff-9d82-0820d8b31bae";
}
}

add_action('wp_login', 'after_login', 10, 2);

add_action('user_register', 'myplugin_registration_save', 10, 1);
function myplugin_registration_save($user_id)
{
    $user_info = get_userdata($user_id);
//    $name = $user_info->first_name . ' ' . $user_info->last_name;
    $name = $user_info->user_login;
    if ($name == NULL || $name == ' ') {
        $name = 'User';
    }
    $email = $user_info->user_email;
    $pass = $user_info->user_pass;
    $pass = substr($pass, 0, 5);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://pafssh.provirtualmeeting.com/video/calendar/public/api/del-data");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "email=$email&name=$name&password=$pass");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    echo $server_output = curl_exec($ch);
    curl_close($ch);
}

add_action('wpcf7_before_send_mail', 'save_form');

function save_form($wpcf7)
{
    global $wpdb;
    $wpcf7 = WPCF7_ContactForm::get_current();
    $submission = WPCF7_Submission::get_instance();
    $data = $submission->get_posted_data();


    $field1 = $data["your-email"];

    if (is_email($field1)) {
        $pg_status = 0;
        $name = '';
/*    	
$link = mysqli_connect('localhost', 'stalboom@pafssh.', 'Boomer5!');
if (!$link) {
die('Could not connect: ' . mysqli_error());
}
echo 'Connected successfully';
mysqli_close($link);

die();*/
      /*  $mydb = new wpdb('root', 'Boomer5!', 'reg', 'http://aaecho.org/phpmyadmin');
        $rows = $mydb->get_results("SELECT k2.payment_status,k1.element_1_1,k1.element_1_2 FROM `ap_form_36939` k1 INNER JOIN ap_form_payments k2 ON k1.id = k2.record_id WHERE k1.element_12 = '$field1' ORDER BY k1.id DESC");
        foreach ($rows as $obj) :
            if ($obj->payment_status == 'paid') {
                $pg_status = 1;
                $name = $obj->element_1_1 . ' ' . $obj->element_1_2;
                break;
            }
        endforeach;*/
    $url = "http://reg.mktgm.com/connectapi.php/?mailID=".$field1;
    $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $headResponse = curl_exec($ch);
            curl_close($ch);
   /* echo "<pre>";
    print_r($headResponse);
    echo "</pre>";*/
         $resdecoded = json_decode($headResponse);
    /*echo "<pre>";
    print_r($resdecoded);
    echo "</pre>";
    echo $resdecoded->status;
    die();*/
       if ($resdecoded->status == 1) {
                $pg_status = 1;
                $name = $resdecoded->name;
            }
        if ($pg_status == 1) {
        /*--------------- user login section START-------------------*/
          $user = email_exists($field1);
           if ($user != false) {
                wp_clear_auth_cookie();
                wp_set_current_user($user);
                wp_set_auth_cookie($user);
                $_SESSION['pass'] = $field1;
                $_SESSION['url'] = "https://pafssh.provirtualmeeting.com/video/calendar/public/api/log";
 //               header('location:https://pafssh.provirtualmeeting.com');
//                exit();
        /*--------------- user login section END-------------------*/
            ?>
            <!--                <script>-->
            <!--                    window.location.hash = '';-->
            <!--                    window.location.href = "https://pafssh.provirtualmeeting.com"-->
            <!--                </script>-->
            <?php
            /*--------------- user login section START-------------------*/
            }
            else {
                $userdata = array(
                    'user_login' => $name,
                   'user_pass' => 'mypass',
                'user_email' => $field1,
                    'user_registered' => date_i18n('Y-m-d H:i:s', time()),
                    'role' => 'subscriber'
                );
                $user = wp_insert_user($userdata);
                wp_clear_auth_cookie();
                wp_set_current_user($user);
            	wp_set_auth_cookie($user);
                $_SESSION['pass'] = $field1;
                $_SESSION['url'] = "https://pafssh.provirtualmeeting.com/video/calendar/public/api/log";
 //               header('location:https://pafssh.provirtualmeeting.com');
//                exit();
            }
          		update_user_meta( $user, 'simple-restrict-paid', 'yes' );
       		 ?>

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
            <script type="text/javascript">
                var data = '<?= $field1 ?>';
                var url = 'https://pafssh.provirtualmeeting.com/video/calendar/public/api/log';
                jQuery.ajax({
                    url: url,
                    data: 'email=' + data,
                    type: "POST",
                    xhrFields: {withCredentials: true},
                    success: function (result) {
                        alert('Logged In successfully');
                        window.location.hash = '';
                        window.location.href = "https://pafssh.provirtualmeeting.com/lobby-2/";
                        console.log(data);
                        console.log(result);
                    }
                }).fail(function (jqXHR, textStatus, error) {
                    console.log(textStatus.error);
                });
            </script>
			<?php
            /*--------------- user login section END-------------------*/
        } else {
            echo '<script>alert("Unable to login because you are not paid");
                   window.location.hash = "";
                   window.location.href = "https://pafssh.provirtualmeeting.com";
</script>';
        }
    } else {
        $msg = 'Invalid email';
    }
}

function ajax_check_user_logged_in()
{
    echo is_user_logged_in() ? 'yes' : 'no';
    die();
}

add_action('wp_ajax_is_user_logged_in', 'ajax_check_user_logged_in');
add_action('wp_ajax_nopriv_is_user_logged_in', 'ajax_check_user_logged_in');
?>

