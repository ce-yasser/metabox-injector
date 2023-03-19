<?php
// Exit on direct access
if (!defined('ABSPATH')) exit();

/** 
 * Section Class
 */
class AWESOME_Section {
	/**
	 * Template path
	 *
	 * @var string
	 */
	protected $template_path = '';

	/**
	 * Metaboxes
	 *
	 * @var string
	 */
	protected $metaboxes = array();

	/**
	 * Section ID
	 *
	 * @var string
	 */
	protected $id = '';

	public function __construct($id) {
		$this->id = $id;
	}

	public function get_metaboxes($title = '', $allowed_template = '') {
		/**
		 * If allowed template is not empty
		 */
		if ($allowed_template !== '') {
			$this->metaboxes['custom_autohrize_only_on'] = array('template' => array($allowed_template));
		}
		/**
		 * If title is not empty
		 */
		if ($title != '') {
			$this->metaboxes['title'] = $title;
		}

		$this->metaboxes['id'] = $this->id;

		return $this->metaboxes;
	}

	/**
	 * Call section template
	 *
	 * @param string $filter_name The filter that this section will be included in.
	 */
	public function call_template($filter_name) {

		add_filter($filter_name, function ($html) {
			if (rwmb_get_value($this->id . '_disabled') == 1) return $html;

			$section = $this->get_html();

			return $html . $section;
		}, 10, 2);
	}

	public function get_html() {
		$section_id = 'awesome-section-' . $this->id;
		// Begin: call template
		ob_start();
		include($this->template_path);
		$section = ob_get_contents();
		ob_end_clean();
		// End: call template
		return $section;
	}

	/**
	 * Get image full url
	 *
	 * @param array $arr
	 * @return string
	 */
	public function get_full_url($arr) {
		return $arr['full_url'];
	}
}
