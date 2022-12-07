<?php get_header(); ?>

    <div class="content">
        <div class="container">
            <div class="row content__row">
                <div class="col content__col content__col_big">
                    <div class="content__body">
						<?php get_template_part( 'template-parts/breadcrumbs' ); ?>

						<?php while ( have_posts() ) : the_post(); ?>

                            <section class="section-post">
                                <div class="section-post__about post">
                                    <div class="post__body">
                                        <div class="post__title">
                                            <h1 class="title"><?php the_title(); ?></h1>
                                        </div>
                                    </div>
                                </div>

                                <div class="section-post__body">
                                    <div class="section-post__editor entry-content">
										<?php the_content(); ?>
                                    </div>

									<?php edit_post_link(); ?>
                                </div>
                            </section>

						<?php endwhile; ?>
                    </div>
                </div>
				<?php get_sidebar(); ?>
            </div>
        </div>
    </div>

<?php get_footer(); ?>