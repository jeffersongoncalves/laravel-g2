<?php

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use JeffersonGoncalves\G2\Facades\G2;

it('fetches a list of competitor comparisons for a product', function () {
    Http::fake([
        'data.g2.com/api/v1/competitor-comparisons*' => Http::response(['data' => []], 200),
    ]);

    expect(G2::competitors()->list('123', 1, 25))->toBe(['data' => []]);

    Http::assertSent(function (Request $request) {
        parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

        return $query['filter']['product_id'] === '123'
            && $query['page']['size'] === '25'
            && $query['page']['number'] === '1';
    });
});
