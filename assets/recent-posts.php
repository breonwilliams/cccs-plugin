<?php
/**
 * Custom functions
 */


/*recent posts list start*/
if ( ! function_exists('list_recent_posts') ) {
    function list_recent_posts( $atts ){

        $atts = shortcode_atts( array(
            'ptype' => '',
            'per_page'  =>      2,
            'order'     =>  'DESC',
            'orderby'   =>  'date',
            'category' => '',
            'class' => '',
            'pagination' => '',
        ), $atts );

        $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

        $class = $atts['class'];
        $pagination = $atts['pagination'];

        $args = array(
            'post_type'    =>  $atts["ptype"],
            'posts_per_page'    =>  $atts["per_page"],
            'order'             =>  $atts["order"],
            'orderby'           =>  $atts["orderby"],
            'paged'             =>  $paged,
            'category_name' => $atts["category"],
        );

        $query = new WP_Query($args);

        $output = '';
        $output .= '<ul class="media recent-posts '.$class.'">';

        if($query->have_posts()) : $output;

            while ($query->have_posts()) : $query->the_post();

                $output .= '<li id="post-' . get_the_ID() . '" class="media-listitem ' . implode(' ', get_post_class()) . '">';

                if ( has_post_thumbnail() ) {

                    $output .= '<a class="pull-left" href="' . get_permalink() . '" title="' . the_title('','',false) . '">';
                    $output .= '<div class="thumbnail">';
                    $output .= get_the_post_thumbnail( get_the_id(), 'post_thumbnail', array('class' => 'img-responsive aligncenter'));
                    $output .= '</div>';
                    $output .= '</a>';

                } else {

                }

                if ( has_post_thumbnail() ) {

                    $output .= '<div class="media-content marginlft-90">';

                } else {
                    $output .= '<div class="media-content">';
                }

                $output .= '<div class="caption">';

                $output .= '<h4 class="media-heading"><span><a href="' . get_permalink() . '" title="' . the_title('','',false) . '">' . the_title('','',false) . '</a></span></h4>';

                $output .= get_the_excerpt();
                $output .= '</div>';

                $output .= '</div>';
                $output .= '<div class="clearfix"></div>';


                $output .= '</li>';

            endwhile;global $wp_query;
            $output .= '</ul>';
            $output .= '<div class="clearfix"></div>';

            $args_pagi = array(
                'base' => add_query_arg( 'paged', '%#%' ),
                'total' => $query->max_num_pages,
                'current' => $paged
            );

            $output .= '<div class="post-nav col-md-12 ' . $pagination . '">';
            $output .= paginate_links( $args_pagi);

            //    $output .= '<div class="next-page">' . get_next_posts_link( "Older Entries »", 3 ) . '</div>';

            $output .= '</div>';

        else:

            $output .= '<p>Sorry, there are no posts to display</p>';

        endif;
        wp_reset_postdata();

        return $output;
    }
}

add_shortcode('list_recent_posts', 'list_recent_posts');

/*recent posts list end*/



