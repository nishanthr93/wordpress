<?php
$custom_css = $atts['itpl_news_ticker_custom_css'];
$offset_val = $atts['itpl_news_ticker_horizontal_Offset'] * 2;
$custom_style.='<style>';
$custom_style .= '
				.itnt-ticker-id-'.esc_attr($rand).'.itnt-ticker-holder.itnt-fix-place{
					width: calc(100% - '.$offset_val.'px);
					margin-left : '.$atts['itpl_news_ticker_horizontal_Offset'].'px ;
				}
				
				.itnt-ticker-id-'.esc_attr($rand).' .itnt-dot-floating,
				.itnt-ticker-id-'.esc_attr($rand).' .itnt-dot-floating:before,
				.itnt-ticker-id-'.esc_attr($rand).' .itnt-dot-floating:after{
					background-color: '.$atts['itpl_news_ticker_horizontal_ticker_content_color'].';
				}
				';
$custom_style .= $custom_css;
$custom_style.='
</style>';
?>