<?php
/**
 * Custom functions
 */


/* set the [events-tribe-list] shortcode */
function ckhp_get_tribe_list($atts) {
    wp_enqueue_style( 'events-css' );
    if ( !function_exists( 'tribe_get_events' ) ) {
        return;
    }

    global $wp_query, $tribe_ecp, $post;
    $output='';
    $ckhp_event_tax = '';

    extract( shortcode_atts( array(
        'cat' => '',
        'number' => 5,
        'class' => '',
        'error' => 'y'
    ), $atts, 'ckhp-tribe-events' ), EXTR_PREFIX_ALL, 'ckhp' );

    $class = $atts['class'];

    if ( $ckhp_cat ) {
        $ckhp_event_tax = array(
            array(
                'taxonomy' => 'tribe_events_cat',
                'field' => 'slug',
                'terms' => $ckhp_cat
            )
        );
    }

    $posts = tribe_get_events(apply_filters('tribe_events_list_widget_query_args', array(
        'eventDisplay' => 'list',
        'posts_per_page' => $ckhp_number,
        'tax_query'=> $ckhp_event_tax
    )));

    if(! isset($no_upcoming_events) ) $no_upcoming_events=0; if ( $posts && !$no_upcoming_events) {

        if ( $posts && !$no_upcoming_events) {

            $output .= '<div class="event-calendar '.$class.'">';
            foreach( $posts as $post ) :
                setup_postdata( $post );
                $output .= '<a href="' . tribe_get_event_link() . '" rel="bookmark">';
                $output .= '<div class="event-post">';
                $output .= '<div class="event-date">';
                $output .= '<time>' . tribe_get_start_date($postId = null, $showtime = true, $dateFormat = 'M') . '<span>' . tribe_get_start_date($postId = null, $showtime = true, $dateFormat = 'd') . '</span></time>';
                $output .= '</div>';
                $output .= '<div class="event-details">';
                $output .= '<p>' . tribe_get_start_date($postId = null, $showtime = true, $dateFormat = 'l') . ' ' . tribe_get_start_date($postId = null, $showtime = true, $dateFormat = 'g:i a') . '</p>';
                $output .= '<h4 class="media-heading">' . '<a href="' . tribe_get_event_link() . '" rel="bookmark">' . get_the_title() . '</a>' . '</h4>';
                $output .= '</div>';
                $output .= '</div>';
                $output .= '</a>';
            endforeach;
            $output .= '</div><!-- .hfeed -->';
            $output .= '<p class="tribe-events-widget-link"><a class="btn btn-white rounded btn-md" href="' . tribe_get_events_link() . '" rel="bookmark">' . translate( 'View All Events', 'tribe-events-calendar' ) . '</a></p>';

        }} else { //No Events were Found
        $output .= ( $ckhp_error == 'y' ? '<p>' . translate( 'There are no upcoming events at this time.', 'tribe-events-calendar' ) . '</p>' : '' ) ;
    } // endif

    wp_reset_query();
    return $output;
}
add_shortcode('events-tribe-list', 'ckhp_get_tribe_list'); // link new function to shortcode name