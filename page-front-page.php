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
				<h1>Front End Web Developer With a Focus on Coding</h1>
				<?php the_content(); ?>
			</div>

			<section id='intro-para'>
				<p>Hey there, I'm Steffen. I am a front end web developer based out of Vancouver, BC</p>
			</section>
			<section id='front-page-featured'>
				<h2>Check Out Some of My Featured Works</h2>
				<?php
					$args = array(
						'post_type' => 'portfolio_work',
						'posts_per_page' => -1,
						'tax_query' => array(
							array(
								'taxonomy' => 'portfolio_featured',
								'field' => 'slug',
								'terms' => 'front-featured'
							),
						),
					);
					$query = new WP_Query($args);
					if($query->have_posts()): ?>
					<div class="swiper">
						<div class="swiper-wrapper"> <?php
							while($query->have_posts()) : 
							$query->the_post(); ?>
							<div class='swiper-slide'>
								<article>
									<a href="<?php the_permalink();?>">
										<h3><?the_title();?></h3>
										<?php the_post_thumbnail('cube-work'); ?>
									</a>
									<a class='project-card-link' href="<?php the_permalink();?>">View Project</a>
								</article>
							</div>
							<?php endwhile; ?>
						</div>
						<div class="swiper-pagination"></div>
					</div>
					<?php
					wp_reset_postdata();
					endif;
				?>
				<div id = 'all-works'>
					<a href="/portfolio/works">All Projects</a>
				</div>
			</section>
			<section id='contact-me'>
				<h2>Want to Get in Touch?</h2>
				<a href="/portfolio/contact-me">
					<h3>Contact Me!</h3>
				</a>
			</section>
			<?php

		endwhile;
		?>

	</main><!-- #main -->

<?php
get_footer();