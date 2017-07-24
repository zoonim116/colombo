<?
class Custom_WC_Widget_Product_Categories extends WC_Widget_Product_Categories {

  /**
	 * Category ancestors.
	 *
	 * @var array
	 */
	public $cat_ancestors;

	/**
	 * Current Category.
	 *
	 * @var bool
	 */
	public $current_cat;

	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->widget_cssclass    = 'woocommerce widget_product_categories';
		$this->widget_description = __( 'A list or dropdown of product categories.', 'woocommerce' );
		$this->widget_id          = 'woocommerce_product_categories';
		$this->widget_name        = __( 'WooCommerce product categories', 'woocommerce' );
		$this->settings           = array(
			'title'  => array(
				'type'  => 'text',
				'std'   => __( 'Product categories', 'woocommerce' ),
				'label' => __( 'Title', 'woocommerce' ),
			),
			'orderby' => array(
				'type'  => 'select',
				'std'   => 'name',
				'label' => __( 'Order by', 'woocommerce' ),
				'options' => array(
					'order' => __( 'Category order', 'woocommerce' ),
					'name'  => __( 'Name', 'woocommerce' ),
				),
			),
			'dropdown' => array(
				'type'  => 'checkbox',
				'std'   => 0,
				'label' => __( 'Show as dropdown', 'woocommerce' ),
			),
			'count' => array(
				'type'  => 'checkbox',
				'std'   => 0,
				'label' => __( 'Show product counts', 'woocommerce' ),
			),
			'hierarchical' => array(
				'type'  => 'checkbox',
				'std'   => 1,
				'label' => __( 'Show hierarchy', 'woocommerce' ),
			),
			'show_children_only' => array(
				'type'  => 'checkbox',
				'std'   => 0,
				'label' => __( 'Only show children of the current category', 'woocommerce' ),
			),
			'hide_empty' => array(
				'type'  => 'checkbox',
				'std'   => 0,
				'label' => __( 'Hide empty categories', 'woocommerce' ),
			),
		);

