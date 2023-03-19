# Metabox Injector
I created this structure a while back while working on a wordpress theme based on metabox.io plugin.
I was able to create custom reusable sections where I can share the metaboxes of each section between page templates and can use the same section multiple times in the same page.

## How To Use It
### Creating a section 
Create a section class and extend AWESOME_Class
It will contain 3 variables
- id: Section id, passed from the parent page.
- template_path: Your section file
- metaboxes: Array of metaboxes
```php
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
```

Then lets create the section file, nothing special in this file, just make sure you added the correct path to the section class
```php
<?php
// Exit on direct access
if (!defined('ABSPATH')) exit();

$img_url = empty(rwmb_get_value($this->id . '_image')) ?
	get_template_directory_uri() . '/images/home/intro.png' :
	$this->get_full_url(rwmb_get_value($this->id . '_image', ['size' => 'full', 'limit' => 1])[0]);
?>

<section class="awesome-intro" id="<?php echo $section_id; ?>" style="--awesome-intro-img: url(<?php echo $img_url; ?>);">
	<h1 class="awesome-intro__title"><?php echo rwmb_get_value($this->id . '_title'); ?></h1>
</section>
```
### Creating a page template
You need to create a page template and add a custom filter to it.
```php
<?php /* Template Name: Home */
get_header(); ?>

<main id="primary" class="site-main">

	<?php
	/**
	 * awesome_home filter
	 * 
	 * @param string $html
	 */
	echo apply_filters('awesome_home', '', get_the_ID()); ?>

</main>

<?php
get_footer();

```

Then create a new class for home page and extend the page class.
You will use this class to define 3 variables.
- template_name: Template path in theme folder
- filter_name: The unique filter use in the template
- sections: Array of objects(sections), key should be unique, value section class name
```php
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
```