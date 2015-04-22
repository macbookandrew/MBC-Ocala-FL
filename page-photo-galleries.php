<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>

		<div id="primary">
			<div id="content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<h1 class="entry-title"><?php the_title(); ?></h1>
					</header><!-- .entry-header -->
				
					<div class="entry-content">
						<?php
						
						// Get the ID of this post
						$post_id = get_the_id();
						
						// Set up the objects needed
						$child_pages_query = new WP_Query();
						$all_wp_pages = $child_pages_query->query(array('post_type' => 'page'));
						
						// Filter through all pages and find Portfolio's children
						$gallery_children = get_page_children($post_id, $all_wp_pages);
						
						// Output to browser
						echo '<ul>';
						foreach ($gallery_children as $gallery_child) {
							echo '<li><a href="'.home_url('/media/photo-galleries/').$gallery_child->post_name.'">'.$gallery_child->post_title.'</a></li>';
						}
						// Reset Post Data
						wp_reset_postdata();
						echo '</ul>';
						
						?>
					</div><!-- .entry-content -->
				</article><!-- #post-<?php the_ID(); ?> -->

				<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>