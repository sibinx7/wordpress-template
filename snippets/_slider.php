<!-- COMMON SLIDER -->
<?php
			$slides = new WP_Query( [
				'post_type'   => 'slider',
				'post_status' => 'publish',
				'order'       => 'dec',
				'orderby'     => 'date',
				'meta'        => [
					[
						'key'     => '_thumbnail_id',
						'compare' => 'EXISTS'
					]
				]
			] );
			if ( $slides->have_posts() ):
				?>
        <div class="home__slider__post slick-home-banner-slider">
					<?php
						while ( $slides->have_posts() ):
							$slides->the_post();
						  $slider_image = get_the_post_thumbnail_url();
							?>
              <div class="home__slider__item" style="background-image: url('<?php echo $slider_image?>')">
                <div class="container">
                  <div class="text-right">
                    <h3 class="m-b-20 sub-title"><?php echo get_the_title()?></h3>
                    <h1 class="m-b-30 main-title"><?php echo get_the_title();?></h1>
                    <p>
                      <a href="<?php echo get_the_permalink()?>" class="btn btn-primary btn-lg">
                        <?php
                          echo __('Know More', 'operational-solution')
                        ?>
                      </a>
                    </p>
                  </div>
                </div>
              </div>
						<?php
						endwhile;
					?>
        </div>
			<?php
			endif;
			wp_reset_postdata();
		?>
<!-- END COMMON SLIDER -->