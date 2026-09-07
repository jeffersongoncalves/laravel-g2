<?php

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use JeffersonGoncalves\G2\Facades\G2;

it('fetches tracking event visitors', function () {
    Http::fake([
        'data.g2.com/api/v1/tracking-events*' => Http::response(['data' => []], 200),
    ]);

    expect(G2::tracking()->visitors('2026-01-01', '2026-01-31', 1, 25))->toBe(['data' => []]);

    Http::assertSent(function (Request $request) {
        parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

        return $query['filter']['start_date'] === '2026-01-01'
            && $query['filter']['end_date'] === '2026-01-31'
            && $query['page']['size'] === '25'
            && $query['page']['number'] === '1';
    });
});
