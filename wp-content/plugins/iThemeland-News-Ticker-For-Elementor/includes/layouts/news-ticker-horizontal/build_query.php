<?php
include "build_query_sql.php";

$ticker_template   = $atts['itpl_news_ticker_horizontal_template'];
$ticker_pos        = $atts['itpl_news_ticker_horizontal_pos'];
$show_time         = ! empty( $atts['itpl_news_ticker_horizontal_show_time'] ) ? 'itnt-timer-enable' : 'itnt-timer-disable';
$show_navigation   = ! empty( $atts['itpl_news_ticker_horizontal_show_navigation'] ) ? 'itnt-ticker-show-nav' : 'itnt-hide-nav';
$title_show_icon   = $atts['itpl_news_ticker_horizontal_show_icon'];
$title_icon        = $atts['itpl_news_ticker_horizontal_title_icon'];
$title_text        = $atts['itpl_new_ticker_horizontal_title_text'];
$title_text_sec    = $atts['itpl_new_ticker_horizontal_title_text_second'];
$marquee_direction = ! empty( $atts['itpl_news_ticker_horizontal_marquee_direction'] ) ? $atts['itpl_news_ticker_horizontal_marquee_direction'] : 'no-marquee';
$carousel_effect   = $atts['itpl_news_ticker_horizontal_carousel_effect'];
$manual_source     = $atts['itpl_news_ticker_horizontal_manual'];
$show_post_image   = ! empty( $atts['itpl_news_ticker_horizontal_show_post_image'] ) ? 'show_post_image' : '';
$post_image_style  = $atts['itpl_news_ticker_horizontal_post_image_style'];

$show_logo  = ! empty( $atts['itpl_news_ticker_horizontal_show_logo'] ) ? 'show_logo' : 'hide_logo';
$logo_image = $atts['itpl_news_ticker_horizontal_logo'];


$open_link_new      = ! empty( $atts['itpl_news_ticker_horizontal_open_link_new'] ) ? '_blank' : '';
$show_sharing       = ! empty( $atts['itpl_news_ticker_horizontal_show_sharing'] ) ? 'show_sharing' : '';
$social_icons       = $atts['itpl_news_ticker_horizontal_social_icons'];
$show_date          = ! empty( $atts['itpl_news_ticker_horizontal_show_date'] ) ? 'show_date' : 'hide_date';
$date_format        = $atts['itpl_new_ticker_horizontal_date_format'];
$custom_date_format = ! empty( $atts['itpl_new_ticker_horizontal_custom_data'] ) ? $atts['itpl_new_ticker_horizontal_custom_data'] : 'Y-m-d';
$auto_speed         = $atts['itpl_news_ticker_horizontal_auto_speed'];
$trans_speed        = $atts['itpl_news_ticker_horizontal_trans_speed'];
$scroll_amount      = $atts['itpl_news_ticker_horizontal_scroll_amount'];
$default_image      = $atts['itpl_news_ticker_horizontal_default_image'];
$query_post_type    = $atts['itpl_news_ticker_horizontal_post_type'];
$enable_interval    = $atts['itpl_news_ticker_horizontal_enable_interval'] ?? "disable_interval";
$ticker_interval    = $atts['itpl_news_ticker_horizontal_interval'] ?? "1";

unset( $atts['user_css'] );
$output .= "<form style='display:none' class='pw_ticker_form_" . esc_attr( $rand ) . "'><input name='pw_atts' value=
				'" . json_encode( $atts ) . "' /><input name='pw_rand_id' value=
				'" . esc_attr( $rand ) . "' /></form>";

$car_row_counter = 0;

//rtl and fix position(itnt-fix-place)
$output .= '
<div class="itnt-ticker-holder itnt-ticker-id-' . esc_attr( $rand ) . '  ' . esc_attr( $ticker_pos ) . ' ' . esc_attr( $ticker_template ) . ' ' . esc_attr( $carousel_effect ) . '-effect ' . esc_attr( $show_logo ) . '" style="visibility:hidden">';
$output .= '
	 <div class="itnt-ticker-main-body itnt-ticker-main-body-' . esc_attr( $rand ) . '">';
