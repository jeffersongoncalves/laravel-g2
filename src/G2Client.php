<?php

namespace JeffersonGoncalves\G2;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use JeffersonGoncalves\G2\Exceptions\G2Exception;
use JeffersonGoncalves\G2\Resources\Categories;
use JeffersonGoncalves\G2\Resources\Competitors;
use JeffersonGoncalves\G2\Resources\Products;
use JeffersonGoncalves\G2\Resources\Reports;
use JeffersonGoncalves\G2\Resources\Reviews;
use JeffersonGoncalves\G2\Resources\Tracking;

/**
 * Thin fluent client for the G2 API (https://data.g2.com/api/v1). Groups
 * endpoints behind resource accessors (reviews, products, reports,
 * competitors, categories, tracking) and authenticates every request with
 * a `G2_API_TOKEN` sent as `Authorization: Token token={token}`, using the
 * JSON:API content type (`application/vnd.api+json`).
 */
class G2Client
{
    public function reviews(): Reviews
    {
        return new Reviews($this);
    }

    public function products(): Products
    {
        return new Products($this);
    }

    public function reports(): Reports
    {
        return new Reports($this);
    }

    public function competitors(): Competitors
    {
        return new Competitors($this);
    }

    public function categories(): Categories
    {
        return new Categories($this);
    }

    public function tracking(): Tracking
    {
        return new Tracking($this);
    }

    /**
     * @param  array<string, mixed>  $query
     * @return array<string, mixed>
     *
     * @throws G2Exception
     */
    public function get(string $uri, array $query = []): array
    {
        return $this->handle($this->http()->get($uri, $query));
    }

    private function http(): PendingRequest
    {
        return Http::baseUrl($this->baseUrl())
            ->withHeaders([
                'Authorization' => "Token token={$this->token()}",
            ])
            ->contentType('application/vnd.api+json')
            ->accept('application/vnd.api+json');
    }

    /**
     * @return array<string, mixed>
     *
     * @throws G2Exception
     */
    private function handle(Response $response): array
    {
        if ($response->failed()) {
            throw new G2Exception($this->errorMessage($response), $response->status());
        }

        $data = $response->json();

        return is_array($data) ? $data : [];
    }

    private function errorMessage(Response $response): string
    {
        $data = $response->json();

        if (is_array($data) && is_array($data['errors'] ?? null) && is_array($data['errors'][0] ?? null)) {
            $error = $data['errors'][0];

            if (is_string($error['detail'] ?? null)) {
                return $error['detail'];
            }

            if (is_string($error['title'] ?? null)) {
                return $error['title'];
            }
        }

        return $response->body() !== ''
            ? $response->body()
            : "G2 API request failed with status {$response->status()}.";
    }

    private function token(): string
    {
        return (string) config('g2.token');
    }

    private function baseUrl(): string
    {
        return (string) config('g2.base_url', 'https://data.g2.com/api/v1');
    }
}
