<?php
/* Custom functions code goes here. */

function custom_mini_cart_scripts() {
    if ( ! class_exists( 'WooCommerce' ) ) {
        return; // Exit if WooCommerce is not active.
    }

    $random_version = time();
    wp_enqueue_style( 'custom-mini-cart-style', get_stylesheet_directory_uri() . '/css/min-cartstyle.css', array(), $random_version );
    wp_enqueue_script( 'woocommerce', null, array(), $random_version, true );
    wp_enqueue_script( 'wc-cart-fragments', null, array(), $random_version, true );
    wp_enqueue_script( 'custom-js', get_stylesheet_directory_uri() . '/js/custom.js', array( 'jquery' ), $random_version, true );

    wp_localize_script( 'custom-js', 'customMiniCart', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
    ) );
}
add_action( 'wp_enqueue_scripts', 'custom_mini_cart_scripts' );


function update_custom_mini_cart() {
    if ( ! class_exists( 'WooCommerce' ) ) {
        return; // Exit if WooCommerce is not active.
    }

    ob_start();
    wc_get_template( 'mini-cart.php' );
    $mini_cart = ob_get_clean();
    echo $mini_cart;
    wp_die();
}
add_action( 'wp_ajax_update_custom_mini_cart', 'update_custom_mini_cart' );
add_action( 'wp_ajax_nopriv_update_custom_mini_cart', 'update_custom_mini_cart' );


function display_custom_mini_cart() {
    if ( ! class_exists( 'WooCommerce' ) ) {
        return ''; // Exit if WooCommerce is not active.
    }

    ob_start();
    wc_get_template( 'mini-cart.php' );
    return ob_get_clean();
}
add_shortcode( 'custom_mini_cart', 'display_custom_mini_cart' );

add_action('wp_ajax_remove_from_cart', 'remove_from_cart');
add_action('wp_ajax_nopriv_remove_from_cart', 'remove_from_cart'); // Allow non-logged-in users to use the AJAX action

function remove_from_cart() {
    WC()->cart->empty_cart();
    wp_send_json_success();
    wp_die();
    
}
add_action('woocommerce_after_mini_cart', 'custom_content_before_mini_cart');
function custom_content_before_mini_cart() {
    // Check if the cart is not empty
    if (WC()->cart->get_cart_contents_count() > 0) {
        echo '<a href="#" class="remove-from-cart" data-product_id="123">Delete Entire Cart</a>';
    }
	?>
<style>
.cst-cart .w-cart-dropdown ul.product_list_widget {
    max-height: 20rem;
}
</style>

<?php
}