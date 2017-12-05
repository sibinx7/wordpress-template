<?php 
/**
 * Post format post.{post_name}.php 
 * 
 */


$allowed_posts = [];

foreach($allowed_posts as $post){
	$post = "post.$post.php";
	require_once realpath(__DIR__."/$post.php");
}

 
function add_custom_posts(){

}

add_action( 'init', 'add_custom_posts');
