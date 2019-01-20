<?php
/**
 * Test de la class Zone
 *
 * @author Olivier <sabinus52@gmail.com>
 *
 * @package SoundTouchApi
 */

use PHPUnit\Framework\TestCase;
use Sabinus\SoundTouch\Response;
use Sabinus\SoundTouch\Component\Zone;
use Sabinus\SoundTouch\Component\ZoneSlave;
use Sabinus\SoundTouch\Request\SetZoneRequest;
use Sabinus\SoundTouch\Request\SetAddZoneRequest;
use Sabinus\SoundTouch\Request\SetRemoveZoneRequest;


class ZoneTest extends TestCase
{
    
    public function testConstruct()
    {
        $response = new Response();
        $response->parseContent('<?xml version="1.0" encoding="UTF-8" ?>
        <zone master="ABCD123456">
            <member ipaddress="192.168.0.1">111ABCDEF</member>
            <member ipaddress="192.168.0.2">222ABCDEF</member>
        </zone>');
        $obj = new Zone();
        $obj->setResponse($response->getXml());
        $this->assertSame('ABCD123456', $obj->getMaster());
        $slaves = $obj->getSlaves();
        $this->assertSame('111ABCDEF', $slaves[0]->getMacAddress());
        $this->assertSame('192.168.0.1', $slaves[0]->getIpAddress());
        $this->assertSame('222ABCDEF', $slaves[1]->getMacAddress());
        $this->assertSame('192.168.0.2', $slaves[1]->getIpAddress());
    }


    public function testConstructNull()
    {
        $response = new Response();
        $response->parseContent('<?xml version="1.0" encoding="UTF-8" ?><zone master="ABCD123456"></zone>');
        $obj = new Zone();
        $obj->setResponse($response->getXml());
        $this->assertSame('ABCD123456', $obj->getMaster());
        $this->assertEmpty($obj->getSlaves());
    }


    public function testSetZone()
    {
        $zone = new Zone();
        $zone->setMaster('ABCD123456')->setSender('192.168.0.0');
        $slave1 = new ZoneSlave();
        $slave1->setMacAddress('111ABCDEF')->setIpAddress('192.168.0.1');
        $slave2 = new ZoneSlave();
        $slave2->setMacAddress('222ABCDEF')->setIpAddress('192.168.0.2');
        $zone->setSlaves( [ $slave1, $slave2 ] );
        $request = new SetZoneRequest();
        $request->setZone($zone);
        $this->assertSame('<zone master="ABCD123456" senderIPAddress="192.168.0.0"><member ipaddress="192.168.0.1">111ABCDEF</member><member ipaddress="192.168.0.2">222ABCDEF</member></zone>', $request->getPayload());
    }


    public function testAddZoneSlave()
    {
        $slave = new ZoneSlave();
        $slave->setMacAddress('111ABCDEF')->setIpAddress('192.168.0.1');
        $request = new SetAddZoneRequest();
        $request->setDeviceID('ABCD123456')->setSlave($slave);
        $this->assertSame('<zone master="ABCD123456"><member ipaddress="192.168.0.1">111ABCDEF</member></zone>', $request->getPayload());
    }


    public function testRemoveZoneSlave()
    {
        $slave = new ZoneSlave();
        $slave->setMacAddress('111ABCDEF')->setIpAddress('192.168.0.1');
        $request = new SetRemoveZoneRequest();
        $request->setDeviceID('ABCD123456')->setSlave($slave);
        $this->assertSame('<zone master="ABCD123456"><member ipaddress="192.168.0.1">111ABCDEF</member></zone>', $request->getPayload());
    }


    public function testPushAndPopSlave()
    {
        $zone = new Zone();
        $zone->setMaster('ABCD123456');
        $slave1 = new ZoneSlave();
        $slave1->setMacAddress('111ABCDEF')->setIpAddress('192.168.0.1');
        $zone->addSlave($slave1);
        $this->assertCount(1, $zone->getSlaves());
        $slave2 = new ZoneSlave();
        $slave2->setMacAddress('222ABCDEF')->setIpAddress('192.168.0.2');
        $zone->addSlave($slave2);
        $this->assertCount(2, $zone->getSlaves());
        $this->assertTrue($zone->hasSlave($slave1));
        $zone->removeSlave($slave1);
        $this->assertFalse($zone->hasSlave($slave1));
        $this->assertCount(1, $zone->getSlaves());
    }

}
