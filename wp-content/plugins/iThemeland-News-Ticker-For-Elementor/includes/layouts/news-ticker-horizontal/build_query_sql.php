<?php
/**
 * @var $atts
 */

//Order By Data Query
$order_by = $atts['itpl_news_ticker_horizontal_sort_by'];
if ($atts['itpl_news_ticker_horizontal_sort_by'] == '1 week' || $atts['itpl_news_ticker_horizontal_sort_by'] == '1 month') {
    $data_query = array(
        array(
            'after' => $atts['itpl_news_ticker_horizontal_sort_by'] . ' ago',
        ),
    );
    $order_by   = 'rand';
} else {
    $data_query = '';
}

//ORDER FOR CUSTOM POSTS
$order_meta_key      = '';
$public_orders_array = array('modified', 'oldest_post', 'title', 'ID', '1 week', 'rand', 'comment_count', '1 month');
if ( ! in_array($order_by, $public_orders_array)) {
    $order_meta_key = $order_by;

    if ($order_by == '_sku') {
        $order_by = 'meta_value';
    } else {
        $order_by = 'meta_value_num';
    }
}


//Dynamic Post Or Page Type

$post_type = $atts['itpl_news_ticker_horizontal_post_type'];
$post_in   = $post_not_in = $author = '';

if ($post_type == 'post') {
    $post_in     = ($atts['itpl_news_ticker_horizontal_post_type'] == 'post') ? $atts['itpl_news_ticker_horizontal_include_post_id'] : $atts['itpl_news_ticker_horizontal_page_include_id'];
    $post_not_in = ($atts['itpl_news_ticker_horizontal_post_type'] == 'post') ? $atts['itpl_news_ticker_horizontal_exclude_post_id'] : $atts['itpl_news_ticker_horizontal_page_exclude_id'];
    $author      = $atts['itpl_news_ticker_horizontal_author_select'];
} elseif ($post_type == 'page') {
    $post_in     = ($atts['itpl_news_ticker_horizontal_post_type'] == 'page') ? $atts['itpl_news_ticker_horizontal_include_page_id'] : $atts['itpl_news_ticker_horizontal_include_page_id'];
    $post_not_in = ($atts['itpl_news_ticker_horizontal_post_type'] == 'page') ? $atts['itpl_news_ticker_horizontal_exclude_page_id'] : $atts['itpl_news_ticker_horizontal_exclude_page_id'];
    $author      = $atts['itpl_news_ticker_horizontal_page_author_select'];
}

//Include, Exclude Taxonomy
$include_taxonomy = (empty($atts['itpl_news_ticker_horizontal_include_tax']) ? '0' : $atts['itpl_news_ticker_horizontal_include_tax']);
$exclude_taxonomy = (empty($atts['itpl_news_ticker_horizontal_exclude_tax']) ? '0' : $atts['itpl_news_ticker_horizontal_exclude_tax']);


//Dynamic Query => main query
$args = array(
    'posts_per_page'   => (empty($atts['itpl_news_ticker_horizontal_post_number']) ? '20' : $atts['itpl_news_ticker_horizontal_post_number']),
    'post_type'        => $atts['itpl_news_ticker_horizontal_post_type'],
    'author__in'       => $author,
    'offset'           => (empty($atts['itpl_news_ticker_horizontal_post_offset']) ? '0' : $atts['itpl_news_ticker_horizontal_post_offset']),
    'post__in'         => $post_in,
    'post__not_in'     => $post_not_in,
    'orderby'          => $order_by,
    'meta_key'         => $order_meta_key,
    'date_query'       => $data_query,
    'order'            => (empty($atts['itpl_news_ticker_horizontal_order']) ? '0' : str_replace(',', ' ',
        $atts['itpl_news_ticker_horizontal_order'])),
    'category__in'     => (empty($atts['itpl_news_ticker_horizontal_include_category']) ? '0' : $atts['itpl_news_ticker_horizontal_include_category']),
    'category__not_in' => (empty($atts['itpl_news_ticker_horizontal_exclude_category']) ? '0' : $atts['itpl_news_ticker_horizontal_exclude_category']),
    'tag__in'          => (empty($atts['itpl_news_ticker_horizontal_include_tag']) ? '0' : $atts['itpl_news_ticker_horizontal_include_tag']),
    'tag__not_in'      => (empty($atts['itpl_news_ticker_horizontal_exclude_tag']) ? '0' : $atts['itpl_news_ticker_horizontal_exclude_tag']),
    'tax_query'        => create_tax_query($include_taxonomy, $exclude_taxonomy)
);

// The Query
$the_query = new WP_Query($args);
