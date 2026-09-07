<?php

namespace JeffersonGoncalves\G2\Exceptions;

use RuntimeException;

/**
 * Raised when the G2 API answers a request with a non-2xx HTTP status.
 * Carries the response's JSON:API error message (`errors[0].detail`/`title`,
 * falling back to the raw body) and the HTTP status code.
 */
class G2Exception extends RuntimeException
{
    public function __construct(string $message, public readonly int $statusCode)
    {
        parent::__construct($message, $statusCode);
    }
}
