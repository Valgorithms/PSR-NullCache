<?php
/**
 * @author ihipop@gmail.com @ 19-2-27 下午6:22 For 1688-sdk.
 */

use PHPUnit\Framework\TestCase;

class SimpleCacheNullCacheTest extends TestCase
{

    protected $nullCache;
    protected $invalidKey = [];

    public function __construct(?string $name = null, array $data = [], string $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->nullCache  = new \ihipop\PsrNullCache\SimpleCache\NullCache(false);
        $this->invalidKey = str_split('{}()/\@:');
    }

    public function testInvalidKeySet()
    {
        $invalidKeyChr      = array_merge([new stdClass(), ''], $this->invalidKey);
        $totalException     = count($invalidKeyChr);
        $exceptionContainer = [];
        foreach ($invalidKeyChr as $key) {
            try {
                $this->nullCache->set($key, 'foobar');
            } catch (\Psr\SimpleCache\InvalidArgumentException $e) {
                $exceptionContainer[] = $e;
            }
        }

        $this->assertEquals($totalException, count($exceptionContainer));
        $this->assertContainsOnlyInstancesOf(\Psr\SimpleCache\InvalidArgumentException::class, $exceptionContainer);
    }

    public function testInvalidKeyGet()
    {
        $invalidKeyChr      = array_merge([new stdClass(), ''], $this->invalidKey);
        $totalException     = count($invalidKeyChr);
        $exceptionContainer = [];
        foreach ($invalidKeyChr as $key) {
            try {
                $this->nullCache->get($key);
            } catch (\Psr\SimpleCache\InvalidArgumentException $e) {
                $exceptionContainer[] = $e;
            }
        }

        $this->assertEquals($totalException, count($exceptionContainer));
        $this->assertContainsOnlyInstancesOf(\Psr\SimpleCache\InvalidArgumentException::class, $exceptionContainer);
    }

    public function testInvalidKeyDelete()
    {
        $invalidKeyChr  = array_merge([new stdClass(), ''], $this->invalidKey);
        $totalException = count($invalidKeyChr);
        foreach ($invalidKeyChr as $key) {
            try {
                $this->nullCache->delete($key);
            } catch (\Psr\SimpleCache\InvalidArgumentException $e) {
                $exceptionContainer[] = $e;
            }
        }

        $this->assertEquals($totalException, count($exceptionContainer));
        $this->assertContainsOnlyInstancesOf(\Psr\SimpleCache\InvalidArgumentException::class, $exceptionContainer);
    }

    public function testInvalidKeyHas()
    {
        $invalidKeyChr      = array_merge([new stdClass(), ''], $this->invalidKey);
        $totalException     = count($invalidKeyChr);
        $exceptionContainer = [];
        foreach ($invalidKeyChr as $key) {
            try {
                $this->nullCache->has($key);
            } catch (\Psr\SimpleCache\InvalidArgumentException $e) {
                $exceptionContainer[] = $e;
            }
        }

        $this->assertEquals($totalException, count($exceptionContainer));
        $this->assertContainsOnlyInstancesOf(\Psr\SimpleCache\InvalidArgumentException::class, $exceptionContainer);
    }

    public function testInvalidKeySetMultiple()
    {
        $invalidKeyChr      = array_merge([''], $this->invalidKey);
        $totalException     = count($invalidKeyChr);
        $exceptionContainer = [];
        foreach ($invalidKeyChr as $key) {
            try {
                $this->nullCache->setMultiple(['foo' => 'bar', $key => 'bar']);
            } catch (\Psr\SimpleCache\InvalidArgumentException $e) {
                $exceptionContainer[] = $e;
            }
        }

        $this->assertEquals($totalException, count($exceptionContainer));
        $this->assertContainsOnlyInstancesOf(\Psr\SimpleCache\InvalidArgumentException::class, $exceptionContainer);
    }

    public function testInvalidKeyGetMultiple()
    {
        $invalidKeyChr      = array_merge([''], $this->invalidKey);
        $totalException     = count($invalidKeyChr);
        $exceptionContainer = [];
        foreach ($invalidKeyChr as $key) {
            try {
                foreach ($this->nullCache->getMultiple(['foo', $key]) as $iter) {
                    // fo nothing
                }
            } catch (\Psr\SimpleCache\InvalidArgumentException $e) {
                $exceptionContainer[] = $e;
            }
        }

        $this->assertEquals($totalException, count($exceptionContainer));
        $this->assertContainsOnlyInstancesOf(\Psr\SimpleCache\InvalidArgumentException::class, $exceptionContainer);
    }

    public function testInvalidKeyDeleteMultiple()
    {
        $invalidKeyChr      = array_merge([''], $this->invalidKey);
        $totalException     = count($invalidKeyChr);
        $exceptionContainer = [];
        foreach ($invalidKeyChr as $key) {
            try {
                $this->nullCache->deleteMultiple(['foo', $key]);
            } catch (\Psr\SimpleCache\InvalidArgumentException $e) {
                $exceptionContainer[] = $e;
            }
        }

        $this->assertEquals($totalException, count($exceptionContainer));
        $this->assertContainsOnlyInstancesOf(\Psr\SimpleCache\InvalidArgumentException::class, $exceptionContainer);
    }
}