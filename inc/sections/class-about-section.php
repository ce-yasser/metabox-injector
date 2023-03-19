<?php
// Exit on direct access
if (!defined('ABSPATH')) exit();

/** 
 * About section class
 */
class AWESOME_About_Section extends AWESOME_Section {

	function __construct($id) {
		$this->id = $id;
		$this->template_path = get_template_directory() . '/templates/sections/about.php';

		$this->metaboxes = array(
			'title' => esc_html__('About', 'my_theme_name'),
			'context' => 'normal',
			'post_types' => 'page',
			'fields' => array(
				array(
					'id' => $this->id . '_image',
					'name' => esc_html__('About Background', 'my_theme_name'),
					'type' => 'image_advanced',
					'force_delete' => false,
					'max_file_uploads' => 1,
					'max_status' => false,
					'image_size' => 'large'
				),
				array(
					'id' => $this->id . '_subtitle',
					'name' => esc_html__('About Subtitle', 'my_theme_name'),
					'type' => 'text',
					'std' => esc_html__('Who we are ?', 'my_theme_name'),
					'placeholder' => esc_html__('Who we are ?', 'my_theme_name')
				),
				array(
					'id' => $this->id . '_title',
					'name' => esc_html__('About Title', 'my_theme_name'),
					'type' => 'textarea',
					'std' => __('About <br>US', 'my_theme_name'),
					'placeholder' => __('About <br>US', 'my_theme_name')
				),
				array(
					'id' => $this->id . '_text',
					'name' => esc_html__('About Text', 'my_theme_name'),
					'type' => 'textarea',
					'raw' => false,
					'std' => esc_html__('Some awesome description goes here', 'my_theme_name'),
					'placeholder' => esc_html__('Some awesome description goes here', 'my_theme_name'),
				),
			),
		);
	}
}
