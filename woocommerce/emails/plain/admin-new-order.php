<?php
/**
 * Order details table shown in emails.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/plain/email-order-details.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woo.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_email_before_order_table', $order, $sent_to_admin, $plain_text, $email );

/* translators: %1$s: Order ID. %2$s: Order date */
echo wp_kses_post( 
    $before . sprintf( __( 'Order: #%s', 'woocommerce' ) . "\n" . $after . '<time datetime="%s">%s</time>', 
        $order->get_order_number(), date( 'F j, Y, g:i a', $order->get_date_created ()->getOffsetTimestamp()), 
        date( 'F j, Y, g:i a', 
            $order->get_date_created ()->getOffsetTimestamp()
        ) . "\n"
    ) 
);

/* fix delivery */

$delivery_address = get_post_meta($order->get_id(), '_delivery_address', true);
$da_var = empty($delivery_address) ? "STORE PICKUP" : "DELIVERY";

if( $da_var ) {
    echo wp_kses_post( "\n" . $da_var . "\n--------------------------\n" );
} 

echo wp_kses_post( $order->get_billing_first_name() . ' ' . $order->get_billing_last_name() ) . "\n";
echo wp_kses_post( $order->get_billing_phone() ) . "\n";
echo wp_kses_post( $order->get_billing_email() ) . "\n";
if($delivery_address) {
	echo wp_kses_post( $delivery_address ) . "\n";
} 
// else { 
// 	echo "\n" ;
// }
if($order->get_customer_note()){
	echo wp_kses_post( $order->get_customer_note() );
}
echo "\n====================\n";

/* translators: %1$s: Order ID. %2$s: Order date */
echo wc_get_email_order_items( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	$order,
	array(
		'show_sku'      => $sent_to_admin,
		'show_image'    => false,
		'image_size'    => array( 32, 32 ),
		'plain_text'    => true,
		'sent_to_admin' => $sent_to_admin,
	)
);

echo "\n====================\n\n";

$item_totals = $order->get_order_item_totals();

if ( $item_totals ) {
	//$i = 0;
	foreach ( $item_totals as $total ) {
		if( $total['label'] !== 'Shipping:' ) {
			echo wp_kses_post( $total['label'] . " " . $total['value'] ) . "\n";
		}
	}
}

// if ( $order->get_customer_note() ) {
// 	echo esc_html__( 'Note:', 'woocommerce' ) . "\t " . wp_kses_post( wptexturize( $order->get_customer_note() ) ) . "\n";
// }

// if ( $sent_to_admin ) {
// 	/* translators: %s: Order link. */
// 	echo "\n" . sprintf( esc_html__( 'View order: %s', 'woocommerce' ), esc_url( $order->get_edit_order_url() ) ) . "\n";
// }

do_action( 'woocommerce_email_after_order_table', $order, $sent_to_admin, $plain_text, $email );
