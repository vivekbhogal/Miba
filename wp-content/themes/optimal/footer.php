<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

<?php $miba_options = get_option('theme_miba_options'); ?>


	</div><!-- #main .wrapper -->
	<div id="footer-sidebar" class="secondary">
		<div id="footer-1">
			<?php
			if(is_active_sidebar('footer-1')){
			dynamic_sidebar('footer-1');
			}
			?>
		</div>
		<div id="footer-2">
			<?php
			if(is_active_sidebar('footer-2')){
			dynamic_sidebar('footer-2');
			}
			?>
		</div>
		<div id="footer-3">
			<?php
			if(is_active_sidebar('footer-3')){
			dynamic_sidebar('footer-3');
			}
			?>
		</div>
		<div id="footer-4">
			<?php
			if(is_active_sidebar('footer-4')){
			dynamic_sidebar('footer-4');
			}
			?>
		</div>
	</div>
	<footer id="colophon" role="contentinfo">
		<div class="site-info">
			
			<p class="copyright">Copyright &copy; <?php bloginfo('name'); ?><?php if($miba_options['footer_copy']) : ?> -  <?php echo $miba_options['footer_copy']; ?><?php endif; ?></p>
			<p class="levertav">Levert av <a href="http://www.optimalnorge.no">Optimal Norge AS</a></p>
			
			<div class="clearboth"></div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>