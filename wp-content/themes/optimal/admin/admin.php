<?php

/* Lager default options */
function miba_get_default_options() {
	$options = array(
		'front_slug' => '',
		'front_slug_link' => '',
		'facebook' => '',
		'youtube' => '',
		'twitter' => '',
		'rss' => '',
		'footer_copy' => '',
		'footer_levert' => '',
		'front_slug_linken' => '',
		'front_slug_linken_text' => ''
	);
	return $options;
}

/* Installerer options */
function miba_options_init() {
	$miba_options = get_option('theme_miba_options');
	
	if(false === $miba_options) {
		$miba_options = miba_get_default_options();
		add_option('theme_miba_options', $miba_options);
	}
}

add_action('after_setup_theme', 'miba_options_init');

/* Oppretter menu */
function miba_menu_options() {
	add_theme_page('miba options', 'Miba', 'edit_theme_options', 'miba_settings', 'miba_admin_options_page');
}

add_action('admin_menu', 'miba_menu_options');

/* Setter utseende*/
function miba_admin_options_page() {
	?>
	
	<div class="wrap">
		<div id="icon-themes" class="icon32"><br/></div>
		<h2>Instillinger</h2>
		
		<?php settings_errors('miba-settings-errors'); ?>
		
		
		<form id="form-miba-options" action="options.php" method="post" enctype="multipart/form-data">
		
		<?php 
			settings_fields('theme_miba_options');
			do_settings_sections('miba');
		
			
		
		?>
		
		<p class="submit">
			<input name="theme_miba_options[submit]" id="submit_options_form" type="submit" class="button-primary" value="<?php esc_attr_e('Lagre', 'miba'); ?>" />
			<input name="theme_miba_options[reset]" type="submit" class="button-secondary" value="<?php esc_attr_e('Reset', 'miba'); ?>" />
		</p>
		
		</form>
		
	</div>

	<?php	
}

/* Legger til settings */
function miba_options_settings_init() {
	
	register_setting('theme_miba_options','theme_miba_options', 'miba_options_validate');
	
	add_settings_section('miba_settings_frontpage','Froside','miba_settings_frontpage_text', 'miba');
	add_settings_field('miba_setting_front_slug', 'Forside slagord', 'miba_setting_front_slug', 'miba', 'miba_settings_frontpage');
	
	add_settings_section('miba_settings_footer','Footer','miba_settings_footer_text', 'miba');
	add_settings_field('miba_setting_footer_copy', 'Footer instillinger', 'miba_setting_footer_copy', 'miba', 'miba_settings_footer');
	
	add_settings_section('miba_settings_sosialemedier', 'Sosiale Medier', 'miba_settings_sosialemedier_text', 'miba');
	add_settings_field('miba_setting_sm', 'Medier', 'miba_setting_sm', 'miba', 'miba_settings_sosialemedier');
	
	
}

add_action('admin_init','miba_options_settings_init');

/* Logo settings */
function miba_setting_front_slug() {
	$miba_options = get_option('theme_miba_options');
	
	global $wpdb;
	
	?>
	
		<input type="text" id="front-slug" name="theme_miba_options[front_slug]" value="<?php echo $miba_options['front_slug']; ?>" /><span class="description">Slagord på forside</span><br/>
		<input type="text" id="front-slug-link" name="theme_miba_options[front_slug_link]" value="<?php echo $miba_options['front_slug_link']; ?>" /><span class="description">Navnet på link kanppen siden av slagordet</span><br/>
		
		<?php 
			
			$result = $wpdb->get_results("SELECT post_type, guid, ID, post_title FROM $wpdb->posts WHERE post_type = 'post' OR post_type = 'page'");

		?>
		
		<select id="front_post_page">
			<option value=""><?php if($miba_options['front_slug_linken_text'] !=  '') { echo $miba_options['front_slug_linken_text']; }else {echo 'Velg side';} ?></option>
			<?php 
				if($result) {
					foreach($result as $res) { ?>
						<option value="<?php echo $res->guid; ?>">
							<?php echo $res->post_title; ?>
						</option>>
						
					<?php }
				}
			 ?>
		</select><span class="description">Hvilken side skal linken like til</span>
		<input type="hidden" id="front-slug-linken" name="theme_miba_options[front_slug_linken]" value="<?php $miba_options['front_slug_linken']; ?>"/>
		<input type="hidden" id="front-slug-linken-text" name="theme_miba_options[front_slug_linken_text]" value="<?php $miba_options['front_slug_linken_text']; ?>"/>

	<?php
}

