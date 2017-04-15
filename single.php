<?php
/**
 * Created by PhpStorm.
 * User: sibin
 * Date: 1/1/2017
 * Time: 8:38 PM
 */
get_header()
?>
<div class="single-blog-post-wrapper padding-tb-50">
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-9 col-lg-9">
				<div class="single-blog-post">
          <?php
            if(have_posts()):
              while(have_posts()):
                the_post();
                get_template_part('content','single');
              endwhile;
            endif;
          ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
	get_footer();
?>
