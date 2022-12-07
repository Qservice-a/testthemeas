<?php if ( 'sidebar-none' !== Helper::get_sidebar_position() ) { ?>

	<?php add_filter( 'widget_nav_menu_args', array( 'TemplateFilters', 'aside_nav_menu_args' ) ); ?>

    <div class="col content__col">
		<?php if ( is_active_sidebar( 'sidebar-catalog' ) ) : ?>
            <aside class="aside" id="aside" itemscope itemtype="http://schema.org/WPSideBar">
				<?php
				$code = get_theme_mod( 'reklama_sidebar_top', '' );
				if ( $code ) {
					echo '<div class="widget">' . do_shortcode( $code ) . '</div>';
				}
				?>

				<?php dynamic_sidebar( 'sidebar-catalog' ); ?>

				<?php
				$code = get_theme_mod( 'reklama_sidebar_bottom', '' );
				if ( $code ) {
					echo '<div class="widget">' . do_shortcode( $code ) . '</div>';
				}
				?>
            </aside>
		<?php elseif ( current_user_can( 'administrator' ) ): ?>
            <aside class="aside">
				<?php printf( __( 'Настройте виджеты в админ-панели, <a href="%s">Внешний вид - Виджеты</a>', 'wescle' ), admin_url( 'widgets.php' ) ); ?>
            </aside>
		<?php endif; ?>
    </div>

	<?php remove_filter( 'widget_nav_menu_args', array( 'TemplateFilters', 'aside_nav_menu_args' ) ); ?>
<?php } ?>

