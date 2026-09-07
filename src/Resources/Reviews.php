<?php

namespace JeffersonGoncalves\G2\Resources;

use JeffersonGoncalves\G2\G2Client;

/**
 * Review endpoints (`/survey-responses`).
 */
class Reviews
{
    public function __construct(private readonly G2Client $client) {}

    /**
     * @return array<string, mixed>
     */
    public function list(?string $productId = null, ?string $state = null, int $page = 1, int $perPage = 25): array
    {
        return $this->client->get('/survey-responses', array_filter([
            'filter[product_id]' => $productId,
            'filter[state]' => $state,
            'page[size]' => $perPage,
            'page[number]' => $page,
        ]));
    }

    /**
     * @return array<string, mixed>
     */
    public function get(string $id): array
    {
        return $this->client->get("/survey-responses/{$id}");
    }
}
