# WordPress REST API Theme

This theme is to be used for headless WordPress websites.

It removes the frontend completely and redirects any non-API calls to the correct URL

## Config
To setup the theme, navigate to the inc/config.php file and update the rest_theme_url_redirect function with the Gatsby URL.

## Plugins
As well as this theme, the WordPress install will need the following plugins installing.

- https://github.com/wp-graphql/wp-graphql
- https://github.com/wp-graphql/wp-graphiql - helpful for checking queries
- https://github.com/yoast/wordpress-seo
- https://github.com/ashhitch/wp-graphql-yoast-seo
- https://github.com/lukethacoder/wp-webhook-netlify-deploy

### Expanding Theme

To have more functionality, also add these plugins

- https://www.advancedcustomfields.com/pro
- https://github.com/wp-graphql/wp-graphql-acf
- https://github.com/Yoast/yoast-acf-analysis

## Development
This theme will slowly evolve, as the Gatsby theme improves: https://github.com/robmarshall/tns-gatsby
