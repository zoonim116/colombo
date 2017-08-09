<?
require_once get_template_directory() . '/helpers/class-tgm-plugin-activation.php';
require_once get_template_directory() . '/helpers/required_plugins.php';
require_once get_template_directory() . '/helpers/colombo_nav_walker.php';
require_once get_template_directory() . '/helpers/theme_utils.php';
require_once get_template_directory() . '/helpers/cpt.php';
require_once get_template_directory() . '/helpers/dealers-import.php';
require_once get_template_directory() . '/helpers/dealers.php';

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
    // wp_enqueue_script( 'google-maps', '//maps.google.com/maps/api/js?sensor=false&amp;language=en', array(), '1.0.0', true );
    wp_enqueue_script( 'vendor', get_template_directory_uri() . '/js/vendor.js', array(), '1.0.0', true );

    wp_enqueue_script( 'jquery-latest', 'https://code.jquery.com/jquery-latest.min.js', array(), '1.0.0', true );
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
							.st01{fill:#5a1644;}
						</style>
						<g>
							<path class="st01" d="M142.4,47.5c-7.3,0-13.4,2.5-18.5,7.4c-5.1,5-7.6,11-7.6,18c0,6.3,1.8,11.6,5.2,16.1h20.9
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
							<path class="st01" d="M356.8,17.1c-0.4-3.9-10.2-8.1-20.8-2c-2.3,1.4-3.6,2.2-4.7,2.9c1.2-1.8,2.2-3.5,3.1-5c0.2-0.3,0.4-0.6,0.6-1
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


/**
 * Show series thummb list on series pages.
 */
function colombo_show_series() {
  $terms = get_terms( array(
    'taxonomy' => 'pa_seriya',
    'hide_empty' => false,
  ));
  foreach ($terms as $term) {
      $img = get_wp_term_image($term->term_id); ?>
      <div class="colum-1-4">
				<div class="series">
					<a href="<?= get_permalink(98).$term->slug; ?>">
						<img src="<?= $img;?>" alt="<?= $term->name; ?>" title="<?= $term->name; ?>">
						<span class="series-name"><?= $term->name; ?></span>
					</a>
				</div>
			</div>
  <? }
}

add_action('colombo_show_series', 'colombo_show_series', 10);


/**
 * Show select with series collections.
 */
function colombo_get_collections_list() {
  $taxonomies = get_terms([
      'taxonomy' => 'collection',
      'hide_empty' => false
    ]);
  if ($taxonomies) : ?>
      <ul class="filters-list hide">
          <li><a data-class="all" class="selected" href="#"><?= __('Все интерьеры', 'Colombo'); ?></a></li>
          <? foreach ($taxonomies as $taxonomy) : ?>
                <li><a data-class="<?= $taxonomy->slug; ?>" href="#"><?= $taxonomy->name; ?></a></li>
          <? endforeach; ?>
      </ul>
  <? else: ?>
    <p> <?= __('Серии не найдены', 'Colombo'); ?></p>
  <? endif; ?>
<? }

add_action('colombo_get_collections_list', 'colombo_get_collections_list', 10);


/**
 * Show the series thumb .
 */

function colombo_get_series_thumb() {
  $the_query = new WP_Query(array(
      'post_type' => 'interior',
      'posts_per_page' => -1
    ));

    if ($the_query->have_posts()) { ?>
      <ul class="colums">
    <?   while ($the_query->have_posts()) {
        $the_query->the_post();
        $redirect_url = '';
        if(get_field('url_for_redirect')) {
          if(qtranxf_getLanguage() == 'ua') {
            $redirect_url = get_field('url_for_redirect');
          } else {
            $redirect_url = '/'. qtranxf_getLanguage() . get_field('url_for_redirect');
          }
        }
        $collecton =  get_the_terms($post->ID, 'collection')[0];?>
          <li class="interior-foto <?= $collecton->slug; ?> colum-1-4">
            <a href="#" data-url="<?= $redirect_url; ?>" data-desc="<?= strip_tags(get_the_content()); ?>" title="<? the_title(); ?>"><? the_post_thumbnail(); ?></a>
        </li>
      <?  } ?>
      </ul>
    <? } else { ?>
        <p> <?= __('Серии не найдены', 'Colombo'); ?></p>
  <?  }
}

add_action('colombo_get_series_thumb', 'colombo_get_series_thumb', 10);

/**
 * Show the list of news on news page .
 */

function colombo_show_news_thumbs () {
  if (isset($_GET['view_all']) &&  $_GET['view_all'] == 1) {
    $newsCount = -1;
  } else {
    $newsCount = get_option('posts_per_page');
  }
  $the_query = new WP_Query(array(
      'post_type' => 'news',
      'posts_per_page' => $newsCount
    ));

    if ($the_query->have_posts()) {
      while ($the_query->have_posts()) {
        $the_query->the_post(); ?>
          <div class="colum-1-1">
            <article class="colums">
              <div class="post-image colum-1-3">
                <a href="<? the_permalink(); ?>">
                  <? the_post_thumbnail(); ?>
                </a>
              </div>
              <div class="post-content colum-2-3">
                <p class="post-date"><?= get_the_date('d.m.Y'); ?></p>
                <h3 class="post-title">
                  <a href="<? the_permalink(); ?>"><? the_title(); ?></a>
                </h3>
                <div class="post-description"><? the_content(''); ?></div>
                <a href="<? the_permalink(); ?>" class="read-more"><?= __('подробнее'); ?></a>
              </div>
            </article>
          </div>
      <? }
    }
}

add_action('colombo_show_news_thumbs', 'colombo_show_news_thumbs', 10);

/**
 * Show the list of interests on interesting page .
 */

function colombo_get_interest_lists () {
  $the_query = new WP_Query(array(
      'post_type' => 'interest',
      'posts_per_page' => -1
    ));

    if ($the_query->have_posts()) {
      while ($the_query->have_posts()) {
        $the_query->the_post(); ?>
          <div class="colum-1-3">
            <article>
              <div class="interesting-image">
                <a href="<? the_permalink(); ?>">
                  <? the_post_thumbnail(); ?>
                </a>
              </div>
              <div class="interesting-content">
                <h3> <a href="<? the_permalink(); ?>"><? the_title(); ?></a> </h3>
              </div>
            </article>
          </div>
      <? }
    }
}

add_action('colombo_get_interest_lists', 'colombo_get_interest_lists', 10);

/**
 * Display show all link on news page
 */

function colombo_show_show_all_link() {
  global $wp_query;
  if ((!isset($_GET['view_all']) || $_GET['view_all'] !== 1) && $wp_query->max_num_pages > 1) { ?>
    <p class="show-all">
      <a href="?view_all=1"><?= __('Показать все'); ?></a>
    </p>
 <? }
}

add_action('colombo_show_show_all_link', 'colombo_show_show_all_link', 10);


function colombo_show_new_pagination() {
  global $wp_query;
  $big = 999999999; // need an unlikely integer
  if( get_option('permalink_structure') ) {
    $format = '&paged=%#%';
  } else {
    $format = 'page/%#%/';
  }
  $pages = paginate_links(array(
    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
    'format' => $format,
    'type' => 'array',
    'current' => max( 1, get_query_var('paged') ),
    'prev_text' => '<i class="fa fa-angle-left"></i>',
    'next_text' => '<i class="fa fa-angle-right"></i>',
    'total' => $wp_query->max_num_pages
  ));

  ?>
  <ul class="pagination-list">
    <? if($pages) {
        foreach ($pages as $page) { ?>
      <li>
        <?= $page; ?>
      </li>
      <?  }
      } ?>
  </ul>
<?}

add_action('colombo_show_new_pagination', 'colombo_show_new_pagination', 10);

function colombo_related_latest_news() {
  global $post;
  $the_query = new WP_Query(array(
      'post_type' => 'news',
      'post__not_in' => [$post->ID],
      'posts_per_page' => 3
    ));

    if ($the_query->have_posts()) { ?>
      <div class="news-novelties colums">
    <?  while ($the_query->have_posts()) {
        $the_query->the_post(); ?>

    <div class="colum-1-3">
      <article>
        <div class="post-image">
          <a href="<? the_permalink(); ?>">
              <? the_post_thumbnail(); ?>
          </a>
        </div>
        <div class="post-content">
          <p class="post-date"><?= get_the_date('d.m.Y'); ?></p>
          <h3 class="post-title">
            <a href="<? the_permalink(); ?>"><? the_title(); ?></a>
          </h3>
          <div class="post-description"><? the_content(''); ?></div>
          <a href="<? the_permalink(); ?>" class="read-more"><?= __('подробнее'); ?></a>
        </div>
      </article>
    </div>

<? } ?>
    </div>
<?  }
}


add_action('colombo_related_latest_news', 'colombo_related_latest_news', 10);

function colombo_customize_register( $wp_customize ) {
   //All our sections, settings, and controls will be added here
   $wp_customize->add_section( 'mytheme_new_section_name' , array(
      'title'      => __( 'Заголовки страниц'),
      'priority'   => 10,
    ));
    $wp_customize->add_setting('news_page_title', array(
     'default'        => 'Новости и новинки от Colombo',
     ));

     $wp_customize->add_setting('interest_page_title', array(
      'default'        => 'О компании Colombo',
      ));

    $wp_customize->add_control( new WP_Customize_Control(
    	$wp_customize,
    	'news_page_title',
    	array(
    		'label'      => __( 'Страница списка новостей:' ),
    		'section'    => 'mytheme_new_section_name',
        'type'    => 'text',
    	)
    ));

    $wp_customize->add_control( new WP_Customize_Control(
    	$wp_customize,
    	'interest_page_title',
    	array(
    		'label'      => __( 'Страница списка интересно знать:' ),
    		'section'    => 'mytheme_new_section_name',
        'type'    => 'text',
    	)
    ));
}
add_action( 'customize_register', 'colombo_customize_register' );

remove_filter('the_content', 'wpautop');

/**
 * Disable add to cart action
 */
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );


