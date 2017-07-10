<?
require_once get_template_directory() . '/helpers/class-tgm-plugin-activation.php';
/**************************************************** Show plugins for required install *********************************************************************/
add_action( 'tgmpa_register', 'colombo_register_required_plugins' );
function colombo_register_required_plugins() {

  $plugins = array(
    array(
  			'name'      => 'Woocommerce',
  			'slug'      => 'woocommerce',
  			'required'  => false,
  		),
  );

  $config = array(
		'id'           => 'colombo',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.

		/*
		'strings'      => array(
			'page_title'                      => __( 'Install Required Plugins', 'colombo' ),
			'menu_title'                      => __( 'Install Plugins', 'colombo' ),
			/* translators: %s: plugin name. * /
			'installing'                      => __( 'Installing Plugin: %s', 'colombo' ),
			/* translators: %s: plugin name. * /
			'updating'                        => __( 'Updating Plugin: %s', 'colombo' ),
			'oops'                            => __( 'Something went wrong with the plugin API.', 'colombo' ),
			'notice_can_install_required'     => _n_noop(
				/* translators: 1: plugin name(s). * /
				'This theme requires the following plugin: %1$s.',
				'This theme requires the following plugins: %1$s.',
				'colombo'
			),
			'notice_can_install_recommended'  => _n_noop(
				/* translators: 1: plugin name(s). * /
				'This theme recommends the following plugin: %1$s.',
				'This theme recommends the following plugins: %1$s.',
				'colombo'
			),
			'notice_ask_to_update'            => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
				'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
				'colombo'
			),
			'notice_ask_to_update_maybe'      => _n_noop(
				/* translators: 1: plugin name(s). * /
				'There is an update available for: %1$s.',
				'There are updates available for the following plugins: %1$s.',
				'colombo'
			),
			'notice_can_activate_required'    => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following required plugin is currently inactive: %1$s.',
				'The following required plugins are currently inactive: %1$s.',
				'colombo'
			),
			'notice_can_activate_recommended' => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following recommended plugin is currently inactive: %1$s.',
				'The following recommended plugins are currently inactive: %1$s.',
				'colombo'
			),
			'install_link'                    => _n_noop(
				'Begin installing plugin',
				'Begin installing plugins',
				'colombo'
			),
			'update_link' 					  => _n_noop(
				'Begin updating plugin',
				'Begin updating plugins',
				'colombo'
			),
			'activate_link'                   => _n_noop(
				'Begin activating plugin',
				'Begin activating plugins',
				'colombo'
			),
			'return'                          => __( 'Return to Required Plugins Installer', 'colombo' ),
			'plugin_activated'                => __( 'Plugin activated successfully.', 'colombo' ),
			'activated_successfully'          => __( 'The following plugin was activated successfully:', 'colombo' ),
			/* translators: 1: plugin name. * /
			'plugin_already_active'           => __( 'No action taken. Plugin %1$s was already active.', 'colombo' ),
			/* translators: 1: plugin name. * /
			'plugin_needs_higher_version'     => __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'colombo' ),
			/* translators: 1: dashboard link. * /
			'complete'                        => __( 'All plugins installed and activated successfully. %1$s', 'colombo' ),
			'dismiss'                         => __( 'Dismiss this notice', 'colombo' ),
			'notice_cannot_install_activate'  => __( 'There are one or more required or recommended plugins to install, update or activate.', 'colombo' ),
			'contact_admin'                   => __( 'Please contact the administrator of this site for help.', 'colombo' ),

			'nag_type'                        => '', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
		),
		*/
	);

    tgmpa( $plugins, $config );
}
/************************************************** Register menus **************************************************************************/
function register_menus() {
  register_nav_menus(
    array(
      'main-menu' => __( 'Меню' ),
    )
  );
}
add_action( 'init', 'register_menus' );

/************************************************** Setup theme **************************************************************************/
add_action( 'after_setup_theme', 'my_theme_setup' );
function my_theme_setup(){
    $res = load_theme_textdomain('machete');
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'custom-logo' );
    add_theme_support( 'woocommerce' );
    add_theme_support( 'html5', array( 'gallery', 'caption' ) );
    // set_post_thumbnail_size( 825, 510, true );
}

/**************************************************** Register scripts and styles *********************************************************************/
function wpdocs_theme_name_scripts() {
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'google-maps', '//maps.google.com/maps/api/js?sensor=false&amp;language=en', array(), '1.0.0', true );
    wp_enqueue_script( 'vendor', get_template_directory_uri() . '/js/vendor.js', array(), '1.0.0', true );
    wp_enqueue_script( 'mousewheel', get_template_directory_uri() . '/js/fancybox/lib/jquery.mousewheel-3.0.6.pack.js', array(), '1.0.0', true );
    wp_enqueue_script( 'fancybox-pack', get_template_directory_uri() . '/js/fancybox/source/jquery.fancybox.pack.js', array(), '2.1.5', true );
    wp_enqueue_script( 'fancybox-buttons', get_template_directory_uri() . '/js/fancybox/source/helpers/jquery.fancybox-buttons.js', array(), '1.0.5', true );
    wp_enqueue_script( 'fancybox-media', get_template_directory_uri() . '/js/fancybox/source/helpers/jquery.fancybox-media.js', array(), '1.0.6', true );
    wp_enqueue_script( 'fancybox-thumbs', get_template_directory_uri() . '/js/fancybox/source/helpers/jquery.fancybox-thumbs.js', array(), '1.0.7', true );
    wp_enqueue_script( 'main', get_template_directory_uri() . '/js/main.js', array(), '1.0.0', true );

    wp_enqueue_style( 'bootstrap', '//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css');
    wp_enqueue_style('reset', get_template_directory_uri() . '/css/reset.css');
    wp_enqueue_style('vendor', get_template_directory_uri() . '/css/vendor.css');
    wp_enqueue_style('style', get_template_directory_uri() . '/css/style.css');

}
add_action( 'wp_enqueue_scripts', 'wpdocs_theme_name_scripts' );

/**
 * Insert the img tag for logo in header.
 */

function colombo_get_logo() {
  $custom_logo_id = get_theme_mod( 'custom_logo' );
  $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
  echo "<img src=".$logo[0]." alt=".get_bloginfo('name')." />";
}

add_action( 'colombo_get_logo', 'colombo_get_logo', 10 );
