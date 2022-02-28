<?php

/**
 * Set the URL of the live Gatsby site
 *
 * @return string The domain of the live site
 */

function rest_theme_url_redirect() {
    return 'robertmarshall.dev';
}

/**
 * Get the text domain from the stylesheet
 *
 * May seem pointless, but it avoids any
 * errors from changes later in the day
 *
 * @return string The text domain of the theme
 */

function theme_text_domain(){
    $theme_details = wp_get_theme();
    return $theme_details->get('TextDomain');
}
