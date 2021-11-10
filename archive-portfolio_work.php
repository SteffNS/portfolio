<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Steffen-Portfolio
 */

get_header();
?>

	<main id="primary" class="site-main">
	<h1>Projects</h1>
		<?php
			$args = array(
				'post_type'   => 'portfolio_work',
				'posts_per_page' => -1,
			);
			$query = new WP_Query($args);
			if($query->have_posts()) : ?>
			<section class='archive-work'> <?php
				while($query->have_posts()){
					$query->the_post(); ?>
					<article class='list-work-item'>
						<a class='banner-image-link' href="<?php the_permalink();?>">
							<h2><?php the_title();?></h2>
							<?the_post_thumbnail('cube-work');?>
						</a>
						<p><?php if(the_field('excerpt')):
								the_field('excerpt');
							endif;?>
						</p>
						<?php
						if(have_rows('languages')): ?>
						<div class='para-wrapper'>
						<p class='list-work-item-para'>Languages: </p> <?php
							while(have_rows('languages')):
								the_row();
								$sub_value=get_sub_field('code_language'); ?>
								<p class='list-work-item-para'><?php echo $sub_value; ?></p>
							<?php endwhile; ?>
						</div> <?php
						endif;
						?>
						<a class='list-project' href="<?php the_permalink()?>">View Project</a>
					</article>
				<?php
				}
				wp_reset_postdata(); ?>
			</section> <?php
			endif;
		?>
	</main><!-- #main -->
<?php
get_footer();
