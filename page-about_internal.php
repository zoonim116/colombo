<? /* Template Name: О компании (внутренняя) */ ?>
<? get_header(); ?>
<section>
  <div class="row">
    <? do_action('colombo_get_page_title'); ?>
    <div class="tabs">
					<div class="all-tabs">
						<div class="tab">
              <? while ( have_posts() ) : the_post(); ?>
							<h3 class="tab-title"><?= get_field('about_subtitle'); ?></h3>
							<div class="colums">
								<div class="colum-2-3">
									<p><? the_content(); ?></p>
								</div>
								<div class="colum-1-3">
									<div class="production-galery">
										<ul>
                      <? if(count(get_field('about_gallery')) > 0) : ?>
                        <? foreach (get_field('about_gallery') as $img):  ?>
                          <li>
                            <a class="fancybox" href="<?= $img['url']; ?>" rel="production-galery">
                              <img src="<?= $img['sizes']['shop_catalog']; ?>" alt="<?= $img['alt'] ?>">
                            </a>
                          </li>
                         <? endforeach; ?>
                       <? endif; ?>
										</ul>
									</div>
								</div>
							</div>
              <? endwhile; ?>
						</div>
					</div>
				</div>
  </div>
</section>
<? get_footer(); ?>
