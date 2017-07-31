<? get_header(); ?>
<section>
  <div class="row">
    <h1 class="page-title"><?= __(get_theme_mod( 'interest_page_title'));?></h1>
    <div class="tabs">
        <div class="all-tabs">
          <div class="tab">
            <h3 class="tab-title"><?= __('Интересно узнать', 'Colombo'); ?></h3>
            <div class="interesting-content">
              <div class="colums">
                  <? do_action('colombo_get_interest_lists'); ?>
              </div>
            </div>
          </div>
        </div>
    </div>
  </div>
</section>
<? get_footer(); ?>