/* staff list start*/
if ( ! function_exists('list_staff_posts') ) {
    function list_staff_posts( $atts ){

        $atts = shortcode_atts( array(
            'ptype' => '',
            'per_page'  =>      2,
            'order'     =>  'DESC',
            'orderby'   =>  'date',
            'category' => '',
            'class' => '',
            'pagination' => '',
        ), $atts );

        $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

        $class = $atts['class'];
        $pagination = $atts['pagination'];

        $args = array(
            'post_type'    =>  $atts["ptype"],
            'posts_per_page'    =>  $atts["per_page"],
            'order'             =>  $atts["order"],
            'orderby'           =>  $atts["orderby"],
            'paged'             =>  $paged,
            'category_name' => $atts["category"],

        );

        $query = new WP_Query($args);

        $output = '';
        $output .= '<div class="staff-flex-wrap '.$class.'">';

        if($query->have_posts()) : $output;

            while ($query->have_posts()) : $query->the_post();

                $output .= '<div id="post-' . get_the_ID() . '" class="staff-content-wrap ' . implode(' ', get_post_class()) . '">';
//start
$output .= '<a href="' . get_permalink() . '" title="' . the_title('','',false) . '">';
$output .= '<div class="staff-wrap">';


                if ( has_post_thumbnail() ) {
                    $output .= '<div class="thumbnail">';
                    $output .= get_the_post_thumbnail( get_the_id(), 'full', array('class' => 'staff-headshot'));
                    $output .= '</div>';
                } else {
                }

                $output .= '<div class="staff-overlay">';
                $output .= '<div class="staff-text">';
                $output .= get_the_excerpt();
                $output .= '<span>See More</span></div>';
                $output .= '</div>';


                $output .= '</div>';

                $output .= '<h6 class="staff-name"><span>' . the_title('','',false) . '</span></h6><p>' . get_field('member_title') . '</p><button class="staff-button">Read Bio</button>';

$output .= '</a>';
                $output .= '</div>';
//end
            endwhile;global $wp_query;
            $output .= '</div>';
            $output .= '<div class="clearfix"></div>';

            $args_pagi = array(
                'base' => add_query_arg( 'paged', '%#%' ),
                'total' => $query->max_num_pages,
                'current' => $paged
            );

            $output .= '<div class="post-nav col-md-12 ' . $pagination . '">';
            $output .= paginate_links( $args_pagi);

            //    $output .= '<div class="next-page">' . get_next_posts_link( "Older Entries »", 3 ) . '</div>';

            $output .= '</div>';

        else:

            $output .= '<p>Sorry, there are no posts to display</p>';

        endif;
        wp_reset_postdata();

        return $output;
    }
}

add_shortcode('list_staff_posts', 'list_staff_posts');

/* staff list end*/






/* custom card list start*/
if ( ! function_exists('custom_card_posts') ) {
    function custom_card_posts( $atts ){

        $atts = shortcode_atts( array(
            'ptype' => '',
            'per_page'  =>      2,
            'order'     =>  'DESC',
            'orderby'   =>  'date',
            'category' => '',
            'class' => '',
            'pagination' => '',
            'line' => '',
        ), $atts );

        $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

        $class = $atts['class'];
        $pagination = $atts['pagination'];

        $args = array(
            'post_type'    =>  $atts["ptype"],
            'posts_per_page'    =>  $atts["per_page"],
            'order'             =>  $atts["order"],
            'orderby'           =>  $atts["orderby"],
            'paged'             =>  $paged,
            'category_name' => $atts["category"],
            'tax_query'         => array( array(
            'taxonomy'  => 'card_category',
            'field'     => 'slug',
            'terms'     => array( sanitize_title( $atts['line'] ) )
        ) )
        );

        $query = new WP_Query($args);

        $output = '';
        $output .= '<div class="ccard-flex-wrap '.$class.'">';

        if($query->have_posts()) : $output;

            while ($query->have_posts()) : $query->the_post();
//start
                $output .= '<div id="post-' . get_the_ID() . '" class="ccard-content-wrap ' . implode(' ', get_post_class()) . '">';
                $output .= '<a href="' . get_permalink() . '" title="' . the_title('','',false) . '">';
                $output .= '<div class="ccard-wrap">';


                if ( has_post_thumbnail() ) {
                    $output .= '<div class="thumbnail">';
                    $output .= get_the_post_thumbnail( get_the_id(), 'full', array('class' => 'staff-headshot'));
                    $output .= '</div>';
                } else {
                }

                $output .= '<div class="ccard-overlay">';
                $output .= '<div class="ccard-text">';
                $output .= '<h6>' . the_title('','',false) . '</h6>';
                $output .= get_the_excerpt('');
                $output .= '</div>';
                $output .= '</div>';
                $output .= '<div class="more-btn"><span>See More</span></div>';



                $output .= '</div>';


$output .= '</a>';
                $output .= '</div>';
//end
            endwhile;global $wp_query;
            $output .= '</div>';
            $output .= '<div class="clearfix"></div>';

            $args_pagi = array(
                'base' => add_query_arg( 'paged', '%#%' ),
                'total' => $query->max_num_pages,
                'current' => $paged
            );

            $output .= '<div class="post-nav col-md-12 ' . $pagination . '">';
            $output .= paginate_links( $args_pagi);

            //    $output .= '<div class="next-page">' . get_next_posts_link( "Older Entries »", 3 ) . '</div>';

            $output .= '</div>';

        else:

            $output .= '<p>Sorry, there are no posts to display</p>';

        endif;
        wp_reset_postdata();

        return $output;
    }
}

