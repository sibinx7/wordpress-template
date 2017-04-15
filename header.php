<html>
	<head>
		<?php wp_head()?>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="charset" content="utf-8">
		<meta name="author" content="Sibin Xavier">
		<title><?php echo wp_title()?></title>
	</head>
	<body>
		<div class="wrapper">
			<!-- HEADER SECTION -->
      <header class="c-header">
      <?php
        $c_img_logo = get_stylesheet_directory_uri().'/images/logo.jpg';
        $blog_name  = get_bloginfo('name');
      ?>
      <nav class="navbar navbar-toggleable-md navbar-light bg-faded c-custom-header">
       <div class="container">

         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
           <span class="navbar-toggler-icon"></span>
         </button>
         <a class="navbar-brand" href="<?php echo get_home_url()?>">
           <img src="<?php echo $c_img_logo?>" alt="<?php echo $blog_name?>">
         </a>
         <div class="collapse navbar-collapse align-content-end c-collpase-menu" id="navbarTogglerDemo01">
           <ul class="social-media-and-top ">
             <li class="f-icon"><a href=""><span class="fa fa-linkedin"></span></a></li>
             <li class="f-icon"><a href=""><span class="fa fa-facebook"></span></a></li>
             <li><a href="">(55) 3251-2761</a></li>
           </ul>
           <?php
            if(has_nav_menu('c_header_menu')){
              get_campanher_header_menu('c_header_menu',[]);
            }
           ?>
         </div>
       </div>
      </nav>
      </header>
			<!-- END HEADER SECTION -->

