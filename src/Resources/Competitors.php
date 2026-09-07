<?php

namespace JeffersonGoncalves\G2\Resources;

use JeffersonGoncalves\G2\G2Client;

/**
 * Competitor comparison endpoints (`/competitor-comparisons`).
 */
class Competitors
{
    public function __construct(private readonly G2Client $client) {}

    /**
     * @return array<string, mixed>
     */
    public function list(string $productId, int $page = 1, int $perPage = 25): array
    {
        return $this->client->get('/competitor-comparisons', [
            'filter[product_id]' => $productId,
            'page[size]' => $perPage,
            'page[number]' => $page,
        ]);
    }
}
