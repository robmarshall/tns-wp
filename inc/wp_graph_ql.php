<?php

// Automatically import functions from the wp_graphql/ folder.
foreach ( glob( get_stylesheet_directory() . '/inc/wp_graphql/*.php' ) as $filename ) {
	require_once $filename;
}
