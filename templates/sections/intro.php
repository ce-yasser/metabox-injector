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