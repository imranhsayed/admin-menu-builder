<?php
/**
 * Custom functions for Plugin.
 * Contains definition of constants, file includes and enqueue stylesheets and scripts.
 *
 * @package Admin Menu Builder
 */

/* Define Constants */
define( 'IHS_ADMIN_MENU_URI', plugins_url( 'admin-menu-builder' ) );
define( 'IHS_ADMIN_MENU_JS_URI', plugins_url( 'admin-menu-builder' ) . '/vendor/js' );
define( 'IHS_ADMIN_MENU_CSS_URI', plugins_url( 'admin-menu-builder' ) . '/css' );
define( 'IHS_ADMIN_MENU_ADMIN_JS_URI', plugins_url( 'admin-menu-builder' ) . '/admin/js' );
define( 'IHS_ADMIN_MENU_ADMIN_CSS_URI', plugins_url( 'admin-menu-builder' ) . '/admin/css' );


if ( ! function_exists( 'ihs_admin_menu_enqueue_scripts' ) ) {
	/**
	 * Enqueue Styles and Scripts.
	 */
	function ihs_admin_menu_enqueue_scripts() {
		wp_enqueue_style( 'ihs_admin_menu_styles', IHS_ADMIN_MENU_CSS_URI . '/style.css' );
		wp_enqueue_script( 'ihs_admin_menu_main_js', IHS_ADMIN_MENU_JS_URI . '/main.js', array( 'jquery' ), '', true );
	}
	add_action( 'wp_enqueue_scripts', 'ihs_admin_menu_enqueue_scripts' );
}

if ( ! function_exists( 'ihs_menu_enqueue_admin_scripts' ) ) {
	/**
	 * Enqueue Styles and Scripts for admin.
	 *
	 * @param {string} $hook Hook.
	 */
	function ihs_menu_enqueue_admin_scripts( $hook ) {
		if ( 'edit.php' != $hook ) {
			return;
		}
		wp_enqueue_style( 'ihs_admin_menu_admin_styles', IHS_ADMIN_MENU_ADMIN_CSS_URI. '/admin.css' );
		wp_enqueue_script( 'ihs_admin_menu_admin_script', IHS_ADMIN_MENU_ADMIN_JS_URI . '/admin.js', array( 'jquery' ), '', true );
	}
	add_action( 'admin_enqueue_scripts', 'ihs_menu_enqueue_admin_scripts' );
}

// Include create-admin-menu.php
require_once 'inc/create-admin-menu.php';