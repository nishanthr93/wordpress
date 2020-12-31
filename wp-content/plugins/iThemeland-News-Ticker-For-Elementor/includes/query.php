<?php
if ( ! function_exists( 'it_bundle_get_query' ) ) {
	function it_bundle_get_query( $args = array() ) {
		$the_query = new WP_Query( $args );

		return $the_query;
	}
}
//include post id
if ( ! function_exists( 'itpl_get_posts_include' ) ) {
	function itpl_get_posts_include() {
		$args          = array(
			'posts_per_page' => - 1,
			'post_type'      => 'post',
		);
		$get_all_posts = get_posts( $args );
		foreach ( $get_all_posts as $object ) {
			$post_id_include[ $object->ID ] = $object->post_name;
		}

		return $post_id_include;
	}
}

//include & Exclude Page id
if ( ! function_exists( 'itpl_get_pages_include' ) ) {
	function itpl_get_pages_include() {
		$args          = array(
			'posts_per_page' => - 1,
			'post_type'      => 'page',
		);
		$get_all_posts = get_pages( $args );
		foreach ( $get_all_posts as $object ) {
			$page_id_include[ $object->ID ] = $object->post_name;
		}

		return $page_id_include;
	}
}

//include category
if ( ! function_exists( 'itpl_get_category_include' ) ) {
	function itpl_get_category_include() {
		$args = array(
			'taxonomy'     => 'category',
			'orderby'      => 'name',
			'order'        => 'ASC',
			'hide_empty'   => 0,
			'depth'        => 1,
			'hierarchical' => 1,
			'exclude'      => '',
			'include'      => '',
			'child_of'     => 0,
			'number'       => '',
			'pad_counts'   => false
		);

		$inc_categories = get_categories( $args );
		foreach ( $inc_categories as $categor ) {
			$inc_category_array[ $categor->term_id ] = $categor->cat_name . ' (' . esc_html($categor->count) . ')';
		}

		return $inc_category_array;
	}
}

//include tags
if ( ! function_exists( 'itpl_get_tag_include' ) ) {
	function itpl_get_tag_include() {
		$inc_tags_array = array();
		$args           = array(
			'taxonomy'     => 'post_tag',
			'orderby'      => 'name',
			'order'        => 'ASC',
			'hide_empty'   => 0,
			'depth'        => 1,
			'hierarchical' => 1,
			'exclude'      => '',
			'include'      => '',
			'child_of'     => 0,
			'number'       => '',
			'pad_counts'   => false
		);

		$posttags = get_tags( $args );
		if ( $posttags ) {
			foreach ( $posttags as $tag ) {
				$inc_tags_array[ $tag->term_id ] = $tag->name . ' (' . esc_html($tag->count) . ')';
			}
		}

		return $inc_tags_array;

	}
}

//get all post author
if ( ! function_exists( 'itpl_get_all_author' ) ) {
	function itpl_get_all_author() {
		$users = get_users( array(
			'orderby'        => 'display_name',
			'order'          => 'DESC',
			'posts_per_page' => - 1,
			'fields'         => array( 'ID', 'user_nicename' ),
			'post_type'      => 'post',
		) );

		if ( $users ) {
			$author_array = array();
			foreach ( $users as $user ) {
				$author_array[ $user->ID ] = $user->user_nicename;
			}

			return $author_array;
		}

	}
}

//get all page author
if ( ! function_exists( 'itpl_get_all_page_author' ) ) {
	function itpl_get_all_page_author() {
		$users = get_users( array(
			'orderby'        => 'display_name',
			'order'          => 'DESC',
			'posts_per_page' => - 1,
			'fields'         => array( 'ID', 'user_nicename' ),
			'post_type'      => 'page',
		) );

		if ( $users ) {
			$author_array_page = array();
			foreach ( $users as $user ) {
				$author_array_page[ $user->ID ] = $user->user_nicename;
			}

			return $author_array_page;
		}

	}
}

