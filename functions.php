<?
require_once get_template_directory() . '/helpers/class-tgm-plugin-activation.php';
require_once get_template_directory() . '/helpers/required_plugins.php';
require_once get_template_directory() . '/helpers/colombo_nav_walker.php';
require_once get_template_directory() . '/helpers/theme_utils.php';
require_once get_template_directory() . '/helpers/cpt.php';

/************************************************** Register menus **************************************************************************/
function register_menus() {
  register_nav_menus(
    array(
      'main-menu' => __( 'Header menu' ),
    )
  );
}
add_action( 'init', 'register_menus' );

/************************************************** Setup theme **************************************************************************/
add_action( 'after_setup_theme', 'my_theme_setup' );
function my_theme_setup(){
    $res = load_theme_textdomain('Colombo');
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
    wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array(), '1.0.0', true );
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

/**
* Insert last 3 news to homepage
* @param  int $cntNews count of news to display
*/

function colombo_get_last_news_on_homepage($cntNews) {
  $the_query = new WP_Query(array(
      'post_type' => 'news',
      'posts_per_page' => $cntNews
    ));

    if ($the_query->have_posts()) {
      while ($the_query->have_posts()) {
        $the_query->the_post(); ?>
        <article class="colum-1-3">
          <div class="post-content">
            <p class="post-date"> <?= get_the_date('d.m.Y'); ?></p>
            <h3 class="post-title">
              <a href="<? the_permalink(); ?>"><? the_title(); ?></a>
            </h3>
          </div>
          <div class="post-image">
            <a href="<? the_permalink(); ?>">
              <? the_post_thumbnail(); ?>
            </a>
          </div>
        </article>
    <?  }
    }
}

add_action( 'colombo_get_last_news_on_homepage', 'colombo_get_last_news_on_homepage', 10, 1 );
