<?php
/**
 * Test de la class Preset
 *
 * @author Olivier <sabinus52@gmail.com>
 *
 * @package SoundTouchApi
 */

use PHPUnit\Framework\TestCase;
use Sabinus\SoundTouch\Response;
use Sabinus\SoundTouch\Component\Preset;
use Sabinus\SoundTouch\Component\Presets;


class PresetTest extends TestCase
{
    
    protected $presets;


    protected function setUp()
    {
        $response = new Response();
        $response->parseContent('<?xml version="1.0" encoding="UTF-8" ?>
        <presets>
            <preset id="1" createdOn="1543927979" updatedOn="1543927980">
                <ContentItem source="TUNEIN" type="stationurl" location="/v1/playback/station/s6616" sourceAccount="" isPresetable="true">
                    <itemName>RFM</itemName>
                    <containerArt>http://cdn-radiotime-logos.tunein.com/s6616q.png</containerArt>
                </ContentItem>
            </preset>
            <preset id="2" createdOn="1546713729" updatedOn="1546713730">
                <ContentItem source="DEEZER" type="playlist" location="123456789" sourceAccount="toto@gmail.com" isPresetable="false">
                    <itemName>Ma playlist</itemName>
                    <containerArt>http://e-cdn-images.deezer.com/images/cover/123.jpg</containerArt>
                </ContentItem>
            </preset>
            <preset id="3" createdOn="1546713728" updatedOn="1546713728"/>
        </presets>');
        $presets = new Presets();
        $presets->setResponse($response->getXml());
        $this->presets = $presets->getPresets();
    }


    public function testConstructPreset1()
    {   
        $obj = $this->presets[0];
        $this->assertSame(1, $obj->getId());
        $this->assertSame('2018-12-04 12:52:59', $obj->getCreatedOn()->format('Y-m-d H:i:s'));
        $this->assertSame('2018-12-04 12:53:00', $obj->getUpdatedOn()->format('Y-m-d H:i:s'));
        $this->assertSame('RFM', $obj->getContentItem()->getName());
        $this->assertSame('http://cdn-radiotime-logos.tunein.com/s6616q.png', $obj->getContentItem()->getImage());
        $this->assertSame('TUNEIN', $obj->getContentItem()->getSource());
        $this->assertSame('stationurl', $obj->getContentItem()->getType());
        $this->assertSame('/v1/playback/station/s6616', $obj->getContentItem()->getLocation());
        $this->assertEmpty($obj->getContentItem()->getAccount());
        $this->assertTrue($obj->getContentItem()->getIsPresetable());
    }


    public function testConstructPreset2()
    {   
        $obj = $this->presets[1];
        $this->assertSame(2, $obj->getId());
        $this->assertSame('2019-01-05 18:42:09', $obj->getCreatedOn()->format('Y-m-d H:i:s'));
        $this->assertSame('2019-01-05 18:42:10', $obj->getUpdatedOn()->format('Y-m-d H:i:s'));
        $this->assertSame('Ma playlist', $obj->getContentItem()->getName());
        $this->assertSame('http://e-cdn-images.deezer.com/images/cover/123.jpg', $obj->getContentItem()->getImage());
        $this->assertSame('DEEZER', $obj->getContentItem()->getSource());
        $this->assertSame('playlist', $obj->getContentItem()->getType());
        $this->assertSame('123456789', $obj->getContentItem()->getLocation());
        $this->assertSame('toto@gmail.com', $obj->getContentItem()->getAccount());
        $this->assertFalse($obj->getContentItem()->getIsPresetable());
    }


    public function testConstructPreset3()
    {   
        $obj = $this->presets[2];
        $this->assertSame(3, $obj->getId());
        $this->assertSame('2019-01-05 18:42:08', $obj->getCreatedOn()->format('Y-m-d H:i:s'));
        $this->assertSame('2019-01-05 18:42:08', $obj->getUpdatedOn()->format('Y-m-d H:i:s'));
        $this->assertEmpty($obj->getContentItem());
    }

}
