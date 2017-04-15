<?php
/**
 * Created by PhpStorm.
 * User: sibin
 * Date: 3/26/2017
 * Time: 7:36 AM
 */

  get_header();
?>
<div class="wrapper 404-page padding-tb-60">
  <div class="container">
    <div class="row">
      <div class="col-12 text-center">
        <h1 class="big-title mb-5">
          404 Not Found
        </h1>
        <article class="big-article">
          Looks like somethinf went completely wrong!. But don't worry, it can happend to the best of us, and it just happened to you.
        </article>
        <article class="big-article mb-3">
          try below links
        </article>
        <ul class="good-links">
          <li><a href="<?php echo home_url()?>">Home</a></li>
          <li><a href="<?php echo home_url().'/blog'?>">Blog</a></li>
          <li><a href="<?php echo home_url().'/contact-us'?>">Contact US</a></li>
          <li><a href="<?php echo home_url().'/wp-login.php'?>">Login</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<?php
  get_footer();
?>
