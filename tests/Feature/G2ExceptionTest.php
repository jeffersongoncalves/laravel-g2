<?php

use Illuminate\Support\Facades\Http;
use JeffersonGoncalves\G2\Exceptions\G2Exception;
use JeffersonGoncalves\G2\Facades\G2;

it('throws a G2Exception with the JSON:API error detail on a non-2xx response', function () {
    Http::fake([
        'data.g2.com/api/v1/products/1' => Http::response(['errors' => [['status' => '404', 'title' => 'Not Found', 'detail' => 'Product not found.']]], 404),
    ]);

    expect(fn () => G2::products()->get('1'))
        ->toThrow(G2Exception::class, 'Product not found.');
});

it('falls back to the error title when no detail is present', function () {
    Http::fake([
        'data.g2.com/api/v1/products/1' => Http::response(['errors' => [['status' => '401', 'title' => 'Unauthorized']]], 401),
    ]);

    expect(fn () => G2::products()->get('1'))
        ->toThrow(G2Exception::class, 'Unauthorized');
});

it('falls back to the raw body when no JSON:API error shape is present', function () {
    Http::fake([
        'data.g2.com/api/v1/products/1' => Http::response('Internal Server Error', 500),
    ]);

    expect(fn () => G2::products()->get('1'))
        ->toThrow(G2Exception::class, 'Internal Server Error');
});
