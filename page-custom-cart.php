<?php
/*
Template Name: Min Cart Page
*/
get_header();
?>
<head>
    <style>
    
	.w-cart-dropdown ul.product_list_widget {
		max-height: none;
		overflow-y: auto;
		margin: 0;
	}

	/* Styles for smaller screens */
	@media (max-width: 768px) {
		.w-cart-dropdown ul.product_list_widget {
			max-height: 15rem; /* Adjust as needed */
		}
		.w-cart-dropdown ul.product_list_widget {
			max-height: none;
			overflow-y: auto;
			margin: 0;
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
</head>
<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <div class="custom-container">
            <div class="custom-layout">
                <div class="content-area">
                    <?php
                    while (have_posts()) : the_post();
                        the_content();
                    endwhile; // End of the loop.
                    ?>
                </div>
                <div class="cart-area">
                    <?php echo do_shortcode('[custom_mini_cart]'); ?>
                </div>
            </div>
        </div>
    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
?>