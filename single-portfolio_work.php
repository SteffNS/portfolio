<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Steffen-Portfolio
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post(); ?>
			<h1><?php the_title(); ?></h1>

			<section id='swiper-wrapper'>
			<?php 
			$images = get_field('work_image');
			if( $images ): ?>
				<div class="swiper">
					<div class="swiper-wrapper">
						<?php foreach( $images as $image ): ?>
							<div class='swiper-slide'>
								<article>
									<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
									<p><?php echo esc_html($image['caption']); ?></p>
								</article>
							</div>
						<?php endforeach; ?>
					</div>
					<div class="swiper-pagination"></div>
				</div>
			<?php endif; ?>
			</section>
			<section id='dev-lang' class='tech-logos'>
				<h3>Development Languages</h3>
				<ul>
				<?php $tech_lang = get_field('language_choice');
				foreach($tech_lang as $single_language): ?>
					<li>
						<?php get_template_part('images/inline', $single_language); ?>
					</li>
					<?php
				endforeach; ?>
				</ul>
			</section>
			<section id='work-info'>
				<h3>About the Project</h3>
				<div class='acf-work-field'>
					<?php 
					if(function_exists('get_field')):
						the_field('work_info');
					endif;
					?>
				</div>
				<?php 
					the_content(); 
				
				?>
			</section>
			<section id='dev-tool' class='tech-logos'>
				<h3>Development Tools</h3>
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
			</section>
			<section class='role-timeline'>
				<?php
				if(function_exists('the_field')): ?>
					<p><i class="fas fa-calendar-alt"></i><strong> Project timeline:</strong> <?php the_field('timeline');?></p>
				<?php endif;
				if(function_exists('the_field')): ?>
					<p><i class="fas fa-user-alt"> </i><strong> Role:</strong> <?php the_field('roles');?></p>
				<?php endif; ?>
			</section>
			<?php
			the_post_navigation(
				array(
					'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'steffen-portfolio' ) . '</span> <span class="nav-title">%title</span>',
					'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'steffen-portfolio' ) . '</span> <span class="nav-title">%title</span>',
				)
			); 

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
