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
      'main-menu' => __( 'Главное меню' ),
      'series-menu' => __( 'Меню серий' ),
      'categories-menu' => __( 'Меню категорий' ),
      'pages-menu' => __( 'Меню разделов сайта' )
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
    /********* fancybox  *******/
    wp_enqueue_style('fancybox-css', get_template_directory_uri() . '/js/fancybox/source/jquery.fancybox.css');
    wp_enqueue_style('fancybox-buttons-css', get_template_directory_uri() . '/js/fancybox/source/helpers/jquery.fancybox-buttons.css');
    wp_enqueue_style('fancybox-thumbs-css', get_template_directory_uri() . '/js/fancybox/source/helpers/jquery.fancybox-thumbs.css');

    wp_enqueue_style('reset', get_template_directory_uri() . '/css/reset.css');
    wp_enqueue_style('vendor', get_template_directory_uri() . '/css/vendor.css');
    wp_enqueue_style('style', get_template_directory_uri() . '/css/style.css');


}
add_action( 'wp_enqueue_scripts', 'wpdocs_theme_name_scripts' );


/**
 * Insert the img tag for logo in header.
 */

function colombo_get_logo() { ?>
  <svg version="1.1" id="Слой_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 362.2 89.1" style="enable-background:new 0 0 362.2 89.1;" xml:space="preserve">
						<style type="text/css">
							.st0{fill:#5a1644;}
						</style>
						<g>
							<path class="st0" d="M142.4,47.5c-7.3,0-13.4,2.5-18.5,7.4c-5.1,5-7.6,11-7.6,18c0,6.3,1.8,11.6,5.2,16.1h20.9
								c-4.4,0-7.9-1.4-10.6-4.3c-2.6-2.8-3.9-6.7-3.9-11.6c0-4.6,1.3-8.3,4-11.2c2.7-2.9,6.2-4.3,10.5-4.3c4.4,0,7.9,1.4,10.6,4.3
								c2.6,2.8,4,6.6,4,11.4c0,4.8-1.3,8.6-4,11.4c-2.6,2.9-6.2,4.3-10.6,4.3h20.9c3.4-4.4,5.2-9.7,5.2-15.7c0-7.3-2.5-13.4-7.5-18.4
								C155.9,50,149.7,47.5,142.4,47.5 M101,89.1h11.3V36.2H101V89.1z M70.7,47.5c-7.3,0-13.4,2.5-18.5,7.4c-5.1,5-7.6,11-7.6,18
								c0,6.3,1.8,11.6,5.2,16.1h20.9c-4.4,0-7.9-1.4-10.6-4.3c-2.6-2.8-3.9-6.7-3.9-11.6c0-4.6,1.3-8.3,4-11.2c2.7-2.9,6.2-4.3,10.5-4.3
								c4.4,0,7.9,1.4,10.6,4.3c2.6,2.8,4,6.6,4,11.4c0,4.8-1.3,8.6-4,11.4c-2.6,2.9-6.2,4.3-10.6,4.3h20.9c3.4-4.4,5.2-9.7,5.2-15.7
								c0-7.3-2.5-13.4-7.5-18.4C84.1,50,78,47.5,70.7,47.5 M223,47.5c-6.1,0-10.9,2.4-14.4,7.2c-3.2-4.8-7.6-7.2-13.1-7.2
								c-2.5,0-4.5,0.4-6.2,1.3c-1.5,0.8-3.4,2.3-5.6,4.6v-5.8h-11.3v41.5h11.3V72.5c0-5.1,0.7-8.9,2.2-11.3c1.5-2.4,3.8-3.6,7-3.6
								c5,0,7.5,4.4,7.5,13.1v18.3h11.3V72.5c0-5.2,0.7-9,2.1-11.3c1.4-2.3,3.7-3.5,6.8-3.5c2.7,0,4.6,1,5.8,3c1.1,1.9,1.7,5.3,1.7,9.9
								v18.5h11.4V67.5C239.6,54.2,234.1,47.5,223,47.5 M7.7,55.2C2.6,60.2,0,66.3,0,73.6c0,6,1.7,11.1,5.1,15.5h20.2
								c-3.9-0.2-7.2-1.6-9.7-4.3c-2.7-2.9-4.1-6.7-4.1-11.3c0-4.5,1.4-8.2,4.2-11.2c2.8-3,6.3-4.5,10.6-4.5c2.7,0,5.1,0.6,7.1,1.8
								c2,1.2,4.3,3.3,6.9,6.5v-15c-4.3-2.3-8.8-3.5-13.6-3.5C19.2,47.6,12.9,50.2,7.7,55.2 M342,55c-5.1-5-11.3-7.5-18.6-7.5
								c-7.3,0-13.4,2.5-18.5,7.4c-5,5-7.6,11-7.6,18c0,6.3,1.8,11.6,5.2,16.1h20.9c-4.4,0-7.9-1.4-10.6-4.3c-2.6-2.8-3.9-6.7-3.9-11.6
								c0-4.6,1.3-8.3,4-11.2c2.7-2.9,6.2-4.3,10.5-4.3c4.4,0,7.9,1.4,10.6,4.3c2.7,2.8,4,6.6,4,11.4c0,4.8-1.3,8.6-4,11.4
								c-2.6,2.9-6.2,4.3-10.6,4.3h20.9c3.4-4.4,5.2-9.7,5.2-15.7C349.5,66.1,347,59.9,342,55 M33,87.3c-1.8,1-3.9,1.6-6.2,1.7h13.5v-8.6
								C37.5,83.9,35,86.1,33,87.3 M270.5,47.5c-5.7,0-10.8,2.3-15.4,7V36.2h-11.3v52.8h24.5c-4.2,0-7.5-1.5-10-4.4
								c-2.6-2.8-3.8-6.6-3.8-11.4c0-4.6,1.3-8.4,3.9-11.2c2.6-2.9,6-4.4,10.1-4.4c3.9,0,7.1,1.5,9.7,4.5c2.5,3,3.8,6.8,3.8,11.5
								c0,4.4-1.3,8.1-3.9,11c-2.6,2.9-5.8,4.4-9.7,4.4h20.7c3-4.4,4.5-9.7,4.5-15.9c0-7.3-2.2-13.4-6.6-18.3
								C282.6,49.9,277.1,47.5,270.5,47.5"/>
							<path class="st0" d="M356.8,17.1c-0.4-3.9-10.2-8.1-20.8-2c-2.3,1.4-3.6,2.2-4.7,2.9c1.2-1.8,2.2-3.5,3.1-5c0.2-0.3,0.4-0.6,0.6-1
								c0.3-0.5,0.5-1,0.7-1.5c0.1-0.1,0.1-0.3,0.2-0.4c0,0-0.1,0.1-0.1,0.1c1.5-5.5-2.8-12.9-14.6-9.1c-32.6,10.4-57.5,12.6-96.9,5.9
								c-3.6-0.6,5.9,10.9,14.8,12.9c10.8,2.4,51.3-6,80.2-13.7c10.7-2.8,8.9,7.5,6.3,12.5c-0.9,1.7-1.8,3.3-3,5.2l0,0
								c-0.3,0.5-0.6,1-1,1.6c-2.7,4.3-10.5,16-17.8,21.1c6.5-4,13.8-10.4,21.5-18.4c0.9-1,5.4-4.7,6.8-6c4.2-3.6,12.3-7.2,16.8-3.2
								c-8.1,4-12.9,13.5-9.8,25.8c0.9-12.4,5.9-22.6,23.1-23.8C362.2,20.9,360.6,17.7,356.8,17.1"/>
						</g>
					</svg>
<? }

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

/**
 * Insert the h1 tag title on series page.
 */

function colombo_get_page_title() {
  $title = get_field('page_header');
  if(!$title) {
    $title = get_the_title();
  }
  echo "<h1 class=\"page-title\">". $title ."</h1>";
}

add_action('colombo_get_page_title', 'colombo_get_page_title', 10);

function colombo_show_series() {
  $terms = get_terms( array(
    'taxonomy' => 'pa_seriya',
    'hide_empty' => false,
  ));
  foreach ($terms as $term) {
      $img = get_wp_term_image($term->term_id); ?>
      <div class="colum-1-4">
				<div class="series">
					<a href="#">
						<img src="<?= $img;?>" alt="<?= $term->name; ?>" title="<?= $term->name; ?>">
						<span class="series-name"><?= $term->name; ?></span>
					</a>
				</div>
			</div>
  <? }
}

add_action('colombo_show_series', 'colombo_show_series', 10);

function colombo_get_collections_list() {
  $taxonomies = get_terms([
      'taxonomy' => 'collection',
      'hide_empty' => false
    ]);
  if ($taxonomies) : ?>
      <ul class="filters-list hide">
          <li><a data-class="all" class="selected" href="#"><?= __('Все интерьеры'); ?></a></li>
          <? foreach ($taxonomies as $taxonomy) : ?>
                <li><a data-class="<?= $taxonomy->slug; ?>" href="#"><?= $taxonomy->name; ?></a></li>
          <? endforeach; ?>
      </ul>
  <? else: ?>
    <p> Серии не найдены</p>
  <? endif; ?>
<? }

add_action('colombo_get_collections_list', 'colombo_get_collections_list', 10);


function colombo_get_series_thumb() {
  $the_query = new WP_Query(array(
      'post_type' => 'interior',
      'posts_per_page' => -1
    ));

    if ($the_query->have_posts()) { ?>
      <ul class="colums">
    <?   while ($the_query->have_posts()) {
        $the_query->the_post();
        $collecton =  get_the_terms($post->ID, 'collection')[0];?>
        <? var_dump(); ?>
          <li class="interior-foto <?= $collecton->slug; ?> colum-1-4">
            <a href="#" data-desc="<?= strip_tags(get_the_content()); ?>" title="<? the_title(); ?>"><? the_post_thumbnail(); ?></a>
        </li>
      <?  } ?>
      </ul>
    <? }
}

add_action('colombo_get_series_thumb', 'colombo_get_series_thumb', 10);
