<? /* Template Name: О компании */ ?>
<? get_header(); ?>
<section>
  <div class="row">
    <? do_action('colombo_get_page_title'); ?>
    <div class="colums all-about">
      <? do_action('colombo_get_about_company_posts_list'); ?>
    </div>
  </div>
</section>
<? get_footer(); ?>
