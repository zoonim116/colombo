<?

class ThemeUtils
{
  public static function breadcrumbs() {
    $output = '<div class="breadcrumbs">';
    $output .= '<div class="content">';
    $output .= '<ul>';

    $output .= '<li><a href="'.get_home_url().'">'.__('Главная').'</a></li>';
    if(is_page()) {
      $output .= '<li><span>'.get_the_title().'</span></li>';
    }
    if(is_single()) {
      global $post;
      global $wp_post_types;
      if ($wp_post_types[$post->post_type]) {
        $output .= '<li><a href="/'.$wp_post_types[$post->post_type]->rewrite['slug'].'">'.$wp_post_types[$post->post_type]->label.'</a></li>';
      }
      $output .= '<li><span>'.$post->post_title.'</span></li>';
    }
    $output .= '</ul>';
    $output .= '</div>';
    $output .= '</div>';
    return $output;
  }
}
