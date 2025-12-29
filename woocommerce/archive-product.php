<?php
/**
 * Product Archive Template
 * 
 * @package Blaze_Theme
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

get_header('shop');
?>

<main id="primary" class="site-main woocommerce-archive-product">

    <!-- Page Header -->
    <div class="shop-header py-12 bg-gray-50 border-b border-gray-200 mb-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl">
            
            <?php if (apply_filters('woocommerce_show_page_title', true)) : ?>
                <h1 class="woocommerce-products-header__title page-title text-4xl font-bold text-gray-900 mb-4">
                    <?php woocommerce_page_title(); ?>
                </h1>
            <?php endif; ?>

            <?php
            /**
             * Archive description
             */
            do_action('woocommerce_archive_description');
            ?>

        </div>
    </div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-7xl pb-12">

        <?php
        if (woocommerce_product_loop()) {

            /**
             * Hook: woocommerce_before_shop_loop.
             */
            do_action('woocommerce_before_shop_loop');
            ?>

            <!-- Toolbar -->
            <div class="woocommerce-toolbar flex flex-col md:flex-row items-start md:items-center justify-between gap-4 mb-8 p-4 bg-white rounded-lg shadow-sm">
                
                <!-- Result Count -->
                <div class="woocommerce-result-count text-gray-600">
                    <?php woocommerce_result_count(); ?>
                </div>

                <!-- Catalog Ordering -->
                <div class="woocommerce-ordering">
                    <?php woocommerce_catalog_ordering(); ?>
                </div>

            </div>

            <?php
            woocommerce_product_loop_start();

            if (wc_get_loop_prop('total')) {
                while (have_posts()) {
                    the_post();

                    /**
                     * Hook: woocommerce_shop_loop.
                     */
                    do_action('woocommerce_shop_loop');

                    wc_get_template_part('content', 'product');
                }
            }

            woocommerce_product_loop_end();

            /**
             * Hook: woocommerce_after_shop_loop.
             */
            do_action('woocommerce_after_shop_loop');

        } else {
            /**
             * Hook: woocommerce_no_products_found.
             */
            do_action('woocommerce_no_products_found');
        }
        ?>

    </div>

</main>

<style>
    /* Product Loop */
    .products {
        display: grid;
        grid-template-columns: repeat(1, 1fr);
        gap: 2rem;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    @media (min-width: 640px) {
        .products {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (min-width: 1024px) {
        .products {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media (min-width: 1280px) {
        .products {
            grid-template-columns: repeat(4, 1fr);
        }
    }

    /* Ordering Dropdown */
    .woocommerce-ordering select {
        padding: 0.5rem 2.5rem 0.5rem 1rem;
        border: 1px solid #E5E7EB;
        border-radius: 0.5rem;
        background-color: white;
        color: #374151;
        font-size: 0.875rem;
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%236B7280'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 0.5rem center;
        background-size: 1.25rem;
    }

    .woocommerce-ordering select:focus {
        outline: none;
        border-color: #DC2626;
        box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
    }

    /* Pagination */
    .woocommerce-pagination {
        margin-top: 3rem;
    }

    .woocommerce-pagination ul {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .woocommerce-pagination li {
        display: inline-block;
    }

    .woocommerce-pagination a,
    .woocommerce-pagination span {
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 2.5rem;
        height: 2.5rem;
        padding: 0 0.75rem;
        font-weight: 500;
        border-radius: 0.5rem;
        transition: all 0.2s ease;
    }

    .woocommerce-pagination a {
        background: white;
        color: #374151;
        border: 1px solid #E5E7EB;
        text-decoration: none;
    }

    .woocommerce-pagination a:hover {
        background: #DC2626;
        color: white;
        border-color: #DC2626;
    }

    .woocommerce-pagination span.current {
        background: #DC2626;
        color: white;
        border: 1px solid #DC2626;
    }

    /* No Products Found */
    .woocommerce-info {
        padding: 2rem;
        background: #F3F4F6;
        border-left: 4px solid #DC2626;
        border-radius: 0.5rem;
        margin-bottom: 2rem;
    }

    .woocommerce-info::before {
        content: 'ℹ';
        display: inline-block;
        margin-right: 0.5rem;
        font-size: 1.25rem;
        color: #DC2626;
    }
</style>

<?php
get_footer('shop');
?>