<?php
/**
 * Single Product Template
 * 
 * @package Blaze_Theme
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

get_header('shop');
?>

<main id="primary" class="site-main woocommerce-single-product">

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl py-12">

        <?php
        while (have_posts()) :
            the_post();
            ?>

            <div id="product-<?php the_ID(); ?>" <?php wc_product_class('product-single', $product); ?>>

                <!-- Breadcrumbs -->
                <div class="mb-8">
                    <?php woocommerce_breadcrumb(); ?>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-12">
                    
                    <!-- Product Images -->
                    <div class="product-images">
                        <?php woocommerce_show_product_images(); ?>
                    </div>

                    <!-- Product Summary -->
                    <div class="product-summary">
                        <div class="summary entry-summary">
                            
                            <!-- Product Title -->
                            <h1 class="product_title entry-title text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                                <?php the_title(); ?>
                            </h1>

                            <!-- Product Rating -->
                            <?php woocommerce_template_single_rating(); ?>

                            <!-- Product Price -->
                            <div class="product-price mb-6">
                                <?php woocommerce_template_single_price(); ?>
                            </div>

                            <!-- Product Excerpt -->
                            <?php woocommerce_template_single_excerpt(); ?>

                            <!-- Add to Cart Form -->
                            <?php woocommerce_template_single_add_to_cart(); ?>

                            <!-- Product Meta -->
                            <div class="product_meta mt-8 pt-8 border-t border-gray-200">
                                <?php woocommerce_template_single_meta(); ?>
                            </div>

                            <!-- Share Buttons -->
                            <div class="product-share mt-6">
                                <?php woocommerce_template_single_sharing(); ?>
                            </div>

                        </div>
                    </div>

                </div>

                <!-- Product Tabs -->
                <div class="product-tabs mb-12">
                    <?php woocommerce_output_product_data_tabs(); ?>
                </div>

                <!-- Related Products -->
                <div class="related-products">
                    <?php woocommerce_output_related_products(); ?>
                </div>

            </div>

            <?php
        endwhile;
        ?>

    </div>

</main>

<style>
    /* Product Images */
    .woocommerce-product-gallery {
        position: relative;
    }

    .woocommerce-product-gallery__image {
        margin-bottom: 1rem;
    }

    .woocommerce-product-gallery__image img {
        width: 100%;
        height: auto;
        border-radius: 0.75rem;
    }

    /* Product Price */
    .product-price .price {
        font-size: 2rem;
        font-weight: 700;
        color: #DC2626;
    }

    .product-price .price del {
        color: #9CA3AF;
        font-size: 1.5rem;
        margin-right: 0.5rem;
    }

    /* Add to Cart Button */
    .single_add_to_cart_button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        padding: 1rem 2rem;
        background-color: #DC2626;
        color: white;
        font-weight: 600;
        border-radius: 0.5rem;
        border: none;
        cursor: pointer;
        transition: all 0.2s ease;
        width: 100%;
    }

    .single_add_to_cart_button:hover {
        background-color: #B91C1C;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }

    /* Product Meta */
    .product_meta {
        font-size: 0.875rem;
        color: #6B7280;
    }

    .product_meta > span {
        display: block;
        margin-bottom: 0.5rem;
    }

    .product_meta a {
        color: #DC2626;
        text-decoration: none;
        transition: color 0.2s ease;
    }

    .product_meta a:hover {
        color: #B91C1C;
    }

    /* Product Tabs */
    .woocommerce-tabs {
        background: white;
        border-radius: 0.75rem;
        padding: 2rem;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
    }

    .woocommerce-tabs .tabs {
        display: flex;
        gap: 2rem;
        border-bottom: 2px solid #E5E7EB;
        margin-bottom: 2rem;
        padding-bottom: 0;
        list-style: none;
    }

    .woocommerce-tabs .tabs li {
        margin: 0;
        padding: 0;
    }

    .woocommerce-tabs .tabs li a {
        display: block;
        padding: 1rem 0;
        color: #6B7280;
        text-decoration: none;
        font-weight: 600;
        border-bottom: 2px solid transparent;
        transition: all 0.2s ease;
    }

    .woocommerce-tabs .tabs li.active a,
    .woocommerce-tabs .tabs li a:hover {
        color: #DC2626;
        border-bottom-color: #DC2626;
    }

    /* Related Products */
    .related.products h2 {
        font-size: 1.875rem;
        font-weight: 700;
        color: #111827;
        margin-bottom: 2rem;
    }

    .related.products ul.products {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 2rem;
        list-style: none;
        padding: 0;
        margin: 0;
    }
</style>

<?php
get_footer('shop');
?>