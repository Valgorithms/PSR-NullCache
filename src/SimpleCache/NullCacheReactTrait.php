<?php declare(strict_types=1);

namespace ihipop\PsrNullCache\SimpleCache;

use ihipop\PsrNullCache\Exception\InvalidArgumentException;

trait NullCacheReactTrait
{
    public static function typeString(mixed $object): string
    {
        return \is_object($object) ? \get_class($object) : \gettype($object);
    }

    public static function validateKey(mixed $key): string
    {
        if (!\is_string($key)) {
            throw new InvalidArgumentException(sprintf('Cache key must be string, "%s" given', self::typeString($key)));
        }
        if ('' === $key) {
            throw new InvalidArgumentException('Cache key length must be greater than zero');
        }
        if (false !== strpbrk($key, '{}()/\@:')) {
            throw new InvalidArgumentException(sprintf('Cache key "%s" contains reserved characters {}()/\@:', $key));
        }

        return $key;
    }

    public static function traversToArray(mixed $travers): array
    {
        if ($travers instanceof \Traversable) {
            $travers = iterator_to_array($travers, false);
        }
        if (!\is_array($travers)) {
            throw new InvalidArgumentException(sprintf('Cache keys must be array or Traversable, "%s" given',
                self::typeString($travers)));
        }

        return $travers;
    }

    /** @inheritdoc */
    public function get($key, $default = null)
    {
        self::validateKey($key);

        return $default;
    }

    /** @inheritdoc */
    public function set($key, $value, $ttl = null)
    {
        self::validateKey($key);

        return $this->defaultBool;
    }

    /** @inheritdoc */
    public function delete($key)
    {
        self::validateKey($key);

        return $this->defaultBool;
    }

    /** @inheritdoc */
    public function clear()
    {
        return $this->defaultBool;
    }

    /** @inheritdoc */
    public function getMultiple(array $keys, $default = null)
    {
        $keys = self::traversToArray($keys);
        foreach ($keys as $value) {
            self::validateKey($value);
        }
        foreach ($keys as $key) {
            yield $key => $default;
        }
    }

    /** @inheritdoc */
    public function setMultiple(array $values, $ttl = null)
    {
        $KeyValues = self::traversToArray($values);

        foreach ($KeyValues as $key => $__) {
            self::validateKey($key);
        }

        return $this->defaultBool;
    }

    /** @inheritdoc */
    public function deleteMultiple(array $keys)
    {
        $keys = self::traversToArray($keys);
        foreach ($keys as $value) {
            self::validateKey($value);
        }

        return $this->defaultBool;
    }

    /** @inheritdoc */
    public function has($key)
    {
        self::validateKey($key);

        return $this->defaultBool;
    }
}