<?php
/**
 * @var $atts
 */
$rand              = rand(999, 999999);
$ticker_template   = $atts['itpl_news_ticker_horizontal_template'];
$ticker_pos        = $atts['itpl_news_ticker_horizontal_pos'];
$reset_interval    = ! empty($atts['itpl_news_ticker_horizontal_enable_interval']) ? 'true' : '';
$rss_sources       = $atts['itpl_news_ticker_horizontal_rss'];
$show_post_image   = ! empty($atts['itpl_news_ticker_horizontal_show_post_image']) ? 'show_post_image' : '';
$title_text        = $atts['itpl_new_ticker_horizontal_title_text'];
$title_text_sec    = $atts['itpl_new_ticker_horizontal_title_text_second'];
$marquee_direction = ! empty($atts['itpl_news_ticker_horizontal_marquee_direction']) ? $atts['itpl_news_ticker_horizontal_marquee_direction'] : 'no-marquee';
$carousel_effect   = $atts['itpl_news_ticker_horizontal_carousel_effect'];
$post_image_style  = $atts['itpl_news_ticker_horizontal_post_image_style'];
$show_time         = ! empty($atts['itpl_news_ticker_horizontal_show_time']) ? 'itnt-timer-enable' : 'itnt-timer-disable';
$show_sharing      = ! empty($atts['itpl_news_ticker_horizontal_show_sharing']) ? 'show_sharing' : '';
$social_icons      = $atts['itpl_news_ticker_horizontal_social_icons'];
$enable_interval   = $atts['itpl_news_ticker_horizontal_enable_interval'] ?? "disable_interval";
$ticker_interval   = $atts['itpl_news_ticker_horizontal_interval'] ?? "1";
$auto_speed        = $atts['itpl_news_ticker_horizontal_auto_speed'];
$trans_speed       = $atts['itpl_news_ticker_horizontal_trans_speed'];
$hide_title        = ! empty($atts['itpl_news_ticker_horizontal_hide_title']) ? 'show_title' : '';
$scroll_amount     = $atts['itpl_news_ticker_horizontal_scroll_amount'];
$show_navigation   = ! empty($atts['itpl_news_ticker_horizontal_show_navigation']) ? 'itnt-ticker-show-nav' : '';
$hide_title        = ! empty($atts['itpl_news_ticker_horizontal_hide_title']) ? 'show_title' : '';
$show_date         = ! empty($atts['itpl_news_ticker_horizontal_show_date']) ? 'show_date' : 'hide_date';
$date_format       = $atts['itpl_new_ticker_horizontal_custom_data'];

$show_logo   = !empty($atts['itpl_news_ticker_horizontal_show_logo']) ?  'show_logo':'hide_logo';
$logo_image   = $atts['itpl_news_ticker_horizontal_logo'];

unset($atts['user_css']);
$output .= "<form style='display:none' class='pw_ticker_form_" . esc_attr($rand) . "'><input name='pw_atts' value=
				'" . json_encode($atts) . "' /><input name='pw_rand_id' value=
				'" . esc_html($rand) . "' /></form>";

$output .= '
<div class="itnt-ticker-holder itnt-ticker-id-' . esc_attr($rand) . ' ' . esc_attr($ticker_pos) . ' '.esc_attr($ticker_template).' '.esc_attr($carousel_effect).' '.esc_attr($show_logo).'"  style="visibility:hidden" >';
$output .= '
	 <div class="itnt-ticker-main-body itnt-ticker-main-body-' . esc_attr($rand) . '">';
if ($show_logo=='show_logo'){
	$output .= '
	 <div class="itnt-logo"><img src="'.esc_url($logo_image["url"]).'" /></div>';
}

$new_post_date     = current_time('timestamp');
$new_post_date_gmt = get_gmt_from_date($new_post_date, 'H:i');
$new_post_date_gmt = date("H : i", current_time('timestamp'));

$title_show_icon = $atts['itpl_news_ticker_horizontal_show_icon'];
$title_icon      = $atts['itpl_news_ticker_horizontal_title_icon'];


$output .= '
	<div class="itnt-ticker-body ' . esc_attr($show_time) . ' ' . esc_attr($show_navigation) . '">';
if ($show_time == 'itnt-timer-enable') {
    $output .= '
			<div class="itnt-time-cnt">
				<div class="itnt-hour-cnt itnt-hour-cnt-' . esc_attr($rand) . '"><span class="itnt-hour"></span><span class="it-blinking"> : </span><span class="itnt-min"></span></div>
				<div class="itnt-min-cnt"></div>
			</div>';
}

$output .= '<div class="itnt-ticker-heading">';
if ( ! empty($title_icon['value']) && $title_show_icon == 'show_icon') {
    $output .= '<div class="itnt-heading-icon"><i class="fa ' . esc_attr($title_icon['value']) . '"></i></div>';
}

