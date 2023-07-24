<?php

declare(strict_types=1);

namespace Retrofit\Core\Internal\ParameterHandler\Factory;

use ReflectionMethod;
use Retrofit\Core\Attribute\Header;
use Retrofit\Core\Attribute\HttpRequest;
use Retrofit\Core\Attribute\ParameterAttribute;
use Retrofit\Core\Internal\Encoding;
use Retrofit\Core\Internal\ParameterHandler\HeaderParameterHandler;
use Retrofit\Core\Internal\ParameterHandler\ParameterHandler;
use Retrofit\Core\Type;

/**
 * @extends AbstractParameterHandlerFactory<Header>
 */
readonly class HeaderParameterHandlerFactory extends AbstractParameterHandlerFactory
{
    /**
     * @param Header $param
     * @param HttpRequest $httpRequest
     * @param Encoding|null $encoding
     * @param ReflectionMethod $reflectionMethod
     * @param int $position
     * @param Type $type
     * @return ParameterHandler
     */
    public function create(
        ParameterAttribute $param,
        HttpRequest $httpRequest,
        ?Encoding $encoding,
        ReflectionMethod $reflectionMethod,
        int $position,
        Type $type,
    ): ParameterHandler
    {
        return new HeaderParameterHandler($param->name(), $this->converterProvider->getStringConverter($type));
    }
}