/* Function which displays your post date in time ago format */
if ( ! function_exists( 'itpl_time_ago' ) ) {
	function itpl_time_ago() {
		return human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) . ' ' . esc_html__( 'ago' );
	}
}
if ( ! function_exists( 'itpl_pc_data_format' ) ) {
	function itpl_pc_data_format( $atts ) {
		$output = '';
		if ( $atts['itpl_carousel_form_data_format'] == 'WP_default' ) {
			$output .= get_the_date();
		} elseif ( $atts['itpl_carousel_form_data_format'] == 'relative' ) {
			$output .= itpl_time_ago();
		} else {
			$output .= get_the_date( '' . ( ! empty( $atts['itpl_carousel_form_custom_data'] ) ? $atts['itpl_carousel_form_custom_data'] : 'Y-m-d' ) . '' );
		}

		return $output;
	}
}
//Custom excerpt with length
if ( ! function_exists( 'itpl_custom_excerpt' ) ) {
	function itpl_custom_excerpt( $limit ) {
		$excerpt = explode( ' ', get_the_excerpt(), $limit );
		if ( count( $excerpt ) >= $limit ) {
			array_pop( $excerpt );
			$excerpt = implode( " ", $excerpt ) . '...';
		} else {
			$excerpt = implode( " ", $excerpt );
		}
		$excerpt = preg_replace( '`[[^]]*]`', '', $excerpt );

		return $excerpt;
	}
}
//include taxonomy
if ( ! function_exists('itpl_get_tax_include')) {
    function itpl_get_tax_include()
    {

        $post_type = itpl_get_post_type();

        $option = [];

        foreach ($post_type as $post_name => $post_lbl) {

            if ($post_name == 'post' || $post_name == 'page') {
                continue;
            }

            $all_tax = get_object_taxonomies($post_name);

            if (is_array($all_tax) && count($all_tax) > 0) {
                $post_type_label = get_post_type_object($post_name);
                $label           = $post_type_label->label;

                //FETCH TAXONOMY
                foreach ($all_tax as $tax) {

                    if ('product_type' === $tax) continue;
                    if ('product_visibility' === $tax) continue;
                    $taxonomy = get_taxonomy($tax);
                    $values   = $tax;
                    $label    = $taxonomy->label;

                    $args = array(
                        'orderby'      => 'name',
                        'order'        => 'ASC',
                        'hide_empty'   => 1,
                        'hierarchical' => 1,
                        'exclude'      => '',
                        'include'      => '',
                        'child_of'     => 0,
                        'number'       => '',
                        'pad_counts'   => false

                    );

                    $categories = get_terms($tax, $args);
                    foreach ($categories as $category) {
                        $option[$tax . '__' . $category->term_id] = $category->name;
                    }
                }
            }
        }

        return $option;
    }
}
//get all post type
if ( ! function_exists('itpl_get_post_type')) {
    function itpl_get_post_type()
    {
        $output     = 'objects';
        $args       = array(
            'public' => true
        );
        $post_types = get_post_types($args, $output);
        $options    = [];
        foreach ($post_types as $post_type) {
            if ($post_type->name != 'attachment') {
                $post_value           = $post_type->name;
                $post_lbl             = $post_type->labels->name;
                $options[$post_value] = $post_lbl;
            }
        }

        return $options;
    }
}
if ( ! function_exists('create_tax_query')) {
    function create_tax_query($include_items, $exclude_items)
    {
        $query_tax_query = array('relation' => 'AND');
        if ( ! is_array($include_items) && ! is_array($exclude_items)) {
            return false;
        }

        $include_items_array = [];
        foreach ($include_items as $item) {
            $explode_item                = explode("__", $item);
            $tax                         = $explode_item[0];
            $item                        = $explode_item[1];
            $include_items_array[$tax][] = $item;
        }

        $exclude_items_array = [];
        foreach ($exclude_items as $item) {
            $explode_item                = explode("__", $item);
            $tax                         = $explode_item[0];
            $item                        = $explode_item[1];
            $exclude_items_array[$tax][] = $item;
        }

        foreach ($include_items_array as $tax => $items) {

            $query_tax_query[] = array(
                'taxonomy' => $tax,
                'field'    => 'id',
                'terms'    => $items,
                'operator' => 'IN',
            );
        }

        foreach ($exclude_items_array as $tax => $items) {

            $query_tax_query[] = array(
                'taxonomy' => $tax,
                'field'    => 'id',
                'terms'    => $items,
                'operator' => 'NOT IN',
            );
        }

        return $query_tax_query;
    }
}
//Data Format
if ( ! function_exists( 'itpl_all_data_format' ) ) {
	function itpl_all_data_format( $atts, $prefix ) {
		$output = '';
		if ( $atts[ $prefix . '_data_format' ] == 'WP_default' ) {
			$output .= get_the_date();
		} elseif ( $atts[ $prefix . '_data_format' ] == 'relative' ) {
			$output .= itpl_time_ago();
		} else {
			$output .= get_the_date( '' . ( ! empty( $atts[ $prefix . '_custom_data' ] ) ? $atts[ $prefix . '_custom_data' ] : 'Y-m-d' ) . '' );
		}

		return $output;
	}
}


