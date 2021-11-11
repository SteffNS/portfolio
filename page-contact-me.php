<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Steffen-Portfolio
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post(); ?>
			<div id='banner-wrapper'>
				<h1>Questions?</h1>
				<?php 
				$image = get_field('banner_image');
				if( !empty( $image ) ): ?>
					<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
				<?php endif;
				?>
			</div>
			<section id='contact-before'>
				<a href="mailto:snevessilva1@my.bcit.ca">
					<h2>Fill out the form or email me!</h2>
				</a>
			</section>
			<section id='contact-form'>
			<?php
				the_content(); ?>
			</section>
			<?php
		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
