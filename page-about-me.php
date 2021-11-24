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
				<h1>About Me</h1>
				<?php 
				$image = get_field('banner_image');
				if( !empty( $image ) ): ?>
					<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
				<?php endif;
				?>
			</div>
			<section id='about-steffen'>
				<?php
				the_content();
				?>
			</section>
			<?php
			if(have_rows('tools')): ?>
				<section id='toolkit'>
					<h2>Toolkit</h2>
					<section id='toolkit-wrapper'>
						<div id='design-toolkit' class='toolkit'>
							<h3>Design</h3>
							<ul>
							<?php
							$dev_tools = get_field('design_tools');
							foreach($dev_tools as $single_tool): ?>
								<li>
									<?php get_template_part('images/inline', $single_tool); ?>
								</li>
								<?php
							endforeach; ?>
							</ul>
						</div>
						<div id='develop-toolkit' class='toolkit'>
							<h3>Development</h3>
							<ul>
							<?php
							$dev_tools = get_field('dev_tools');
							foreach($dev_tools as $single_tool): ?>
								<li>
									<?php get_template_part('images/inline', $single_tool); ?>
								</li>
								<?php
							endforeach; ?>
							</ul>
						</div>	
					</section>			
				</section>
				<?php
			endif;
		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
