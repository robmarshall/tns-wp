<?php

/**
 * Limit Sensitive Data
 *
 * Currently wpGraphql exposes all data. This means anyone has access to sensitive data.
 * Use the following function to limit particular data.
 *
 * @link https://docs.wpgraphql.com/getting-started/users/
 */

add_action( 'graphql_register_types', function() {
    /**
     * Define the Types and their Fields that we want to filter
     */
    $fields_to_require_auth = [
        'User' => [
            'email'
        ],
        'Comment' => [
            'authorIp',
        ],
    ];
    /**
     * Loop through the fields
     */
    foreach ( $fields_to_require_auth as $type_name => $fields_to_filter ) {
        if ( ! empty( $fields_to_filter ) && is_array( $fields_to_filter ) ) {
            /**
             * Apply a filter to said Type's fields
             */
            add_filter( 'graphql_' . $type_name . '_fields', function( $fields ) use ( $type_name, $fields_to_filter ) {
                /**
                 * Loop through each of the fields we want to filter for this Type
                 */
                foreach ( $fields_to_filter as $field_name ) {
                    /**
                     * The registry normalizes all keys to lowercase, so we make our $field_name lowercase here too
                     */
                    $field_key = strtolower( $field_name );
                    /**
                     * Make sure the field exists in the registry (it could have been removed by another plugin)
                     */
                    if ( isset( $fields[ $field_key ] ) ) {
                        /**
                         * If the request is not authenticated (no current user is set), override the resolver for the field to throw
                         * a UserError
                         *
                         * Change this to whatever condition you want
                         */
                        if ( ! get_current_user_id() ) {
                            $fields[ $field_key ]['resolve'] = function ( $root, $args, $context, $info ) use ( $type_name, $field_name ) {
                                throw new GraphQLErrorUserError( __( sprintf( 'You do not have access to view the "%1$s" Field on the %2$s Type', $field_name, $type_name ), 'wp-graphql' ) );
                            };
                        }
                    }
                }
                /**
                 * Return the fields to the filter.
                 */
                return $fields;
            } );
        }
    }
} );
