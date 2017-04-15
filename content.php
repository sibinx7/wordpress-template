<?php
/**
 * Created by PhpStorm.
 * User: sibin
 * Date: 1/1/2017
 * Time: 8:38 PM
 */

$the_ID = get_the_ID();
$s_img = get_the_post_thumbnail_url($the_ID);
$s_per_link = get_permalink($the_ID);
$s_title = get_the_title($the_ID);
if(isset($s_img) && ($s_img==null && $s_img=="")){
  $s_img = "https://placehold.it/360X240";
}

$s_post_type = get_post_type($the_ID);
?>



<div class="blog-posts post-type-<?php echo $s_post_type?>">
  <div class="b-item-box sm-with-img">
    <?php if( isset($s_img) && $s_img!=null &&  $s_img!=""):?>
    <div class="b-img m-b-40" style="background-image: url('<?php echo $s_img?>')">
      <img src="<?php echo $s_img?>" alt="<?php echo $s_title?>">
    </div>
    <?php endif;?>
    <div class="b-box-footer">
      <h5 class="title"><a href="<?php echo $s_per_link ?>">
        <?php
          echo $s_title;
        ?>
        </a>
        <a href="<?php echo $s_per_link ?>" class="float-right icon-link btn btn-outline btn-white-outline btn-sm">
          <span class="fa fa-plus"></span>
        </a>
      </h5>
    </div>
  </div>
</div>
