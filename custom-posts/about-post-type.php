<?

function create_about_post_type() {

	register_post_type( 'about',
	// CPT Options
		array(
			'labels' => array(
				'name' => __( 'О компании' ),
				'singular_name' => __( 'О компании' )
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'interior'),
      'query_var' => true,
      'supports' => array('title', 'editor', 'thumbnail'),
      'menu_icon' => 'dashicons-screenoptions',
		)
	);
}
add_action( 'init', 'create_about_post_type' );
