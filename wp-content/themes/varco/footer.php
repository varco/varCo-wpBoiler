<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package _mbbasetheme
 */
?>

	</div><!-- #content -->

	<footer id="colophon"
        class="site-footer row"
        role="contentinfo">
		<nav class="small-12 medium-4 columns">
                    <?php wp_nav_menu( array(
                        'theme_location' => 'footer-left',
                        'menu_id' => 'footer-left',
                        'container' => 'ul',
                        'container_class' => '',
                        'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>', ) ); ?>
        </nav>
        <nav class="small-12 medium-4 columns">
                    <?php wp_nav_menu( array(
                        'theme_location' => 'footer-middle',
                        'menu_id' => 'footer-middle',
                        'container' => 'ul',
                        'container_class' => '',
                        'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>', ) ); ?>
        </nav>
        <nav class="small-12 medium-4 columns">
                    <?php wp_nav_menu( array(
                        'theme_location' => 'footer-right',
                        'menu_id' => 'footer-right',
                        'container' => 'ul',
                        'container_class' => '',
                        'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>', ) ); ?>
        </nav>

        <div class="site-info small-12">
			<p class="copyright">&copy; <?php echo date( "Y" ); echo " "; bloginfo( 'name' ); ?></p>
		</div><!-- .site-info -->

    </footer><!-- #colophon -->

</div><!-- #page -->

<input type="hidden" id="txtDebug" name="txtDebug" value="<?php echo WP_DEBUG; ?>" />

<?php
    echo get_template_part('templates-includes/tracking');
?>

<?php wp_footer(); ?>


</body>
</html>
