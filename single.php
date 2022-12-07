<?php get_header(); ?>

<?php
$post_version = Helper::get_single_about_version();

if ( $post_version == 'v4' ) {
	get_template_part( 'template-parts/post/promo', $post_version );
}

$thumb_size = THEME_SLUG . '_single_thumbnail';

$post_blocks_hide = Helper::get_post_blocks_hide();
?>
    <div class="content">
        <div class="container">
            <div class="row content__row">
                <div class="col content__col content__col_big">
                    <div class="content__body" itemscope itemtype="http://schema.org/Article">
						<?php get_template_part( 'template-parts/breadcrumbs' ); ?>

						<?php
						set_query_var( 'template_args', [ 'key' => 'after_breadcrumb' ] );
						get_template_part( 'template-parts/post/advertising' );
						?>

						<?php while ( have_posts() ) : the_post(); ?>

                            <section class="section-post section-post_<?php echo $post_version; ?>">
								<?php get_template_part( 'template-parts/post/about', $post_version ); ?>

                                <div class="section-post__body">
									<?php
									set_query_var( 'template_args', [ 'key' => 'before_content' ] );
									get_template_part( 'template-parts/post/advertising' );
									?>

									<?php if ( $post_version == 'v1' && get_post_thumbnail_id() && Helper::get_post_about_version_image() ) { ?>
										<?php $custom_class = Helper::is_about_image_height_variable() ? 'section-post__image_nocrop' : ''; ?>
                                        <div class="section-post__image section-post__image_main <?php echo $custom_class; ?>">
											<?php the_post_thumbnail( $thumb_size ); ?>
                                        </div>
									<?php } ?>

                                    <div class="section-post__editor entry-content" itemprop="articleBody">
										<?php the_content(); ?>
                                    </div>

									<?php
									wp_link_pages(
										array(
											'before'      => '<div class="post-nav-links"><span class="post-nav-links__label">' . __( 'Страницы:', 'wescle' ) . '</span>',
											'after'       => '</div>',
											'link_before' => '<span class="page-number">',
											'link_after'  => '</span>',
										)
									);
									?>

									<?php edit_post_link(); ?>

									<?php get_template_part( 'template-parts/post/tags' ); ?>

									<?php
									set_query_var( 'template_args', [ 'key' => 'after_content' ] );
									get_template_part( 'template-parts/post/advertising' );
									?>

									<?php
									if ( ! in_array( 'share', $post_blocks_hide ) ) {
										get_template_part( 'template-parts/post/share' );

										set_query_var( 'template_args', [ 'key' => 'after_share' ] );
										get_template_part( 'template-parts/post/advertising' );
									}
									?>
                                </div>

								<?php
								if ( ! in_array( 'author_info', $post_blocks_hide ) ) {
									get_template_part( 'template-parts/post/author' );

									set_query_var( 'template_args', [ 'key' => 'after_author' ] );
									get_template_part( 'template-parts/post/advertising' );
								}
								?>

								<?php get_template_part( 'template-parts/post/navigation' ); ?>
                            </section>

							<?php
							set_query_var( 'template_args', [ 'key' => 'before_related' ] );
							get_template_part( 'template-parts/post/advertising' );
							?>

							<?php get_template_part( 'template-parts/post/related' ); ?>

							<?php
							if ( ( comments_open() || get_comments_number() ) && ! post_password_required() ) {
								comments_template();
							}
							?>

                            <meta itemscope itemprop="mainEntityOfPage" itemType="https://schema.org/WebPage" itemid="<?php the_permalink() ?>" content="<?php the_title(); ?>">
                            <meta itemprop="datePublished" content="<?php the_time( 'c' ) ?>">
                            <meta itemprop="author" content="<?php the_author() ?>">
							<?php echo Helper::html_microdata_publisher() ?>
							<?php echo Helper::html_microdata_image() ?>

						<?php endwhile; ?>
                    </div>
                </div>
	            <?php
	            $sidebar_name = apply_filters( 'wescle_sidebar_name', null, $post );
	            get_sidebar( $sidebar_name );
	            ?>
            </div>
        </div>
    </div>

<?php get_footer(); ?>