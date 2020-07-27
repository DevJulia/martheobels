<?php
/**
 * Surcharge de fonctions ou des hooks du thème Storefront
 */

add_action('init', function() {
    remove_action( 'storefront_header', 'storefront_product_search', 40);
    remove_action( 'storefront_header', 'storefront_primary_navigation', 50);
    remove_action( 'storefront_header', 'storefront_header_container', 0);
    remove_action( 'storefront_header', 'storefront_header_container_close', 41);
    add_action( 'storefront_header', 'mobels_primary_navigation', 50);

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


if ( ! function_exists( 'storefront_site_title_or_logo' ) ) {
	/**
	 * Display the site title or logo
	 *
	 * @since 2.1.0
	 * @param bool $echo Echo the string or return it.
	 * @return string
	 */
	function storefront_site_title_or_logo( $echo = true ) {
        $tag = 'div';

        $logo = get_field('logo', 'options');

        if ($logo) {
            $logo = '<img src="' . $logo['url'] .'" alt="'. $logo['alt'] .'" />' ; 
            $html = '<' . esc_attr( $tag ) . ' class="beta site-title"><a href="' . esc_url( home_url( '/' ) ) . '" rel="home">' . $logo . '</a></' . esc_attr( $tag ) . '>';
        } else {
            $html = '<' . esc_attr( $tag ) . ' class="beta site-title"><a href="' . esc_url( home_url( '/' ) ) . '" rel="home">' . esc_html( get_bloginfo( 'name' ) ) . '</a></' . esc_attr( $tag ) . '>';
        }

		if ( ! $echo ) {
			return $html;
		}

		echo $html; // WPCS: XSS ok.
	}
}

if ( ! function_exists( 'storefront_primary_navigation_wrapper' ) ) {
	/**
	 * The primary navigation wrapper
	 */
	function storefront_primary_navigation_wrapper() {
		echo '<div class="storefront-primary-navigation">';
	}
}

if ( ! function_exists( 'storefront_primary_navigation_wrapper_close' ) ) {
	/**
	 * The primary navigation wrapper close
	 */
	function storefront_primary_navigation_wrapper_close() {
		echo '</div>';
	}
}


if ( ! function_exists( 'storefront_cart_link' ) ) {
	/**
	 * Cart Link
	 * Displayed a link to the cart including the number of items present and the cart total
	 *
	 * @return void
	 * @since  1.0.0
	 */
	function storefront_cart_link() {
		?>
            <a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'storefront' ); ?>"><?php print_svg(get_img_url('icon-cart.svg')); ?>
                <?php 
                    $cart_count = WC()->cart->get_cart_contents_count();
                ?>
                <?php if ($cart_count) : ?>
                    <div class="count"><?php echo $cart_count; ?></div>
                <?php endif; ?>
            </a>
		<?php
	}
}

function mobels_primary_navigation() {
    ?>
    <a href="mailto:<?= get_field('contact_email','options'); ?>"><?php the_field('contact_email', 'options'); ?></a>

    <div class="social-icons-block">
        <a href="<?= get_field('facebook', 'options'); ?>" target="_blank"><?php print_svg(get_img_url('icon-facebook.svg')) ?></a>
        <a href="<?= get_field('instagram', 'options'); ?>" target="_blank"><?php print_svg(get_img_url('icon-instagram.svg')) ?></a>
    </div>

    <a href="<?= get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>'"><?php print_svg(get_img_url('icon-account.svg')); ?></a>

    <?php
}

add_filter( 'woocommerce_get_image_size_thumbnail', function( $size ) {
    return array(
    'width' => 445,
    'height' => 445,
    'crop' => 0,
    );
} );