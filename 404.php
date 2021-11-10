<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Steffen-Portfolio
 */

get_header();
?>

	<main id="primary" class="site-main">

		<section class="error-404 not-found">
			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'steffen-portfolio' ); ?></h1>
			</header><!-- .page-header -->

			<div class="page-content">
				<p>It looks like you have found the 404 page. <a href='/portfolio'>Go back home</a> or view some of my past works.</p>

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
						<article>
							<a href="<?php the_permalink();?>">
								<h3><?php the_title();?></h3>
								<?the_post_thumbnail('medium');?>
							</a>
							<p><?the_excerpt();?></p>
							<a class='list-project' href="<?php the_permalink()?>">View Project</a>
						</article>
					<?php
					}
					wp_reset_postdata();
				endif;
				?>

			</div><!-- .page-content -->
		</section><!-- .error-404 -->

	</main><!-- #main -->

<?php
get_footer();
