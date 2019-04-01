NullCache | [ENGLISH](README.md)
----

本包是、 `Null` implementation of PSR-16 `SimpleCache` with `Basic data validation`

# Why this Package ?

There is nothing like [NullLogger](https://github.com/php-fig/log/blob/master/Psr/Log/NullLogger.php) of PSR-3 in PSR-16/PSR-6

## I (Or if you) don't  want to write these code every where

```php
if ($this->logger){
    $this->logger->error($message,$contex);
}
```

Then You need this Package.

## And want some Basic data validation ? 

PSR-16 have some special `InvalidArgumentException` to throw when enter with invalid data.
You Will have these check if you use These Package,`InvalidArgumentException` will be thrown when it is necessary ,
to let you know your  problem in  earlier.

# Usage
 
 In your `__construction` or `DI container` initialization
 ```
 ///...
$logger = new \ihipop\PsrNullCache\SimpleCache\NullCache(false);
///...
 ```

# CacheInterfaceProxy

Use this trait when you want a quick implementation of PSR `CacheInterface`  quickly via a Proxy class.