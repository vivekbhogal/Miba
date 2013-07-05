<?php
/**
 * Template Name: Front Page Template
 *
 * Description: A page template that provides a key component of WordPress as a CMS
 * by meeting the need for a carefully crafted introductory page. The front page template
 * in Twenty Twelve consists of a page content area for adding text, images, video --
 * anything you'd like -- followed by front-page-only widgets in one or two columns.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">
			<div id="frontpage_content">
			<?php $teller=0; query_posts( 'posts_per_page=4&cat=15&order=DESC' ); ?>
				<?php if (have_posts()): while (have_posts()) : the_post(); ?>
					<? $link = get_permalink(); ?>
				<div class="<?php if($teller == 0){echo 'front_half'; $teller++;}else{echo 'front_rest';if($teller==2){echo ' front_rest_border';} $teller++;} ?>">			
						<?php		
							$feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
							
							$bloginfo = get_bloginfo('template_url');
							
							if($feat_image && $teller==1) {
								echo "<img src='" . $bloginfo .  "/timthumb.php?src=" . $feat_image . "&w=468&h=300' />";
							}
							else if($feat_image && $teller>1) {
								echo "<img class='front_rest_img' src='" . $bloginfo .  "/timthumb.php?src=" . $feat_image . "&w=140&h=130' />";
							}
						?>
					<h2 class="front_title"><?php the_title(); ?></h2>
					<div class="front_content"><?php the_excerpt(); ?></div>
					<a class="lesmer" href="<?php echo get_permalink( get_the_ID() ); ?>">Les mer</a>
				</div>
				
				<?php endwhile; endif;?>	
				<?php wp_reset_query(); ?>
				<div class="clearboth"></div>
				</div> <!-- /frontpage_content -->

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar( 'front' ); ?>
<?php get_footer(); ?>