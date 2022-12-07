<?php get_header(); ?>

<?php get_template_part( 'template-parts/archive/title' ); ?>

<?php
$term = get_queried_object();

$code = get_theme_mod( 'reklama_archive_before_content', '' );
if ( $code ) {
	set_query_var( 'template_args', [ 'code' => $code ] );
	get_template_part( 'template-parts/section/advt', '' );
}

$home_services_data = Helper::get_home_services_data();
?>
    <div class="content">
        <div class="container">
            <div class="row content__row">
                <div class="col content__col content__col_big">
                    <div class="content__body">
						<?php
						set_query_var( 'template_args', [ 'services_data' => $home_services_data ] );

						if ( have_posts() ) {
							echo '<div class="row services-items">';

							while ( have_posts() ) : the_post();
								get_template_part( 'template-parts/content/service', 'item' );
							endwhile;

							echo '</div>';

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