<?php declare(strict_types=1);
/**
 * @author ihipop@gmail.com @ 19-2-27 下午6:22 For 1688-sdk.
 */

use PHPUnit\Framework\TestCase;
use ihipop\PsrNullCache\SimpleCache\NullCache;
use Psr\SimpleCache\InvalidArgumentException;

class SimpleCacheNullCacheTest extends TestCase
{
    protected NullCache $nullCache;
    protected array $invalidKey;

    public function __construct(?string $name = null, array $data = [], string $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->nullCache  = new NullCache(false);
        $this->invalidKey = array_merge([''], str_split('{}()/\@:'));
    }

    protected function performKeyTest(callable $action, array $invalidKeyChr): void
    {
        $totalException     = count($invalidKeyChr);
        $exceptionContainer = [];
        foreach ($invalidKeyChr as $key) {
            try {
                $ret = $action($key);
                if ($ret instanceof \Traversable) {
                    foreach ($ret as $K => $__) {
                        // Do nothing to trigger the error
                    }
                }
            } catch (InvalidArgumentException $e) {
                $exceptionContainer[] = $e;
            }
        }

        $this->assertEquals($totalException, count($exceptionContainer));
        $this->assertContainsOnlyInstancesOf(InvalidArgumentException::class, $exceptionContainer);
    }

    public function testInvalidKeySet(): void
    {
        $invalidKeyChr = array_merge([new stdClass()], $this->invalidKey);
        $this->performKeyTest(function ($key) {
            $this->nullCache->set($key, 'Foobar');
        }, $invalidKeyChr);
    }

    public function testInvalidKeyGet(): void
    {
        $invalidKeyChr = array_merge([new stdClass()], $this->invalidKey);
        $this->performKeyTest(function ($key) {
            $this->nullCache->get($key);
        }, $invalidKeyChr);
    }

    public function testInvalidKeyDelete(): void
    {
        $invalidKeyChr = array_merge([new stdClass()], $this->invalidKey);
        $this->performKeyTest(function ($key) {
            $this->nullCache->delete($key);
        }, $invalidKeyChr);
    }

    public function testInvalidKeyHas(): void
    {
        $invalidKeyChr = array_merge([new stdClass()], $this->invalidKey);
        $this->performKeyTest(function ($key) {
            $this->nullCache->has($key);
        }, $invalidKeyChr);
    }

    public function testInvalidKeySetMultiple(): void
    {
        $invalidKeyChr = array_merge([], $this->invalidKey);
        $this->performKeyTest(function ($key) {
            $this->nullCache->setMultiple(['foo' => 'bar', $key => 'bar']);
        }, $invalidKeyChr);
    }

    public function testInvalidKeyGetMultiple(): void
    {
        $invalidKeyChr = array_merge([], $this->invalidKey);
        $this->performKeyTest(function ($key) {
            return $this->nullCache->getMultiple(['foo', $key]);
        }, $invalidKeyChr);
    }

    public function testInvalidKeyDeleteMultiple(): void
    {
        $invalidKeyChr = array_merge([], $this->invalidKey);
        $this->performKeyTest(function ($key) {
            return $this->nullCache->deleteMultiple(['foo', $key]);
        }, $invalidKeyChr);
    }
}