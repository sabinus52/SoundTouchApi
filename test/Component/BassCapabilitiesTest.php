<?php
/**
 * Test de la class BassCapabilities
 *
 * @author Olivier <sabinus52@gmail.com>
 *
 * @package SoundTouchApi
 */

use PHPUnit\Framework\TestCase;
use Sabinus\SoundTouch\Response;
use Sabinus\SoundTouch\Component\BassCapabilities;


class BassCapabilitiesTest extends TestCase
{

    public function testConstruct()
    {
        $response = new Response('<?xml version="1.0" encoding="UTF-8" ?>
        <bassCapabilities deviceID="ABCD123456">
            <bassAvailable>false</bassAvailable>
            <bassMin>-9</bassMin>
            <bassMax>9</bassMax>
            <bassDefault>1</bassDefault>
        </bassCapabilities>');
        $obj = new BassCapabilities($response->getXml());
        $this->assertFalse($obj->getAvailable());
        $this->assertSame(-9, $obj->getMin());
        $this->assertSame(9, $obj->getMax());
        $this->assertSame(1, $obj->getDefault());
    }


    public function testConstructNull()
    {
        $response = new Response('<?xml version="1.0" encoding="UTF-8" ?><bassCapabilities deviceID="ABCD123456"></bassCapabilities>');
        $obj = new BassCapabilities($response->getXml());
        $this->assertEmpty($obj->getAvailable());
        $this->assertEmpty($obj->getMin());
        $this->assertEmpty($obj->getMax());
        $this->assertEmpty($obj->getDefault());
    }

}
