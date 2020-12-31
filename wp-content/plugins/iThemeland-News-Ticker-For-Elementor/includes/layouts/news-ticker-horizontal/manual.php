<?php
/**
 * @var $atts
 */

$rand = $this->get_id();
$ticker_template = $atts['itpl_news_ticker_horizontal_template'];
$ticker_pos = $atts['itpl_news_ticker_horizontal_pos'];
$show_time = !empty($atts['itpl_news_ticker_horizontal_show_time']) ? 'itnt-timer-enable' : 'itnt-timer-disable';
$show_navigation = !empty($atts['itpl_news_ticker_horizontal_show_navigation']) ? 'itnt-ticker-show-nav' : '';
$title_show_icon = $atts['itpl_news_ticker_horizontal_show_icon'];
$title_icon = $atts['itpl_news_ticker_horizontal_title_icon'];
$title_text = $atts['itpl_new_ticker_horizontal_title_text'];
$title_text_sec = $atts['itpl_new_ticker_horizontal_title_text_second'];
$marquee_direction = ! empty($atts['itpl_news_ticker_horizontal_marquee_direction']) ? $atts['itpl_news_ticker_horizontal_marquee_direction'] : 'no-marquee';
$carousel_effect = $atts['itpl_news_ticker_horizontal_carousel_effect'];
$manual_source = $atts['itpl_news_ticker_horizontal_manual'];
$show_post_image = !empty($atts['itpl_news_ticker_horizontal_show_post_image']) ? 'show_post_image' : '';
$post_image_style = $atts['itpl_news_ticker_horizontal_post_image_style'];

$open_link_new = !empty($atts['itpl_news_ticker_horizontal_open_link_new']) ? '_blank' : '';
$show_sharing = !empty($atts['itpl_news_ticker_horizontal_show_sharing']) ? 'show_sharing' : '';
$social_icons = $atts['itpl_news_ticker_horizontal_social_icons'];
$show_date    = ! empty($atts['itpl_news_ticker_horizontal_show_date']) ? 'show_date' : 'hide_date';
$auto_speed = $atts['itpl_news_ticker_horizontal_auto_speed'];
$trans_speed = $atts['itpl_news_ticker_horizontal_trans_speed'];
$scroll_amount = $atts['itpl_news_ticker_horizontal_scroll_amount'];

$show_logo = !empty($atts['itpl_news_ticker_horizontal_show_logo']) ? 'show_logo' : 'hide_logo';
$logo_image = $atts['itpl_news_ticker_horizontal_logo'];

$output .= '
<div class="itnt-ticker-holder itnt-ticker-id-' . esc_attr($rand) . ' '.esc_attr($ticker_pos).' '.esc_attr($ticker_template).' '.esc_attr($carousel_effect).'-effect '.esc_attr($show_logo).'"  style="visibility:hidden">';
$output .= '
	 <div class="itnt-ticker-main-body itnt-ticker-main-body-' . esc_attr($rand) . '">';
if ($show_logo == 'show_logo') {
	$output .= '
	 <div class="itnt-logo"><img src="' . esc_url($logo_image["url"]) . '" /></div>';
}
$output .= '
	<div class="itnt-ticker-body ' . esc_attr($show_time) . ' ' . esc_attr($show_navigation) . '">';
if ($show_time == 'itnt-timer-enable') {
	$new_post_date = current_time('timestamp');
	$new_post_date_gmt = get_gmt_from_date($new_post_date, 'H:i');
	$new_post_date_gmt = date("H : i", current_time('timestamp'));
	$output .= '
			<div class="itnt-time-cnt">
				<div class="itnt-hour-cnt itnt-hour-cnt-' . esc_attr($rand) . '"><span class="itnt-hour"></span><span class="it-blinking"> : </span><span class="itnt-min"></span></div>
				<div class="itnt-min-cnt"></div>
			</div>';
}

