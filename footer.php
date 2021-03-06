</main>

<footer>
		<div class="hide-block">
		<div class="content">
			<div class="footer-widgets colums">
				<div class="footer-widget">
					<h5 class="widget-title"><?= __('Категории', 'Colombo'); ?></h5>
					<div class="widget-menu">
						<? wp_nav_menu( array( 'theme_location' => 'categories-menu', 'container' => '',  'menu_id' => '', 'menu_class' => 'menu')); ?>
					</div>
				</div>
				<div class="footer-widget">
					<h5 class="widget-title"><?= __('Серии', 'Colombo'); ?></h5>
					<div class="widget-menu">
					  <? wp_nav_menu( array( 'theme_location' => 'series-menu', 'container' => '',  'menu_id' => '', 'menu_class' => 'menu')); ?>
					</div>
				</div>
				<div class="footer-widget">
					<h5 class="widget-title"><?= __('Разделы сайта', 'Colombo'); ?></h5>
					<div class="widget-menu">
						<? wp_nav_menu( array( 'theme_location' => 'pages-menu', 'container' => '',  'menu_id' => '', 'menu_class' => 'menu')); ?>
					</div>
				</div>
			</div>
		</div>
		</div>
		<div class="footer-bottom">
		<div class="content">
			<p class="show-footer">
				<a href="#"><?= __('Карта сайта', 'Colombo'); ?> <i class="fa fa-angle-up"></i></a>
			</p>
			<p class="copyrights">© 2017. Copyrights by Colombo.</p>
		</div>
	</div>
	</footer>

  <script type="text/javascript">
  WebFontConfig = {
    google: { families: [ 'Ubuntu:300,400,500,700&amp;subset=cyrillic'] }
  };
  (function() {
    var wf = document.createElement('script');
    wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
      '://ajax.googleapis.com/ajax/libs/webfont/1.5.18/webfont.js';
    wf.type = 'text/javascript';
    wf.async = 'true';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(wf, s);
  })(); </script>
  <? wp_footer(); ?>

</body>
</html>
