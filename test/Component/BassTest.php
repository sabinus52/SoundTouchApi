<?php
/**
 * Test de la class Bass
 *
 * @author Olivier <sabinus52@gmail.com>
 *
 * @package SoundTouchApi
 */

use PHPUnit\Framework\TestCase;
use Sabinus\SoundTouch\Response;
use Sabinus\SoundTouch\Component\Bass;
use Sabinus\SoundTouch\Request\SetBassRequest;


class BassTest extends TestCase
{
    
    public function testConstruct()
    {
        $response = new Response('<?xml version="1.0" encoding="UTF-8" ?>
        <bass deviceID="2C6B7D5EC886">
            <targetbass>-1</targetbass>
            <actualbass>1</actualbass>
        </bass>');
        $obj = new Bass($response->getXml());
        $this->assertSame(1, $obj->getActual());
        $this->assertSame(-1, $obj->getTarget());
    }


    public function testConstructNull()
    {
        $response = new Response('<?xml version="1.0" encoding="UTF-8" ?><bass deviceID="2C6B7D5EC886"></bass>');
        $obj = new Bass($response->getXml());
        $this->assertEmpty($obj->getActual());
        $this->assertEmpty($obj->getTarget());
    }


    public function testSetBass()
    {
        $bass = new Bass(1);
        $request = new SetBassRequest();
        $request->setBass($bass);
        $this->assertEquals('<bass>1</bass>', $request->getPayload());

        $bass = new Bass();
        $request = new SetBassRequest();
        $request->setBass($bass);
        $this->assertEquals('<bass>0</bass>', $request->getPayload());

        $bass = new Bass();
        $bass->setTarget(-2);
        $request = new SetBassRequest();
        $request->setBass($bass);
        $this->assertEquals('<bass>-2</bass>', $request->getPayload());

        $bass = new Bass('toto');
        $request = new SetBassRequest();
        $request->setBass($bass);
        $this->assertEquals('<bass>0</bass>', $request->getPayload());
    }

}
