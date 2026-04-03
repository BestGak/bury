<?php 

define('BURY_THEME_DIRECTORY', esc_url(trailingslashit(get_template_directory_uri())));
define('BURY_REQUIRE_DIRECTORY', trailingslashit(get_template_directory()));
define('BURY_VERSION', wp_get_theme()['Version']);
define('BURY_DEVELOPMENT', true);

require_once(TEMPLATEPATH . '/inc/helper-functions.php');
require_once(TEMPLATEPATH . '/inc/helper-templates.php');
require_once(TEMPLATEPATH . '/inc/ajax.php');
require_once(TEMPLATEPATH . '/inc/customize.php');
require_once(TEMPLATEPATH . '/inc/cpt.php');
require_once(TEMPLATEPATH . '/inc/enqueue.php');
require_once(TEMPLATEPATH . '/inc/shortcodes.php');