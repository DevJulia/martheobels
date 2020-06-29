<?php

if (file_exists(__DIR__.'/vendor/autoload.php')) {
    require __DIR__.'/vendor/autoload.php';
}

/* Constantes */
define('THEME_PATH', get_stylesheet_directory());
define('THEME_URL', get_stylesheet_directory_uri());

/* Chargements des scripts CSS et JS */
require_once 'includes/scripts.php';
require_once 'includes/styles.php';


/* Chargements des CPT & taxonomies */
//require_once 'includes/custom_post_type/equipe.php';
//require_once 'includes/taxonomy/product_typology.php';

require_once 'includes/storefront_hooks.php';
require_once 'includes/api.php';
require_once 'includes/acf.php';
require_once 'includes/woocommerce.php';

/**
 * Templates and Page IDs without editor
 */
function ea_disable_editor( $id = false ) {

	$excluded_templates = array(
		'homepage.php'
	);

	$excluded_ids = array(
		// get_option( 'page_on_front' )
	);

	if( empty( $id ) )
		return false;

	$id = intval( $id );
	$template = get_page_template_slug( $id );

	return in_array( $id, $excluded_ids ) || in_array( $template, $excluded_templates );
}

/**
 * Disable Gutenberg by template
 *
 */
function ea_disable_gutenberg( $can_edit, $post_type ) {

	if( ! ( is_admin() && !empty( $_GET['post'] ) ) )
		return $can_edit;

	if( ea_disable_editor( $_GET['post'] ) )
		$can_edit = false;

	return $can_edit;

}
add_filter( 'gutenberg_can_edit_post_type', 'ea_disable_gutenberg', 10, 2 );
add_filter( 'use_block_editor_for_post_type', 'ea_disable_gutenberg', 10, 2 );