add_shortcode('custom_card_posts', 'custom_card_posts');

/* custom card list end*/





/*recent posts list horizontal start*/
if ( ! function_exists('list_recent_posts_horiz') ) {
    function list_recent_posts_horiz( $atts ){

        $atts = shortcode_atts( array(
            'ptype' => '',
            'per_page'  =>      2,
            'order'     =>  'DESC',
            'orderby'   =>  'date',
            'category' => '',
            'class' => '',
            'pagination' => '',
        ), $atts );

        $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

        $class = $atts['class'];
        $pagination = $atts['pagination'];

        $args = array(
            'post_type'    =>  $atts["ptype"],
            'posts_per_page'    =>  $atts["per_page"],
            'order'             =>  $atts["order"],
            'orderby'           =>  $atts["orderby"],
            'paged'             =>  $paged,
            'category_name' => $atts["category"],
        );

        $query = new WP_Query($args);

        $output = '';
        $output .= '<ul class="rct-posts-horiz '.$class.'">';

        if($query->have_posts()) : $output;

            while ($query->have_posts()) : $query->the_post();

                $output .= '<li id="post-' . get_the_ID() . '" class="rct-post-hwrap ' . implode(' ', get_post_class()) . '">';

                if ( has_post_thumbnail() ) {

                    $output .= '<a class="float-post-img" href="' . get_permalink() . '" title="' . the_title('','',false) . '">';
                    $output .= get_the_post_thumbnail( get_the_id(), 'article_thumbnail', array('class' => 'rct-posts-img'));
                    $output .= '</a>';

                } else {

                }

                if ( has_post_thumbnail() ) {

                    $output .= '<div class="rct-post-content">';

                } else {
                    $output .= '<div class="rct-post-content no-img">';
                }

                $output .= '<p class="date">' . get_the_date() . '</p>';

                $output .= '<h4 class="media-heading"><span><a href="' . get_permalink() . '" title="' . the_title('','',false) . '">' . the_title('','',false) . '</a></span></h4>';

                $output .= get_excerpt(180);

                $output .= '</div>';
                $output .= '<div class="clearfix"></div>';


                $output .= '<div class="arrow-width">';
                $output .= '<a href="' . get_permalink() . '" class="arrow-pos">';

                $output .= '<div class="rct-post-arrow">';
                $output .= '<span class="center-arrow"><i class="fas fa-angle-right"></i></span>';
                $output .= '</div>';

                $output .= '</a>';
                $output .= '</div>';


                $output .= '</li>';

            endwhile;global $wp_query;
            $output .= '</ul>';
            $output .= '<div class="clearfix"></div>';

            $args_pagi = array(
                'base' => add_query_arg( 'paged', '%#%' ),
                'total' => $query->max_num_pages,
                'current' => $paged
            );

            $output .= '<div class="post-nav col-md-12 ' . $pagination . '">';
            $output .= paginate_links( $args_pagi);

            //    $output .= '<div class="next-page">' . get_next_posts_link( "Older Entries »", 3 ) . '</div>';

            $output .= '</div>';

        else:

            $output .= '<p>Sorry, there are no posts to display</p>';

        endif;
        wp_reset_postdata();

        return $output;
    }
}

