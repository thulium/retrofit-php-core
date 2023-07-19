<?php

declare(strict_types=1);

namespace Retrofit\Core\Internal\ParameterHandler\Factory;

use ReflectionMethod;
use Retrofit\Core\Attribute\HttpRequest;
use Retrofit\Core\Attribute\Path;
use Retrofit\Core\Internal\Encoding;
use Retrofit\Core\Internal\ParameterHandler\ParameterHandler;
use Retrofit\Core\Internal\ParameterHandler\PathParameterHandler;
use Retrofit\Core\Type;

readonly class PathParameterHandlerFactory extends AbstractParameterHandlerFactory
{
    public function create(
        Path $param,
        HttpRequest $httpRequest,
        ?Encoding $encoding,
        ReflectionMethod $reflectionMethod,
        int $position,
        Type $type,
    ): ParameterHandler
    {
        return new PathParameterHandler($param->name(), $param->encoded(), $this->converterProvider->getStringConverter($type), $reflectionMethod, $position);
    }
}
