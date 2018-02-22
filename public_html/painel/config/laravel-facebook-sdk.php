<?php

return [
    /*
     * In order to integrate the Facebook SDK into your site,
     * you'll need to create an app on Facebook and enter the
     * app's ID and secret here.
     *
     * Add an app: https://developers.facebook.com/apps
     *
     * You can add additional config options here that are
     * available on the main Facebook\Facebook super service.
     *
     * https://developers.facebook.com/docs/php/Facebook/5.0.0#config
     *
     * Using environment variables is the recommended way of
     * storing your app ID and app secret. Make sure to update
     * your /.env file with your app ID and secret.
     */
    'facebook_config' => [
        'app_id' => '999282056817361',
        'app_secret' => '752baa199940407d4d2aace2f1425be7',
        'default_graph_version' => 'v2.7',
        'default_access_token' => 'EAAOM13wG6tEBANRibBu0UQqNNcQZANBXCPSatWEQJr0E7jRnqYUE6tUtWKslYrLa7lgB7zoQpJ69C6YucY6sLZAYBpriO0oZCIKy2rjuTCyZAej2tpoQIxUuIVEwHV4F3xlRP2DzZCrYM3O3ULZCtSEdgAB8SX3y0jrA889VSNEQZDZD',
        //'enable_beta_mode' => true,
        //'http_client_handler' => 'guzzle',
    ],

    /*
     * The default list of permissions that are
     * requested when authenticating a new user with your app.
     * The fewer, the better! Leaving this empty is the best.
     * You can overwrite this when creating the login link.
     *
     * Example:
     *
     * 'default_scope' => ['email', 'user_birthday'],
     *
     * For a full list of permissions see:
     *
     * https://developers.facebook.com/docs/facebook-login/permissions
     */
    'default_scope' => [],

    /*
     * The default endpoint that Facebook will redirect to after
     * an authentication attempt.
     */
    'default_redirect_uri' => '/facebook/callback',
    ];
