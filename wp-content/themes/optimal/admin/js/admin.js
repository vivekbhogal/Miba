jQuery(document).ready(function($) {
	
	$('#front_post_page').change(function() {
		$('#front_post_page option:selected').each(function() {
			var t = $(this).text();
			var v = $(this).val();
			$('#front-slug-linken').attr('value', v);
			$('#front-slug-linken-text').attr('value', $.trim(t));
		});
	});
	
});