/**
 * Add widget area for common filters like categories, series, search
 */
function common_widgets_init() {
  register_sidebar(array(
    'name' => __('Общие фильтры категорий', 'Colombo'),
    'id' => 'common_widget_area',
    'before_widget' => '<div class="colum-1-3">',
	   'after_widget'  => '</div>',
  ));

  register_sidebar(array(
    'name' => __('Фильтры в категориях', 'Colombo'),
    'id' => 'internal_filters_widget_area',
    'before_widget' => '<div class="widget woocommerce widget_layered_nav colum-1-4">',
	  'after_widget'  => '</div>',
    'before_title'  => '<span class="gamma widget-title">',
	   'after_title'   => '</span>'
  ));
}

add_action( 'widgets_init', 'common_widgets_init' );


/**
 * Override woocommerce widgets
 */
function override_woocommerce_widgets() {
  // Ensure our parent class exists to avoid fatal error (thanks Wilgert!)

  if ( class_exists( 'WC_Widget_Product_Categories' ) ) {
    unregister_widget( 'WC_Widget_Product_Categories' );

    include_once( 'widgets/widget-products_categories.php' );

    register_widget( 'Custom_WC_Widget_Product_Categories' );
  }

  if ( class_exists( 'WC_Widget_Layered_Nav' ) ) {
    unregister_widget( 'WC_Widget_Layered_Nav' );

    include_once( 'widgets/widget-products_attributes.php' );

    register_widget( 'Custom_Widget_Layered_Nav' );
  }

}

