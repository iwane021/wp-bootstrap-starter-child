<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP_Bootstrap_Starter
 */

?>

<div class="container">
	<div id="content-berita" class="home-grid">
		<div class="list-heading text-center">
			<h2><span>Berita</span></h2>
		</div>
		<div class="row">
			<?php 
				// Berita -> Category ID : 4
				$args = array(
					'post_status' => 'publish',
					'cat' => 4,
					'posts_per_page' => 3
					);
				
				$query = new WP_Query($args);
				// print '<pre>';
				// print_r($query);
				// print '</pre>';
				// exit();
				if($query->have_posts()):
					$i = 0;
					while($query->have_posts()): $query->the_post();
						$i = $i + 0.25;
				?>
				<div class="col-md-4">
					<div class="card">
						<?php if(has_post_thumbnail()) : 
						$image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID())); ?>
							<img class="card-img-top" src="<?php echo esc_url( $image[0] ); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
						<?php else: ?>
							<img class="card-img-top" src="<?php echo esc_url(get_stylesheet_directory_uri().'/assets/images/thumbnail.jpg'); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
						<?php endif; ?>
					  	<div class="card-body">
				    		<h5 class="card-title"><?php the_title(); ?></h5>
					    	<p class="card-text">
					    		<?php echo custom_letter_count( get_the_excerpt(), 200 );  // WPCS: XSS OK. ?>
			    			</p>
					    	<a href="<?php the_permalink(); ?>" class="btn btn-primary"><?php esc_html_e('Read More','wp-bootstrap-starter') ?>&nbsp;&nbsp;<i class="fa fa-angle-right"></i></a>
					  </div>
					</div>
				</div>

				<?php
					endwhile;
					wp_reset_postdata();
				endif;
			?>
			<!-- <div class="col-sm-4">
				<ul class="list-group">
					<li class="list-group-item">Cras justo odio</li>
					<li class="list-group-item">Dapibus ac facilisis in</li>
					<li class="list-group-item">Morbi leo risus</li>
					<li class="list-group-item">Porta ac consectetur ac</li>
					<li class="list-group-item">Vestibulum at eros</li>
				</ul>
			</div>
			<p></p>
			<div class="col-sm-4">
				<ul class="list-group">
					<li class="list-group-item">Cras justo odio 2</li>
					<li class="list-group-item">Dapibus ac facilisis in 2</li>
					<li class="list-group-item">Morbi leo risus 2</li>
					<li class="list-group-item">Porta ac consectetur ac 2</li>
					<li class="list-group-item">Vestibulum at eros 2</li>
				</ul>
			</div>
			<p></p>
			<div class="col-sm-4">
				<ul class="list-group">
					<li class="list-group-item">Cras justo odio 3</li>
					<li class="list-group-item">Dapibus ac facilisis in 3</li>
					<li class="list-group-item">Morbi leo risus 3</li>
					<li class="list-group-item">Porta ac consectetur ac 3</li>
					<li class="list-group-item">Vestibulum at eros 3</li>
				</ul>
			</div>
			<p></p> -->
		</div> <!-- .row -->
	</div> <!-- #content-berita -->
</div> <!--.container -->
