<?php

declare(strict_types=1);

namespace Retrofit\Core\Internal\ParameterHandler\Factory;

use ReflectionMethod;
use Retrofit\Core\Attribute\HttpRequest;
use Retrofit\Core\Attribute\ParameterAttribute;
use Retrofit\Core\Attribute\Part;
use Retrofit\Core\Internal\Encoding;
use Retrofit\Core\Internal\ParameterHandler\ParameterHandler;
use Retrofit\Core\Internal\ParameterHandler\PartParameterHandler;
use Retrofit\Core\Internal\Utils\Utils;
use Retrofit\Core\Type;

/**
 * @extends AbstractParameterHandlerFactory<Part>
 */
readonly class PartParameterHandlerFactory extends AbstractParameterHandlerFactory
{
    /**
     * @param Part $param
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
        if ($encoding !== Encoding::MULTIPART) {
            throw Utils::parameterException($reflectionMethod, $position, '#[Part] parameters can only be used with multipart.');
        }

        $converter = $this->converterProvider->getRequestBodyConverter($type);

        return new PartParameterHandler($param->name(), $param->encoding(), $converter, $reflectionMethod, $position);
    }
}
