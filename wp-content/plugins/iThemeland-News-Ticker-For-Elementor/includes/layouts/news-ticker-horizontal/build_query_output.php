<?php
$ticker_template   = $atts['itpl_news_ticker_horizontal_template'];
$ticker_pos        = $atts['itpl_news_ticker_horizontal_pos'];
$show_time         = ! empty($atts['itpl_news_ticker_horizontal_show_time']) ? 'itnt-timer-enable' : 'itnt-timer-disable';
$show_navigation   = ! empty($atts['itpl_news_ticker_horizontal_show_navigation']) ? 'itnt-ticker-show-nav' : 'itnt-hide-nav';
$title_show_icon   = $atts['itpl_news_ticker_horizontal_show_icon'];
$title_icon        = $atts['itpl_news_ticker_horizontal_title_icon'];
$title_text        = $atts['itpl_new_ticker_horizontal_title_text'];
$title_text_sec    = $atts['itpl_new_ticker_horizontal_title_text_second'];
$marquee_direction = ! empty($atts['itpl_news_ticker_horizontal_marquee_direction']) ? $atts['itpl_news_ticker_horizontal_marquee_direction'] : 'no-marquee';
$carousel_effect   = $atts['itpl_news_ticker_horizontal_carousel_effect'];
$manual_source     = $atts['itpl_news_ticker_horizontal_manual'];
$show_post_image   = ! empty($atts['itpl_news_ticker_horizontal_show_post_image']) ? 'show_post_image' : '';
$post_image_style  = $atts['itpl_news_ticker_horizontal_post_image_style'];

$show_logo  = ! empty($atts['itpl_news_ticker_horizontal_show_logo']) ? 'show_logo' : 'hide_logo';
$logo_image = $atts['itpl_news_ticker_horizontal_logo'];

$open_link_new      = ! empty($atts['itpl_news_ticker_horizontal_open_link_new']) ? '_blank' : '';
$show_sharing       = ! empty($atts['itpl_news_ticker_horizontal_show_sharing']) ? 'show_sharing' : '';
$social_icons       = $atts['itpl_news_ticker_horizontal_social_icons'];
$show_date          = ! empty($atts['itpl_news_ticker_horizontal_show_date']) ? 'show_date' : 'hide_date';
$date_format        = $atts['itpl_new_ticker_horizontal_date_format'];
$custom_date_format = ! empty($atts['itpl_new_ticker_horizontal_custom_data']) ? $atts['itpl_new_ticker_horizontal_custom_data'] : 'Y-m-d';
$auto_speed         = $atts['itpl_news_ticker_horizontal_auto_speed'];
$trans_speed        = $atts['itpl_news_ticker_horizontal_trans_speed'];
$scroll_amount      = $atts['itpl_news_ticker_horizontal_scroll_amount'];
$default_image      = $atts['itpl_news_ticker_horizontal_default_image'];
$query_post_type    = $atts['itpl_news_ticker_horizontal_post_type'];
$enable_interval    = $atts['itpl_news_ticker_horizontal_enable_interval'] ?? "disable_interval";
$ticker_interval    = $atts['itpl_news_ticker_horizontal_interval'] ?? "1";


$output .= '<div class="itnt-slick-' . esc_attr($rand) . ' itnt-slider-wrapper " data-slider-id="' . esc_attr($rand) . '" >';