add_action( 'widgets_init', 'override_woocommerce_widgets', 15 );


function colombo_product_counter() {

  if(is_product_category()) {
      global $post;
      $terms = get_the_terms( $post->ID, 'product_cat' ); ?>
      <p class="product-count"> <?= __('Всего позиций в категории', 'Colombo') ?>: <span class="count-number"><?= $terms[0]->count; ?></span></p>
  <? }
  if(is_shop()) {
    global $wp_query; ?>
     <p class="product-count"> <?= __('Всего позиций в категории', 'Colombo') ?>: <span class="count-number"><?= $wp_query->found_posts; ?></span></p>
  <? }
}

add_action('colombo_product_counter', 'colombo_product_counter', 10);

/**
 * Lets check if user click show all button on woocommerce pages
 */
if((isset($_GET['view_all']) && strpos($_SERVER['REQUEST_URI'], 'product-category')) || (isset($_GET['view_all']) && strpos($_SERVER['REQUEST_URI'], 'categories'))) {
  add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 20 );

    function new_loop_shop_per_page( $cols ) {
    // $cols contains the current number of products per page based on the value stored on Options -> Reading
    // Return the number of products you wanna show per page.
     return - 1;
    }
}

function get_product_category_by_slug($cat_slug)
{
    $category = get_term_by('slug', $cat_slug, 'product_cat', 'ARRAY_A');
    return $category['name'];
}

