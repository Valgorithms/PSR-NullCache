<?php declare(strict_types=1);

namespace ihipop\PsrNullCache\SimpleCache;

use Psr\SimpleCache\CacheInterface;

class NullCache implements CacheInterface
{
    protected bool $defaultBool;

    public function __construct(bool $defaultBool = false)
    {
        $this->defaultBool = $defaultBool;
    }

    use NullCacheTrait;
}