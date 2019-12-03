<?php

class WP_2Checkout_Shortcodes{
	public function __construct() {
		add_shortcode('form', [$this, 'form']);
	}

	function form(){
		ob_start();
		include WP_2CHECKOUT_TEMPLATES.'/form.php';

		return ob_get_clean();
	}

}

new WP_2Checkout_Shortcodes();