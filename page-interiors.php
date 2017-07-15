<? /* Template Name: Интерьеры */ ?>
<? get_header(); ?>
<section>
	<div class="row">
    <? do_action('colombo_get_page_title'); ?>
    <div class="colums all-interiors">
      <div class="sort colum-1-3">
						<div class="filters interiors">
							<p class="filters-title">
								<a href="#"><span><?= __('Все интерьеры'); ?></span> <i class="fa fa-angle-down"></i></a>
							</p>
              <? do_action('colombo_get_collections_list'); ?>
						</div>
				</div>
				<div class="interiors-foto colum-1-1">
					<? do_action('colombo_get_series_thumb'); ?>
					<div id="modal-interior" class="modal-interior hide">
							<div class="container" style="max-width: 750px;">
								<p class="interior-title"></p>
								<div class="modal-img"><img src="" alt=""></div>
								<div class="modal-text">
									<p></p>
									<a href="#" class="category-link"><?= __('Перейти в категорию товаров'); ?> </a>
								</div>
							</div>
						</div>
					</div>
    </div>
  </div>
</section>
<? get_footer(); ?>
