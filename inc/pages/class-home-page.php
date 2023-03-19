<?php
// Exit on direct access
if (!defined('ABSPATH')) exit();

/**
 * Define home metaboxes
 */

class AWESOME_Home_Page extends AWESOME_Page {
	function __construct() {
		$this->template_name = 'templates/page-home.php';
		$this->filter_name = 'awesome_home';

		$this->sections = array(
			'home_intro' => array(
				'class' => 'AWESOME_Intro_Section',
			),
			'home_about' => array(
				'class' => 'AWESOME_About_Section',
			),
		);

		parent::__construct();
	}
}

new AWESOME_Home_Page();