function colombo_show_page_text_description() {
  $page_id = wc_get_page_id('shop');
  if($page_id && is_shop()) {
    $query = new WP_Query;
    $page = $query->query( array(
    	'post_type' => 'page',
      'p' => $page_id,
    ) );
    foreach( $page as $p ){
      $contet = $p->post_content;
    }
    $title = get_field('page_header',$page_id);
     ?>
      <div class="category-description colum-1-1">
        <h3><?= $title; ?></h3>
        <div class="description-content">
            <?= $contet; ?>
        </div>
        <a href="#" class="read-more show-text"><?= __('Подробнее', 'Colombo'); ?></a>
      </div>
  <? }
}

add_action('colombo_show_page_text_description', 'colombo_show_page_text_description', 10);

/**
 * Get list of product properties
 */
function colombo_get_product_properties() {
  $attribute_taxonomies = wc_get_attribute_taxonomies();
  $taxonomy_terms = array();
  $_product = wc_get_product( get_the_ID() );
  if ( $attribute_taxonomies ) {
    foreach ($attribute_taxonomies as $tax) {
      if (taxonomy_exists(wc_attribute_taxonomy_name($tax->attribute_name))) {
          $taxonomy_terms[$tax->attribute_label] = get_terms( wc_attribute_taxonomy_name($tax->attribute_name), 'orderby=name&hide_empty=0' );
      }
    }
  }
  $out = '';

  if($_product->get_sku()) {
    $out .= "<li>". __('Артикул', 'Colombo') .": <span>" . $_product->get_sku() ." </span> </li>";
  }
  if($EAN = get_post_meta(get_the_ID(), '_cpf_ean', true )) {
    $out .= "<li>". __('EAN', 'Colombo') .": <span>" . $EAN." </span> </li>";
  }
  foreach ($taxonomy_terms as $key => $value) {
      $out .= "<li>". $key .": <span>" .$value[0]->name ." </span> </li>";
  }

  if(intval($_product->get_price()) > 0) {
    $out .= "<li>".__('Рекомендованная розничная цена', 'Colombo').$_product->get_price_html()."</li>";
  }
  echo $out;
}

add_action('colombo_get_product_properties', 'colombo_get_product_properties', 10);

/**
 * Get formated product description
 */
function colombo_get_product_description() {
  $_product = wc_get_product( get_the_ID() );
  global $post;
    echo "<p class='description-title'>".__('Описание', 'Colombo').": </p>";
    echo "<p>".$post->post_content.": </p>";
}

add_action('colombo_get_product_description', 'colombo_get_product_description', 10);

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );

/**
 * Get about company posts list
 */
function colombo_get_about_company_posts_list() {
  $the_query = new WP_Query(array(
      'post_type' => 'about',
      'posts_per_page' => -1
    ));

    if ($the_query->have_posts()) {
      while ($the_query->have_posts()) {
          $the_query->the_post();
     ?>
      <div class="<?= get_field('width_class'); ?>">
          <div class="about">
            <div class="about-image">
              <a href="<?= get_field('page_href'); ?>">
                <? the_post_thumbnail('medium'); ?>
              </a>
            </div>
            <div class="about-title">
              <h4><a href="<?= get_field('page_href'); ?>"><?= the_title(); ?></a></h4>
            </div>
          </div>
        </div>
  <? }
    } else { ?>
      <p> <?= __('Серии не найдены', 'Colombo'); ?></p>
  <? }
}

