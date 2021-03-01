<?php
/**
 * Test de la class SoundTouchCache
 *
 * @author Olivier <sabinus52@gmail.com>
 *
 * @package SoundTouchApi
 */

use PHPUnit\Framework\TestCase;
use Sabinus\SoundTouch\SoundTouchCache;


class SoundTouchCacheTest extends TestCase
{

    public function testCache()
    {
        $cache = new SoundTouchCache();
        $this->assertNull($cache->getData('test'));
        $cache->setData('test', 'Hello World !');
        $this->assertSame('Hello World !', $cache->getData('test'));
    }

}
