<?php

namespace JeffersonGoncalves\G2\Resources;

use JeffersonGoncalves\G2\G2Client;

/**
 * Report endpoints (`/reports`).
 */
class Reports
{
    public function __construct(private readonly G2Client $client) {}

    /**
     * @return array<string, mixed>
     */
    public function list(int $page = 1, int $perPage = 25): array
    {
        return $this->client->get('/reports', [
            'page[size]' => $perPage,
            'page[number]' => $page,
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    public function get(string $id): array
    {
        return $this->client->get("/reports/{$id}");
    }
}
