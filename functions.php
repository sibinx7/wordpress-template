<?php
/**
 * Created by PhpStorm.
 * User: sibin
 * Date: 1/1/2017
 * Time: 8:11 PM
 */


	add_theme_support('post-thumbnails');
	add_theme_support('html5');

/**
 * Stylesheet
 */
	function theme_stylesheets(){
		wp_enqueue_style('stylesheet', get_stylesheet_uri());
		wp_enqueue_style('main', get_stylesheet_directory_uri().'/stylesheets/main.css');
	
	}

	function theme_script(){
		wp_enqueue_script('bootstrap-libs',get_stylesheet_directory_uri().'/javascripts/bootstrap-libs.js',[],false,true);
    wp_enqueue_script('common-3rd-libs',get_stylesheet_directory_uri().'/javascripts/common-3rd-libs.js',[],false,true);
    wp_enqueue_script('main-js',get_stylesheet_directory_uri().'/javascripts/main-es6.js',[],false,true);
	}

	add_action('wp_enqueue_scripts','theme_stylesheets');
	add_action('wp_enqueue_scripts','theme_script');

	add_action('init','default_header_menu');

	function default_header_menu(){
	  register_nav_menu('c_header_menu',__('Header Menu',''));
  }

function get_default_header_menu($theme_location,$options=[]){
	$theme_location_slug = create_slug($theme_location);
  $default_options = [
    'class' => "navbar-nav ml-auto $theme_location_slug"
  ];

  $options = array_merge($default_options,$options);
  $locations = get_nav_menu_locations();
  if(isset($theme_location) &&  isset($locations) && $locations[$theme_location]){
    $menu = get_term($locations[$theme_location],'nav_menu');
    $site_url = get_site_url();
    $menu_items = wp_get_nav_menu_items($menu->term_id);
    $max_menu_items = sizeof($menu_items);
    $menu_tpl = [];
    $menu_tpl_outer = "<ul class='".$options['class']."'>";
    $bool = false;
    try{
      foreach ($menu_items as $key => $menu_item){
        if( $menu_item->menu_item_parent == 0 ) {
          $parent = $menu_item->ID;
          $menu_array = array();
          foreach( $menu_items as $submenu ) {
            if( $submenu->menu_item_parent == $parent ) {
              $bool = true;
              $menu_array[] = '<li class="nav-item"><a href="' . $submenu->url . '" class="nav-item">' . $submenu->title . '</a></li>' ."\n";
            }
          }

          if( $bool == true && count( $menu_array ) > 0 ) {
            $menu_tpl_a = "";
            $menu_tpl_a .= '<li class="dropdown nav-item">' ."\n";
            $menu_tpl_a .= '<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">' . $menu_item->title . '</a>' ."\n";

            $menu_tpl_a .= '<ul class="dropdown-menu">' ."\n";
            $menu_tpl_a .= implode( "\n", $menu_array );
            $menu_tpl_a .= '</ul>' ."\n";
            $menu_tpl_a .= '</li>' ."\n";
            array_push($menu_tpl,$menu_tpl_a);
          } else {
            $menu_tpl_a = "";
            $menu_tpl_a .= '<li class="nav-item">' ."\n";
            $menu_tpl_a .= '<a href="' . $menu_item->url . '" class="nav-link">' . $menu_item->title . '</a>' ."\n";
            $menu_tpl_a .= '</li>' ."\n";
            array_push($menu_tpl,$menu_tpl_a);
          }

        }
//        if(($max_menu_items) > 1 && $menu_item_number == round($max_menu_items/2)){
//          $menu_tpl .=  "<li class='home-brand hidden-xs hidden-sm'><a href='$site_url'><div>".get_bloginfo('name')."</div></a></li>";
//        }

      }
    }catch (Exception $e){
      var_dump($e->getMessage());
    }
    $menu_tpl_outer .= implode("\n",  $menu_tpl);
    $menu_tpl_outer .= "</ul>";
    echo ($menu_tpl_outer);
  }
}

add_filter('excerpt_more','new_excerpt_more');
function new_excerpt_more($more){
  return '';
}
add_filter('excerpt_length','new_excerpt_length');
function new_excerpt_length($length){
  return 40;
}


function create_slug($str, $delimiter = '-'){
  $slug = strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), $delimiter));
  return $slug;

}


function custom_excerpt($limit) {
	$excerpt = explode(' ', get_the_excerpt(), $limit);

	if (count($excerpt) >= $limit) {
			array_pop($excerpt);
			$excerpt = implode(" ", $excerpt) . '...';
	} else {
			$excerpt = implode(" ", $excerpt);
	}

	$excerpt = preg_replace('`\[[^\]]*\]`', '', $excerpt);

	return $excerpt;
}

function content($limit) {
$content = explode(' ', get_the_content(), $limit);

if (count($content) >= $limit) {
		array_pop($content);
		$content = implode(" ", $content) . '...';
} else {
		$content = implode(" ", $content);
}

$content = preg_replace('/\[.+\]/','', $content);
$content = apply_filters('the_content', $content); 
$content = str_replace(']]>', ']]&gt;', $content);

return $content;
}