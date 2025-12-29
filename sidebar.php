<?php
/**
 * The sidebar containing the main widget area
 *
 * @package Blaze_Theme
 */

if (!is_active_sidebar('sidebar-1')) {
    return;
}
?>

<aside id="secondary" class="widget-area lg:col-span-1">
    <div class="sticky top-24 space-y-6">
        <?php dynamic_sidebar('sidebar-1'); ?>
    </div>
</aside><!-- #secondary -->