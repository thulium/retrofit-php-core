<?php
declare(strict_types=1);

namespace Retrofit\Core\Internal\Proxy;

use ReflectionClass;
use Retrofit\Core\Retrofit;

interface ProxyFactory
{
    /**
     * Creates a new proxy from given service.
     */
    public function create(Retrofit $retrofit, ReflectionClass $service): object;
}