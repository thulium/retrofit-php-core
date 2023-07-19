<?php

declare(strict_types=1);

namespace Retrofit\Core\Internal\ParameterHandler\Factory;

use ReflectionMethod;
use Retrofit\Core\Attribute\Body;
use Retrofit\Core\Attribute\HttpRequest;
use Retrofit\Core\Internal\Encoding;
use Retrofit\Core\Internal\ParameterHandler\BodyParameterHandler;
use Retrofit\Core\Internal\ParameterHandler\ParameterHandler;
use Retrofit\Core\Type;

readonly class BodyParameterHandlerFactory extends AbstractParameterHandlerFactory
{
    public function create(
        Body $param,
        HttpRequest $httpRequest,
        ?Encoding $encoding,
        ReflectionMethod $reflectionMethod,
        int $position,
        Type $type,
    ): ParameterHandler
    {
        $converter = $this->converterProvider->getRequestBodyConverter($type);

        return new BodyParameterHandler($converter, $reflectionMethod, $position);
    }
}
