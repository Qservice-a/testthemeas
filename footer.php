</main>

<footer class="footer" id="footer" itemscope itemtype="http://schema.org/WPFooter">
	<?php echo wescle_home_block_bg_image( 'footer_image_bg' ); ?>
    <div class="container">
		<?php get_template_part( 'template-parts/footer/subscription' ); ?>

		<?php if ( is_active_sidebar( 'sidebar-footer' ) ) : ?>
            <div class="footer__body">
                <div class="row footer__row accordion">
					<?php get_sidebar( 'footer' ); ?>
                </div>
            </div>
		<?php endif; ?>

        <div class="footer__bottom">
			<?php
			$footer_blocks = get_theme_mod( 'footer_block_sortable', [
				'copyright',
				'text',
				'payments',
				'socials',
			] );
			foreach ( $footer_blocks as $block ) {
				get_template_part( 'template-parts/footer/' . $block );
			}
			?>
        </div>
    </div>
</footer>
<?php wescle_module_hidden_elements(); ?>
</div>

<div class="show-in-modal is-hide"></div>

<div class="call-modals-buttons">
	<?php get_template_part( 'template-parts/modals/modal', 'buttons' ); ?>
	<?php get_template_part( 'template-parts/footer/scroll_up' ); ?>
</div>

<?php get_template_part( 'template-parts/modals/modal', 'call' ); ?>
<?php get_template_part( 'template-parts/modals/modal', 'order_package' ); ?>
<?php get_template_part( 'template-parts/modals/modal', 'order_price' ); ?>
<?php get_template_part( 'template-parts/modals/modal', 'order_license' ); ?>
<?php get_template_part( 'template-parts/modals/modal', 'wescle' ); ?>
<?php get_template_part( 'template-parts/modals/modal', 'team_cpt' ); ?>
<?php get_template_part( 'template-parts/modals/modal', 'product' ); ?>
<?php get_template_part( 'template-parts/footer/cookie' ); ?>

<?php wp_footer(); ?>
<script>document.querySelector('.header').style.opacity = 1;</script>
</body>
</html>
