<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>

	</div><!-- #main -->

	<footer id="colophon" role="contentinfo">

			<?php
				/* A sidebar in the footer? Yep. You can can customize
				 * your footer with three columns of widgets.
				 */
				get_sidebar( 'footer' );
			?>

			<div id="site-generator">
				&copy;2012<?php if (date('Y') > 2012) {echo '&ndash;'.date('Y');} ?> | designed by <a href="http://minionsformissions.com/" title="AndrewRMinion Design">AndrewRMinion Design</a> | powered by <a href="http://wordpress.org/" title="Semantic Personal Publishing Platform" rel="generator">Wordpress</a> | <?php wp_loginout(); ?>
			</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>