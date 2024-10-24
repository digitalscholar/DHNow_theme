<?php
/*
Template Name: Blog
*/

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		get_template_part( 'template-parts/content', 'page' );
		?>

	</main><!-- #main -->

<?php
get_footer();
