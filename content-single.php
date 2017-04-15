<?php
/**
 * Created by PhpStorm.
 * User: sibin
 * Date: 1/1/2017
 * Time: 8:38 PM
 */
?>

<div class="home-single-post single-post">
  <?php if(has_post_thumbnail()): ?>
<!--  <div class="single-body-img">-->
<!--    <img src="--><?php //echo get_the_post_thumbnail_url()?><!--" alt="--><?php //echo get_the_title()?><!--"-->
<!--    class="img-fluid">-->
<!--  </div>-->
  <?php endif;?>
  <div class="single-body-title">
  <?php
    the_title('<h1 class="single-title">','</h1>')
  ?>
    
  </div>
  <div class="single-body-content">
  <?php
    the_content();
  ?>
  </div>
</div>