if ( $show_logo == 'show_logo' ) {
	$output .= '
	 <div class="itnt-logo"><img src="' . esc_url( $logo_image["url"] ) . '" /></div>';
}

//$new_post_author   = wp_get_current_user();
$new_post_date     = current_time( 'timestamp' );
$new_post_date_gmt = get_gmt_from_date( $new_post_date, 'H:i' );
$new_post_date_gmt = date( "H : i", current_time( 'timestamp' ) );

$output .= '
	<div class="itnt-ticker-body ' . esc_attr( $show_time ) . ' ' . esc_attr( $show_navigation ) . '">';

if ( $show_time == 'itnt-timer-enable' ) {
	$output .= '
			<div class="itnt-time-cnt">
				<div id="itnt-hour-cnt" class="itnt-hour-cnt  itnt-hour-cnt-' . esc_attr( $rand ) . '""><span class="itnt-hour"></span><span class="it-blinking"> : </span><span class="itnt-min"></span></div>
				<div class="itnt-min-cnt"> </div>
			</div>';
}


$output .= '<div class="itnt-ticker-heading">';
if ( ! empty( $title_icon['value'] ) && $title_show_icon == 'show_icon' ) {
	$output .= '<div class="itnt-heading-icon"><i class="fa ' . esc_attr( $title_icon['value'] ) . '"></i></div>';
}
$output .= '<div class="itnt-heading-title itnt-heading-title-' . esc_attr( $rand ) . '">' . '<b>' . esc_html( $title_text ) . '</b> ' . esc_html( $title_text_sec ) . '</div>
		</div>';

$output .= '
		<div class="itnt-ticker-loading itnt-ticker-loading-' . esc_attr( $rand ) . '"><div class="itnt-stage"><div class="itnt-dot-floating"></div></div></div>
		<div class="itnt-ticker-content-cnt itnt-ticker-content-cnt-' . esc_attr( $rand ) . ' itnt-' . esc_attr( $carousel_effect ) . ' ' . esc_attr( $marquee_direction ) . '-direction"   style="display:none">
		';


include "build_query_output.php";

$output .= '	
				</div><!-- -->		 
			</div>
		</div><!--itnt-ticker-main-body --->
    </div><!--itnt-ticker-holder --> 
	
	';
wp_reset_query();


$interval_time = $ticker_interval * 60000;
$item_per_show = $item_per_slide = 1;

