<?
// Our custom post type function
function create_posttype() {

	register_post_type( 'news',
	// CPT Options
		array(
			'labels' => array(
				'name' => __( 'Новости' ),
				'singular_name' => __( 'Новость' )
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'news'),
      'query_var' => true,
      'supports' => array( 'title', 'editor', 'thumbnail'),
      'menu_icon'           => 'dashicons-list-view',
		)
	);
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype' );
