<?php declare(strict_types=1);

namespace ihipop\PsrNullCache\SimpleCache;

use Psr\SimpleCache\CacheInterface;

trait CacheInterfaceProxy
{
    protected CacheInterface $realCacheClient;

    public function __call(string $name, array $arguments): mixed
    {
        return call_user_func_array([$this->realCacheClient, $name], $arguments);
    }

    /** @inheritdoc */
    public function get($key, $default = null)
    {
        return call_user_func_array([$this->realCacheClient, __FUNCTION__], func_get_args());
    }

    /** @inheritdoc */
    public function set($key, $value, $ttl = null)
    {
        return call_user_func_array([$this->realCacheClient, __FUNCTION__], func_get_args());
    }

    /** @inheritdoc */
    public function delete($key)
    {
        return call_user_func_array([$this->realCacheClient, __FUNCTION__], func_get_args());
    }

    /** @inheritdoc */
    public function clear()
    {
        return call_user_func_array([$this->realCacheClient, __FUNCTION__], func_get_args());
    }

    /** @inheritdoc */
    public function getMultiple($keys, $default = null)
    {
        return call_user_func_array([$this->realCacheClient, __FUNCTION__], func_get_args());
    }

    /** @inheritdoc */
    public function setMultiple($values, $ttl = null)
    {
        return call_user_func_array([$this->realCacheClient, __FUNCTION__], func_get_args());
    }

    /** @inheritdoc */
    public function deleteMultiple($keys)
    {
        return call_user_func_array([$this->realCacheClient, __FUNCTION__], func_get_args());
    }

    /** @inheritdoc */
    public function has($key)
    {
        return call_user_func_array([$this->realCacheClient, __FUNCTION__], func_get_args());
    }
}
