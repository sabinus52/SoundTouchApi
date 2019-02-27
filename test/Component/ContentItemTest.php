<?php
/**
 * Test de la class ContentItem
 *
 * @author Olivier <sabinus52@gmail.com>
 *
 * @package SoundTouchApi
 */

use PHPUnit\Framework\TestCase;
use Sabinus\SoundTouch\Component\ContentItem;
use Sabinus\SoundTouch\Constants\Source;
use Sabinus\SoundTouch\Request\SetSelectRequest;


class ContentItemTest extends TestCase
{

    public function testSelectSourceBluetooth()
    {
        $source = new ContentItem();
        $source->setSource(Source::BLUETOOTH);
        $request = new SetSelectRequest();
        $request->setSource($source);
        $this->assertSame('<ContentItem source="BLUETOOTH"></ContentItem>', $request->getPayload());
    }


    public function testSelectSourceHDMI()
    {
        $source = new ContentItem();
        $source->setSource(Source::PRODUCT)
            ->setAccount('HDMI_1');
        $request = new SetSelectRequest();
        $request->setSource($source);
        $this->assertSame('<ContentItem source="PRODUCT" sourceAccount="HDMI_1"></ContentItem>', $request->getPayload());
    }


    public function testSelectSourceTuneIn()
    {
        $source = new ContentItem();
        $source->setSource(Source::TUNEIN)
            ->setType('stationurl')
            ->setLocation('/v1/playback/station/s17695');
        $request = new SetSelectRequest();
        $request->setSource($source);
        $this->assertSame('<ContentItem source="TUNEIN" location="/v1/playback/station/s17695" type="stationurl"></ContentItem>', $request->getPayload());
    }


    public function testSelectSourceTuneInFull()
    {
        $source = new ContentItem();
        $source->setSource(Source::TUNEIN)
            ->setType('stationurl')
            ->setLocation('/v1/playback/station/s17695')
            ->setName('Radio FG')
            ->setImage('http://cdn-radiotime-logos.tunein.com/s17695q.png');
        $request = new SetSelectRequest();
        $request->setSource($source);
        $this->assertSame('<ContentItem source="TUNEIN" location="/v1/playback/station/s17695" type="stationurl"><itemName>Radio FG</itemName><containerArt>http://cdn-radiotime-logos.tunein.com/s17695q.png</containerArt></ContentItem>', $request->getPayload());
    }

}
