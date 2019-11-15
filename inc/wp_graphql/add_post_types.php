<?php

/**
 * Use the following function to add post type slug of the posttype to the Graphql schema
 */

add_action( 'graphql_register_types', 'register_post_type_types' );
function register_post_type_types() {
    $post_type_array = array(
      'Post',
      'Page'
    );
    foreach ($post_type_array as $post_type){
      register_graphql_field( $post_type, 'postType', [
        'description' => __( 'Post type', theme_text_domain() ),
        'type' => 'String',
        'resolve' => function( $post ) {
            return $post->post_type;
        }
      ] );
    }
}
