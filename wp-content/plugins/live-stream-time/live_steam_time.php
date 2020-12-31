<?php
/*
Plugin Name: Live Stream Time
Plugin URI: 
Description: Plugin to show Live Time during stream.
Version: 0.1
Author: Abhishek Tomar
Author URI: 
License: GPL
*/


/* **************** CHECKBOXES **************** */
    // settings checkbox 
    add_action('admin_init', 'live_timer_theme_options');
function live_timer_theme_options() {
 
    // First, we register a section. This is necessary since all future options must belong to one.
    add_settings_section(
        'live_timer_settings_section',         // ID used to identify this section and with which to register options
        'Timer Options',                  // Title to be displayed on the administration page
        'live_timer_options_callback', // Callback used to render the description of the section
        'general'                           // Page on which to add this section of options
    );
    register_setting('general','live_timer_settings_section', 'esc_attr');
} // end sandbox_initialize_theme_options
 
/* ------------------------------------------------------------------------ *
 * Section Callbacks
 * ------------------------------------------------------------------------ */
 
/**
 * This function provides a simple description for the General Options page. 
 *
 * It is called from the 'sandbox_initialize_theme_options' function by being passed as a parameter
 * in the add_settings_section function.
 */
function live_timer_options_callback() {
	
	$value =get_option( 'live_timer_settings_section' );
	
   echo ' <label><input type="checkbox" value="1" '; checked($value, true, true); echo ' name="live_timer_settings_section" >';
    echo 'Enable'; 
    echo '</label>';
} 
 
 add_action( 'wp_footer', 'my_footer_scripts' );
	function my_footer_scripts(){
		$displayTimer = get_option( 'live_timer_settings_section' );
		if($displayTimer ==1){
	  ?>
		  <script type="text/javascript">
			  jQuery(document).ready( function($) {
				  $.fn.clockUpdate = function() { 
					  var datestime = new Date();
					 // datestime = datestime.toString("en-US", {timeZone: "CET"});
					 var targetTimeOffset  = +1*60; //desired time zone, taken as GMT-4
					datestime.setMinutes(datestime.getMinutes() + datestime.getTimezoneOffset() + targetTimeOffset );
					   var datenew = new Date(datestime);;
					 datenew.setDate(datenew.getDate() -1 );
					  var date = new Date(datenew);
				  
				  $.fn.addZero = function(x) {
					if (x < 10) {
					  return x = '0' + x;
					} else {
					  return x;
					}
				  }
				 $.fn.setMonths = function(x){
					if (x < 12) {
					  return x = 1 + x;
					} else {
					  return x = '1';
					}
				}
				 $.fn.twelveHour = function(x) {
					if (x == 0) {
					  return x = 12;
					} else {
					  return x;
					}
				  }
					$.fn.addMonths =function(date, months) {
						var d = date.getDate();
						date.setMonth(date.getMonth() + +months);
						if (date.getDate() != d) {
						  date.setDate(0);
						}
						return date;
					}
				  var h = $.fn.addZero($.fn.twelveHour(date.getHours()));
				  var m = $.fn.addZero(date.getMinutes());
				  var s = $.fn.addZero(date.getSeconds());
				  var da = date.getDay();
				  var mo = $.fn.setMonths(date.getMonth());
				  var ye = date.getFullYear();
					
				 // jQuery('#body-live-logo-col-2-time').text(h + ':' + m + ':' + s);
				  jQuery('#body-live-logo-col-2-time').text(h + ':' + m);
				  jQuery('#body-live-logo-col-2-date').text(da + '.' + mo+ '.'+ye );
				}
				  var pluginsUrl = "<?php echo site_url();?>";
				  var htmlcont = '<a id="body-live-logo" href="#live"><img src="'+pluginsUrl+'/wp-content/plugins/live-stream-time/live-icon.png" style="max-width: 50px;"><div id="body-live-logo-text">LIVE</div><div class="rowlive align-items-center"><div class="col-auto" id="body-live-logo-col-1"><img src="'+pluginsUrl+'/wp-content/plugins/live-stream-time/live-time-icon.png" style="max-width: 15px;"></div><div class="col-auto" id="body-live-logo-col-2"><div style="height: 20px;">      <span id="body-live-logo-col-2-time" style="font-size: 14px;"></span><span style="font-size: 8px;"> CET</span></div><div id="body-live-logo-col-2-date" style="font-size: 10px;"></div> </div></div>     </a>';
				$('body').prepend(htmlcont);
				   $.fn.clockUpdate();
				setInterval( $.fn.clockUpdate, 1000);
				
			 
			 });
				  
	</script>
		<style type="text/css">
			#body-live-logo {
				/* display: block; */
				width: 90px;
				height: 140px;
				background-color: rgb(200,10,52);
				color: white;
				text-align: center;
				position: fixed;
				top: 200px;
				border-top: 2px solid white;
				border-right: 2px solid white;
				border-bottom: 2px solid white;
				padding-top: 20px;
				z-index: 100;
				line-height: 1.5;
				text-decoration: non
			}
			#body-live-logo-text {
				font-size: 25px;
			}
			.align-items-center {
				-ms-flex-align: center!important;
				align-items: center!important;
			}
			#body-live-logo-col-1 {
				padding-left: 22px;
				padding-right: 0;
				color: white;
			}
			#body-live-logo-col-2 {
				padding-left: 3px;
			}
			.col-auto {
				-ms-flex: 0 0 auto;
				flex: 0 0 auto;
				width: auto;
				max-width: 100%;
			}
			.rowlive {
				display: -ms-flexbox;
				display: flex;
				-ms-flex-wrap: wrap;
				flex-wrap: wrap;
				margin-right: -15px;
				margin-left: -15px;
			}
		</style>
	  <?php
		}
	}


/*add_submenu_page( 'popup', 'PDF Popup', 'PDF Poopup', 'manage_options', 'pdf-popup', 'pdf_popup_function' );
function pdf_popup_function(){
	echo "here";
}
 */
?>
