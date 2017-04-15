<?php  get_header()?>
<!-- MAIN CONTENT -->


<!-- END MAIN CONTENT -->
<div class="home-blog home-notice padding-tb-50">

  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="blog-wrapper clearfix">
		    <?php
		    if(have_posts()){
			    while(have_posts()){
				    the_post();
				    get_template_part('content');
			    }
			    ?>
        </div>
        <div class="clearfix"></div>
        <div class="blog-pagination clearfix align-content-center justify-content-center">
          <?php
            echo paginate_links([
              'type'    => 'list'
            ]);
          ?>
        </div>
          <?php
		    }else{
		      get_template_part('content','none');
        }
		    ?>
      </div>
    </div>
  </div>
</div>




<?php get_footer()?>
