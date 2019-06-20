<?php
/**
 * Template Name: Home Page
 *
 * @package WP_Bootstrap_Starter
 */

get_header(); ?>
	
	<!-- Slider Homepage -->
    <div class="container">
		<div id="slideshow-image">
            <?php nivo_slider( "slider-1" ); ?>
        </div>
    </div>

	<!-- Konten Berita -->
	<?php get_template_part( 'template-parts/content', 'berita' ); ?>
	<!-- Konten Acara -->
	<?php get_template_part( 'template-parts/content', 'acara' ); ?>

	<?php /*
	<section id="primary" class="content-area col-sm-12">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>

			<?php
			endif;

			// Start the Loop
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', get_post_format() );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->
	*/ ?>

<?php
get_footer();
