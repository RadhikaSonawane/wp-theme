<?php
/**
 * The template for the front page.
 *
 */
get_header();

get_template_part('template-parts/front-page', 'slideshow');
get_template_part('template-parts/front-page', 'usps');
get_template_part('template-parts/front-page', 'education');
get_template_part('template-parts/front-page', 'socialmedia');

get_footer();
?>
