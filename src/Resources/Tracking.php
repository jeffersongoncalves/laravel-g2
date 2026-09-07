<?php

namespace JeffersonGoncalves\G2\Resources;

use JeffersonGoncalves\G2\G2Client;

/**
 * Tracking event endpoints (`/tracking-events`).
 */
class Tracking
{
    public function __construct(private readonly G2Client $client) {}

    /**
     * @return array<string, mixed>
     */
    public function visitors(?string $startDate = null, ?string $endDate = null, int $page = 1, int $perPage = 25): array
    {
        return $this->client->get('/tracking-events', array_filter([
            'filter[start_date]' => $startDate,
            'filter[end_date]' => $endDate,
            'page[size]' => $perPage,
            'page[number]' => $page,
        ]));
    }
}
