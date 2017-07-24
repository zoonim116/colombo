<?

class Colombo_Nav_Walker extends Walker_Nav_Menu {
  function start_el(&$output, $item, $depth, $args) {
    $class_names = join( ' ', $item->classes );

    $class_names = ' class="' .esc_attr( $class_names ). '"';

    $output.= '<li id="menu-item-' . $item->ID . '"' .$class_names. '>';

    $attributes.= !empty( $item->url ) ? ' href="' .esc_attr($item->url). '"' : '';

    $item_output = $args->before;

    $current_url = (is_ssl()?'https://':'http://').$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    $item_url = esc_attr( $item->url );
    if ( $item_url != $current_url )  {
      if (!$depth) {
        $attributes .= ' class=" menu-link "';
      }
    } else {
      if (!$depth) {
        $attributes .= ' class=" menu-link current-menu-link"';
      }
    }
    $item_output.= '<a'. $attributes .'>'.$item->title.'</a>';
    $item_output.= $args->after;
    $output.= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
  }
}
