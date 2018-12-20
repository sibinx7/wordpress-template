<!-- HOME BLOG -->
<?php
  $home_news = new WP_Query([
    'post_type' => 'post',
    'post_status' => 'publish',
    'order' => 'desc',
    'orderby' => 'date',
    'posts_per_page' => 5,
    'meta' => [
      [
        'key' => '_thumbnail_id',
        'compare' => 'EXISTS'
      ]
    ]
  ]);

if ($home_news->have_posts()):
?>
  <div class="home__news section-padding section-padding">
    <div class="container">
      <h3 class="section-title text-center text-uppercase title-border text-light mb-5 text-dark">Blog</h3>
      <div class="row">
        <div class="col-12">
          <div class="news__list">
            <?php
            while ($home_news->have_posts()):
              $home_news->the_post();
              $h_title = get_the_title();
              $h_id = get_the_ID();
              $h_thumbnail = get_the_post_thumbnail_url();
              $h_link = get_the_permalink();
              $h_categories = get_categories($h_id);
              ?>
              <div class="news__item">
                <div class="card news__card" style="background-image: url('<?php _e($h_thumbnail) ?>')">
                  <div class="card-body">
                    <div class="content">
                      <h4 class="title">
                        <a href="<?php _e($h_link) ?>"><?php _e($h_title) ?></a>
                      </h4>
                    </div>
                    <div class="content-more">
                      <div class="more text-center">
                        <a href="<?php _e($h_link) ?>">Load More</a>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            <?php
            endwhile;
            ?>
          </div>
        </div>
      </div>
      <p class="text-center">
        <a href="<?php _e(get_post_type_archive_link('post'));?>" class="btn btn-outline btn-outline-dark btn-lg">+ POSTS</a>
      </p>
    </div>
  </div>
<?php
  endif;
?>

<!-- END HOME BLOG -->