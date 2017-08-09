<? get_header(); ?>

<section>
	<div class="row">
		<h1 class="page-title"><? printf( __( 'Search Results for: %s', 'twentysixteen' ), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h1>
	</div>
	<div class="row dark-background">
		<div class="container">
		<? if ( have_posts() ) : ?>
				<div class="all-products colums">
					<? while ( have_posts() ) : the_post(); ?>
					<? $custom_posts = ['clm_video', 'interior'];  ?>
					<? $href = "#"; ?>
					<? if(in_array(get_post_type(), $custom_posts)) : ?>
						<? switch (get_post_type()) {
							case 'clm_video':
								$thumb = get_field('youtube_code');
								break;

							case 'interior':
								$thumb = get_the_post_thumbnail([300, 300]);
								$href = get_permalink(85);
								break;

							default:
								# code...
								break;
						} ?>
						<div class="product colum-1-4">
							<div class="product-image">
								<a href="<?= $href; ?>"><?= $thumb; ?></a>
							</div>
							<div class="product-name">
								<p> <a href="<?= $href; ?>">
									<? if(strlen(get_the_title()) > 64 ): ?>
										<span class="name"><?= mb_substr(get_the_title(), 0, 60 ).'...'; ?></span>
									<? else: ?>
										<span class="name"><?= get_the_title(); ?></span>
									<? endif; ?>
								 </a> </p>
							</div>
						</div>
					<? else : ?>
						<div class="product colum-1-4">
							<div class="product-image">
								<a href="<?= get_permalink(); ?>"><? the_post_thumbnail([300, 300]); ?></a>
							</div>
							<div class="product-name">
								<p> <a href="<?= get_permalink(); ?>">
									<? if(strlen(get_the_title()) > 64 ): ?>
										<span class="name"><?= mb_substr(get_the_title(), 0, 60 ).'...'; ?></span>
									<? else: ?>
										<span class="name"><?= get_the_title(); ?></span>
									<? endif; ?>
								 </a> </p>
							</div>
						</div>
					<? endif; ?>
				 <?	endwhile; ?>
				</div>
				<? the_posts_pagination( array(
					'prev_text'          => __( 'Previous page', 'twentysixteen' ),
					'next_text'          => __( 'Next page', 'twentysixteen' ),
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentysixteen' ) . ' </span>',
				) );
			else : ?>
				<p> <?= __('По запросу: ', 'Colombo'). esc_html( get_search_query() ) . " ". __('ничего не найдено', 'Colombo'); ?> </p>
		<?	endif;
		?>
		</div>
	</div>
</section>
<? get_footer(); ?>
