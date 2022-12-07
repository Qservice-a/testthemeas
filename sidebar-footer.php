<?php
TemplateFilters::getInstance()->widget_footer_menu_args();

if ( is_active_sidebar( 'sidebar-footer' ) ) :
	dynamic_sidebar( 'sidebar-footer' );
endif;
