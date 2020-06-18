<?php
/**
 * Surcharge de fonctions ou des hooks du thème Storefront
 */

add_action('init', function() {
    remove_action( 'storefront_header', 'storefront_product_search', 40);
    remove_action( 'storefront_header', 'storefront_primary_navigation', 50);
    remove_action( 'storefront_footer', 'storefront_credit', 20);

    /*
    remove_action( 'storefront_post_content_before', 'storefront_post_thumbnail', 10 );

    remove_action( 'storefront_single_post_bottom', 'storefront_post_taxonomy', 5 );
    remove_action( 'storefront_single_post_bottom', 'storefront_post_nav', 10 );
    remove_action( 'storefront_single_post_bottom', 'storefront_display_comments', 20 );

    remove_action( 'storefront_before_content', 'woocommerce_breadcrumb', 10 );
    remove_action( 'storefront_before_content', 'woocommerce_breadcrumb', 10 );
    */

    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
});

add_filter( 'woocommerce_product_tabs', 'woo_new_product_tab' );
function woo_new_product_tab( $tabs ) {
// Adds the new tab
    $tabs['desc_tab'] = array(
        'title'     => __( 'Additional Information', 'woocommerce' ),
        'priority'  => 50,
        'callback'  => 'woo_new_product_tab_content'
    );

    return $tabs;
}

function woo_new_product_tab_content() {
    // The new tab content
    echo '<p>Lorem Ipsum</p>';
}

add_action('storefront_after_footer', 'browser_sync_script');
function browser_sync_script()
{
    ?>
    <script id="__bs_script__">//<![CDATA[
        document.write("<script async src='http://HOST:3000/browser-sync/browser-sync-client.js?v=2.26.7'><\/script>".replace("HOST", location.hostname));
    //]]></script>
    <?php
}