add_shortcode('list_recent_posts_horiz', 'list_recent_posts_horiz');

/*recent posts list horizontal end*/

/*recent posts carousel start*/
if ( ! function_exists('carousel_recent_posts') ) {
    function carousel_recent_posts( $atts ){
        wp_enqueue_script( 'slick-js' );
        wp_enqueue_script( 'slick-init' );
        wp_enqueue_style( 'slick-css' );
        wp_enqueue_style( 'slick-theme' );

        $atts = shortcode_atts( array(
            'ptype' => '',
            'per_page'  =>      8,
            'order'     =>  'DESC',
            'orderby'   =>  'date',
            'category' => '',
            'class' => '',
            'column' => '',
            'pagination' => '',
        ), $atts );

        $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

        $class = $atts['class'];
        $column = $atts['column'];
        $pagination = $atts['pagination'];

        $args = array(
            'post_type'    =>  $atts["ptype"],
            'posts_per_page'    =>  $atts["per_page"],
            'order'             =>  $atts["order"],
            'orderby'           =>  $atts["orderby"],
            'paged'             =>  $paged,
            'category_name' => $atts["category"],
        );

        $query = new WP_Query($args);

        $output .= '<div class="row '.$class.'">';

        if($query->have_posts()) : $output;

            while ($query->have_posts()) : $query->the_post();

                $output .= '<div id="post-' . get_the_ID() . '" class="'.$column.' ' . implode(' ', get_post_class('colleges-card')) . '">';



                // new
                $output .= '<a href="' . get_permalink() . '" title="' . the_title('','',false) . '"><div class="colleges-card-image">';
                if ( has_post_thumbnail() ) {
                    $output .= get_the_post_thumbnail( get_the_id(), 'article_thumbnail', array('class' => 'img-responsive aligncenter'));
                } else {
                }
                $output .= '<div class="colleges-card-content">';
                $output .= '<h3 class="post-title"><span>' . the_title('','',false) . '</span></h3>';
                $output .= '<p>';
                $output .= get_the_excerpt();
                $output .= '</p><button>More</button>';
                $output .= '</div>';
                $output .= '</div></a>';
                // NEW END


                $output .= '</div>';
                // close loop

            endwhile;global $wp_query;
            $output .= '</div>';

            $args_pagi = array(
                'base' => add_query_arg( 'paged', '%#%' ),
                'total' => $query->max_num_pages,
                'current' => $paged
            );
            $output .= '<div class="clearfix"></div>';

            $output .= '<div class="post-nav col-md-12 ' . $pagination . '">';
            $output .= paginate_links( $args_pagi);

            //    $output .= '<div class="next-page">' . get_next_posts_link( "Older Entries »", 3 ) . '</div>';

            $output .= '</div>';

        else:

            $output .= '<p>Sorry, there are no posts to display</p>';

        endif;
        wp_reset_postdata();

        return $output;
    }
}

add_shortcode('carousel_recent_posts', 'carousel_recent_posts');
/*recent posts carousel end*/