$output .= '<script type="text/javascript">
				var itpl_setInterval' . esc_html( $rand ) . ';
				
				jQuery(document).ready(function() {	
					jQuery(".itnt-ticker-id-' . esc_attr( $rand ) . '").css("visibility","visible");
					function itpl_generateInterval_query(rand_id){

						clearInterval(itpl_setInterval' . esc_html( $rand ) . ');
						itpl_setInterval' . esc_html( $rand ) . ' =setInterval(function () {
							
							if(jQuery("html").find(".itnt-filter-item-' . esc_html( $rand ) . '")>1)
							{
								jQuery(".itnt-filter-item-' . esc_html( $rand ) . '").find(".pw_active_filter").trigger("click");
							}
							else{
								itpl_generateInterval_query("' . esc_html( $rand ) . '");
							}
							
						},' . esc_html( $interval_time ) . ');
						
						var pdata = {
							action: "it_newsticker_build_query_interval",
							postdata: jQuery(".pw_ticker_form_"+rand_id).serialize()+"&cat_id=no_cat",
							nonce: "' . wp_create_nonce( 'it_bundle_none' ) . '",
						};
						
                            jQuery(".itnt-ticker-content-cnt-' . esc_html( $rand ) . '").html("<div class=\'itnt-ticker-loading\'><div class=\'itnt-stage\'><div class=\'itnt-dot-floating\'></div></div></div>");
						
						//jQuery(".itnt-ticker-content-cnt-' . esc_html( $rand ) . '").html("<div class=&quot;itnt-ticker-loading&quot;><div class=&quot;itnt-stage&quot;><div class=&quot;itnt-dot-floating&quot;></div></div></div>");

						
						jQuery.ajax ({
							type: "POST",
							url : "' . admin_url( 'admin-ajax.php' ) . '",
							data:  pdata,
							dataType: "html",
							success : function(resp){
							    							
								var datas=resp.split("@#");
								jQuery(".itnt-ticker-content-cnt-' . esc_html( $rand ) . '").html(datas[0]);
								//jQuery(".itnt-hour-cnt-' . esc_html( $rand ) . '").html(datas[1]);
								
								itpl_runTimeJS();
								
							}
						});
						
					}
					
					';

if ( $enable_interval == 'enable_interval' ) {
	$output .= '
                    itpl_setInterval' . esc_html( $rand ) . ' =setInterval(function () {
                        itpl_generateInterval_query("' . esc_html( $rand ) . '");
                    },' . esc_html( $interval_time ) . ');
                    
                    jQuery( ".itnt-ticker-id-' . esc_html( $rand ) . '" )
                        .hover(function(ev) {
                            clearInterval(itpl_setInterval' . esc_html( $rand ) . ');
                        }, function(ev){
                            clearInterval(itpl_setInterval' . esc_html( $rand ) . ');
                            itpl_setInterval' . esc_html( $rand ) . ' =setInterval(function () {
                                itpl_generateInterval_query("' . esc_html( $rand ) . '");
                            },' . esc_html( $interval_time ) . ');
                    });';
}

$output .= '		
                function itpl_runTimeJS(){
				';

if ( $carousel_effect == 'fade' || $carousel_effect == 'slide' ) {

	$car_mode = $carousel_effect;
	if ( $car_mode == 'slide' ) {
		$car_mode = 'horizontal';
	}

	$output .= '
                            jQuery(".itnt-ticker-content-cnt-' . esc_html( $rand ) . '").show();
                            jQuery(".itnt-ticker-loading-' . esc_html( $rand ) . '").hide();
                            
                            pl_slick_' . esc_html( $rand ) . '=
                            jQuery(".itnt-slick-' . esc_html( $rand ) . '").tickerSlider({
                                mode:\'' . esc_html( $car_mode ) . '\',
                                minSlides: ' . esc_html( $item_per_show ) . ',
                                maxSlides: 1,
                                moveSlides:' . esc_html( $item_per_slide ) . ',
                                slideMargin: 15,
                                speed:' . esc_html( $auto_speed ) . ',
                                pause:' . esc_html( $trans_speed ) . ',
                                touchEnabled:false,
                                pager:false,
                                nextText:"<i class=\'fa fa-chevron-right\'></i>",
								prevText:"<i class=\'fa fa-chevron-left\'></i>",
                                autoHover:true,
                                autoStart:true,
                                auto:true,
                                wrapperClass: "ticker-slider-holder",
                                adaptiveHeight:false,';
	if ( $show_navigation != 'itnt-ticker-show-nav' ) {
		$output .= 'controls:false,';
	}
	$output .= ' 
                            });
                            jQuery(".itnt-ticker-id-' . esc_html( $rand ) . ' .bx-controls-direction a").click(function(){
                                  pl_slick_' . esc_html( $rand ) . '.startAuto();
                             });
                        ';
} else {
	$output .= '
                                    
                            jQuery(".itnt-ticker-content-cnt-' . esc_html( $rand ) . '").show();
                            jQuery(".itnt-ticker-loading-' . esc_html( $rand ) . '").hide();
                            jQuery(".itnt-slick-' . esc_html( $rand ) . '").liMarquee({
                                direction:"' . esc_html( $marquee_direction ) . '",	
                                loop:-1,			
                                scrolldelay: 0,		
                                scrollamount:' . esc_html( $scroll_amount ) . ',	
                                circular: true,		
                                drag: false,
                                
                            });
                        ';
}

$output .= '
				}
				
				itpl_runTimeJS();';

$output .= '
				});
		    </script>';