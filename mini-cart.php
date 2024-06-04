<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

if ( ! class_exists( 'WooCommerce' ) ) {
    return; // Exit if WooCommerce is not active.
}
?>
<style>
	#page-header{
		width: 70%;
		float: left;
	}
.cst-cart .variation {
    display: grid;
    grid-template-columns: auto 1fr; 
    gap: 0.5rem;
    align-items: start;
}

.cst-cart .variation dt,
.cst-cart .variation dd {
    margin: 0;
    padding: 0rem 0;
}
	.cst-cart .widget_shopping_cart_content{
		padding-bottom: 10px;
	}
.cst-cart .variation dd p {
    margin: 0;
}
.remove-from-cart {
    color: #1fd808;
    text-decoration: none;
    margin-left: 0px;
    font-size: 20px;
}
.cst-cart .variation dt {
    position: relative;
    list-style-type: disc;
    margin-left: 0px;
}
.cst-cart .woocommerce .variation p {
    font-weight: 600;
}
	.cst-cart .woocommerce-mini-cart__buttons.buttons{
		margin-bottom: 10px;
	}
	@media (max-width: 480px) {
		#page-header{
		width: 100%;
		float: left;
	}
	}
	/* Small devices (phones, 600px and down) */
@media only screen and (max-width: 600px) {
	#page-header {
		width: 100%;
		float: left;
	}
	.custom-layout .cart-area {
   		z-index: 1;
	}
	.w-cart.dropdown_slide {
		display: block;
	}
	.w-cart-dropdown{
		display: none;
	}
}


/* Medium devices (portrait tablets and large phones, 600px and up) */
@media only screen and (min-width: 600px) and (max-width: 768px) {
	#page-header {
			width: 100%;
			float: left;
		}
		.custom-layout .cart-area {
   		z-index: 1;
	}
	.w-cart.dropdown_slide {
		display: block;
	}
	.w-cart-dropdown{
		display: none;
	}
}
</style>
<div class="w-cart-dropdown cst-cart">
    <div class="widget woocommerce widget_shopping_cart">
    <p class="cst_order">
                        <?php _e( 'YOUR ORDER', 'woocommerce' ); ?>
            </p>
        <div class="widget_shopping_cart_content">
            
            <ul class="woocommerce-mini-cart cart_list product_list_widget" style="max-height: 20rem;">
                    
                <?php if ( WC()->cart->get_cart_contents_count() == 0 ) : ?>
                    <li class="woocommerce-mini-cart-item mini_cart_item">
                        <?php _e( 'No products in the cart.', 'woocommerce' ); ?>
                    </li>
                <?php else : ?>
                    <?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) : ?>
                        <?php
                        $_product = $cart_item['data'];
                        if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 ) :
                            $product_permalink = $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '';
                        ?>
                            <li class="woocommerce-mini-cart-item mini_cart_item" data-product_id="<?php echo esc_attr( $_product->get_id() ); ?>">
                                <a href="<?php echo esc_url( wc_get_cart_remove_url( $cart_item_key ) ); ?>" class="remove remove_from_cart_button" aria-label="<?php _e( 'Remove this item', 'woocommerce' ); ?>" data-product_id="<?php echo esc_attr( $cart_item['product_id'] ); ?>" data-cart_item_key="<?php echo esc_attr( $cart_item_key ); ?>" data-product_sku="<?php echo esc_attr( $_product->get_sku() ); ?>">×</a>
                                <a href="<?php echo esc_url( $product_permalink ); ?>">
                                    <?php echo $_product->get_image(); ?>
                                    <span class="product-title"><?php echo $_product->get_name(); ?></span>
                                </a>
                                <span class="quantity"><?php echo sprintf( '%s × %s', $cart_item['quantity'], $_product->get_price_html() ); ?></span>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>

            <p class="woocommerce-mini-cart__total total">
                <strong><?php _e( 'Subtotal:', 'woocommerce' ); ?></strong> <span class="woocommerce-Price-amount amount"><?php echo WC()->cart->get_cart_subtotal(); ?></span>
            </p>

            <p class="woocommerce-mini-cart__buttons buttons">
                <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="button wc-forward"><?php _e( 'View cart', 'woocommerce' ); ?></a>
                <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="button checkout wc-forward"><?php _e( 'Checkout', 'woocommerce' ); ?></a>
            </p>

            <span class="us_mini_cart_amount" style="display: none;"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
        </div>
				
    </div>
</div>

