<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>

	<?php
		/**
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 * @hooked WC_Structured_Data::generate_website_data() - 30
		 */
		// do_action( 'woocommerce_before_main_content' );
		// echo "<pre>";
		// die(var_dump($_GET));
	?>
<section>
	<div class="row">
				<h1 class="page-title"><?= __('Продукция Colombo: сантехника, керамика и мебель для ванных', 'Colombo'); ?></h1>
			</div>
			<div class="row dark-background">
				<div class="container">
					<div class="colums filters-and-serch">
						<?php if ( is_active_sidebar( 'common_widget_area' ) ) : ?>
							<?php dynamic_sidebar( 'common_widget_area' ); ?>
						<?php endif; ?>
					</div>
					<? if(is_product_category() && is_active_sidebar('internal_filters_widget_area')) : ?>
						<div class="all-filters colums">
							<p class="filters-title colum-1-1"><?= __('Фильтра', 'Colombo'); ?></p>
							<?php dynamic_sidebar( 'internal_filters_widget_area' ); ?>
						</div>
					<? endif; ?>
					<div class="all-products colums">
		<?php if ( have_posts() ) : ?>

			<?php
				/**
				 * woocommerce_before_shop_loop hook.
				 *
				 * @hooked wc_print_notices - 10
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				// do_action( 'woocommerce_before_shop_loop' );
			?>

			<?php //woocommerce_product_loop_start(); ?>

				<?php woocommerce_product_subcategories(); ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						/**
						 * woocommerce_shop_loop hook.
						 *
						 * @hooked WC_Structured_Data::generate_product_data() - 10
						 */
						do_action( 'woocommerce_shop_loop' );
					?>

					<?php wc_get_template_part( 'content', 'product' ); ?>

				<?php endwhile; // end of the loop. ?>

			<?php //woocommerce_product_loop_end(); ?>
			<div class="pagination colum-1-1">
					<? do_action('colombo_product_counter'); ?>
					<!-- <p class="product-count"> <?= __('Всего позиций в категории', 'Colombo') ?>: <span class="count-number">120</span></p> -->
				<?php
					/**
					 * woocommerce_after_shop_loop hook.
					 *
					 * @hooked woocommerce_pagination - 10
					 */
					do_action( 'colombo_show_new_pagination' );
					do_action( 'colombo_show_show_all_link' );
					do_action( 'colombo_show_page_text_description');
				?>
			</div>

		<?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

			<?php
				/**
				 * woocommerce_no_products_found hook.
				 *
				 * @hooked wc_no_products_found - 10
				 */
				do_action( 'woocommerce_no_products_found' );
			?>

		<?php endif; ?>

	<?php
		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>
		</div>
		</div>
	</div>
	<?php

		/**
		 * woocommerce_sidebar hook.
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		// do_action( 'woocommerce_sidebar' );
	?>
</section>
<?php get_footer( 'shop' ); ?>
