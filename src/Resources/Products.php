<?php

namespace JeffersonGoncalves\G2\Resources;

use JeffersonGoncalves\G2\G2Client;

/**
 * Product endpoints (`/products`).
 */
class Products
{
    public function __construct(private readonly G2Client $client) {}

    /**
     * @return array<string, mixed>
     */
    public function list(?string $name = null, int $page = 1, int $perPage = 25): array
    {
        return $this->client->get('/products', array_filter([
            'filter[name]' => $name,
            'page[size]' => $perPage,
            'page[number]' => $page,
        ]));
    }

    /**
     * @return array<string, mixed>
     */
    public function get(string $id): array
    {
        return $this->client->get("/products/{$id}");
    }
}
