</main>
	<footer>
		<div class="content">
			<div class="footer-widgets colums">
				<div class="footer-widget">
					<h5 class="widget-title"><?= __('Категории'); ?></h5>
					<div class="widget-menu">
            <? wp_nav_menu( array( 'theme_location' => 'categories-menu', 'container' => '',  'menu_id' => '', 'menu_class' => 'menu')); ?>
					</div>
				</div>
				<div class="footer-widget">
					<h5 class="widget-title"><?= __('Серии'); ?></h5>
					<div class="widget-menu">
            <? wp_nav_menu( array( 'theme_location' => 'series-menu', 'container' => '',  'menu_id' => '', 'menu_class' => 'menu')); ?>
					</div>
				</div>
				<div class="footer-widget">
					<h5 class="widget-title"><?= __('Разделы сайта'); ?></h5>
					<div class="widget-menu">
						<ul class="menu">
							<li><a href="#">Продукция</a></li>
							<li><a href="#">Серии</a></li>
							<li><a href="#">Интерьеры</a></li>
							<li><a href="#">Где купить</a></li>
							<li><a href="#">Новости</a></li>
							<li><a href="#">О компании</a></li>
							<li><a href="#">Контакты</a></li>
							<li><a href="#">Видео</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="footer-bottom">
			<div class="content">
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
