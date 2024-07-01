<?php
/**
 * Plugin Name: Post Managesment Plugin
 * Description: This is the plugin for Partics purpose.
*/

class post_managesment_plugin {

	private static $instance;

	public static function get_instance () {
		if ( ! self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	private function __construct() {
		$this->require_classes();
	}

	private function require_classes() {
		require_once __DIR__ . '/includes/admin-menu.php';
		new Post_Management_Admin_Menu();
	}
}

post_managesment_plugin::get_instance();