$rss = array();

$output .= '
				<div class="itnt-heading-title  itnt-heading-title-' . esc_attr($rand) . '">' . '<b>' . esc_html($title_text) . '</b> ' . esc_html($title_text_sec) . '</div>
            </div>';

$output .= '
		<div class="itnt-ticker-loading itnt-ticker-loading-' . esc_attr($rand) . '"><div class="itnt-stage"><div class="itnt-dot-floating"></div></div></div>
		<div class="itnt-ticker-content-cnt itnt-ticker-content-cnt-' . esc_attr($rand) . ' itnt-' . esc_attr($carousel_effect) . ' ' . esc_attr($marquee_direction) . '-direction"   style="display:none">';


$output .='<div class="itnt-slick-' . esc_attr($rand) . ' itnt-slider-wrapper" data-slider-id="' . esc_attr($rand) . '">';
foreach ($rss_sources as $source) {

    $source = (array)$source;

    $source_link = (array)$source['itpl_news_ticker_horizontal_rss_link'];
    $rss = fetch_feed($source_link['url']);

    $maxitems = 0;
    if ( ! is_wp_error($rss)) : // Checks that the object is created correctly
        // Figure out how many total items there are, but limit it to 5.
        $max_items = 10;
        $maxitems  = $rss->get_item_quantity($max_items);
		
        // Build an array of all the items, starting with element 0 (first element).
        $rss_items = $rss->get_items(0, $maxitems);
		
    endif;
	
    if ($maxitems == 0) :
        $output .= '
				<div class="itnt-slider-slide"  >' . esc_html__('No items', ITPL_ELEMENTOR_TEXTDOMAIN) . '</div>';
    else :
        $excerpt_len = 20;

        foreach ($rss_items as $item) :
		
            $pl_excerpt = $item->get_description();
            $pl_excerpt = wp_html_excerpt($pl_excerpt, intval($excerpt_len));

            /*IMAGES*/
            $pl_output    = preg_match_all('/<img[^>]+src=[\'"]([^\'"]+)[\'"][^>]*>/i', $item->get_description(),
                $pl_matches);
            $pl_thumbnail = '';
            if (is_array($pl_matches[1]) && count($pl_matches[1]) > 0) {
                $pl_thumbnail = $pl_matches[1][0];
            } else {
                $pl_thumbnail = $source['itpl_news_ticker_horizontal_rss_image']['url'];
            }

            $pl_title = esc_html($item->get_title());
            $pl_link  = esc_url($item->get_permalink());
            $pl_author = '';
            $output .= '
						<div class="itnt-slider-slide"  >
							<div class="itnt-ticker-feeds">
								
								<div class="itnt-feed-title">';
            if ($show_post_image == 'show_post_image') {
                $output .= '
										<div class="itnt-ticker-thumb ' . esc_attr($post_image_style) . '">
											<a href="' . esc_url($pl_link) . '"  target="_blank"><img src="' . esc_url($pl_thumbnail) . '" class="slide-img" alt=""/> </a>
										</div>';
            }
            if ($show_sharing == 'show_sharing') {
	            $output .= '<div class="itnt-ticker-share">
								<i class="fa fa-share-alt"></i>
							<div class="itnt-social-icons">';

	            foreach ($social_icons as $icon) {
		            switch ($icon) {
			            case 'share_twitter':
				            $output .= '<a href="https://twitter.com/share?url=' . esc_url($pl_link) . '"><i class="fa fa-twitter"></i></a>';
				            break;
			            case 'share_facebook':
				            $output .= '<a href="https://www.facebook.com/sharer/sharer.php?u=' . esc_url($pl_link) . '"><i class="fa fa-facebook"></i></a>';
				            break;
			            case 'share_google':
				            $output .= '<a href="https://plus.google.com/share?url=' . esc_url($pl_link) . '"><i class="fa fa-google-plus"></i></a>';
				            break;
		            }

	            }//end foreach

	            $output .= '
												</div>
											</div>	
										';
            }

            $output .= '<a class="itnt-feed-link" href="' . esc_url($pl_link) . '"  target="_blank">';
            $output .= $pl_title . '</a>';
	        if ($show_date == 'show_date') {
		        $pl_date = $item->get_date($date_format);
		        $output  .= '<div class="itnt-meta-date"><span>' . esc_html($pl_date) . '</span></div>';
	        }
	        $output .=	'
								</div><!--itnt-feed-title -->
							</div><!--itnt-ticker-feeds -->
						</div><!--itnt-slider-slide -->	';

        endforeach;
    endif;

}//end foreach sources
$output .='</div>';



$output .= '	
				</div><!-- -->		 
			</div>
		</div><!--itnt-ticker-main-body --->
    </div><!--itnt-ticker-holder --> 
	
	';

