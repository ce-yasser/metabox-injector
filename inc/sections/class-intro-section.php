<?php
// Exit on direct access
if (!defined('ABSPATH')) exit();

/** 
 * Intro section class
 */
class AWESOME_Intro_Section extends AWESOME_Section {

	function __construct($id) {
		$this->id = $id;
		$this->template_path = get_template_directory() . '/templates/sections/intro.php';

		$this->metaboxes = array(
			'title' => esc_html__('Intro', 'my_theme_name'),
			'context' => 'normal',
			'post_types' => 'page',
			'fields' => array(
				array(
					'id' => $this->id . '_image',
					'name' => esc_html__('Intro background', 'my_theme_name'),
					'type' => 'image_advanced',
					'force_delete' => false,
					'max_file_uploads' => 1,
					'max_status' => false,
					'image_size' => 'large'
				),
				array(
					'id' => $this->id . '_title',
					'name' => esc_html__('Intro Title', 'my_theme_name'),
					'type' => 'textarea',
					'std' => esc_html__('My Awesome Title','my_theme_name'),
					'placeholder' => esc_html__('My Awesome Title','my_theme_name')
				),
			),
		);
	}
}
