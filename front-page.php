<? get_header(); ?>
<section>
		<div class="row">
			<div class="slider">
        <? echo do_shortcode("[metaslider id=24]"); ?>
      </div>
    </div>
</section>
<section>
			<div class="row dark-background">
				<div class="container">
					<h1><?= __( 'Современная сантехника для ванных комнат' ) ?></h1>
					<div class="last-post colums">
            <? do_action('colombo_get_last_news_on_homepage', 3); ?>
						
					</div>
				</div>
			</div>
		</section>

<? get_footer(); ?>
