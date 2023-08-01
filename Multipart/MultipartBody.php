<?php

declare(strict_types=1);

namespace Retrofit\Core\Multipart;

use Psr\Http\Message\StreamInterface;

/**
 * @api
 */
class MultipartBody
{
    /**
     * Build a new part.
     */
    public static function Part(): PartInterface
    {
        return new class () implements PartInterface {
            public function __construct(
                private readonly string $name = '',
                private readonly StreamInterface|string $body = '',
                /** @var array<string, string> */
                private readonly array $headers = [],
                private readonly ?string $filename = null,
            )
            {
            }

            public function getName(): string
            {
                return $this->name;
            }

            public function getBody(): StreamInterface|string
            {
                return $this->body;
            }

            public function getHeaders(): array
            {
                return $this->headers;
            }

            public function getFilename(): ?string
            {
                return $this->filename;
            }

            /**
             * Creates part which is used in multipart bodies.
             *
             * @param array<string, string> $headers
             */
            public static function createFromData(
                string $name,
                StreamInterface|string $body,
                array $headers = [],
                ?string $filename = null,
            ): PartInterface
            {
                return new self($name, $body, $headers, $filename);
            }
        };
    }
}
