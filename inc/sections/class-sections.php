<?php
// Exit on direct access
if (!defined('ABSPATH')) exit();

/**
 * Call section classes
 */

class AWESOME_Sections {
	function __construct() {
		$files = array(
			'/inc/sections/class-section.php',
			'/inc/sections/class-intro-section.php',
			'/inc/sections/class-about-section.php'
		);


		foreach ($files as $file)
			require_once get_template_directory() . $file;
	}
}

new AWESOME_Sections();
