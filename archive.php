<?php get_header(); ?>

<?php
if ( is_archive() || is_search() || ( is_home() && ! is_front_page() ) ) {
	get_template_part( 'template-parts/archive/title' );
}
?>

<?php
$code = get_theme_mod( 'reklama_archive_before_content', '' );
if ( $code ) {
	set_query_var( 'template_args', [ 'code' => $code ] );
	get_template_part( 'template-parts/section/advt', '' );
}
?>
    <div class="content">
        <div class="container">
            <div class="row content__row">
                <div class="col content__col content__col_big">
                    <div class="content__body" itemscope itemtype="http://schema.org/Blog">
						<?php
						if ( is_author() ) {
							get_template_part( 'template-parts/breadcrumbs' );

							get_template_part( 'template-parts/archive/author-info' );
						}

						if ( have_posts() ) {

							$post_card_meta = Helper::get_post_card_meta();

							$template_args = [
								'posts'          => $wp_query->posts,
								'block_title'    => '',
								'post_card_type' => 'default',
								'post_card_meta' => $post_card_meta,
								'posts_per_page' => $wp_query->get( 'posts_per_page' ),
							];

							set_query_var( 'template_args', $template_args );

							$block_type = get_theme_mod( 'archive_post_card_type', 'default' );

							if ( is_author() ) {
								$block_type = 'default';
							}

							if ( $block_type == 'default' ) {
								$block_type = 'recommended';
							}
                            elseif ( $block_type == 'vertical' ) {
								$block_type = 'featured';
							}
                            elseif ( $block_type == 'horizontal' ) {
								$block_type = 'latest';
							}
                            elseif ( $block_type == 'horizontal2' ) {
								$block_type = 'latest2';
							}

							get_template_part( 'template-parts/section/section', $block_type );

							wescle_paginate_links();
						}
						else {
							get_template_part( 'template-parts/content/content', 'none' );
						}

						if ( ! is_paged() ) {
							$description_bottom = get_term_meta( get_queried_object_id(), 'description_bottom', 1 );
							if ( $description_bottom ) {
								?>
                                <div class="content-bottom entry-content text section-post__editor">
									<?php echo do_shortcode( shortcode_unautop( wpautop( $description_bottom ) ) ); ?>
                                </div>
								<?php
							}
						}
						?>
                    </div>
                </div>
	            <?php get_sidebar( 'sidebar-area' ); ?>
            </div>
        </div>
    </div>

<?php
$code = get_theme_mod( 'reklama_archive_after_content', '' );
if ( $code ) {
	set_query_var( 'template_args', [ 'code' => $code ] );
	get_template_part( 'template-parts/section/advt', '' );
}
?>

<?php get_footer(); ?>