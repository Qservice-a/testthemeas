<?php get_header(); ?>

<?php
$post_version     = 'v1';
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
                            </section>

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
	            <?php get_sidebar(); ?>
            </div>
        </div>
    </div>

<?php get_footer(); ?>