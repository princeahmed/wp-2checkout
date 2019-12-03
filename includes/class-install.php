<?php

defined( 'ABSPATH' ) || exit;

/**
 * Class Install
 */
class WP_Popup_Install {

	public static function activate() {
		self::update_option();
	}


	private static function update_option() {
		update_option( 'wp_popup_flush_rewrite_rules', true );
	}

	private function create_tables() {
		$tables = "CREATE TABLE `orders` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `name` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
 `email` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
 `card_num` bigint(20) NOT NULL,
 `card_exp_month` int(2) NOT NULL,
 `card_exp_year` year(4) NOT NULL,
 `card_cvv` int(3) NOT NULL,
 `item_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
 `item_number` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
 `item_price` float(10,2) NOT NULL,
 `currency` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
 `paid_amount` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
 `order_number` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
 `txn_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
 `payment_status` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
 `created` datetime NOT NULL,
 `modified` datetime NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
	}

}