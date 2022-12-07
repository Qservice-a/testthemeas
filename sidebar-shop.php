<?php if ( Helper::get_sidebar_position() !== 'sidebar-none' ) { ?>
	<?php add_filter( 'widget_nav_menu_args', array( TemplateFilters::getInstance(), 'aside_nav_menu_args' ) ); ?>

    <div class="col content__col">
		<?php if ( is_active_sidebar( 'sidebar-shop' ) ) : ?>
            <aside class="aside aside-store" itemscope itemtype="http://schema.org/WPSideBar">
				<?php
				$code = get_theme_mod( 'reklama_sidebar_top', '' );
				if ( $code ) {
					echo '<div class="widget">' . do_shortcode( $code ) . '</div>';
				}
				?>

				<?php dynamic_sidebar( 'sidebar-shop' ); ?>

				<?php
				$code = get_theme_mod( 'reklama_sidebar_bottom', '' );
				if ( $code ) {
					echo '<div class="widget">' . do_shortcode( $code ) . '</div>';
				}
				?>
            </aside>
		<?php endif; ?>
    </div>

	<?php remove_filter( 'widget_nav_menu_args', array( TemplateFilters::getInstance(), 'aside_nav_menu_args' ) ); ?>
<?php } ?>

