<?php
/**
 * Taxonomy Posts List
 */
function unc_taxonomy_list( $atts ) {
	$a = shortcode_atts( array(
		'taxonomy' => '',
		'post-type' => 'post',
		'type' => 'list',
		'title' => '',
	), $atts );
	$filter_text = '';
	// Make sure the taxonomy field is valid and it exists
	if( $a['taxonomy'] !== '' && taxonomy_exists( $a['taxonomy'] ) ) {
		$taxonomy = get_taxonomy( $a['taxonomy'] );
		$tax_url = get_post_type_archive_link( $a['post-type'] ) . '?' . $taxonomy->name . '=';
		$taxonomy_name = ucfirst( $taxonomy->labels->name );

		if( $a['type'] == 'list' ) {

			$filter_text .= '<div class="taxonomy-list taxonomy-' . $taxonomy->name . '">';
			if( $a['title'] !== '' ) {
				$filter_text .= '<h3 class="info-head">' . $a['title'] . '</h3>';
			} else {
				$filter_text .= '<h3 class="info-head">Search By ' . $taxonomy->labels->singular_name . '</h3>';
			}
			$filter_text .= '<ul>';

			$args = array(
				'orderby' => 'name',
				'order' => 'ASC',
			);
			$terms = get_terms( $taxonomy->name, $args );
			foreach( $terms as $term ) {
				$filter_text .= '<li><a href="' . get_term_link( $term, $taxonomy->name ) . '" title="' . $term->name . '">' . $term->name . '</a></li>';
			}

			$filter_text .= '</ul></div>';

		} elseif( $a['type'] == 'dropdown' ) {

			$filter_text .= '<div class="taxonomy-list taxonomy-' . $taxonomy->name . '"><form name="type_jump">';
			if( $a['title'] !== '' ) {
				$filter_text .= '<h3 class="info-head">' . $a['title'] . '</h3>';
			} else {
				$filter_text .= '<h3 class="info-head">Search By ' . $taxonomy->labels->singular_name . '</h3>';
			}
			$filter_text .= '<select class="input-block-level select" name="' . $taxonomy->name . '" OnChange="window.location=this.options[this.selectedIndex].value;">';

			$args = array(
				'orderby' => 'name',
				'order' => 'ASC',
			);

			$filter_text .= '<option value="">Select A ' . $taxonomy->labels->singular_name . '</option>';

			$terms = get_terms( $taxonomy->name, $args );
			foreach( $terms as $term ) {
				$filter_text .= '<option value="' . $tax_url . $term->slug . '">' . $term->name . '</option>';
			}

			$filter_text .= '</select></form></div>';

		}
	}
	return $filter_text;
}
add_shortcode( 'unc_taxonomy_list', 'unc_taxonomy_list' );

// hierarchical list

// First we create a function
function list_terms_custom_taxonomy( $atts ) {
	ob_start();
// Inside the function we extract custom taxonomy parameter of our shortcode

	extract( shortcode_atts( array(
		'custom_taxonomy' => '',
	), $atts ) );

// arguments for function wp_list_categories
	$args = array(
		'taxonomy' => $custom_taxonomy,
		'title_li' => ''
	);

// We wrap it in unordered list
	echo '<ul class="hierarch-list">';
	echo wp_list_categories($args);
	echo '</ul>';

	$myvariable = ob_get_clean();
	return $myvariable;
}

// Add a shortcode that executes our function
add_shortcode( 'ct_terms', 'list_terms_custom_taxonomy' );

//Allow Text widgets to execute shortcodes

add_filter('widget_text', 'do_shortcode');