$interval_time = $ticker_interval * 60000;
$item_per_show = $item_per_slide = 1;
$output .= '<script type="text/javascript">
				var itpl_setInterval' . esc_html($rand) . ';
				jQuery(document).ready(function() {	
				    jQuery(".itnt-ticker-id-' . esc_attr( $rand ) . '").css("visibility","visible");
					function itpl_generateInterval_rss(rand_id){
						clearInterval(itpl_setInterval' . esc_html($rand) . ');
						itpl_setInterval' . esc_html($rand) . ' =setInterval(function () {
							
							itpl_generateInterval_rss("' . esc_html($rand) . '");
							
						},' . esc_html($interval_time) . ');
						
						var pdata = {
							action: "it_newsticker_rss_interval",
							postdata: jQuery(".pw_ticker_form_"+rand_id).serialize()+"&rss_id=no_rss",
							nonce: "' . wp_create_nonce('it_bundle_none') . '",
						};
						
						jQuery(".itnt-ticker-content-cnt-' . esc_html($rand) . '").html("<div class=\'itnt-ticker-loading\'><div class=\'itnt-stage\'><div class=\'itnt-dot-floating\'></div></div></div>");
												
						jQuery.ajax ({
							type: "POST",
							url : "' . admin_url('admin-ajax.php') . '",
							data:  pdata,
							dataType: "html",
							success : function(resp){
								jQuery(".itnt-ticker-content-cnt-' . esc_html($rand) . '").html(resp);
								itpl_runTimeJS();	
							}
						});
						
					}	
				';

if ($enable_interval == 'enable_interval') {
    $output .= '
                itpl_setInterval' . esc_html($rand) . ' =setInterval(function () {							
                    itpl_generateInterval_rss("' . esc_html($rand) . '");
                    
                },' . esc_html($interval_time) . ');
                
                
                jQuery( ".itnt-ticker-id-' . esc_html($rand) . '" )
                    .hover(function(ev) {
                        clearInterval(itpl_setInterval' . esc_html($rand) . ');
                    }, function(ev){
                        clearInterval(itpl_setInterval' . esc_html($rand) . ');
                        itpl_setInterval' . esc_html($rand) . ' =setInterval(function () {
                            itpl_generateInterval_rss("' . esc_html($rand) . '");
                        },' . esc_html($interval_time) . ');
                });';
}

$output .= '
					
					
				
					function itpl_runTimeJS(){
					';
if ($carousel_effect == 'fade' || $carousel_effect == 'slide') {
    $car_mode = $carousel_effect;
    if ($car_mode == 'slide') {
        $car_mode = 'horizontal';
    }

    $output .= '
                jQuery(".itnt-ticker-content-cnt-' . esc_html($rand) . '").show();
                jQuery(".itnt-ticker-loading-' . esc_html($rand) . '").hide();
                pl_slick_' . esc_html($rand) . '=
                jQuery(".itnt-slick-' . esc_html($rand) . '").tickerSlider({
                  mode:\'' . esc_html($car_mode) . '\',
                  minSlides: ' . esc_html($item_per_show) . ',
                  maxSlides: 1,
                  moveSlides:' . esc_html($item_per_slide) . ',
                  slideMargin: 15,
                  speed:' . esc_html($auto_speed) . ',
                  pause:' . esc_html($trans_speed) . ',
                  touchEnabled:false,
                  pager:false,
                  nextText:"<i class=\'fa fa-chevron-right\'></i>",
                  prevText:"<i class=\'fa fa-chevron-left\'></i>",
                  autoHover:true,
                  autoStart:true,
                  auto:true,
                  wrapperClass: "ticker-slider-holder",
                  adaptiveHeight:false,';
if ($show_navigation != 'itnt-ticker-show-nav') {
$output .= ' 
                      controls:false,	
                      ';
}
$output .= ' 
                });
                jQuery(".itnt-ticker-id-' . esc_html($rand) . ' .bx-controls-direction a").click(function(){
                      pl_slick_' . esc_html($rand) . '.startAuto();
                 });
            ';
}
else {
    $output .= '
                jQuery(".itnt-ticker-content-cnt-' . esc_html($rand) . '").show();
                jQuery(".itnt-ticker-loading-' . esc_html($rand) . '").hide();
                jQuery(".itnt-slick-' . esc_html($rand) . '").liMarquee({
                    direction:"' . esc_html($marquee_direction) . '",	
                    loop:-1,			
                    scrolldelay: 0,		
                    scrollamount:' . esc_html($scroll_amount) . ',	
                    circular: true,		
                    drag: false,
                    runshort: true,

                });
        ';
}
$output .= '}	
			itpl_runTimeJS();';
$output .= '	
				});
			</script>
	';
?>