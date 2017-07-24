<?

class ThemeUtils
{
  public static function breadcrumbs() {
    $output = '<div class="breadcrumbs">';
    $output .= '<div class="content">';
    $output .= '<ul>';

    $output .= '<li><a href="'.get_home_url().'">'.__('Главная', 'Colombo').'</a></li>';
    if(is_page()) {
      $output .= '<li><span>'.get_the_title().'</span></li>';
    }
    if(is_shop()) {
      $output .= '<li><span>'.get_the_title(98).'</span></li>';
    }
    if(is_product_category()) {
        $output .= '<li><a href="'.get_permalink(98).'">'.get_the_title(98).'</a></li>';
        $output .= '<li><span>'.single_term_title('', false).'</span></li>';
    }
    if(is_single()) {
      if(is_product()) {
        global $post;
        $categories = get_the_terms( $post->ID, 'product_cat' );
        $output .= '<li><a href="'.get_permalink(98).'">'.get_the_title(98).'</a></li>';
        foreach ($categories as $category) {
            $output .= '<li><a href="'.get_term_link($category->term_id, 'product_cat').'">'.$category->name.'</a></li>';
        }
        $output .= '<li><span>'.$post->post_title.'</span></li>';
      } else {
          global $post;
          global $wp_post_types;
          if ($wp_post_types[$post->post_type]) {
            $output .= '<li><a href="/'.$wp_post_types[$post->post_type]->rewrite['slug'].'">'.$wp_post_types[$post->post_type]->label.'</a></li>';
          }
          $output .= '<li><span>'.$post->post_title.'</span></li>';
      }
    }
    $output .= '</ul>';
    $output .= '</div>';
    $output .= '</div>';
    return $output;
  }
}
