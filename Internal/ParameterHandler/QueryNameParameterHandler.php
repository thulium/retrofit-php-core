<?php

declare(strict_types=1);

namespace Retrofit\Core\Internal\ParameterHandler;

use ReflectionMethod;
use Retrofit\Core\Converter\StringConverter;
use Retrofit\Core\Internal\RequestBuilder;

/**
 * @internal
 */
readonly class QueryNameParameterHandler implements ParameterHandler
{
    use WithQueryParameter;

    public function __construct(
        private bool $encoded,
        private StringConverter $converter,
        private ReflectionMethod $reflectionMethod,
        private int $position,
    )
    {
    }

    public function apply(RequestBuilder $requestBuilder, mixed $value): void
    {
        if (is_null($value)) {
            return;
        }

        $value = $this->validateAndConvert($value);
        $requestBuilder->addQueryParam($value, null, $this->encoded);
    }
}
