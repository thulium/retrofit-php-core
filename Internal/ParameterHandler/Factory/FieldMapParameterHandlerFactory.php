<?php

declare(strict_types=1);

namespace Retrofit\Core\Internal\ParameterHandler\Factory;

use ReflectionMethod;
use Retrofit\Core\Attribute\FieldMap;
use Retrofit\Core\Attribute\HttpRequest;
use Retrofit\Core\Attribute\ParameterAttribute;
use Retrofit\Core\Internal\Encoding;
use Retrofit\Core\Internal\ParameterHandler\FieldMapParameterHandler;
use Retrofit\Core\Internal\ParameterHandler\ParameterHandler;
use Retrofit\Core\Internal\Utils\Utils;
use Retrofit\Core\Type;

/**
 * @extends AbstractParameterHandlerFactory<FieldMap>
 */
readonly class FieldMapParameterHandlerFactory extends AbstractParameterHandlerFactory
{
    /**
     * @param FieldMap $param
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
        if ($encoding !== Encoding::FORM_URL_ENCODED) {
            throw Utils::parameterException($reflectionMethod, $position, '#[FieldMap] parameters can only be used with form encoding.');
        }

        return new FieldMapParameterHandler($param->encoded(), $this->converterProvider->getStringConverter($type), $reflectionMethod, $position);
    }
}