/*recent posts thumb start*/
if ( ! function_exists('thumb_recent_posts') ) {
    function thumb_recent_posts( $atts ){
        wp_enqueue_style( 'masonry-css' );
        wp_enqueue_script( 'imagesLoaded-js' );
        wp_enqueue_script( 'masonry-min' );
        wp_enqueue_script( 'masonry-init' );

        $atts = shortcode_atts( array(
            'ptype' => '',
            'per_page'  =>      2,
            'order'     =>  'DESC',
            'orderby'   =>  'date',
            'category' => '',
            'class' => '',
            'column' => '',
            'pagination' => '',
        ), $atts );

        $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

        $class = $atts['class'];
        $column = $atts['column'];
        $pagination = $atts['pagination'];

        $args = array(
            'post_type'    =>  $atts["ptype"],
            'posts_per_page'    =>  $atts["per_page"],
            'order'             =>  $atts["order"],
            'orderby'           =>  $atts["orderby"],
            'paged'             =>  $paged,
            'category_name' => $atts["category"],
        );

        $query = new WP_Query($args);
        $output = '';
        $output .= '<div class="row mgrid '.$class.'">';

        if($query->have_posts()) : $output;

            while ($query->have_posts()) : $query->the_post();

                $output .= '<div id="post-' . get_the_ID() . '" class="mgrid-item '.$column.' ' . implode(' ', get_post_class()) . '">';

                $output .= '<div class="thumbnail">';



                if ( has_post_thumbnail() ) {

                    $output .= '<a href="' . get_permalink() . '" title="' . the_title('','',false) . '">';
                    $output .= get_the_post_thumbnail( get_the_id(), 'article_thumbnail', array('class' => 'img-responsive aligncenter'));
                    $output .= '</a>';

                } else {


                }

                $output .= '<div class="caption padbot-30 caption-fixedh">';

                $output .= '<h3 class="post-title"><span><a href="' . get_permalink() . '" title="' . the_title('','',false) . '">' . the_title('','',false) . '</a></span></h3>';

                $output .= get_the_excerpt();

                $output .= '<div class="clearfix"></div>';

                $output .= '</div>';

                $output .= '<div style="padding: 0 30px 30px">';
                $output .= '<a href="' . get_permalink() . '" title="' . the_title('','',false) . '">';
                $output .= 'Learn More';
                $output .= '</a>';
                $output .= '</div>';

                $output .= '</div>';
                $output .= '</div>';

            endwhile;global $wp_query;
            $output .= '</div>';

            $args_pagi = array(
                'base' => add_query_arg( 'paged', '%#%' ),
                'total' => $query->max_num_pages,
                'current' => $paged
            );
            $output .= '<div class="clearfix"></div>';

            $output .= '<div class="post-nav col-md-12 ' . $pagination . '">';
            $output .= paginate_links( $args_pagi);

            //    $output .= '<div class="next-page">' . get_next_posts_link( "Older Entries »", 3 ) . '</div>';

            $output .= '</div>';

        else:

            $output .= '<p>Sorry, there are no posts to display</p>';

        endif;
        wp_reset_postdata();

        return $output;
    }
}

add_shortcode('thumb_recent_posts', 'thumb_recent_posts');

/*recent posts thumb end*/



/*recent posts thumb fluid  start*/
if ( ! function_exists('thumb_recent_posts_fluid') ) {
    function thumb_recent_posts_fluid( $atts ){
        wp_enqueue_style( 'masonry-css' );
        wp_enqueue_script( 'imagesLoaded-js' );
        wp_enqueue_script( 'masonry-min' );
        wp_enqueue_script( 'masonry-init' );

        $atts = shortcode_atts( array(
            'ptype' => '',
            'per_page'  =>      2,
            'order'     =>  'DESC',
            'orderby'   =>  'date',
            'category' => '',
            'class' => '',
            'column' => '',
            'pagination' => '',
        ), $atts );

        $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

        $class = $atts['class'];
        $column = $atts['column'];
        $pagination = $atts['pagination'];

        $args = array(
            'post_type'    =>  $atts["ptype"],
            'posts_per_page'    =>  $atts["per_page"],
            'order'             =>  $atts["order"],
            'orderby'           =>  $atts["orderby"],
            'paged'             =>  $paged,
            'category_name' => $atts["category"],
        );

        $query = new WP_Query($args);
        $output = '';
        $output .= '<div class="row mgrid '.$class.'">';

        if($query->have_posts()) : $output;

            while ($query->have_posts()) : $query->the_post();

                $output .= '<div id="post-' . get_the_ID() . '" class="mgrid-item '.$column.' ' . implode(' ', get_post_class()) . '">';

                $output .= '<div class="thumbnail noshadow">';



                if ( has_post_thumbnail() ) {

                    $output .= '<a href="' . get_permalink() . '" title="' . the_title('','',false) . '">';
                    $output .= get_the_post_thumbnail( get_the_id(), 'article_thumbnail', array('class' => 'img-responsive aligncenter'));
                    $output .= '</a>';

                } else {


                }

                $output .= '<div class="caption padbot-30">';

                $output .= '<h3 class="post-title"><span><a href="' . get_permalink() . '" title="' . the_title('','',false) . '">' . the_title('','',false) . '</a></span></h3>';

                $output .= get_the_excerpt();

                $output .= '<div class="clearfix"></div>';

                $output .= '</div>';

                $output .= '<div style="padding: 0 30px 30px">';
                $output .= '<a class="btn btn-white rounded" href="' . get_permalink() . '" title="' . the_title('','',false) . '">';
                $output .= 'Learn More';
                $output .= '</a>';
                $output .= '</div>';

                $output .= '</div>';
                $output .= '</div>';

            endwhile;global $wp_query;
            $output .= '</div>';

            $args_pagi = array(
                'base' => add_query_arg( 'paged', '%#%' ),
                'total' => $query->max_num_pages,
                'current' => $paged
            );
            $output .= '<div class="clearfix"></div>';

            $output .= '<div class="post-nav col-md-12 ' . $pagination . '">';
            $output .= paginate_links( $args_pagi);

            //    $output .= '<div class="next-page">' . get_next_posts_link( "Older Entries »", 3 ) . '</div>';

            $output .= '</div>';

        else:

            $output .= '<p>Sorry, there are no posts to display</p>';

        endif;
        wp_reset_postdata();

        return $output;
    }
}

