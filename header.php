<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<div class="wrapper">
    <header class="<?php wescle_header_class(); ?>" id="header" itemscope itemtype="http://schema.org/WPHeader" <?php if ( ! wp_is_mobile() ) {
		echo 'style="opacity: 0"';
	} ?>>
		<?php get_template_part( 'template-parts/header/top-banner' ); ?>
		<?php get_template_part( 'template-parts/header/top-bar' ); ?>
		<?php get_template_part( 'template-parts/header/top-tabs' ); ?>
        <div class="header__top header-top">
			<?php echo wescle_home_block_bg_image( 'header_image_bg' ); ?>
            <div class="container">
				<?php if ( Helper::is_header_oneline() || Helper::is_header_tabs() ) { ?>
                    <div class="header-top__row">
                        <div class="header-top__col_left">
							<?php
							theme_site_logo();
							theme_site_description();
							?>
                        </div>
                        <div class="header-top__col _right">
                            <div class="header-top__actions">
								<?php if ( Helper::is_header_oneline() ) { ?>
                                    <nav class="header__navigation navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
										<?php get_template_part( 'template-parts/header/navigation' ); ?>
										<?php get_template_part( 'template-parts/header/navigation', 'search' ); ?>
                                    </nav>
									<?php
									$sort_blocks = get_theme_mod( 'header_block_sortable', [
										'address',
										'phone',
										'button',
									] );

									if ( in_array( 'address', $sort_blocks ) ) {
										get_template_part( 'template-parts/header/address' );
									}
									if ( in_array( 'phone', $sort_blocks ) ) {
										get_template_part( 'template-parts/header/phone' );
									}
									if ( in_array( 'button', $sort_blocks ) ) {
										get_template_part( 'template-parts/header/button', 'callback' );
									}
									get_template_part( 'template-parts/header/buddypress', 'links' );
									?>
								<?php } ?>
								<?php if ( Helper::is_header_tabs() ) { ?>
                                    <nav class="header__navigation navigation">
										<?php get_template_part( 'template-parts/header/navigation', 'tabs' ); ?>
										<?php get_template_part( 'template-parts/header/navigation', 'search' ); ?>
										<?php get_template_part( 'template-parts/header/navigation', 'store' ); ?>
                                    </nav>
									<?php
									$sort_blocks = get_theme_mod( 'header_block_sortable', [
										'address',
										'phone',
										'button',
									] );
									if ( in_array( 'button', $sort_blocks ) ) {
										get_template_part( 'template-parts/header/button', 'callback' );
									}
									?>
								<?php } ?>
                                <div class="header__icon-menu icon-menu"><span></span><span></span><span></span></div>
                                <nav class="menu">
                                    <div class="menu__body">
                                        <div class="menu__title"><?php echo get_theme_mod( 'header_menu_mobile_label', Helper::get_default_theme_data( 'header_menu_mobile_label' ) ); ?></div>
                                        <div class="menu__actions"></div>
                                        <div class="menu__content"></div>
                                    </div>
                                </nav>
                            </div>
                        </div>
                    </div>
				<?php } elseif ( Helper::is_header_store_center() ) { ?>
					<?php get_template_part( 'template-parts/header/header-store-center' ); ?>
				<?php } else { ?>
                    <div class="row header-top__row">
                        <div class="col header-top__col_left">
							<?php
							theme_site_logo();
							theme_site_description();
							?>
                        </div>
                        <div class="col header-top__col">
                            <div class="header-top__actions">
								<?php
								if ( ! get_theme_mod( 'header_block_logo' ) ) {
									$sort_blocks = get_theme_mod( 'header_block_sortable', [
										'address',
										'phone',
										'button',
									] );

									if ( in_array( 'address', $sort_blocks ) ) {
										get_template_part( 'template-parts/header/address' );
									}
									if ( in_array( 'phone', $sort_blocks ) ) {
										get_template_part( 'template-parts/header/phone' );
									}
									if ( in_array( 'button', $sort_blocks ) ) {
										get_template_part( 'template-parts/header/button', 'callback' );
									}
									get_template_part( 'template-parts/header/buddypress', 'links' );
								}
								if ( 'logo_social' === get_theme_mod( 'header_block_logo' ) || 'logo_social_revert' === get_theme_mod( 'header_block_logo' ) ) {
									get_template_part( 'template-parts/header/socials' );
								}
								?>
                                <div class="header__icon-menu icon-menu"><span></span><span></span><span></span></div>
                                <nav class="menu">
                                    <div class="menu__body">
                                        <div class="menu__title"><?php echo get_theme_mod( 'header_menu_mobile_label', Helper::get_default_theme_data( 'header_menu_mobile_label' ) ); ?></div>
                                        <div class="menu__actions"></div>
                                        <div class="menu__content"></div>
                                    </div>
                                </nav>
                            </div>
                        </div>
                    </div>
				<?php } ?>
            </div>
        </div>
		<?php if ( ! Helper::is_header_oneline() && ! Helper::is_header_tabs() ) { ?>
            <div class="header__bottom header-bottom">
				<?php echo wescle_home_block_bg_image( 'header_menu_image_bg' ); ?>
                <div class="container">
                    <nav class="header__navigation navigation" itemscope itemtype="http://schema.org/SiteNavigationElement">
						<?php get_template_part( 'template-parts/header/navigation' ); ?>
						<?php get_template_part( 'template-parts/header/navigation', 'search' ); ?>
                    </nav>
                </div>
            </div>
		<?php } ?>
		<?php
		if ( 'default' === Helper::get_header_search_type() ) {
			get_template_part( 'template-parts/header/navigation', 'search-form' );
		}
		?>
    </header>
    <main class="main">

<?php
/**
 * Functions hooked in to wescle_before_content
 *
 * @hooked wescle_title_for_page_elementor_header_footer - 10
 * @hooked wescle_section_banners - 20
 */
do_action( 'wescle_before_content' );
?>