$post_counter = 1;
if ($the_query->have_posts()) {
    while ($the_query->have_posts()) {

        $the_query->the_post(); // Get post from query
        $post          = new stdClass(); // Creating post object.
        $post->id      = get_the_ID();
        $post->link    = get_permalink($post->id);
        $post->title   = get_the_title($post->id);
        $post->excerpt = get_the_excerpt();

        $priceHtml = '';
        $saleBadge = '';

        if ('product' == $post_type) {
            $product   = new WC_Product(get_the_ID());
            $priceHtml = $product->get_price_html();
            $isSale    = $product->is_on_sale();
            if ($isSale) {
                $saleBadge = 'OnSALE';
            }
        }


        /*Get Taxonomy*/

        $cat_tax       = array();
        $all_tax       = get_object_taxonomies($query_post_type);
        $current_value = array();
        if (is_array($all_tax) && count($all_tax) > 0) {
            foreach ($all_tax as $tax) {
                if ($tax == "post_tag") {
                    continue;
                }

                $cat = get_category_tag($post->id, $tax, '', ',', '');
                if ($cat != '') {
                    $cat_tax[] = $cat;
                }
            }//end foreach
        }//end if is_array($all_tax)
        if (is_array($cat_tax) && (count($cat_tax) > 0)) {
            $cat_tax       = implode(',', $cat_tax);
            $cat_tax_array = explode(',', $cat_tax);
        }

        $post->author = get_the_author();
        $author_id    = get_the_author_meta('ID');
        $author_link  = get_author_posts_url($author_id);

        $excerpt_c = $post->excerpt;

        $comment_link = get_comments_link();
        $comment_num  = get_comments_number('0', '1', '% responses');

        $img_id       = get_post_meta($post->id, '_thumbnail_id', true);
        $img          = array();
        $default_size = '';

        $full_img = wp_get_attachment_image_src($img_id, 'thumbnail');


        //if post not set feature image read default image
        if ( isset($full_img[0])) {

            $full_img = $full_img[0];
        }else{

            $default_image = (array) $default_image;

            $full_img = $default_image['url'];
        }


        $output .= '
        <div class="itnt-slider-slide"  >
            <div class="itnt-ticker-feeds">
                
                <div class="itnt-feed-title">';
        if ($show_post_image == 'show_post_image') {
            $output .= '
            <div class="itnt-ticker-thumb ' . esc_attr($post_image_style) . '">
                <a href="' . esc_url($post->link) . '" target="' . esc_attr($open_link_new) . '"><img src="' . esc_url($full_img) . '" class="slide-img" /> </a>
            </div>';
        }
        if ($show_sharing == 'show_sharing' && isset($social_icons)) {

            $output .= '
            <div class="itnt-ticker-share">
                <i class="fa fa-share-alt"></i>
                <div class="itnt-social-icons">';
	            foreach ($social_icons as $icon) {
	                switch ($icon) {
	                    case 'share_twitter':
	                        $output .= '<a href="https://twitter.com/share?url=' . esc_url($post->link) . '"><i class="fa fa-twitter"></i></a>';
	                        break;
		                case 'share_facebook':
			                $output .= '<a href="https://www.facebook.com/sharer/sharer.php?u=' . esc_url($post->link) . '"><i class="fa fa-facebook"></i></a>';
			                break;
	                    case 'share_google':
	                        $output .= '<a href="https://plus.google.com/share?url=' . esc_url($post->link) . '"><i class="fa fa-google-plus"></i></a>';
	                        break;
	                }

	            }//end foreach

            $output .= '
                    </div>
                </div>	
            ';
        }
        $output .= '<a href="' . esc_url($post->link) . '"  class="itnt-feed-link" target="' . esc_attr($open_link_new) . '">';
        $output .= $post->title . ' </a>';


        if ($show_date == 'show_date') {
            $output .= '<div class="itnt-meta-date">';
            if ($date_format == 'WP_default') {
                $output .= '<span>' . get_the_date() . '</span>';
            } elseif ($date_format == 'relative') {
                $output .= '<span>' . human_time_diff(get_the_time('U'),
                        current_time('timestamp')) . ' ' . esc_html__('ago') . '</span>';
            } else {
                $output .= '<span>' . get_the_date($custom_date_format) . '</span>';

            }
            $output .= '</div>';
        }
        $output .= '</div><!--itnt-feed-title -->';
        $output .= '</div><!--itnt-ticker-feeds -->
				</div><!--itnt-slider-slide -->	';


        $post_counter++;

    }//end While
}
$output .= '</di>';
