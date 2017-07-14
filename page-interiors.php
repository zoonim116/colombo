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
					<? do_action('colombo_get_collections_thumbs'); ?>
						<ul class="colums">
							<li class="interior-foto status colum-1-4">
								<a href="#" data-desc="Выдвижные индивидуальные решения. Два умывальники из высококачественного расширить концепцию промывки области безбарьерных решений Keramag. Agilo на площади и Privo в круговой конструкции для оптимальной адаптации к общему дизайну комнаты. Оба умывальники соответствуют стандарту DIN 18040 для безбарьерной ванной и Санитарные комнаты." title="Статус / Status"><img src="images/series-img1.jpg" alt="Статус / Status"></a>
							</li>
						</ul>
					</div>
    </div>
  </div>
</section>
<? get_footer(); ?>
