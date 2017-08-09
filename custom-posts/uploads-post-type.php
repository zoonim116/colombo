<?
function create_uploads_post_type() {

	register_post_type( 'uploads',
	// CPT Options
		array(
			'labels' => array(
				'name' => __( 'Файлы' ),
				'singular_name' => __( 'Файлы' )
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'pdf'),
      'query_var' => true,
      'supports' => array( 'title', 'editor'),
      'menu_icon' => 'dashicons-paperclip',
		)
	);
}

add_action( 'init', 'create_uploads_post_type' );
