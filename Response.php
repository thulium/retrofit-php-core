<?php
declare(strict_types=1);

namespace Retrofit\Core;

use Psr\Http\Message\ResponseInterface;

/**
 * Create an error response from {@code rawResponse} with {@code body} as the error body.
 */
readonly class Response
{
    public function __construct(
        private ResponseInterface $rawResponse,
        private mixed $body,
        private mixed $errorBody
    )
    {
    }

    /**
     * The raw response from the HTTP client.
     */
    public function raw(): ResponseInterface
    {
        return $this->rawResponse;
    }

    /**
     * HTTP status code.
     */
    public function code(): int
    {
        return $this->rawResponse->getStatusCode();
    }

    /**
     * HTTP status message or null if unknown.
     */
    public function message(): string
    {
        return $this->rawResponse->getReasonPhrase();
    }

    /**
     * HTTP headers.
     */
    public function headers(): array
    {
        return $this->rawResponse->getHeaders();
    }

    /**
     * Returns true if {@link Response::code() code()} is in the range [200..300).
     */
    public function isSuccessful(): bool
    {
        return $this->rawResponse->getStatusCode() >= 200 && $this->rawResponse->getStatusCode() < 300;
    }

    /**
     * The deserialized response body of a {@link Response::isSuccessful() successful} response.
     */
    public function body(): mixed
    {
        return $this->body;
    }

    /**
     * The raw response body of an {@link Response::isSuccessful() unsuccessful} response.
     */
    public function errorBody(): mixed
    {
        return $this->errorBody;
    }
}
