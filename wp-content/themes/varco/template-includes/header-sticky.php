<div id="wrapper"
	class="hfeed site">
	<!--[if lt IE 9]>
	    <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
	<a class="skip-link screen-reader-text hide" href="#content"><?php _e( 'Skip to content', '_mbbasetheme' ); ?></a>
	<header id="masthead"
		data-sticky-container
		class="site-header contain-to-grid"
		role="banner">

		<div class="top-bar sticky"
		 	data-topbar
		 	data-sticky
		 	role="navigation"
		 	style="width:100%;">
			<div class="branding align-left">
				<h1 class="site-title">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<?php bloginfo( 'name' ); ?>
					</a>
				</h1>
				<h2 class="site-description">
					<?php bloginfo( 'description' ); ?>
				</h2>
			</div>

			<nav class="top-bar-left">
				<?php wp_nav_menu( array(
				'theme_location' => 'top-left',
				'menu_id' => 'top-left',
				'container' => 'ul',
				'container_class' => '',
				'items_wrap' => '<ul id="%1$s" class="%2$s" data-responsive-menu="accordion">%3$s</ul>', ) ); ?>
			</nav>

			<nav class="top-bar-right">
				<?php wp_nav_menu( array(
					'theme_location' => 'top-right',
					'menu_id' => 'top-right',
					'container' => 'ul',
					'container_class' => '',
					'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>', ) ); ?>
			</nav>

		</div>

	</header><!-- #masthead -->