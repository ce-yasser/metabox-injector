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