$output .= '<div class="itnt-ticker-heading">';
if (!empty($title_icon['value']) && $title_show_icon == 'show_icon') {
	$output .= '<div class="itnt-heading-icon"><i class="fa ' . esc_attr($title_icon['value']) . '"></i></div>';
}
$output .= '<div class="itnt-heading-title">' . '<b>' . esc_html($title_text) . '</b> ' . esc_html($title_text_sec) . '</div>
			</div>';


$output .= '
		<div  class="itnt-ticker-loading itnt-ticker-loading-' . esc_attr($rand) . '"><div class="itnt-stage"><div class="itnt-dot-floating"></div></div></div>
		<div class="itnt-ticker-content-cnt  itnt-ticker-content-cnt-' . esc_attr($rand) . ' itnt-' . esc_attr($carousel_effect) . ' ' . esc_attr($marquee_direction) . '-direction"    style="display:none">
		<div class="itnt-slick-' . esc_attr($rand) . ' itnt-slider-wrapper" data-slider-id="' . esc_attr($rand) . '" >';

foreach ($manual_source as $source_item) {

	//set default image
	$output .= '
					<div class="itnt-slider-slide"  >
						<div class="itnt-ticker-feeds">
							<div class="itnt-feed-title">';
	if ($show_post_image == 'show_post_image' && !empty($source_item['itpl_news_ticker_horizontal_manual_image']['url'])) {
		$output .= '
					<div class="itnt-ticker-thumb ' . esc_attr($post_image_style) . '">
						<a href="' . esc_url($source_item['itpl_news_ticker_horizontal_manual_link']['url']) . '"  target="' . esc_attr($open_link_new) . '"><img src="' . esc_url($source_item['itpl_news_ticker_horizontal_manual_image']['url']) . '" class="slide-img" /> </a>
					</div>';
	}
	if ($show_sharing == 'show_sharing' && is_array($social_icons)) {
		$output .= '
					<div class="itnt-ticker-share">
						<i class="fa fa-share-alt"></i>
						<div class="itnt-social-icons">';
		foreach ($social_icons as $icon) {
			switch ($icon) {
				case 'share_twitter':
					$output .= '<a href="https://twitter.com/share?url=' . esc_url($source_item['itpl_news_ticker_horizontal_manual_link']['url']) . '"><i class="fa fa-twitter"></i></a>';
					break;
				case 'share_facebook':
					$output .= '<a href="https://www.facebook.com/sharer/sharer.php?u=' . esc_url($source_item['itpl_news_ticker_horizontal_manual_link']['url']) . '"><i class="fa fa-facebook"></i></a>';
					break;
				case 'share_google':
					$output .= '<a href="https://plus.google.com/share?url=' . esc_url($source_item['itpl_news_ticker_horizontal_manual_link']['url']) . '"><i class="fa fa-google-plus"></i></a>';
					break;
			}

		}//end foreach

		$output .= '
											</div>
										</div>	
									';
	}
	$source_link_start = '';
	$source_link_end = '';
	if (trim($source_item['itpl_news_ticker_horizontal_manual_link']['url']) != '') {
		$source_link_start = '<a class="itnt-feed-link" href="' . esc_url($source_item['itpl_news_ticker_horizontal_manual_link']['url']) . '"  target="' . esc_attr($open_link_new) . '">';
		$source_link_end = '</a>';

	}
	$output .= $source_link_start . $source_item['itpl_news_ticker_horizontal_manual_text'] . $source_link_end . '
							</div><!--itnt-feed-title -->
						</div><!--itnt-ticker-feeds -->
					</div><!--itnt-slider-slide -->	';
}//end foreach
$output .= '	
					</div>
				</div><!-- -->		 
			</div>
		</div><!--itnt-ticker-main-body --->
    </div><!--itnt-ticker-holder --> 
	';

$item_per_show = $item_per_slide = 1;
$output .= '<script type="text/javascript">

                

				var itpl_setInterval' . esc_html( $rand ) . ';
				
				jQuery(document).ready(function() {
				
				    jQuery(".itnt-ticker-id-'.esc_attr($rand).'").css("visibility","visible");		
					function itpl_runTimeJS(){';

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

?>