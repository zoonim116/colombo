<? /* Template Name: Серии */ ?>
<? get_header(); ?>
<section>
	<div class="row">
    <? do_action('colombo_get_series_title'); ?>
    <div class="colums series">
      <? do_action('colombo_show_series'); ?>
    </div>
  </div>
</section>
<? get_footer(); ?>
