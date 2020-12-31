<?php
function get_category_tag( $id = 0, $taxonomy, $before = '', $sep = '', $after = '', $count='all', $exclude = array() ){
    $terms = get_the_terms( $id, $taxonomy );

    if ( is_wp_error( $terms ) )
        return $terms;

    if ( empty( $terms ) )
        return false;

    $counter=0;
    foreach ( $terms as $term ) {
        if($counter<$count || $count=='all'){

            if(!in_array($term->term_id,$exclude)) {
                $link = get_term_link( $term, $taxonomy );
                if ( is_wp_error( $link ) )
                    return $link;
                $term_links[] = '<a href="' . esc_url($link) . '" rel="tag">' . esc_html($term->name) . '</a>';
            }
            $counter++;
        }
    }

    $term_links = apply_filters( "term_links-$taxonomy", $term_links );

    return $before . join( $sep, $term_links ) . $after;
}