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
    $output .= '</ul>';
    $output .= '</div>';
    $output .= '</div>';
    return $output;
  }
}
