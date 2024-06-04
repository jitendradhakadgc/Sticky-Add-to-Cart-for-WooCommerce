<?php
/**
 * Email Order Items (plain)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/plain/email-order-items.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woo.com/document/template-structure/
 * @package     WooCommerce\Templates\Emails\Plain
 * @version     5.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

foreach ( $items as $item_id => $item ) :
	if ( apply_filters( 'woocommerce_order_item_visible', true, $item ) ) {
        
		$product       = $item->get_product();
		$sku           = '';
		$purchase_note = '';

        // echo wp_kses_post( "item" . $item ) . "\n";
        // echo wp_kses_post( "product" . $product ) . "\n\n\n\n";

		if ( is_object( $product ) ) {
			$sku           = $product->get_sku();
			$purchase_note = $product->get_purchase_note();
		}

		// phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
		// echo wp_kses_post( "metadata" . $item->get_meta_data() . "\n\n\n");
		echo "\n";
        echo apply_filters( 'woocommerce_email_order_item_quantity', $item->get_quantity(), $item ) . ' X ';
		echo wp_kses_post( apply_filters( 'woocommerce_order_item_name', $item->get_name(), $item, false ) );

		// echo wp_kses_post( str_replace( '|', '\n', $item->get_name())  );

		echo ' = ' . $order->get_formatted_line_subtotal( $item ) . "\n";
		// phpcs:enable WordPress.Security.EscapeOutput.OutputNotEscaped

		// allow other plugins to add additional product information here.
		do_action( 'woocommerce_order_item_meta_start', $item_id, $item, $order, $plain_text );
		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

		// foreach ( $item->get_formatted_meta_data() as $meta_id => $meta ) {
		// 	$edited_order_meta = $meta->display_value;
		// 	$edited_order_meta = str_replace("+", "(", $edited_order_meta );
		// 	$edited_order_meta = $edited_order_meta . ")";
		// 	echo wp_kses_post( "\t  " . str_replace(" | ", "\n\t  ", $edited_order_meta) );
		// }
		foreach ($item->get_formatted_meta_data() as $meta_id => $meta) {
		    $string = $meta->display_value;

		    // Split the string into individual items
		    $items = explode(' | ', $string);

		    // Process each item
		    foreach ($items as $item) {
		        // Find the position of the plus symbol
		        $plus_position = strpos($item, '+');

		        // Extract the components
		        $name = trim($item); // Item name
		        $price = ''; // Initialize price

		        // If plus symbol exists, extract the price
		        if ($plus_position !== false) {
		            $name = trim(substr($item, 0, $plus_position)); // Item name
		            $price = trim(substr($item, $plus_position + 1)); // Price

		            // Replace "+" with "($" in price
		            $price = str_replace('+', '($', $price);
		        }
		        
		        // Output the formatted item with indentation
		        echo "\t$name" . ($price ? "($price)" : "") . "\n";
		    }
		}

		// allow other plugins to add additional product information here.
		do_action( 'woocommerce_order_item_meta_end', $item_id, $item, $order, $plain_text );
	}
endforeach;