add_shortcode('thumb_recent_posts_fluid', 'thumb_recent_posts_fluid');

/*recent posts thumb fluid end*/


/* Recent course list Data Tables */

add_shortcode( 'datatables_recent_staff', 'datatables_recent_staff' );
function datatables_recent_staff( $atts ) {

    wp_enqueue_script( 'dataTables-min' );
    wp_enqueue_script( 'buttons-min' );
    wp_enqueue_script( 'colVis-js' );
    wp_enqueue_script( 'html5-js' );
    wp_enqueue_script( 'print-js' );
    wp_enqueue_script( 'databootstrap-js' );
    wp_enqueue_script( 'buttonsboot-js' );
    wp_enqueue_script( 'jszip-js' );
    wp_enqueue_script( 'pdfmake-js' );
    wp_enqueue_script( 'vfs_fonts-js' );
    wp_enqueue_script( 'responsive-js' );
    wp_enqueue_script( 'responsive-bootstrap' );
    wp_enqueue_script( 'materialize-js' );
    wp_enqueue_script( 'materialize-init' );
    wp_enqueue_style( 'dataTables-css' );
    wp_enqueue_style( 'dataTables-bootstrap' );
    wp_enqueue_style( 'dataTables-buttons' );
    wp_enqueue_style( 'dataTables-responsive' );
    wp_enqueue_style( 'materialize-css' );

    ob_start();
    // define attributes and their defaults
    extract( shortcode_atts( array (
        'posts' => 4,
        'category' => '',
        'ptype' => '',
        'class' => '',
        'staff_category' => '',
    ), $atts ) );


    // define query parameters based on attributes
    $options = array(
        'posts_per_page' => $posts,
        'post_type' => $ptype,
        'category_name' => $category,
        'staff_category' => $staff_category,
        'orderby'=>'title',
		'order'=>'ASC',
    );
    $query = new WP_Query( $options );
    // run the loop based on the query
    if ( $query->have_posts() ) { ?>

            <div id="dataTablesSelect" class="row">
                <div class="col-md-3">
                    <span multiple="true">Category</span>
                    <select multiple="true" id="instructorFltr">
                        <option value="" disabled>Choose your option</option>
                    </select>
                </div>

            </div>

  <table id="staffTable" class="table table-1 table-striped dt-responsive" cellspacing="0" width="100%">
    <thead>
      <tr>
        <th class="col-md-3">Name</th>
        <th class="col-md-3">Email</th>
        <th class="col-md-3">Phone</th>
        <th class="col-md-3">Category</th>
      </tr>
    </thead>
    <tbody>

<?php while ( $query->have_posts() ) : $query->the_post(); ?>

      <tr>
        <td scope="row">
            <?php if( get_field('staff_photo') ): ?>
                <?php

                $image = get_field('staff_photo');

                if( !empty($image) ): ?>
                    <a href="<?php the_permalink(); ?>">
                        <img class="stf-photo rounded" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
                    </a>

                <?php endif; ?>
            <?php endif; ?>
          <p><strong><a href="<?php the_permalink(); ?>">
            <?php the_title(); ?>
          </a></strong></p>
        </td>
        <td>
            <?php the_field( 'staff_email' ); ?>
        </td>
        <td>
          <?php the_field( 'staff_phone_number' ); ?>
        </td>
        <td>

            <?php global $post; $terms_as_text = get_the_term_list( $post->ID,'staff_category', ' ', ', '); if (!empty($terms_as_text)) echo '
            ', strip_tags($terms_as_text) ,''; ?>


        </td>
      </tr>


<?php endwhile;
            wp_reset_postdata(); ?>

    </tbody>
  </table>

<?php $myvariable = ob_get_clean();
    return $myvariable;
    }
}

