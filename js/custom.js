jQuery(document).ready(function($) {
	$('.w-cart-dropdown').hide();
	 // Function to check if the current view is mobile
    function isMobileView() {
        return window.matchMedia('(max-width: 1024px)').matches;
    }

    // Event listener for the cart link click
    $('.w-cart-link').on('click', function(event) {
		
		$('.w-cart-dropdown').hide();
        event.preventDefault(); // Prevent the default action of the <a> tag
        if (isMobileView()) {
            $('html, body').animate({
                scrollTop: $('.cart-area').offset().top
            }, 'slow');
        }
    });
	 
	// Add click event listener to cart elements with the specified classes
    /**
	$(document).on('click', 'li.woocommerce-mini-cart-item.mini_cart_item', function(event) {
        // Check if the clicked element is the first 'a' element with the class 'remove'
        if ($(event.target).is('a.remove')) {
            return; // If it is, do nothing and return
        }

        event.preventDefault(); // Prevent default action if necessary

        // Find the 'a' elements within this 'li' that have the class 'remove' and disable them
        var parentLi = $(this).closest('li.woocommerce-mini-cart-item.mini_cart_item');
        var removeLink = parentLi.find('a.remove');
        removeLink.attr('disabled', true);

        // Get the product ID
        var productId = removeLink.data('product_id');

        // Log the product ID to the console for debugging
        console.log(productId);

        // Trigger click on the associated element
        $(`.cst_jeet${productId} .name`).trigger('click');
    }); */

	$(document).on('click', '.remove-from-cart', function(e) {
        e.preventDefault();
        var $button = $(this);
        var product_id = $button.data('product_id');
        var data = {
            action: 'remove_from_cart',
            product_id: product_id
        };
        $.post(customMiniCart.ajax_url, data, function(response) {
            if (response.success) {
                // Refresh the mini cart
                $(document.body).trigger('wc_fragment_refresh');
            } else {
                console.log('Error removing items from cart');
            }
        });
    });
});

/**
 * Custom JavaScript for adjusting cart area height dynamically.
 * Author: David Gabran
 */
(function($) {
    $(document).ready(function() {
        // Function to adjust cart area height
        function adjustCartHeight() {
            var cartItems = $('.custom-mini-cart .cart-item').length;
            var cartArea = $('.custom-mini-cart .cart-area');
            var cartItemHeight = $('.custom-mini-cart .cart-item').outerHeight(true);
            var cartHeight = cartItems * cartItemHeight;
            cartArea.css('height', cartHeight + 'px');
        }

        // Initial adjustment on page load
        adjustCartHeight();

        // Adjust height when window is resized
        $(window).resize(function() {
            adjustCartHeight();
        });
    });
})(jQuery);



/**
 * Custom JavaScript for recalling selected options in the pop-up window.
 * Author: David G
 */
(function($) {
    $(document).ready(function() {
        // Function to store selected options in local storage
        function storeSelectedOptions(productId, selectedOptions) {
            localStorage.setItem('selectedOptions_' + productId, selectedOptions);
        }

        // Function to recall selected options and populate them in the pop-up window
        function recallSelectedOptions(productId) {
            // Get the selected options for the specified product ID
            var selectedOptions = localStorage.getItem('selectedOptions_' + productId);
            
            // Debug message to check selected options
            console.log('Recalled options for Product ID ' + productId + ': ' + selectedOptions);
            
            // If selected options are found, populate them in the pop-up window
            if (selectedOptions) {
                // Code to populate the selected options in the pop-up window
                // Replace this with your actual code to populate the options
                alert('Selected options: ' + selectedOptions);
            }
        }

        // Event listener for clicking on food item names
        $('.custom-mini-cart .cart-item .product-title').on('click', function() {
            // Get the product ID associated with the clicked item
            var productId = $(this).closest('.cart-item').data('product-id');
            
            // Debug message to check product ID
            console.log('Clicked on product with ID: ' + productId);
            
            // Get the selected options for the clicked product
            var selectedOptions = $(this).closest('.cart-item').find('.variation').text();
            
            // Debug message to check selected options
            console.log('Selected options for Product ID ' + productId + ': ' + selectedOptions);
            
            // Store the selected options in local storage
            storeSelectedOptions(productId, selectedOptions);

            // Recall selected options and populate them in the pop-up window
            recallSelectedOptions(productId);
        });

        // Event listener for clicking on "Edit Item" buttons
        $('.custom-mini-cart .cart-item .edit-item').on('click', function() {
            // Get the product ID associated with the clicked item
            var productId = $(this).closest('.cart-item').data('product-id');
            
            // Debug message to check product ID
            console.log('Clicked on "Edit Item" for product with ID: ' + productId);
            
            // Get the selected options for the clicked product
            var selectedOptions = $(this).closest('.cart-item').find('.variation').text();
            
            // Debug message to check selected options
            console.log('Selected options for Product ID ' + productId + ': ' + selectedOptions);
            
            // Store the selected options in local storage
            storeSelectedOptions(productId, selectedOptions);

            // Recall selected options and populate them in the pop-up window
            recallSelectedOptions(productId);
        });
    });
})(jQuery);








