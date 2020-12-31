<?php
/**
 * @var $atts
 */

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

                //$def_image = (array))$source;

                $pl_thumbnail = $source['itpl_news_ticker_horizontal_rss_image']->url;
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