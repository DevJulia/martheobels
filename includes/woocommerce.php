<?php

add_filter( 'wc_add_to_cart_message', 'custom_add_to_cart_message' );
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
    <label for="upsizing_products"><?php _e( 'Upsizing Product', 'woocommerce' ); ?></label>
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

add_action( 'woocommerce_single_product_summary' , 'mobels_show_accessories', 20 );
function mobels_show_accessories() {
  global $post;
  print_r( get_post_meta( $post->ID, '_upsizing_products_ids', true ) );
}