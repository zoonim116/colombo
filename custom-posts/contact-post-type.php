<?

function create_contact_post_type() {

	register_post_type( 'region_contacts',
	// CPT Options
		array(
			'labels' => array(
				'name' => __( 'Региональные контакты' ),
				'singular_name' => __( 'Региональный контакт' )
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'contacts'),
      'query_var' => true,
      'supports' => array('title', 'editor'),
      'menu_icon' => 'dashicons-groups',
		)
	);

  register_taxonomy(
		'clm_countries',
		'region_contacts',
    // Taxonomy Options
		array(
			'label' => __('Страны', 'Colombo'),
			'rewrite' => array('slug' => 'countries'),
			'hierarchical' => true,
      'query_var' => true,
      'public' => true,
      'has_archive' => true,
		)
	);
}
add_action( 'init', 'create_contact_post_type' );
