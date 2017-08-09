<? /* Template Name: Видео */ ?>
<? get_header(); ?>
<section>
  <div class="row">
    <? do_action('colombo_get_page_title'); ?>
    <div class="video">
      <? do_action('colombo_get_videos'); ?>
    </div>
  </div>
</section>
<? get_footer(); ?>
