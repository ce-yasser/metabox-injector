<?php
// Exit on direct access
if (!defined('ABSPATH')) exit();

/** 
 * Page Class
 */
class AWESOME_Page {
	/**
	 * Sections
	 *
	 * @var array
	 */
	protected $sections = array();

	/**
	 * Template name
	 *
	 * @var string
	 */
	protected $template_name = '';

	/**
	 * Filter name that will be 
	 * used to call the templates
	 *
	 * @var string
	 */
	protected $filter_name = '';

	/**
	 * Page metaboxes
	 *
	 * @var array
	 */
	protected $metaboxes = array();


	/**
	 * Constructor fucntion
	 * Register sections & metaboxes
	 */
	function __construct() {
		$this->register_sections();
		add_filter('rwmb_meta_boxes', array($this, 'register_metaboxes'));
	}

	/**
	 * Extract data from sections array
	 *
	 * @return void
	 */
	public function register_sections() {
		foreach ($this->sections as $id => $data) {
			$section = new $data['class']($id);
			$title = $data['title'] ?? '';
			$section->call_template($this->filter_name);
			$section_metaboxes = $section->get_metaboxes($title, $this->template_name);

			array_push($this->metaboxes, $section_metaboxes);
		}
	}

	/**
	 * Register metaboxes
	 *
	 * @param array $metaboxes
	 * @return array
	 */
	public function register_metaboxes($metaboxes) {
		$new_metaboxes = $this->check_page_template($this->metaboxes);
		return array_merge($metaboxes, $new_metaboxes);
	}

	/**
	 * Check page template and unset 
	 * metabox based authorize value
	 *
	 * @param array $metaboxes
	 * @return array
	 */
	public function check_page_template($metaboxes) {
		foreach ($metaboxes as $index => $meta_box) {
			if (isset($meta_box['custom_autohrize_only_on']) && !$this->maybe_include($meta_box['custom_autohrize_only_on'])) {
				unset($metaboxes[$index]);
			}
		}
		return $metaboxes;
	}

	/**
	 * Maybe include metabox function
	 *
	 * @param array $conditions
	 * @return bool
	 */
	function maybe_include($conditions) {
		if (!is_admin()) {
			return true;
		}
		// Always include for ajax
		if (defined('DOING_AJAX') && DOING_AJAX) {
			return true;
		}
		if (isset($_GET['post'])) {
			$post_id = intval($_GET['post']);
		} elseif (isset($_POST['post_ID'])) {
			$post_id = intval($_POST['post_ID']);
		} else {
			$post_id = false;
		}
		$post_id = (int) $post_id;
		
		foreach ($conditions as $cond => $v) {
			// Catch non-arrays and transform them to array
			switch ($cond) {
				case 'template':
					$template = get_post_meta($post_id, '_wp_page_template', true);
					if (in_array($template, $v)) {
						return true;
					}
					break;
			}
		}
		// If no condition matched
		return false;
	}
}
