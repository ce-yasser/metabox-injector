<?php
// Exit on direct access
if (!defined('ABSPATH')) exit();

/**
 * Call page classes
 */

class AWESOME_Pages {
	function __construct() {
		$files = array(
			'/inc/pages/class-page.php',
			'/inc/pages/class-home-page.php'
		);

		foreach ($files as $file)
			require_once get_template_directory() . $file;
	}
}

new AWESOME_Pages();
