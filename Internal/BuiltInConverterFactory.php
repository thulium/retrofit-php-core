<?php

declare(strict_types=1);

namespace Retrofit\Core\Internal;

use Psr\Http\Message\StreamInterface;
use Retrofit\Core\Converter\ConverterFactory;
use Retrofit\Core\Converter\RequestBodyConverter;
use Retrofit\Core\Converter\ResponseBodyConverter;
use Retrofit\Core\Converter\StringConverter;
use Retrofit\Core\Type;

/**
 * @internal
 */
readonly class BuiltInConverterFactory implements ConverterFactory
{
    public function requestBodyConverter(Type $type): ?RequestBodyConverter
    {
        if ($type->isA(StreamInterface::class)) {
            return BuiltInConverters::StreamInterfaceRequestBodyConverter();
        }
        if (!$type->isScalar()) {
            return BuiltInConverters::JsonEncodeRequestBodyConverter();
        }
        return null;
    }

    public function responseBodyConverter(Type $type): ?ResponseBodyConverter
    {
        if ($type->isA(StreamInterface::class)) {
            return BuiltInConverters::StreamInterfaceResponseBodyConverter();
        }
        if ($type->isA('void')) {
            return BuiltInConverters::VoidResponseBodyConverter();
        }
        return null;
    }

    public function stringConverter(Type $type): ?StringConverter
    {
        if ($type->isScalar()) {
            return BuiltInConverters::ToStringConverter();
        }
        return null;
    }
}
