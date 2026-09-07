<?php

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use JeffersonGoncalves\G2\Facades\G2;

it('fetches a list of reviews', function () {
    Http::fake([
        'data.g2.com/api/v1/survey-responses*' => Http::response(['data' => []], 200),
    ]);

    expect(G2::reviews()->list('123', 'published', 2, 50))->toBe(['data' => []]);

    Http::assertSent(function (Request $request) {
        parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

        return $query['filter']['product_id'] === '123'
            && $query['filter']['state'] === 'published'
            && $query['page']['size'] === '50'
            && $query['page']['number'] === '2'
            && $request->hasHeader('Authorization', 'Token token=fake-token');
    });
});

it('fetches a review by id', function () {
    Http::fake([
        'data.g2.com/api/v1/survey-responses/1' => Http::response(['data' => ['id' => '1']], 200),
    ]);

    expect(G2::reviews()->get('1'))->toBe(['data' => ['id' => '1']]);
});
