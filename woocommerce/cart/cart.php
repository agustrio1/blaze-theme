<?php
/**
 * Cart Page
 * 
 * @package Blaze_Theme
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

do_action('woocommerce_before_cart');
?>

<div class="woocommerce-cart-form-wrapper">

    <form class="woocommerce-cart-form" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
        
        <?php do_action('woocommerce_before_cart_table'); ?>

        <div class="bg-white rounded-xl shadow-md overflow-hidden mb-8">
            
            <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents w-full">
                
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200">
                        <th class="product-remove px-6 py-4">&nbsp;</th>
                        <th class="product-thumbnail px-6 py-4">&nbsp;</th>
                        <th class="product-name px-6 py-4 text-left font-semibold text-gray-900"><?php esc_html_e('Product', 'blaze'); ?></th>
                        <th class="product-price px-6 py-4 text-left font-semibold text-gray-900"><?php esc_html_e('Price', 'blaze'); ?></th>
                        <th class="product-quantity px-6 py-4 text-center font-semibold text-gray-900"><?php esc_html_e('Quantity', 'blaze'); ?></th>
                        <th class="product-subtotal px-6 py-4 text-right font-semibold text-gray-900"><?php esc_html_e('Subtotal', 'blaze'); ?></th>
                    </tr>
                </thead>

                <tbody>
                    <?php do_action('woocommerce_before_cart_contents'); ?>

                    <?php
                    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                        $_product   = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                        $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

                        if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
                            $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
                            ?>
                            <tr class="woocommerce-cart-form__cart-item <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?> border-b border-gray-100 hover:bg-gray-50 transition-colors">

                                <!-- Remove Button -->
                                <td class="product-remove px-6 py-6">
                                    <?php
                                    echo apply_filters(
                                        'woocommerce_cart_item_remove_link',
                                        sprintf(
                                            '<a href="%s" class="remove flex items-center justify-center w-8 h-8 text-red-600 hover:bg-red-50 rounded-lg transition-all" aria-label="%s" data-product_id="%s" data-product_sku="%s">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </a>',
                                            esc_url(wc_get_cart_remove_url($cart_item_key)),
                                            esc_attr__('Remove this item', 'blaze'),
                                            esc_attr($product_id),
                                            esc_attr($_product->get_sku())
                                        ),
                                        $cart_item_key
                                    );
                                    ?>
                                </td>

                                <!-- Product Thumbnail -->
                                <td class="product-thumbnail px-6 py-6">
                                    <?php
                                    $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);

                                    if (!$product_permalink) {
                                        echo '<div class="w-20 h-20 rounded-lg overflow-hidden bg-gray-100">' . $thumbnail . '</div>';
                                    } else {
                                        printf('<a href="%s" class="block w-20 h-20 rounded-lg overflow-hidden bg-gray-100">%s</a>', esc_url($product_permalink), $thumbnail);
                                    }
                                    ?>
                                </td>

                                <!-- Product Name -->
                                <td class="product-name px-6 py-6" data-title="<?php esc_attr_e('Product', 'blaze'); ?>">
                                    <?php
                                    if (!$product_permalink) {
                                        echo '<span class="font-semibold text-gray-900">' . wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key) . '&nbsp;') . '</span>';
                                    } else {
                                        echo '<a href="' . esc_url($product_permalink) . '" class="font-semibold text-gray-900 hover:text-primary transition-colors">' . wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key) . '&nbsp;') . '</a>';
                                    }

                                    do_action('woocommerce_after_cart_item_name', $cart_item, $cart_item_key);

                                    // Meta data
                                    echo wc_get_formatted_cart_item_data($cart_item);

                                    // Backorder notification
                                    if ($_product->backorders_require_notification() && $_product->is_on_backorder($cart_item['quantity'])) {
                                        echo wp_kses_post(apply_filters('woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__('Available on backorder', 'blaze') . '</p>', $product_id));
                                    }
                                    ?>
                                </td>

                                <!-- Product Price -->
                                <td class="product-price px-6 py-6" data-title="<?php esc_attr_e('Price', 'blaze'); ?>">
                                    <span class="font-semibold text-gray-900">
                                        <?php echo apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key); ?>
                                    </span>
                                </td>

                                <!-- Product Quantity -->
                                <td class="product-quantity px-6 py-6" data-title="<?php esc_attr_e('Quantity', 'blaze'); ?>">
                                    <?php
                                    if ($_product->is_sold_individually()) {
                                        $product_quantity = sprintf('1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key);
                                    } else {
                                        $product_quantity = woocommerce_quantity_input(
                                            array(
                                                'input_name'   => "cart[{$cart_item_key}][qty]",
                                                'input_value'  => $cart_item['quantity'],
                                                'max_value'    => $_product->get_max_purchase_quantity(),
                                                'min_value'    => '0',
                                                'product_name' => $_product->get_name(),
                                            ),
                                            $_product,
                                            false
                                        );
                                    }

                                    echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item);
                                    ?>
                                </td>

                                <!-- Product Subtotal -->
                                <td class="product-subtotal px-6 py-6 text-right" data-title="<?php esc_attr_e('Subtotal', 'blaze'); ?>">
                                    <span class="font-bold text-lg text-primary">
                                        <?php echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); ?>
                                    </span>
                                </td>

                            </tr>
                            <?php
                        }
                    }
                    ?>

                    <?php do_action('woocommerce_cart_contents'); ?>

                    <tr>
                        <td colspan="6" class="actions px-6 py-6 bg-gray-50">
                            <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                                
                                <?php if (wc_coupons_enabled()) : ?>
                                    <div class="coupon flex gap-2">
                                        <input type="text" name="coupon_code" class="input-text px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary" placeholder="<?php esc_attr_e('Coupon code', 'blaze'); ?>" value="" />
                                        <button type="submit" class="button px-6 py-2 bg-gray-800 text-white font-semibold rounded-lg hover:bg-gray-900 transition-all" name="apply_coupon" value="<?php esc_attr_e('Apply coupon', 'blaze'); ?>">
                                            <?php esc_html_e('Apply', 'blaze'); ?>
                                        </button>
                                        <?php do_action('woocommerce_cart_coupon'); ?>
                                    </div>
                                <?php endif; ?>

                                <button type="submit" class="button px-6 py-2 bg-primary text-white font-semibold rounded-lg hover:bg-primary-dark transition-all" name="update_cart" value="<?php esc_attr_e('Update cart', 'blaze'); ?>">
                                    <?php esc_html_e('Update cart', 'blaze'); ?>
                                </button>

                                <?php do_action('woocommerce_cart_actions'); ?>
                                <?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>
                            </div>
                        </td>
                    </tr>

                    <?php do_action('woocommerce_after_cart_contents'); ?>
                </tbody>

            </table>

        </div>

        <?php do_action('woocommerce_after_cart_table'); ?>

    </form>

</div>

<?php do_action('woocommerce_before_cart_collaterals'); ?>

<div class="cart-collaterals">
    <?php
    /**
     * Cart collaterals hook.
     */
    do_action('woocommerce_cart_collaterals');
    ?>
