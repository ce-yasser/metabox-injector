<?php
// Exit on direct access
if (!defined('ABSPATH')) exit();

$img_url = empty(rwmb_get_value($this->id . '_image')) ?
	get_template_directory_uri() . '/images/home/about.jpg' :
	$this->get_full_url(rwmb_get_value($this->id . '_image', ['size' => 'full', 'limit' => 1])[0]);
$img_mobile_url = empty(rwmb_get_value($this->id . '_image_mobile')) ?
	get_template_directory_uri() . '/images/home/about_mobile.jpg' :
	$this->get_full_url(rwmb_get_value($this->id . '_image_mobile', ['size' => 'full', 'limit' => 1])[0]);
?>

<section class="awesome-about" id="<?php echo $section_id; ?>" style="--awesome-about-img: url(<?php echo $img_url; ?>);">
	<div class="awesome-about__container">
		<p class="awesome-about__subtitle"><?php echo rwmb_get_value($this->id . '_subtitle'); ?></p>
		<h2 class="awesome-about__title"><?php echo rwmb_get_value($this->id . '_title'); ?></h2>
		<div class="awesome-about__text"><?php echo rwmb_get_value($this->id . '_text'); ?></div>
	</div>
</section>