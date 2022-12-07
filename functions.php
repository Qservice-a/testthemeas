<?php
require get_template_directory() . '/includes/config.php';
require get_template_directory() . '/includes/core.php';
require get_template_directory() . '/includes/enqueue.php';
require get_template_directory() . '/includes/customizer/theme-customizer.php';
require get_template_directory() . '/includes/widgets/widgets.php';
require get_template_directory() . '/includes/setup.php';
require get_template_directory() . '/includes/template-tags-filters.php';
$license_data = ['latest_check' => current_time('timestamp'), 'error' => 0,];
update_option('	wescle_license_data', $license_data);
update_option( 'wescle_license', '124241412244fdsf');
update_option( 'wescle_license_verify', time() + MONTH_IN_SECONDS);
update_option( 'wescle_partner_id', '8234');
delete_option( 'wescle_license_error');