</div>

<?php do_action('woocommerce_after_cart'); ?>

<style>
    /* Quantity Input */
    .quantity input[type="number"] {
        width: 80px;
        padding: 0.5rem;
        border: 1px solid #E5E7EB;
        border-radius: 0.5rem;
        text-align: center;
        font-weight: 600;
    }

    .quantity input[type="number"]:focus {
        outline: none;
        border-color: #DC2626;
        box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
    }

    /* Cart Totals */
    .cart_totals {
        background: white;
        border-radius: 0.75rem;
        padding: 2rem;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
    }

    .cart_totals h2 {
        font-size: 1.5rem;
        font-weight: 700;
        color: #111827;
        margin-bottom: 1.5rem;
    }

    .cart_totals table {
        width: 100%;
    }

    .cart_totals th,
    .cart_totals td {
        padding: 1rem 0;
        border-bottom: 1px solid #F3F4F6;
    }

    .cart_totals .order-total th,
    .cart_totals .order-total td {
        font-size: 1.25rem;
        font-weight: 700;
        color: #111827;
        padding-top: 1.5rem;
    }

    .wc-proceed-to-checkout {
        padding-top: 1.5rem;
    }

    .wc-proceed-to-checkout .checkout-button {
        display: block;
        width: 100%;
        padding: 1rem;
        background: #DC2626;
        color: white;
        text-align: center;
        font-weight: 600;
        border-radius: 0.5rem;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .wc-proceed-to-checkout .checkout-button:hover {
        background: #B91C1C;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }
</style>