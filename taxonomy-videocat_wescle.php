<?php get_header(); ?>

<?php get_template_part( 'template-parts/archive/title' ); ?>

<?php
$term = get_queried_object();

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
                    <div class="content__body">
						<?php
						if ( have_posts() ) {
							if ( 'section' === get_theme_mod( 'video_card_type' ) ) {
								echo '<div class="video-section">';
								echo '<div class="video-section__grid">';

								while ( have_posts() ) : the_post();
									get_template_part( 'template-parts/content/video_cpt', 'item' );
								endwhile;

								echo '</div>';
								echo '</div>';
							}
							else {
								echo '<div class="video-section__row">';

								while ( have_posts() ) : the_post();
									echo '<div class="video-section__col">';
									get_template_part( 'template-parts/content/video', 'item' );
									echo '</div>';
								endwhile;

								echo '</div>';
							}

							wescle_paginate_links();
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