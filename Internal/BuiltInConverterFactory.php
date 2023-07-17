<?php
declare(strict_types=1);

namespace Retrofit\Core\Internal;

use Psr\Http\Message\StreamInterface;
use Retrofit\Core\Converter\Converter;
use Retrofit\Core\Converter\ConverterFactory;
use Retrofit\Core\Converter\RequestBodyConverter;
use Retrofit\Core\Type;

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

    public function responseBodyConverter(Type $type): ?Converter
    {
        if ($type->isA(StreamInterface::class)) {
            return BuiltInConverters::StreamInterfaceResponseBodyConverter();
        }
        if ($type->isA('void')) {
            return BuiltInConverters::VoidResponseBodyConverter();
        }
        return null;
    }

    public function stringConverter(Type $type): ?Converter
    {
        if ($type->isScalar()) {
            return BuiltInConverters::ToStringConverter();
        }
        return null;
    }
}