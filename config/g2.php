<?php

return [
    /*
    |--------------------------------------------------------------------------
    | G2 API Token
    |--------------------------------------------------------------------------
    |
    | Your G2 API token, sent as `Authorization: Token token={token}` on every
    | request. Request API access at https://data.g2.com/api/v1
    |
    */
    'token' => env('G2_API_TOKEN'),

    /*
    |--------------------------------------------------------------------------
    | Base URL
    |--------------------------------------------------------------------------
    |
    | The G2 API base URL. Override only if G2 gives you a dedicated endpoint.
    |
    */
    'base_url' => env('G2_BASE_URL', 'https://data.g2.com/api/v1'),
];