/* Recent course list Data Tables end */


/* related posts */

/* [relatedposts] // This is the default (3 posts, 3 columns)
[relatedposts col=1 max=1 excerpt=false] // single post, full width, without the excerpt */

add_shortcode('relatedposts', 'fphp_get_related_posts');

function fphp_get_related_posts($atts) {
    wp_enqueue_style( 'masonry-css' );
    wp_enqueue_script( 'imagesLoaded-js' );
    wp_enqueue_script( 'masonry-min' );
    wp_enqueue_script( 'masonry-init' );

    $atts = shortcode_atts( array(
        'ptype' => '',
        'max' => '3',
        'class' => '',
        'column' => '',
        'label' => '',
    ), $atts, 'relatedposts' );

    $class = $atts['class'];
    $column = $atts['column'];
    $label = $atts['label'];

    $reset_post = $post;

    global $post;
    $post_tags = wp_get_post_tags($post->ID);

    if ($post_tags) {
        $post_tag_ids = array();
        foreach($post_tags as $post_tag) $post_tag_ids[] = $post_tag->term_id;
        $args=array(
            'tag__in' => $post_tag_ids,
            'post__not_in' => array($post->ID),
            'posts_per_page' => $atts['max'],
            'post_type'    =>  $atts["ptype"],
            'orderby' => 'rand'
        );

        $related_query = new wp_query( $args );
        if (intval($related_query->post_count) === 0) return '';

        $html = '<div class="relatedposts"><h3>'.$label.'</h3>';

        $html .= '<div class="row mgrid '.$class.'">';

        while( $related_query->have_posts() ) {
            $related_query->the_post();
            $html .= '<div id="post-' . get_the_ID() . '" class="mgrid-item '.$column.' ' . implode(' ', get_post_class()) . '">';

            $html .= '<div class="thumbnail">';

            if ( has_post_thumbnail() ) {

                $html .= '<a href="' . get_permalink() . '" title="' . the_title('','',false) . '">';
                $html .= get_the_post_thumbnail( get_the_id(), 'article_thumbnail', array('class' => 'img-responsive aligncenter'));
                $html .= '</a>';

            } else {


            }

            $html .= '<div class="caption caption-fixedh">';

            $html .= '<h3 class="post-title"><span><a href="' . get_permalink() . '" title="' . the_title('','',false) . '">' . the_title('','',false) . '</a></span></h3>';

            $html .= get_the_excerpt();

            $html .= '</div>';
            $html .= '<div class="clearfix"></div>';



            $html .= '</div>';
            $html .= '</div>';
        }
    }
    $post = $reset_post;
    wp_reset_query();

    $html .= '</div>';

    return $html;

}
