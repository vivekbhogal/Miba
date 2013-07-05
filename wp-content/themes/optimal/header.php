<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<style>
/* get the main font */
	@font-face {
	    font-family: 'Helvetica-BC';
	    src: url('<?php echo get_template_directory_uri(); ?>/fonts/Helvetica-BlkCon.eot');
	    src: url('<?php echo get_template_directory_uri(); ?>/fonts/Helvetica-BlkCon.eot?#iefix') format('embedded-opentype'),
	    	url('<?php echo get_template_directory_uri(); ?>/fonts/Helvetica-BlkCon.otf'),
	         url('<?php echo get_template_directory_uri(); ?>/fonts/Helvetica-BlkCon.ttf') format('truetype');
	    font-weight: normal;
	    font-style: normal;
	
	}
	@font-face {
	    font-family: 'Helvetica-C';
	    src: url('<?php echo get_template_directory_uri(); ?>/fonts/Helvetica-Con.eot');
	    src: url('<?php echo get_template_directory_uri(); ?>/fonts/Helvetica-Con.eot?#iefix') format('embedded-opentype'),
	    	url('<?php echo get_template_directory_uri(); ?>/fonts/Helvetica-Con.otf'),
	         url('<?php echo get_template_directory_uri(); ?>/fonts/Helvetica-Con.ttf') format('truetype');
	    font-weight: normal;
	    font-style: normal;
	
	}
	</style>

<?php wp_head(); ?>

<?php $miba_options = get_option('theme_miba_options'); ?>
</head>

<body <?php body_class(); ?>>
<div class="top-bar">
</div>
<div id="page" class="hfeed site">
	<header id="masthead" class="site-header" role="banner">
		<hgroup>
			<a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo get_template_directory_uri(); ?>/images/logo.png"></a>

			<div class="logo-right">><img src="<?php echo get_template_directory_uri(); ?>/images/toffingen.png"></div>
		</hgroup>		

		<?php $header_image = get_header_image();
		if ( ! empty( $header_image ) ) : ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" /></a>
		<?php endif; ?>
	</header><!-- #masthead -->
<div class="clear"></div>
	<nav id="site-navigation" class="main-navigation" role="navigation">
			<h3 class="menu-toggle"><?php _e( 'Menu', 'twentytwelve' ); ?></h3>
			<a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentytwelve' ); ?>"><?php _e( 'Skip to content', 'twentytwelve' ); ?></a>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
		</nav><!-- #site-navigation -->
<div class="clear"></div>

		<?php if(!is_front_page()):?>
			<header class="entry-header2">
				<div class="overskrift">
					<?php if(is_search()) : ?> <h1><?php printf( __( 'Search Results for: %s', 'twentytwelve' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
					<?php elseif(is_404()) : ?> <h1><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'twentytwelve' ); ?></h1>
					<?php elseif(is_category()) :?> <h1><?php printf( __( 'Category Archives: %s', 'twentytwelve' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?></h1>			
					<?php elseif(is_archive()):?> 
						<h1><?php
							if ( is_day() ) :
								printf( __( 'Daily Archives: %s', 'twentytwelve' ), '<span>' . get_the_date() . '</span>' );
							elseif ( is_month() ) :
								printf( __( 'Monthly Archives: %s', 'twentytwelve' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'twentytwelve' ) ) . '</span>' );
							elseif ( is_year() ) :
								printf( __( 'Yearly Archives: %s', 'twentytwelve' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'twentytwelve' ) ) . '</span>' );
							else :
								_e( 'Archives', 'twentytwelve' );
							endif;
						?></h1> 
					<?php else: echo "<h1>". get_the_title() ."</h1>"; ?>
					<?php endif?>
				</div>
				<div class="breadcrumbs">
					<?php if ( function_exists('yoast_breadcrumb') ) {
						yoast_breadcrumb('<p id="breadcrumbs">','</p>');
						} ?>
				</div>
			</header>	
		<?php endif;?>
		<div class="clear"></div>

<?php if (is_front_page()) {
	echo get_new_royalslider(1);
} 
 ?>
 
 <?php if (is_front_page()) {
	if($miba_options['front_slug']) {
		?>
		
		<div id="frontpage_slug" class="wrapper">
			<h2><?php echo $miba_options['front_slug']; ?></h2>
			<span class="frontpage_slug_link"><a href="<?php echo $miba_options['front_slug_linken']; ?>"><?php echo $miba_options['front_slug_link'] ?></a></span>
		</div>
		
		<?php
	}
} 
 ?>
 
	<div id="main" class="wrapper">