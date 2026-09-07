<?php

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use JeffersonGoncalves\G2\Facades\G2;

it('fetches a list of products', function () {
    Http::fake([
        'data.g2.com/api/v1/products*' => Http::response(['data' => []], 200),
    ]);

    expect(G2::products()->list('laravel', 1, 25))->toBe(['data' => []]);

    Http::assertSent(function (Request $request) {
        parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

        return $query['filter']['name'] === 'laravel'
            && $query['page']['size'] === '25'
            && $query['page']['number'] === '1';
    });
});

it('fetches a product by id', function () {
    Http::fake([
        'data.g2.com/api/v1/products/1' => Http::response(['data' => ['id' => '1']], 200),
    ]);

    expect(G2::products()->get('1'))->toBe(['data' => ['id' => '1']]);
});
