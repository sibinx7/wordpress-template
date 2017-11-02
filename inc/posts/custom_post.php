<?php
/**
 * Created by PhpStorm.
 * User: sibin
 * Date: 6/28/2017
 * Time: 11:38 AM
 */
class CustomPost{
  protected  $labels;
  protected  $args;
  protected $name;
  protected $plural;
  public function __construct($name,$plural,$settings=[]){
    $this->name = $name;
    $this->plural = $plural;
    $labels = [];
    $args   = [];
    if(isset($settings['labels'])) $labels = $settings['labels'];
    if(isset($settings['args'])) $args = $settings['args'];
    $this->set_labels($labels);
    $this->set_args($args);
    $this->register_post($name);

  }


  public function set_labels($labels=null){
    $capitalize = ucfirst($this->name);
    $plural     = ucfirst($this->plural);
    $p_name = $this->name.'s';

    $default_labels             = array(
      'name'                    => __( "$plural", 'post type general name', '7chip' ),
      'singular_name'           => __( "$capitalize", 'post type singular name', '7chip' ),
      'menu_name'               => __( "$plural", 'admin menu', '7chip' ),
      'name_admin_bar'          => __( "$capitalize", 'add new on admin bar', '7chip' ),
      'add_new'                 => __( "Add New", 'book', '7chip' ),
      'add_new_item'            => __( "Add New $capitalize", '7chip' ),
      'new_item'                => __( "New $capitalize", '7chip' ),
      'edit_item'               => __( "Edit $capitalize", '7chip' ),
      'view_item'               => __( "View $capitalize", '7chip' ),
      'all_items'               => __( "All $plural", '7chip' ),
      'search_items'            => __( "Search $plural", '7chip' ),
      'parent_item_colon'       => __( "Parent $plural:", '7chip' ),
      'not_found'               => __( "No $p_name found.", '7chip' ),
      'not_found_in_trash'      => __( "No $p_name found in Trash.", '7chip' ),
      'insert_into_item'        => __( "Insert into Page",'7chip'),
      'uploaded_to_this_item'   => __( "Uploaded to this Post",'7chip'),
      'featured_image'          => __( "Featured Image",'7chip'),
      'set_featured_image'      => __( "Set Featured Image",'7chip'),
      'remove_featured_image'   => __( "Remove featured Image","7chip"),
      'use_featured_image'      => __( "Use as featured Image","7chip")

    );
    if($labels && is_array($labels)){
      $this->labels = array_merge($default_labels,$labels);
      return;
    }
    $this->labels = $default_labels;
    return;
  }

  public function set_args($args=null){
    $default_args             = array(
      'labels'                => $this->labels,
      'description'           => __( 'Description.', '7chip' ),
      'public'                => true,
      'publicly_queryable'    => true,
      'show_ui'               => true,
      'show_in_menu'          => true,
      'query_var'             => true,
      'capability_type'       => 'post',
      'has_archive'           => true,
      'hierarchical'          => false,
      'menu_position'         => null,
      'supports'              => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
    );

    if($args && is_array($args)){
      $this->args = array_merge($default_args,$args);
      return;
    }
    $this->args = $default_args;
    return;

  }

  function register_post($name) {
    register_post_type( $name, $this->args);


  }
}