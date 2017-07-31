<? get_header(); ?>
<section>
	<div class="row">
    <? while ( have_posts() ) : the_post(); ?>
		<h1 class="page-title"><? the_title(); ?></h1>
		<div class="post-page">
			<article class="main-news">
        <div class="post-image">
					<? the_post_thumbnail(); ?>
				</div>
				<? the_content();?>
			</article>
      <? endwhile; ?>
		</div>
	</div>
</section>
<? get_footer(); ?>