/* Validere funksjonen */
function miba_options_validate($input) {
	$default_options = miba_get_default_options();
	$valid_input = $default_options;
	
	$submit = ! empty($input['submit']) ? true : false;
	$reset = ! empty($input['reset']) ? true : false;
	
	if($submit) {
		$valid_input['front_slug'] = $input['front_slug'];
		$valid_input['front_slug_link'] = $input['front_slug_link'];
		$valid_input['facebook'] = $input['facebook'];
		$valid_input['youtube'] = $input['youtube'];
		$valid_input['twitter'] = $input['twitter'];
		$valid_input['rss'] = $input['rss'];
		$valid_input['footer_levert'] = $input['footer_levert'];
		$valid_input['footer_copy'] = $input['footer_copy'];
		$valid_input['front_slug_linken'] = $input['front_slug_linken'];
		$valid_input['front_slug_linken_text'] = $input['front_slug_linken_text'];
	}	
	elseif($reset) {
		$valid_input['front_slug'] = $default_options['front_slug'];
		$valid_input['front_slug_link'] = $default_options['front_slug_link'];
		$valid_input['facebook'] = $default_options['facebook'];
		$valid_input['youtube'] = $default_options['youtube'];
		$valid_input['twitter'] = $default_options['twitter'];
		$valid_input['rss'] = $default_options['rss'];
		$valid_input['footer_levert'] = $default_options['footer_levert'];
		$valid_input['footer_copy'] = $default_options['footer_copy'];
		$valid_input['front_slug_linken'] = $default_options['front_slug_linken'];
		$valid_input['front_slug_linken_text'] = $default_options['front_slug_linken_text'];
	}
		
	
	return $valid_input;
}

/* Legge til javascript */
function miba_options_enqueue_scripts() {
	/* wp_register_script('miba-upload', get_template_directory_uri() . '/admin/js/miba-upload.js', array('jquery', 'media-upload', 'thickbox')); */
	
	wp_register_script('adminjs', get_template_directory_uri() . '/admin/js/admin.js');
	
	if('appearance_page_miba_settings' == get_current_screen() -> id) {
		wp_enqueue_script('jquery');
		
		wp_enqueue_script('thickbox');
		wp_enqueue_style('thickbox');
		
		wp_enqueue_script('media-upload');
		/* wp_enqueue_script('miba-upload'); */
		
		wp_enqueue_script('adminjs');
		
		wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_script( 'wp-color-picker' );
	}
}

add_action('admin_enqueue_scripts','miba_options_enqueue_scripts');


/* Sosiale Medier */
function miba_setting_sm() {
	$miba_options = get_option('theme_miba_options');
	?>
	
	<ul>
		<li><label for="facebook">Facebook: </label> <input type="text" name="theme_miba_options[facebook]" id="facebook" value="<?php echo esc_url($miba_options['facebook']);  ?>" /></li>
		<li><label for="youtube">Youtube: </label> <input type="text" name="theme_miba_options[youtube]" id="youtube" value="<?php echo esc_url($miba_options['youtube']);  ?>" /></li>
		<li><label for="twitter">Twitter: </label> <input type="text" name="theme_miba_options[twitter]" id="twitter" value="<?php echo esc_url($miba_options['twitter']);  ?>" /></li>
		<li><label for="rss">RSS: </label> <input type="text" name="theme_miba_options[rss]" id="rss" value="<?php echo esc_url($miba_options['rss']);  ?>" /></li>
	</ul>
	
	<?php
}

/* Footer instillinger */
function miba_setting_footer_copy() {
	$miba_options = get_option('theme_miba_options');
	
	?>
	
		<ul>
			<li><label for="footer_copy">Footer tekst: </label> <input type="text" name="theme_miba_options[footer_copy]" id="footer-copy" value="<?php echo $miba_options['footer_copy']; ?>"/></li>
		</ul>
	
	
	<?php
}


