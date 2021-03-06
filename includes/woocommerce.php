<?php
add_action('init', function() {
    remove_action( 'woocommerce_before_shop_loop', 'storefront_sorting_wrapper', 9);
    remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
    remove_action( 'woocommerce_before_shop_loop', 'storefront_woocommerce_pagination', 30);
    remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 10);
    remove_action( 'woocommerce_before_shop_loop', 'storefront_sorting_wrapper_close', 31);
    remove_action( 'woocommerce_after_shop_loop', 'woocommerce_catalog_ordering', 10);

    remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 30);
    add_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 15);

    //Product page
    remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
    add_action( 'woocommerce_single_product_summary', 'mobels_show_single_description', 25);
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
});

// Replace add to cart button by a linked button to the product in Shop and archives pages
add_filter( 'woocommerce_loop_add_to_cart_link', 'replace_loop_add_to_cart_button', 10, 2 );
function replace_loop_add_to_cart_button( $button, $product  ) {
    // Not needed for variable products
    if( $product->is_type( 'variable' ) ) return $button;

    // Button text here
    $button_text = __( "View product", "woocommerce" );

    return '<a class="view_product_button button" href="' . $product->get_permalink() . '">' . $button_text . '</a>';
}


add_filter( 'wc_add_to_cart_message_html', 'custom_add_to_cart_message' );
function custom_add_to_cart_message() {
  global $woocommerce;

  $shop    = wc_get_page_permalink( 'shop' );
  $cart    = wc_get_cart_url();
  $message = sprintf( 'Votre article a bien été ajouté. Souhaitez-vous <a href="%s">accéder au panier</a> ou <a href="%s">poursuivre vos achats</a> ?',
    esc_url( $cart ), esc_url( $shop ) );

  return $message;
}

/**
 * Remove related products output
 */
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );


// Display the custom fields in the "Linked Products" section
add_action( 'woocommerce_product_options_related', 'woocom_linked_products_data_custom_field' );

// Save to custom fields
add_action( 'woocommerce_process_product_meta', 'woocom_linked_products_data_custom_field_save' );


// Function to generate the custom fields
function woocom_linked_products_data_custom_field() {
    global $woocommerce, $post;
?>
<p class="form-field">
    <label for="upsizing_products"><?php _e( 'Accessoires liés', 'woocommerce' ); ?></label>
    <select class="wc-product-search" multiple="multiple" style="width: 50%;" id="upsizing_products" name="upsizing_products[]" data-placeholder="<?php esc_attr_e( 'Search for a product&hellip;', 'woocommerce' ); ?>" data-action="woocommerce_json_search_products_and_variations" data-exclude="<?php echo intval( $post->ID ); ?>">
        <?php
            $product_ids = get_post_meta( $post->ID, '_upsizing_products_ids', true );

            foreach ( $product_ids as $product_id ) {
                $product = wc_get_product( $product_id );
                if ( is_object( $product ) ) {
                    echo '<option value="' . esc_attr( $product_id ) . '"' . selected( true, true, false ) . '>' . wp_kses_post( $product->get_formatted_name() ) . '</option>';
                }
            }
        ?>
    </select> <?php echo wc_help_tip( __( 'Select Products Here.', 'woocommerce' ) ); ?>
</p>

<?php
}

// Function the save the custom fields
function woocom_linked_products_data_custom_field_save( $post_id ){
    $product_field_type =  $_POST['upsizing_products'];
    update_post_meta( $post_id, '_upsizing_products_ids', $product_field_type );
}


function mobels_show_single_description() {
    global $post;
    echo '<div class="product-single-description">';
    echo '<h2>Description : </h2>';
    $short_description = apply_filters( 'woocommerce_short_description', $post->post_content );
    echo $short_description;
    echo '</div>';
}

function remove_image_zoom_support() {
    remove_theme_support( 'wc-product-gallery-zoom' );
}
add_action( 'wp', 'remove_image_zoom_support', 100 );

//Add review order title
function review_order_payment_title() {
    echo '<h3>Règlement</h3>';
}
add_action('woocommerce_review_order_before_payment', 'review_order_payment_title', 30);

function my_account_title() {
    echo '<h1>Mon compte</h1>';
}
add_action('woocommerce_before_account_navigation', 'my_account_title', 30);
add_action('woocommerce_before_customer_login_form', 'my_account_title', 30);

add_filter( 'woocommerce_account_menu_items', 'custom_remove_downloads_my_account', 999 ); 
function custom_remove_downloads_my_account( $items ) {
    unset($items['downloads']);
    return $items;
}


function order_received_title() {
    echo '<h1>Confirmation de votre commande</h1>';
}
add_action('woocommerce_before_thankyou', 'order_received_title', 10);

//Edit product categories widgets
// define the woocommerce_product_categories_widget_args callback 
function filter_woocommerce_product_categories_widget_args( $list_args ) { 
    // make filter magic happen here... 
    $list_args['title_li'] = '<ul><li><a href="'. get_permalink( wc_get_page_id( 'shop' ) ) .'">Tous les articles</a></li></ul>';
    return $list_args; 
}; 
         
// add the filter 
add_filter( 'woocommerce_product_categories_widget_args', 'filter_woocommerce_product_categories_widget_args', 10, 1 ); 