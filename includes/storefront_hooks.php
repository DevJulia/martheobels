<?php
/**
 * Surcharge de fonctions ou des hooks du thème Storefront
 */

add_action('init', function() {
    remove_action( 'storefront_header', 'storefront_product_search', 40);
    remove_action( 'storefront_header', 'storefront_primary_navigation', 50);
    remove_action( 'storefront_header', 'storefront_secondary_navigation', 30);

    remove_action( 'storefront_header', 'storefront_header_container', 0);
    remove_action( 'storefront_header', 'storefront_header_container_close', 41);
    add_action( 'storefront_header', 'mobels_primary_navigation', 50);
    add_action( 'storefront_header', 'mobels_menu', 65 );

    remove_action( 'storefront_footer', 'storefront_credit', 20);
    remove_action( 'woocommerce_single_product_summary', 'storefront_edit_post_link', 60);


    /*
    remove_action( 'storefront_post_content_before', 'storefront_post_thumbnail', 10 );

    remove_action( 'storefront_single_post_bottom', 'storefront_post_taxonomy', 5 );
    remove_action( 'storefront_single_post_bottom', 'storefront_post_nav', 10 );
    remove_action( 'storefront_single_post_bottom', 'storefront_display_comments', 20 );

    remove_action( 'storefront_before_content', 'woocommerce_breadcrumb', 10 );
    remove_action( 'storefront_before_content', 'woocommerce_breadcrumb', 10 );
    */
});

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
    <div class="primary-nav">
        <a href="mailto:<?= get_field('contact_email','options'); ?>"><?php the_field('contact_email', 'options'); ?></a>

        <div class="social-icons-block">
            <a href="<?= get_field('facebook', 'options'); ?>" target="_blank"><?php print_svg(get_img_url('icon-facebook.svg')) ?></a>
            <a href="<?= get_field('instagram', 'options'); ?>" target="_blank"><?php print_svg(get_img_url('icon-instagram.svg')) ?></a>
        </div>

        <a href="<?= get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>'"><?php print_svg(get_img_url('icon-account.svg')); ?></a>

    <?php
}

function mobels_menu() {
    echo '</div>'; //.primary-nav
    wp_nav_menu( array(
        'theme_location'  => 'primary',
        'container_class' => 'main-menu-container',
        'after'           => '<span class="separator"> |</span>'
    ) );
}

add_filter( 'woocommerce_get_image_size_thumbnail', function( $size ) {
    return array(
    'width' => 445,
    'height' => 445,
    'crop' => 1,
    );
} );

/**
 * Sidebar on single product page
 */
add_action( 'get_header', 'mobels_remove_storefront_sidebar' );
function mobels_remove_storefront_sidebar() {
   if ( is_product() ) {
      remove_action( 'storefront_sidebar', 'storefront_get_sidebar', 10 );
   }
}

add_action( 'woocommerce_before_single_product_summary', 'mobels_single_product_wrapper', 15);
function mobels_single_product_wrapper() {
    echo '<div class="single-product-wrapper">';
    echo '<div class="single-product-info-wrapper">';
}

add_action( 'woocommerce_after_single_product_summary', 'mobels_product_sidebar', 5);
function mobels_product_sidebar() {
    global $post;
    $posts = get_post_meta( $post->ID, '_upsizing_products_ids', true );
    if ($posts) {
        echo '</div>';
        echo '<div class="single-product-sidebar">';
        echo '<h2>Ajouter un accessoire</h2>';

        foreach ($posts as $post) {
            $product = wc_get_product( $post );
            ?>

            <div class="product-acc">
                <a class="acc--image" href="<?php echo $product->get_permalink();?>">
                    <?php echo $product->get_image(); ?>
                </a>

                <div class="acc--text">
                    <a class="title" href="<?php echo $product->get_permalink();?>"><?php echo $product->get_name(); ?></a>
                    <p><?php echo $product->get_short_description(); ?></p>
                </div>
            </div>

            <?php
        }
    
        echo '</div>';
        echo '</div>'; //close product wrapper
    }
}

