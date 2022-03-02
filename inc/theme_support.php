<?php

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function wp_rest_theme_setup() {

	/**
	 * Add support for WordPress 3.0's custom menus
	 * Register area for custom menu
	 *
	 * See: https://codex.wordpress.org/Function_Reference/register_nav_menus
	 */

	 register_nav_menu( 'header-menu', __( 'Header Menu', theme_text_domain() ) );
	 register_nav_menu( 'social-menu', __( 'Social Menu', theme_text_domain() ) );


	if ( function_exists( 'add_theme_support' ) ) {

			// Allow thumbnails
			add_theme_support( 'post-thumbnails' );

	}

}
add_action( 'after_setup_theme', 'wp_rest_theme_setup' );


add_filter( 'the_content', 'myprefix_modify_outbound_links' );
add_filter( 'acf_the_content', 'myprefix_modify_outbound_links' );

function myprefix_modify_outbound_links( $content ) {

    if($content){

        $doc = new DOMDocument('5.0', 'utf-8');

        $doc->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', 'utf-8'));

        //Loop through each <a> tag in the dom and change the href property
        foreach($doc->getElementsByTagName('a') as $anchor) {
            $link = $anchor->getAttribute('href');
						if(!str_contains($link,rest_theme_url_redirect())){
            		$link .= (parse_url($link, PHP_URL_QUERY) ? '&' : '?') . rest_theme_url_redirect();
            		$anchor->setAttribute('href', $link);
						}
        }

        return preg_replace('~<(?:!DOCTYPE|/?(?:html|body))[^>]*>\s*~i', '', $doc->saveHTML($doc->documentElement));

    }

    return $content;
}
