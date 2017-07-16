<? /* Template Name: Интерьеры */ ?>
<? get_header(); ?>
<section>
			<div class="row">
				<h1 class="page-title"><?= __(get_theme_mod( 'news_page_title'));?></h1>
				<div class="news-novelties colums">
					<? do_action('colombo_show_news_thumbs'); ?>
					<div class="pagination colum-1-1">
            <? do_action('colombo_show_new_pagination'); ?>
            <? do_action('colombo_show_show_all_link'); ?>
					</div>
				</div>
			</div>
		</section>
<? get_footer(); ?>
