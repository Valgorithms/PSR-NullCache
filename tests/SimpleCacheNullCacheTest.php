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
        $this->invalidKey = array_merge([''], str_split('{}()/\@:'));
    }

    protected function performKeyTest(callable $action, array $invalidKeyChr)
    {
        $totalException     = count($invalidKeyChr);
        $exceptionContainer = [];
        foreach ($invalidKeyChr as $key) {
            try {
                $ret = $action($key);
                if ($ret instanceof  \Traversable) {
                    foreach ($ret as $K => $__) {
                        //Do nothing to trig the error
                    }
                }
            } catch (\Psr\SimpleCache\InvalidArgumentException $e) {
                $exceptionContainer[] = $e;
            }
        }

        $this->assertEquals($totalException, count($exceptionContainer));
        $this->assertContainsOnlyInstancesOf(\Psr\SimpleCache\InvalidArgumentException::class, $exceptionContainer);
    }
    public function testInvalidKeySet()
    {
        $invalidKeyChr      = array_merge([new stdClass()], $this->invalidKey);
        $this->performKeyTest(function ($key) {
            $this->nullCache->set($key, 'Foobar');
        }, $invalidKeyChr);
    }

    public function testInvalidKeyGet()
    {
        $invalidKeyChr      = array_merge([new stdClass()], $this->invalidKey);
        $this->performKeyTest(function ($key) {
            $this->nullCache->get($key);
        }, $invalidKeyChr);
    }

    public function testInvalidKeyDelete()
    {
        $invalidKeyChr  = array_merge([new stdClass()], $this->invalidKey);
        $this->performKeyTest(function ($key) {
            $this->nullCache->delete($key);
        }, $invalidKeyChr);
    }

    public function testInvalidKeyHas()
    {
        $invalidKeyChr      = array_merge([new stdClass()], $this->invalidKey);
        $this->performKeyTest(function ($key) {
            $this->nullCache->has($key);
        }, $invalidKeyChr);
    }

    public function testInvalidKeySetMultiple()
    {
        $invalidKeyChr      = array_merge([], $this->invalidKey);
        $this->performKeyTest(function ($key) {
            $this->nullCache->setMultiple(['foo' => 'bar', $key => 'bar']);
        }, $invalidKeyChr);
    }

    public function testInvalidKeyGetMultiple()
    {
        $invalidKeyChr      = array_merge([], $this->invalidKey);
        $this->performKeyTest(function ($key) {
            return $this->nullCache->getMultiple(['foo', $key]);
        }, $invalidKeyChr);
    }

    public function testInvalidKeyDeleteMultiple()
    {
        $invalidKeyChr      = array_merge([], $this->invalidKey);
        $this->performKeyTest(function ($key) {
            return $this->nullCache->deleteMultiple(['foo', $key]);
        }, $invalidKeyChr);
    }
}