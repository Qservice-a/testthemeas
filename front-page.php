<?php get_header(); ?>

<?php
if ( $wp_query->is_posts_page || ( get_option( 'show_on_front' ) == 'posts' ) ) {
	include 'home.php';
}
else {
	?>

	<?php get_template_part( 'template-parts/home/promo_text' ); ?>

	<?php get_template_part( 'template-parts/home/woo_blocks', null, [ 'before_promo' => 1 ] ); ?>

	<?php get_template_part( 'template-parts/home/promo' ); ?>

	<?php
	$code = get_theme_mod( 'reklama_home_after_promo', '' );
	if ( $code ) {
		set_query_var( 'template_args', [ 'code' => $code ] );
		get_template_part( 'template-parts/section/advt', '' );
	}
	?>

	<?php
	$blocks_sortable = get_theme_mod( 'home_block_sortable', Helper::get_default_theme_data( 'home_block_sortable' ) );
	foreach ( $blocks_sortable as $block_name ) {
		$block_name_key = str_replace( [ 'map_tabs' ], [ 'map' ], $block_name );
		if ( $block_name_key == 'woo_banners' ) {
			$block_name_key = 'woo_banners_id_block';
		}
		else {
			$block_name_key = 'home_' . $block_name_key . '_id_block';
		}

		if ( $block_id = get_theme_mod( $block_name_key ) ) {
			$block_id = str_replace( '#', '', $block_id );
			echo '<div class="block_divider" id="' . $block_id . '"></div>';
		}

		if ( $block_name === 'block_posts' ) {
			if ( ! Helper::visible_block_in_customizer( 'home_blocks' ) ) {
				continue;
			}

			$home_blocks_posts = get_theme_mod( 'home_blocks_posts', [] );
			if ( ! $home_blocks_posts ) {
				continue;
			}

			$class_title = '';
			if ( $home_blocks_posts && ! $home_blocks_posts[0]['block_title'] ) {
				$class_title .= ' first-without-title';
			}

			$section_position = get_theme_mod( 'home_blocks_position_content', 'left' );
			if ( 'left' != $section_position ) {
				$class_title .= ' _section-' . $section_position;
			}

			$style_bg = '';
			if ( $color_bg = get_theme_mod( 'home_blocks_color_bg' ) ) {
				$style_bg = 'style="background-color:' . $color_bg . ';"';
			}
			?>
            <div class="content<?php echo $class_title; ?>" <?php echo $style_bg; ?>>
                <div class="container">
                    <div class="row content__row">
                        <div class="col content__col content__col_big">
                            <div class="content__body">
								<?php if ( $home_blocks_posts ) { ?>
									<?php get_template_part( 'template-parts/home/section' ); ?>
								<?php } ?>
                            </div>
                        </div>
						<?php get_sidebar(); ?>
                    </div>
                </div>
            </div>
			<?php
		}
		else {
			get_template_part( 'template-parts/home/' . $block_name );
		}
	}
	?>

<?php } // if ( $wp_query->is_posts_page ) ?>

<?php get_footer(); ?>