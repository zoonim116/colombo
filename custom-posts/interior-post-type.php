<?

function create_interior_post_type() {

	register_post_type( 'interior',
	// CPT Options
		array(
			'labels' => array(
				'name' => __( 'Интерьеры' ),
				'singular_name' => __( 'Интерьер' )
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'interior'),
      'query_var' => true,
      'supports' => array('title', 'editor', 'thumbnail'),
      'menu_icon' => 'dashicons-images-alt',
		)
	);

  register_taxonomy(
		'collection',
		'interior',
    // Taxonomy Options
		array(
			'label' => __('Коллекция'),
			'rewrite' => array('slug' => 'collection'),
			'hierarchical' => true,
      'query_var' => true,
      'public' => true,
      'has_archive' => true,
		)
	);
}
add_action( 'init', 'create_interior_post_type' );
