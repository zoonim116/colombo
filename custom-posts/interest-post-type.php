<?

function create_inteest_post_type() {

	register_post_type( 'interest',
	// CPT Options
		array(
			'labels' => array(
				'name' => __( 'Интересно узнать' ),
				'singular_name' => __( 'Интересно узнать' )
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'interesting'),
      'query_var' => true,
      'supports' => array('title', 'editor', 'thumbnail'),
      'menu_icon' => 'dashicons-welcome-learn-more',
		)
	);
}
add_action( 'init', 'create_inteest_post_type' );
