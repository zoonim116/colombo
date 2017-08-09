<?

function create_dealer_post_type() {

	register_post_type( 'dealer',
	// CPT Options
		array(
			'labels' => array(
				'name' => __( 'Диллеры' ),
				'singular_name' => __( 'Диллер' ),
				'add_new' => __('Добавить диллера'),
				'add_new_item' => __('Добавить диллера')
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'dealer'),
      'query_var' => true,
      'supports' => array('title', 'editor'),
      'menu_icon' => 'dashicons-networking',
		)
	);

  register_taxonomy(
		'deal_ukraine',
		'dealer',
    // Taxonomy Options
		array(
			'label' => __('Украина', 'Colombo'),
			'rewrite' => array('slug' => 'ukraine'),
			'hierarchical' => true,
      'query_var' => true,
      'public' => true,
      'has_archive' => true,
		)
	);

  register_taxonomy(
    'deal_other_countries',
    'dealer',
    // Taxonomy Options
    array(
      'label' => __('Другие', 'Colombo'),
      'rewrite' => array('slug' => 'other_countries'),
      'hierarchical' => true,
      'query_var' => true,
      'public' => true,
      'has_archive' => true,
    )
  );

}
add_action( 'init', 'create_dealer_post_type' );
