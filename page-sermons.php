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

<?php require_once('sermons-code/functions.php'); ?>
<?php require_once('sermons-code/mysql.php'); ?>
<?php require_once('sermons-code/queries.php'); ?>

		<div id="primary">
			<div id="content" role="main">

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<header class="entry-header">
							<h1 class="entry-title"><?php the_title(); ?></h1>
						</header><!-- .entry-header -->
						
						<div class="entry-content">
							<p>Click the sermon title to see sermon notes (if available) and the option to download the sermon.</p>
							<?php include('sermons-code/filters.php'); ?>
							
							<?php
							if (!mysql_num_rows($all_sermons)) {
								echo '<div style="text-align: center; font-style: italic;">There are no sermons to display.</div>';
							} else {
							?>
	
								<?php
								$rowCount = 0;
								$prevMonth = 0;
								$prevYear = 0;
								while ($row = mysql_fetch_row($all_sermons)) {
									$sermonID          = $row[0];
									$sermonTitle       = $row[1];
									$sermonDescription = $row[2];
									$sermonDate        = $row[3];
									$sermonServiceTime = $row[4];
									$sermonSpeaker     = $row[5];
									$sermonAudioFile   = $row[6];
									$sermonVideoFile   = $row[7];
									
									$sermonAudioFileSize = round(((filesize("wp-content/uploads/sermons/".$sermonAudioFile) / 1024) / 1024));
								
									$rowColor = ($rowCount % 2) ? "#eeeeee" : "#ffffff";
									
									if ($prevMonth != date("n", strtotime($sermonDate))) {
										$prevMonth = date("n", strtotime($sermonDate));
										?>
							<div class="month-header">
								<?php echo date("F Y", strtotime($sermonDate)); ?>
							</div>
										<?php
									}
								?>
	
							<div class="individual-sermon">
	
								<div class="listen-now-container">
									<?php if (strlen($sermonAudioFile)) { ?>
										<a class="sermon-link" id="listen" href="#" onclick="popAudioWin('<?php echo $sermonID; ?>'); return false;">Listen Now</a>
									<?php } ?>
									<?php if (strlen($sermonVideoFile)) { ?>
										<a class="sermon-link" id="watch" href="#" onclick="popVideoWin('<?php echo $sermonID; ?>'); return false;">Watch Now</a>
									<?php } ?>
								</div><!-- .listen-now-container -->
								<p class="sermon-info"><a class="sermon-title"><?php echo $sermonTitle; ?></a> &mdash; <?php echo $sermonSpeaker; ?><br/>
									<span class="smaller"><?php echo $sermonServiceTime; ?>, <?php echo date("F j, Y", strtotime($sermonDate)); ?></span>
								</p>
								
								<div class="mediaSlide" style="display: none;">
									<a class="sermon-link" id="download" href="/wp-content/themes/MBC-Ocala-FL/sermon-download.php?file=<?php echo $sermonAudioFile; ?>">Download MP3</a> <span class="smaller">(<?php echo $sermonAudioFileSize; ?>MB)</span>
	
									<?php if (strlen($sermonDescription)) { ?>
										<span class="sermon-notes">Sermon Notes: <?php echo $sermonDescription; ?></span>
									<?php } ?>
		
								</div><!-- .mediaSlide -->
									
							</div><!-- .individual-sermon -->
	
								<?php
									$rowCount++;
								} // end while loop
								?>
	
							<?php
							}
							?>

						</div><!-- .entry-content -->
					</article><!-- #post-<?php the_ID(); ?> -->

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>