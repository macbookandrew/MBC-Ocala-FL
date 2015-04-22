<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 */

get_header(); ?>

		<div id="primary">
			<div id="content" role="main">

				<?php twentyeleven_content_nav( 'nav-above' ); ?>
				
				<a class="home-button rounded shadowed" id="ministries" href="<?php bloginfo('url'); ?>/ministries/" title="Ministries">
					<h2 class="rounded"><span class="hide">Ministries</span></h2>
				</a>
				
				<a class="home-button rounded shadowed" id="faith-bible-institute" href="<?php bloginfo('url'); ?>/ministries/faith-bible-institute/" title="Faith Bible Institute">
					<h2 class="rounded"><span class="hide">Faith Bible Institute</span></h2>
				</a>
				
				<a class="home-button rounded shadowed" id="what-to-expect" href="<?php bloginfo('url'); ?>/about-us/what-to-expect/" title="What to Expect">
					<h2 class="rounded"><span class="hide">What to Expect</span></h2>
				</a>
				
				<a class="home-button rounded shadowed" id="addictions" href="<?php bloginfo('url'); ?>/ministries/addictions/" title="Addictions Ministries">
					<h2 class="rounded"><span class="hide">Addictions</span></h2>
				</a>

				<?php twentyeleven_content_nav( 'nav-below' ); ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_sidebar('home'); ?>
<?php get_footer(); ?>