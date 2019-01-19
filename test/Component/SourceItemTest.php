<?php
/**
 * Test de la class SourceItem
 *
 * @author Olivier <sabinus52@gmail.com>
 *
 * @package SoundTouchApi
 */

use PHPUnit\Framework\TestCase;
use Sabinus\SoundTouch\Response;
use Sabinus\SoundTouch\Component\SourceItem;


class SourceItemTest extends TestCase
{
    
    protected $xml;


    protected function setUp()
    {
        $response = new Response('<?xml version="1.0" encoding="UTF-8" ?>
        <sources deviceID="2C6B7D5EC886">
            <sourceItem source="DEEZER" sourceAccount="toto@gmail.com" status="READY" isLocal="false" multiroomallowed="true">toto@gmail.com</sourceItem>
            <sourceItem source="BLUETOOTH" status="UNAVAILABLE" isLocal="true" multiroomallowed="true" />
            <sourceItem source="SPOTIFY" status="UNAVAILABLE" isLocal="false" multiroomallowed="true" />
            <sourceItem source="PRODUCT" sourceAccount="TV" status="READY" isLocal="true" multiroomallowed="true">TV</sourceItem>
            <sourceItem source="TUNEIN" status="READY" isLocal="false" multiroomallowed="true" />
        </sources>');
        $this->xml = $response->getXml();
    }


    public function testConstructDeezer()
    {   
        $obj = new SourceItem($this->xml->sourceItem[0]);
        $this->assertSame('toto@gmail.com', $obj->getName());
        $this->assertSame('DEEZER', $obj->getSource());
        $this->assertSame('toto@gmail.com', $obj->getAccount());
        $this->assertSame('READY', $obj->getStatus());
        $this->assertFalse($obj->getIsLocal());
        $this->assertTrue($obj->getMultiroomAllowed());
    }


    public function testConstructBluetooth()
    {   
        $obj = new SourceItem($this->xml->sourceItem[1]);
        $this->assertSame('BLUETOOTH', $obj->getName());
        $this->assertSame('BLUETOOTH', $obj->getSource());
        $this->assertEmpty($obj->getAccount());
        $this->assertSame('UNAVAILABLE', $obj->getStatus());
        $this->assertTrue($obj->getIsLocal());
        $this->assertTrue($obj->getMultiroomAllowed());
    }


    public function testConstructSpotify()
    {   
        $obj = new SourceItem($this->xml->sourceItem[2]);
        $this->assertSame('SPOTIFY', $obj->getName());
        $this->assertSame('SPOTIFY', $obj->getSource());
        $this->assertEmpty($obj->getAccount());
        $this->assertSame('UNAVAILABLE', $obj->getStatus());
        $this->assertFalse($obj->getIsLocal());
        $this->assertTrue($obj->getMultiroomAllowed());
    }


    public function testConstructProduct()
    {   
        $obj = new SourceItem($this->xml->sourceItem[3]);
        $this->assertSame('TV', $obj->getName());
        $this->assertSame('PRODUCT', $obj->getSource());
        $this->assertSame('TV', $obj->getAccount());
        $this->assertSame('READY', $obj->getStatus());
        $this->assertTrue($obj->getIsLocal());
        $this->assertTrue($obj->getMultiroomAllowed());
    }


    public function testConstructTuneIn()
    {   
        $obj = new SourceItem($this->xml->sourceItem[4]);
        $this->assertSame('TUNEIN', $obj->getName());
        $this->assertSame('TUNEIN', $obj->getSource());
        $this->assertEmpty($obj->getAccount());
        $this->assertSame('READY', $obj->getStatus());
        $this->assertFalse($obj->getIsLocal());
        $this->assertTrue($obj->getMultiroomAllowed());
    }

}
