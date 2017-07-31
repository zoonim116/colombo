<? /* Template Name: Контакты */ ?>
<? get_header(); ?>
<section>
  <div class="row">
    <? do_action('colombo_get_page_title'); ?>
    <div class="colums">
      <div class="address colum-1-1">
          <? while ( have_posts() ) : the_post(); ?>
            <? the_content(); ?>
          <? endwhile; ?>
      </div>
    </div>
  </div>
</section>
<? get_footer(); ?>
