<?php
/**
 * Test de la class Info
 *
 * @author Olivier <sabinus52@gmail.com>
 *
 * @package SoundTouchApi
 */

use PHPUnit\Framework\TestCase;
use Sabinus\SoundTouch\Response;
use Sabinus\SoundTouch\Component\Info;


class InfoTest extends TestCase
{

    public function testConstruct()
    {
        $response = new Response('<?xml version="1.0" encoding="UTF-8" ?><info deviceID="ABCD123456"><name>SoundTouch</name><type>SoundTouch</type><margeAccountUUID>12345678</margeAccountUUID>
            <margeURL>https://streaming.bose.com</margeURL><networkInfo type="SCM"><macAddress>123456ABCD</macAddress><ipAddress>192.168.0.0</ipAddress></networkInfo>
            <moduleType>sm2</moduleType><variant>ginger</variant><variantMode>noap</variantMode><countryCode>GB</countryCode><regionCode>GB</regionCode></info>');
        $obj = new Info($response->getXML());
        $this->assertSame('ABCD123456', $obj->getDeviceID());
        $this->assertSame('SoundTouch', $obj->getName());
        $this->assertSame('SoundTouch', $obj->getType());
        $this->assertSame('12345678', $obj->getAccount());
        $this->assertSame('123456ABCD', $obj->getNetwork()->getMacAddress());
        $this->assertSame('192.168.0.0', $obj->getNetwork()->getIpAddress());
        $this->assertSame('sm2', $obj->getModuleType());
        $this->assertSame('ginger', $obj->getVariant());
        $this->assertSame('noap', $obj->getVariantMode());
        $this->assertSame('GB', $obj->getCountryCode());
        $this->assertSame('GB', $obj->getRegionCode());
    }

    public function testConstructNull()
    {
        $response = new Response('<?xml version="1.0" encoding="UTF-8" ?><info deviceID="ABCD123456"></info>');
        $obj = new Info($response->getXML());
        $this->assertSame('ABCD123456', $obj->getDeviceID());
        $this->assertEmpty($obj->getName());
        $this->assertEmpty($obj->getType());
        $this->assertEmpty($obj->getAccount());
        $this->assertEmpty($obj->getNetwork()->getMacAddress());
        $this->assertEmpty($obj->getNetwork()->getIpAddress());
        $this->assertEmpty($obj->getModuleType());
        $this->assertEmpty($obj->getVariant());
        $this->assertEmpty($obj->getVariantMode());
        $this->assertEmpty($obj->getCountryCode());
        $this->assertEmpty($obj->getRegionCode());
    }

}
