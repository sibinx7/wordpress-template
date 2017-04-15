<?php
/**
 * Created by PhpStorm.
 * User: sibin
 * Date: 1/1/2017
 * Time: 8:38 PM
 */

  get_header();
?>
<div class="page wrapper wrapper single-page single-blog-post padding-tb-50">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <?php
          if(have_posts()){
            while(have_posts()){
              the_post();
              get_template_part('content','page');
            }
          }else{
            get_template_part('content','none');
          }
        ?>
      </div>
    </div>
  </div>
</div>
<?php
  get_footer();
?>
