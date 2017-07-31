<?
function create_video_post_type() {

	register_post_type( 'clm_video',
	// CPT Options
		array(
			'labels' => array(
				'name' => __( 'Видео' ),
				'singular_name' => __( 'Видео' )
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'video'),
      'query_var' => true,
      'supports' => array( 'title', 'editor'),
      'menu_icon' => 'dashicons-format-video',
		)
	);
}

add_action( 'init', 'create_video_post_type' );
