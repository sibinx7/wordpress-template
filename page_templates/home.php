<?php
/**
 * Created by PhpStorm.
 * User: sibin
 * Date: 3/23/2017
 * Time: 7:27 AM
 *
 * @package Campanher
 * @subpackage Campanher Template
 * @author Sibin Xavier
 *
 * Template Name: Home
 */


get_header();
?>
<div class="home-content">
  <!-- HOME SLIDER SECTION -->
  <?php
  $slider_posts = new WP_Query([
    'post_type' => 'slider',
    'post_status' => 'publish',
    'order' => 'desc',
    'orderby' => 'date',
    'posts_per_page' => 4,
    'meta_query' => [
      [
        'key' => '_thumbnail_id',
        'compare' => 'EXISTS'
      ]
    ]
  ]);
  if ($slider_posts->have_posts()):
    ?>
    <div class="home-slider">
      <ul id="home-slider-element">
        <?php
        while ($slider_posts->have_posts()):
          $slider_posts->the_post();
          $s_image = get_the_post_thumbnail_url();
          ?>
          <li>
            <div class="single-home-slider v-center-wrapper"
                 style="background-image: url('<?php echo $s_image ?>')">
              <div class="v-center-inner">
                <div class="container">
                  <div class="row">
                    <div class="col-10 col-sm-10 col-md-8 offset-1 offset-sm-1 offset-md-2">
                      <?php
                      the_title('<h2 class="text-center">', '</h2>');
                      ?>
                      <article class="text-center mb-5">
                        <?php the_excerpt(); ?>
                      </article>
                      <?php
                        $slider_extra           = get_post_meta(get_the_ID(),'extra_fields',true);
                        $slider_extra_array     = unserialize($slider_extra);
                        $slider_extra_array     = array_filter($slider_extra_array);
                        $slider_default_array   = ['button_text'=>'','button_link'=>''];
                        if(is_array($slider_extra_array)){
                          $slider_default_array = array_merge($slider_default_array,$slider_extra_array);
                        }
                        if($slider_default_array['button_link']!='' && $slider_default_array['button_text']):
                      ?>
                      <p class="text-center slider-extra">
                        <a href="<?php echo $slider_default_array['button_link'];?>"
                           class="btn btn-outline btn-white-outline">
                          <?php
                            echo $slider_default_array['button_text'];
                          ?>
                        </a>
                      </p>
                      <?php endif;?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </li>
          <?php
        endwhile;
        ?>
      </ul>
    </div>
    <?php
  endif;
  wp_reset_postdata();
  ?>
  <!-- END HOME SLIDER SECTION -->

  <!-- NUMBER BANNER -->
  <div class="home-num-banner">
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-6 col-lg-3">
          <div class="num-box text-center">
            <div class="title-num">
              +
              <span id="year-history-num">30</span>
            </div>
            <div class="title-text">
              <?php
              echo __('Years of History', 'campaher')
              ?>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
          <div class="num-box text-center">
            <div class="title-num">
              +
              <span id="project-delivered-num">
                  1120
                </span>
            </div>
            <div class="title-text">
              <?php
              echo __("Project Delivered", 'campaher')
              ?>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
          <div class="num-box text-center">
            <div class="title-num">
              +
              <span id="of-built-area-num">1114</span>
              m<sup>2</sup>
            </div>
            <div class="title-text">
              <?php echo __("Of built area", 'campaher') ?>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
          <div class="num-box text-center">
            <div class="title-num">
              +
              <span id="effect-num">1870</span>
            </div>
            <div class="title-text">
              <?php echo __('Maintenance And Inspections Effected', 'campaher') ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- END NUMBER BANNER -->
  <!-- CLIENT WORK SECTION -->
  <div class="home-client-work padding-tb-40">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h2 class="text-center m-b-40">Client Work</h2>
          <!-- client work posts -->
          <?php
            $client_words_args    = [
              'post_type'         => 'customer_word',
              'posts_per_page'    => 2,
              'post_status'       => 'publish',
              'order'             => 'DESC',
              'orderby'           => 'date'
            ];

            $client_words_posts  = new WP_Query($client_words_args);
            if($client_words_posts->have_posts()):
          ?>
          <div class="home-client-words clearfix">
            <?php
              while ($client_words_posts->have_posts()):
                $client_words_posts->the_post();
            ?>
            <div class="each-client-word">
              <div class="client-word-video">
                <?php
                  the_content();
                ?>
              </div>
            </div>
            <?php
              endwhile;
            ?>
          </div>
          <div class="c-worlds-more text-center m-b-40 clearfix">
            <?php
              $deposition_archive = get_post_type_archive_link('customer_word');
            ?>
            <a href="<?php echo $deposition_archive ?>" class="btn btn-outline btn-white-outline text-uppercase">
              <span class="fa fa-plus"></span>&nbsp;
              depositions
            </a>
          </div>
          <?php
            endif;
            wp_reset_postdata();
          ?>
          <!-- end client work posts -->


          <h2 class="text-center m-b-25">Qualidade Campanher</h2>
          <article class="m-b-50 text-center">
            Os 30 anos de fundação da Campanher qualificam a empresa como uma das mais capacitadas na montagem,
            manutenção e inspeção de caldeiras do País. A Campanher honra sua história e continua investindo na
            qualificação técnica de sua equipe, em equipamentos modernos e atualizados, no planejamento de suas ações de
            acordo com as especificidades de cada projeto e em um atendimento exclusivo a cada cliente. O resultado são
            soluções de excelência para os desafios da área com diferenciais que valorizam o investimento do cliente.
            Este é o compromisso da Campanher. Esta é a Campanher:
          </article>
          <div class="clearfix"></div>
          <div class="h-client-work-i-section">
            <div class="row">
              <div class="col-12 col-md-4">
                <div class="icon-m">
                  <div class="icon-element bulb"></div>
                </div>
                <div class="title-s">
                  <h4 class="text-center">
                    SOLUÇÕES COMPLETAS
                  </h4>
                  <p class="text-center">
                    Cada projeto com características
                    únicas de acordo com as necessidades.
                  </p>
                </div>
              </div>
              <div class="col-12 col-md-4">
                <div class="icon-m">
                  <div class="icon-element hand"></div>
                </div>
                <div class="title-s">
                  <h4 class="text-center">
                    COMPROMETIMENTO COM O CLIENTE
                  </h4>
                  <p class="text-center">
                    Cada detalhe da instalação validados
                    por critérios avançados de qualidade.
                  </p>
                </div>
              </div>
              <div class="col-12 col-md-4">
                <div class="icon-m">
                  <div class="icon-element tick"></div>
                </div>
                <div class="title-s">
                  <h4 class="text-center">
                    GARANTIA DE ENTREGA
                  </h4>
                  <p class="text-center">
                    Rígido cumprimento de cronogramas e
                    de acordo com as especificações.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- END CLIENT WORK SECTION -->

  <!-- HOME SOLUTIONS -->
  <div class="home-solution padding-tb-40">
    <div class="container">
      <div class="row m-b-30">
        <div class="col-12">
          <h2 class="text-center text-uppercase m-b-40">Solutions</h2>
          <div class="row">
            <div class="col-12 col-md-6">
              <h4 class="text-center m-b-30 text-uppercase s-list-title">
                ASSEMBLY AND
                MAINTENANCE</h4>
              <ul class="s-list mb-4">
                <li>Montagem de caldeiras de várias marcas do mercado.</li>
                <li>Representante exclusiva no RS das ICAVI Caldeiras.</li>
                <li>Transposição de caldeiras para instalação com equipamentos próprios,
                  como guindastes, por todo estado do RS.</li>
                <li>Trabalho com mangueiras hidráulicas próprias.</li>
              </ul>
              <div class="text-right">
                <a href="" class="btn btn-circle btn-circle-red">
                  <span class="fa fa-plus"></span>
                </a>
              </div>
            </div>
            <div class="col-12 col-md-6">
              <h4 class="text-center m-b-30 text-uppercase s-list-title">
                INSPECTIONS
              </h4>
              <ul class="s-list mb-4">
                <li>Alta qualificação para inspeção detalhada de todo o conjunto contemplando lista de itens, inclusive a cor da fumaça emitida pela caldeira.</li>
                <li>Serviço realizado de acordo com a NR13.</li>
                <li>Profissionais treinados e com capacitação técnica.</li>
                <li>Emissão de laudo técnico da inspeção.</li>
              </ul>
              <div class="text-right">
                <a href="" class="btn btn-circle btn-circle-red">
                  <span class="fa fa-plus"></span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- PROJECT SECTION -->
      <?php
        $projects           = new WP_Query([
          'post_type'       =>  'project',
          'order'           =>  'DESC',
          'orderby'         =>  'date',
          'posts_per_page'  => 6,
          'post_status'     => 'publish',
          'meta_query'      => [
            [
              'key'           => '_thumbnail_id',
              'compare'       => 'EXISTS'
            ]
          ]
        ]);
        if($projects->have_posts()):

      ?>
      <div class="row">
        <div class="col-12">
          <h4 class="text-center text-uppercase mb-5">Projects</h4>

          <ul class="home-project-list m-b-40 clearfix">
            <?php
              while($projects->have_posts()):
                $projects->the_post();
                $project_img = get_the_post_thumbnail_url(get_the_ID());
            ?>
                <li>
                  <div class="home-project-item">
                    <div class="p-image">
                      <a href="" style="background-image: url('<?php echo $project_img;?>')">
                        <img src="<?php echo $project_img?>"
                             class="img-fluid"
                             alt="<?php echo get_the_title()?>">
                      </a>
                    </div>
                    <div class="p-title text-center">
                      <h5><?php echo get_the_title()?></h5>
                    </div>
                    <?php
                      $category_list = wp_get_post_categories(get_the_ID());
                      if(sizeof($category_list)>0):
                    ?>
                    <div class="p-category text-center">
                      <ul class="clearfix m-b-30">
                        <?php
                          foreach ($category_list as $key => $value):?>
                          <li>
                            <a href="<?php echo get_category_link($value)?>">
                              <?php
                                echo (get_the_category_by_ID($value));
                              ?>
                            </a>
                          </li>
                        <?php endforeach;?>
                      </ul>
                    </div>
                    <?php endif;?>
                  </div>
                </li>
            <?php
              endwhile;
            ?>
          </ul>
          <div class="clearfix"></div>
          <div class="text-center m-b-30">
            <?php
              $projects_link = get_post_type_archive_link('project');
            ?>
            <a href="<?php echo $projects_link ?>" class="btn btn-circle btn-circle-red">
              <span class="fa fa-plus"></span>
            </a>
          </div>
        </div>
      </div>
      <?php
        endif;
        wp_reset_postdata();
      ?>
      <!-- END PROJECT SECTION -->
    </div>
  </div>
  <!-- END HOME SOLUTIONS -->
  <!-- HOME CLIENT SECTION -->
  <?php
  $clients            = new WP_Query([
    'post_type'       => 'client',
    'posts_per_page'  => 6,
    'post_status'     => 'publish',
    'order'           => 'DESC',
    'orderby'         => 'date',
    'meta_query'      => [
      [
        'key'           => '_thumbnail_id',
        'compare'       => 'EXISTS'
      ]
    ]
  ]);
  if($clients->have_posts()):
    ?>
    <div class="home-client-section padding-tb-40">
      <h3 class="text-center text-uppercase m-b-30 title">Clients</h3>
      <div class="h-client-wrapper">
      <ul class="h-client-list clearfix m-b-40" id="h-client-list">
        <?php
        while ($clients->have_posts()):
          $clients->the_post();
          $client_img = get_the_post_thumbnail_url(get_the_ID());
          ?>
          <li>
            <a href="">
              <img src="<?php echo $client_img?>" alt="<?php echo get_the_title()?>" class="img-fluid">
            </a>
          </li>
          <?php
        endwhile;
        ?>
      </ul>
      <div class="text-center m-b-30">
        <?php
          $client_links = get_post_type_archive_link('client');
        ?>
        <a href="<?php echo $client_links?>"
           class="btn btn-outline btn-white-outline">
          <span class="fa fa-plus"></span>
          Clients
        </a>
      </div>
      </div>
    </div>
    <?php
  endif;
  ?>
  <!-- END HOME CLIENT -->

  <!-- HOME NOTICE -->
  <?php
    $blog_obj             = new WP_Query([
      'post_type'         => 'post',
      'posts_per_page'    =>  4,
      'order'             => 'DESC',
      'orderby'           => 'date',
      'post_status'       => 'publish',
      'meta_query'        => [
        [
          'key'             => '_thumbnail_id',
          'compare'         => 'EXISTS'
        ]
      ]
    ]);
    $blogs                = $blog_obj->posts;
    if(sizeof($blogs) > 0):
  ?>
  <div class="home-notice home-blogs-box padding-tb-40">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h3 class="text-center text-uppercase m-b-30">Notice</h3>
          <div class="row">
            <?php
              if(isset($blogs[0])):
                $first_blog = $blogs[0];
                setup_postdata( $first_blog );
                $excerpt = get_the_excerpt();
                $b_f_img = get_the_post_thumbnail_url($first_blog->ID);
            ?>
            <div class="col-12 col-md-5">
              <div class="b-item-box main-box">
                <div class="b-img" style="background-image: url('<?php echo $b_f_img?>')">
                  <img src="<?php echo $b_f_img?>" alt="<?php $first_blog->post_title?>">
                </div>
                <h5>
                  <?php echo $first_blog->post_title;?>
                </h5>
                <article class="m-b-10">
                  <?php
                    echo $excerpt;
                  ?>
                </article>
                <div class="text-center">
                  <h5>
                    <a href="" class="btn btn-outline btn-white-outline btn-sm">
                      More
                      <span class="fa fa-plus"></span>
                    </a>
                  </h5>
                </div>
              </div>
            </div>
            <?php
              wp_reset_postdata();
              endif;
              ?>
            <div class="col-12 col-md-7">
              <?php
                if(sizeof($blogs)>2):
              ?>
              <div class="row">
                <?php
                  $upto_index = sizeof($blogs)>2?2:1;
                  $t_t_blogs = array_slice($blogs,1,$upto_index);
                  foreach($t_t_blogs as $key => $s_blog):
                    $s_img = get_the_post_thumbnail_url($s_blog->ID);
                    $s_per_link = get_permalink($s_blog->ID);
                    $s_title = get_the_title($s_blog->ID);
                ?>
                <div class="col-12 col-md-6">
                  <div class="b-item-box sm-with-img">
                    <div class="b-img m-b-40" style="background-image: url('<?php echo $s_img?>')">
                      <img src="<?php echo $s_img?>" alt="<?php echo $s_title?>">
                    </div>
                    <div class="b-box-footer">
                      <h5 class="title">
                        <a href="<?php echo $s_per_link ?>">
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
                <?php
                    endforeach;
                  endif;
                ?>
              </div>
              <?php if(isset($blogs[3])):?>
              <div class="row">
                <div class="col-12">
                  <?php
                    $four_blog        = $blogs[3];
                    $four_title       = $four_blog->post_title;
                    setup_postdata($four_blog);
                    $four_link        = get_permalink($four_title->ID);
                    $four_excerpt     = get_the_excerpt();
                    wp_reset_postdata();
                  ?>
                  <div class="b-item-box without-img">
                    <h5><?php
                        echo $four_title;
                      ?></h5>
                    <article class="m-b-20">
                      <?php echo $four_excerpt;?>
                    </article>
                    <div class="text-right">
                      <a href="<?php echo $four_link?>" class="btn btn-outline btn-white-outline btn-sm">
                        More
                        <span class="fa fa-plus"></span>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <?php endif;?>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12 text-center">
          <a href="" class="btn btn-outline btn-red-outline">
            <span class="fa fa-plus"></span>
            Notices
          </a>
        </div>
      </div>
    </div>
  </div>
  <?php
    endif;
    wp_reset_postdata();
  ?>
  <!-- END HOME NOTICE -->
</div>

<?php
get_footer();
?>