		parent::__construct();
	}

	/**
	 * Output widget.
	 *
	 * @see WP_Widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		global $wp_query, $post;
		$count              = isset( $instance['count'] ) ? $instance['count'] : $this->settings['count']['std'];
		$hierarchical       = isset( $instance['hierarchical'] ) ? $instance['hierarchical'] : $this->settings['hierarchical']['std'];
		$show_children_only = isset( $instance['show_children_only'] ) ? $instance['show_children_only'] : $this->settings['show_children_only']['std'];
		$dropdown           = isset( $instance['dropdown'] ) ? $instance['dropdown'] : $this->settings['dropdown']['std'];
		$orderby            = isset( $instance['orderby'] ) ? $instance['orderby'] : $this->settings['orderby']['std'];
		$hide_empty         = isset( $instance['hide_empty'] ) ? $instance['hide_empty'] : $this->settings['hide_empty']['std'];
		$dropdown_args      = array( 'hide_empty' => $hide_empty );
		$list_args          = array( 'show_count' => $count, 'hierarchical' => $hierarchical, 'taxonomy' => 'product_cat', 'hide_empty' => $hide_empty );

		// Menu Order
		$list_args['menu_order'] = false;
		if ( 'order' === $orderby ) {
			$list_args['menu_order'] = 'asc';
		} else {
			$list_args['orderby']    = 'title';
		}

		// Setup Current Category
		$this->current_cat   = false;
		$this->cat_ancestors = array();

		if ( is_tax( 'product_cat' ) ) {

			$this->current_cat   = $wp_query->queried_object;
			$this->cat_ancestors = get_ancestors( $this->current_cat->term_id, 'product_cat' );

		} elseif ( is_singular( 'product' ) ) {

			$product_category = wc_get_product_terms( $post->ID, 'product_cat', apply_filters( 'woocommerce_product_categories_widget_product_terms_args', array( 'orderby' => 'parent' ) ) );

			if ( ! empty( $product_category ) ) {
				$this->current_cat   = end( $product_category );
				$this->cat_ancestors = get_ancestors( $this->current_cat->term_id, 'product_cat' );
			}
		}

		// Show Siblings and Children Only
		if ( $show_children_only && $this->current_cat ) {

			// Top level is needed
			$top_level = get_terms(
				'product_cat',
				array(
					'fields'       => 'ids',
					'parent'       => 0,
					'hierarchical' => true,
					'hide_empty'   => false,
				)
			);

			// Direct children are wanted
			$direct_children = get_terms(
				'product_cat',
				array(
					'fields'       => 'ids',
					'parent'       => $this->current_cat->term_id,
					'hierarchical' => true,
					'hide_empty'   => false,
				)
			);

			// Gather siblings of ancestors
			$siblings  = array();
			if ( $this->cat_ancestors ) {
				foreach ( $this->cat_ancestors as $ancestor ) {
					$ancestor_siblings = get_terms(
						'product_cat',
						array(
							'fields'       => 'ids',
							'parent'       => $ancestor,
							'hierarchical' => false,
							'hide_empty'   => false,
						)
					);
					$siblings = array_merge( $siblings, $ancestor_siblings );
				}
			}

			if ( $hierarchical ) {
				$include = array_merge( $top_level, $this->cat_ancestors, $siblings, $direct_children, array( $this->current_cat->term_id ) );
			} else {
				$include = array_merge( $direct_children );
			}

			$dropdown_args['include'] = implode( ',', $include );
			$list_args['include']     = implode( ',', $include );

			if ( empty( $include ) ) {
				return;
			}
		} elseif ( $show_children_only ) {
			$dropdown_args['depth']        = 1;
			$dropdown_args['child_of']     = 0;
			$dropdown_args['hierarchical'] = 1;
			$list_args['depth']            = 1;
			$list_args['child_of']         = 0;
			$list_args['hierarchical']     = 1;
		}

		$this->widget_start( $args, $instance );

		// Dropdown
		if ( $dropdown ) {
			$dropdown_defaults = array(
				'show_count'         => $count,
				'hierarchical'       => $hierarchical,
				'show_uncategorized' => 0,
				'orderby'            => $orderby,
				'selected'           => $this->current_cat ? $this->current_cat->slug : '',
			);
			$dropdown_args = wp_parse_args( $dropdown_args, $dropdown_defaults );

			// Stuck with this until a fix for https://core.trac.wordpress.org/ticket/13258
			$this->colombo_product_dropdown_categories( apply_filters( 'woocommerce_product_categories_widget_dropdown_args', $dropdown_args ) );

			wc_enqueue_js( "
        jQuery('.colum-1-3 .filters [data-link=\'category_slug\']').on('click', function(e){
            e.preventDefault();
            if ( jQuery(this).attr('href') != '' ) {
              var this_page = '';
              var home_url  = '" . esc_js( home_url( '/' ) ) . "';
              if ( home_url.indexOf( '?' ) > 0 ) {
                this_page = home_url + '&product_cat=' + jQuery(this).attr('href');
              } else {
                this_page = home_url + '?product_cat=' + jQuery(this).attr('href');
              }
              location.href = this_page;
            } else {
              var rootPage = '".get_permalink( woocommerce_get_page_id( 'shop' ) )."';
              location.href = rootPage;
            }
        });
			" );

		// List
		} else {

			include_once( WC()->plugin_path() . '/includes/walkers/class-product-cat-list-walker.php' );

			$list_args['walker']                     = new WC_Product_Cat_List_Walker;
			$list_args['title_li']                   = '';
			$list_args['pad_counts']                 = 1;
			$list_args['show_option_none']           = __( 'No product categories exist.', 'woocommerce' );
			$list_args['current_category']           = ( $this->current_cat ) ? $this->current_cat->term_id : '';
			$list_args['current_category_ancestors'] = $this->cat_ancestors;

			echo '<ul class="product-categories">';

			wp_list_categories( apply_filters( 'woocommerce_product_categories_widget_args', $list_args ) );

			echo '</ul>';
		}

		$this->widget_end( $args );
	}

  public /**
   * Make a new Dropdown categories bases on stock woocommerce.
   */

  function colombo_product_dropdown_categories( $args = array()) {
  	global $wp_query;

  	if ( ! is_array( $args ) ) {
  		wc_deprecated_argument( 'wc_product_dropdown_categories()', '2.1', 'show_counts, hierarchical, show_uncategorized and orderby arguments are invalid - pass a single array of values instead.' );

  		$args['show_count']         = $args;
  		$args['hierarchical']       = $deprecated_hierarchical;
  		$args['show_uncategorized'] = $deprecated_show_uncategorized;
  		$args['orderby']            = $deprecated_orderby;
  	}

  	$current_product_cat = isset( $wp_query->query_vars['product_cat'] ) ? $wp_query->query_vars['product_cat'] : '';
  	$defaults            = array(
  		'pad_counts'         => 1,
  		'show_count'         => 1,
  		'hierarchical'       => 1,
  		'hide_empty'         => 1,
  		'show_uncategorized' => 1,
  		'orderby'            => 'name',
  		'selected'           => $current_product_cat,
  		'menu_order'         => false,
  		'option_select_text' => __( 'Select a category', 'woocommerce' ),
  	);

  	$args = wp_parse_args( $args, $defaults );

  	if ( 'order' === $args['orderby'] ) {
  		$args['menu_order'] = 'asc';
  		$args['orderby']    = 'name';
  	}

  	$terms = get_terms( 'product_cat', apply_filters( 'wc_product_dropdown_categories_get_terms_args', $args ) );

  	if ( empty( $terms ) ) {
  		return;
  	}

    $colombo_current_cat = strlen($args['selected']) > 0 ? get_product_category_by_slug($args['selected']) : $args['option_select_text'];

    $output = "<div class='filters categories'> ";
    $output .= "<p class='filters-title'>";
    $output .= "<a href='#'>".esc_html( $colombo_current_cat );
    $output .= " <i class='fa fa-angle-down'></i></a>";
    $output .= "</p>";


    $output .= "<ul class='filters-list hide'>";
    if (strlen($args['selected']) > 0) {
      $output .= "<li><a data-link='category_slug' href=''>".$args['option_select_text']."</a></li>";
    }
  	$output .= $this->colombo_walk_category_dropdown_tree( $terms, 0, $args );
  	if ( $args['show_uncategorized'] ) {
  		// $output .= '<option value="0" ' . selected( $current_product_cat, '0', false ) . '>' . esc_html__( 'Uncategorized', 'woocommerce' ) . '</option>';
  	}
  	$output .= "</ul>";
    $output .= "</div>";
  	echo $output;
  }

  public function colombo_walk_category_dropdown_tree() {
    $args = func_get_args();

      if ( ! class_exists( 'Custom_WC_Product_Cat_Dropdown_Walker', false ) ) {
        // include_once( WC()->plugin_path() . '/includes/walkers/class-product-cat-dropdown-walker.php' );
        require_once get_template_directory() . '/helpers/product_filter_item_walker.php';
      }

      // the user's options are the third parameter
      if ( empty( $args[2]['walker'] ) || ! is_a( $args[2]['walker'], 'Walker' ) ) {
        $walker = new Custom_WC_Product_Cat_Dropdown_Walker;
      } else {
        $walker = $args[2]['walker'];
      }

      return call_user_func_array( array( &$walker, 'walk' ), $args );
  }

}
