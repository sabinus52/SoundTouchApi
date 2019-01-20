<?php
/**
 * Test de la class Volume
 *
 * @author Olivier <sabinus52@gmail.com>
 *
 * @package SoundTouchApi
 */

use PHPUnit\Framework\TestCase;
use Sabinus\SoundTouch\Response;
use Sabinus\SoundTouch\Component\Volume;
use Sabinus\SoundTouch\Request\SetVolumeRequest;


class VolumeTest extends TestCase
{
    
    public function testConstruct()
    {
        $response = new Response();
        $response->parseContent('<?xml version="1.0" encoding="UTF-8" ?>
        <volume deviceID="2C6B7D5EC886">
            <targetvolume>27</targetvolume>
            <actualvolume>27</actualvolume>
            <muteenabled>false</muteenabled>
        </volume>');
        $obj = new Volume();
        $obj->setResponse($response->getXml());
        $this->assertSame(27, $obj->getActual());
        $this->assertSame(27, $obj->getTarget());
        $this->assertFalse($obj->isMuted());
    }


    public function testConstructNull()
    {
        $response = new Response();
        $response->parseContent('<?xml version="1.0" encoding="UTF-8" ?><volume deviceID="2C6B7D5EC886"></volume>');
        $obj = new Volume();
        $obj->setResponse($response->getXml());
        $this->assertEmpty($obj->getActual());
        $this->assertEmpty($obj->getTarget());
        $this->assertEmpty($obj->isMuted());
    }


    public function testSetVolume()
    {
        $volume = new Volume(11);
        $request = new SetVolumeRequest();
        $request->setVolume($volume);
        $this->assertEquals('<volume>11</volume>', $request->getPayload());

        $volume = new Volume();
        $request = new SetVolumeRequest();
        $request->setVolume($volume);
        $this->assertEquals('<volume>0</volume>', $request->getPayload());

        $volume = new Volume();
        $volume->setTarget(22);
        $request = new SetVolumeRequest();
        $request->setVolume($volume);
        $this->assertEquals('<volume>22</volume>', $request->getPayload());

        $volume = new Volume('toto');
        $request = new SetVolumeRequest();
        $request->setVolume($volume);
        $this->assertEquals('<volume>0</volume>', $request->getPayload());
    }

}