add_action('colombo_get_about_company_posts_list', 'colombo_get_about_company_posts_list', 10);


function colombo_get_videos() {
  $the_query = new WP_Query(array(
      'post_type' => 'clm_video',
      'posts_per_page' => -1
    ));

    if ($the_query->have_posts()) {
      while ($the_query->have_posts()) {
          $the_query->the_post(); ?>
   <h3 class="video-name"><? the_title(); ?></h3>
    <?= get_field('youtube_code'); ?>
  <? }
  }
}

add_action('colombo_get_videos', 'colombo_get_videos', 10);

function add_endpoints() {
  add_rewrite_tag('%filter_seriya%','([^&]+)');
  add_rewrite_rule('^categories/([^/]*)/page/([0-9]{1,})/?','index.php?post_type=product&filtering=1&filter_seriya=$matches[1]&paged=$matches[2]','top');
  add_rewrite_rule('^categories/([^/]*)?','index.php?post_type=product&filtering=1&filter_seriya=$matches[1]','top');
  add_rewrite_rule('^product-category/([^/]*)/([^/]*)?','index.php?product_cat=$matches[1]&filtering=1&filter_seriya=$matches[2]','top');

}

add_action('init', 'add_endpoints');

add_filter( 'query_vars', 'prefix_register_query_var' );

function prefix_register_query_var( $vars ) {
    $vars[] = 'filter_seriya';
    $vars[] = 'filtering';
    return $vars;
}

function modify_query_to_new_urls() {
    if(get_query_var('filter_seriya') !== false) {
      $_GET['filter_seriya'] = get_query_var('filter_seriya');
    }
}

add_action( 'parse_query', 'modify_query_to_new_urls' );


add_filter( 'term_description', 'filter_description', 10, 4 );

function filter_description($value, $term_id, $taxonomy, $context) {
  if($taxonomy === 'clm_countries') {
      $value = strip_tags($value);
  }
  return $value;
}

add_filter('upload_mimes', 'custom_upload_xml');

function custom_upload_xml($mimes) {
    $mimes = array_merge($mimes, array('xml' => 'application/xml'));
    return $mimes;
}

/**
 * Remove Archives: prefix
 */

add_filter( 'get_the_archive_title', function ( $title ) {
    return str_replace('Archives: ', '', $title);
});

function add_dealer_endpoints() {
  // add_rewrite_rule('^categories/([^/]*)/page/([0-9]{1,})/?','index.php?post_type=product&filtering=1&filter_seriya=$matches[1]&paged=$matches[2]','top');
  // add_rewrite_rule('^categories/([^/]*)?','index.php?post_type=product&filtering=1&filter_seriya=$matches[1]','top');
  add_rewrite_rule('^gde-kupit/([^/]*)?/([^/]*)?/([^/]*)?','index.php?pagename=gde-kupit&country=$matches[1]&region=$matches[2]&city=$matches[3]','top');
  add_rewrite_rule('^gde-kupit/([^/]*)?/([^/]*)?','index.php?pagename=gde-kupit&country=$matches[1]&region=$matches[2]','top');
  add_rewrite_rule('^gde-kupit/([^/]*)?','index.php?pagename=gde-kupit&country=$matches[1]','top');
}

add_action('init', 'add_dealer_endpoints');

add_filter( 'query_vars', 'prefix_register_dealer_query_var' );

function prefix_register_dealer_query_var( $vars ) {
    $vars[] = 'country';
    $vars[] = 'region';
    $vars[] = 'city';
    return $vars;
}

add_action('clmb_dealers_show_filter', 'clmb_dealers_filter');

function clmb_dealers_filter() {
  $deal = new Dealer();
  $deal->renderCountries();
  $deal->renderRegions();
  $deal->renderCities();
  // var_dump(get_query_var('country'));
}
