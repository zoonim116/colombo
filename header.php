<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="Content-Language" content="ru"/>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
	<meta name='yandex-verification' content='79f6f41e1a67be9b' />
  <?php if (is_admin_bar_showing()) { ?>
    	<style type="text/css">
    		header.main-header {
    			margin-top: 32px;
    		}
    		@media only screen and (max-width: 768px) {
    			#mainmenu .menu-wrapper {
    				margin-top: 32px;
    			}
    		}
    	</style>
    <?php } ?>
    <? wp_head(); ?>
</head>

<body class="<?php if(is_front_page()) echo "home"; ?>">
  <header>
		<div class="content">
			<div class="logo">
				<a href="/" title="">
					<?
          /**
        	 * colombo_get_logo hook.
        	 *
        	 * @hooked colombo_get_logo - 10
        	 */
          do_action('colombo_get_logo');
          ?>
				</a>
			</div>
			<div class="navigation">
				<span class="mobile-menu"><i class="fa fa-bars"></i></span>
        <?
        $walker = new Colombo_Nav_Walker();
        wp_nav_menu( array( 'walker' => $walker, 'theme_location' => 'main-menu', 'container' => '',  'menu_id' => '', 'menu_class' => 'main-menu'));
        ?>
			</div>
			<div class="langs">
				<ul class="langs-list">
					<li class="current-lang"><a href="#">Ru</a></li>
					<li><a href="#">Ua</a></li>
				</ul>
			</div>
			<div class="search">
				<span class="show-search"><i class="fa fa-search" aria-hidden="true"></i></span>
				<form action="">
					<input type="text" name="search-input" placeholder="Поиск">
					<button class="search-submit"><i class="fa fa-search" aria-hidden="true"></i></button>
				</form>
			</div>
		</div>
	</header>
  <?  if(!is_home()): ?>
    <?= ThemeUtils::breadcrumbs(); ?>

  <? endif; ?>
	<main>
