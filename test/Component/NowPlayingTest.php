<?php
/**
 * Test de la class NowPlaying
 *
 * @author Olivier <sabinus52@gmail.com>
 *
 * @package SoundTouchApi
 */

use PHPUnit\Framework\TestCase;
use Sabinus\SoundTouch\Response;
use Sabinus\SoundTouch\Component\NowPlaying;


class NowPlayingTest extends TestCase
{

    public function testConstructStandBy()
    {
        $response = new Response('<?xml version="1.0" encoding="UTF-8" ?>
        <nowPlaying deviceID="ABCD123456" source="STANDBY">
            <ContentItem source="STANDBY" isPresetable="false" />
        </nowPlaying>');
        $obj = new NowPlaying($response->getXml());
        $this->assertSame('STANDBY', $obj->getSource());
        $this->assertEmpty($obj->getContentItem()->getName());
        $this->assertEmpty($obj->getContentItem()->getImage());
        $this->assertSame('STANDBY', $obj->getContentItem()->getSource());
        $this->assertEmpty($obj->getContentItem()->getType());
        $this->assertEmpty($obj->getContentItem()->getLocation());
        $this->assertEmpty($obj->getContentItem()->getAccount());
        $this->assertFalse($obj->getContentItem()->getIsPresetable());
        $this->assertEmpty($obj->getTrack());
        $this->assertEmpty($obj->getArtist());
        $this->assertEmpty($obj->getAlbum());
        $this->assertEmpty($obj->getImage());
        $this->assertEmpty($obj->getDuration());
        $this->assertEmpty($obj->getPosition());
        $this->assertEmpty($obj->getPlayStatus());
        $this->assertEmpty($obj->getShuffleSetting());
        $this->assertEmpty($obj->getRepeatSetting());
        $this->assertEmpty($obj->getStreamType());
        $this->assertEmpty($obj->getStationName());
        $this->assertEmpty($obj->getStationLocation());
        $this->assertEmpty($obj->getDescription());
        $this->assertEmpty($obj->getArtistID());
        $this->assertEmpty($obj->getTrackID());
    }


    public function testConstructTV()
    {
        $response = new Response('<?xml version="1.0" encoding="UTF-8" ?>
        <nowPlaying deviceID="2C6B7D5EC886" source="PRODUCT" sourceAccount="TV">
            <ContentItem source="PRODUCT" sourceAccount="TV" isPresetable="false"/>
            <art artImageStatus="SHOW_DEFAULT_IMAGE"/>
            <playStatus>PLAY_STATE</playStatus>
        </nowPlaying>');
        $obj = new NowPlaying($response->getXml());
        $this->assertSame('PRODUCT', $obj->getSource());
        $this->assertEmpty($obj->getContentItem()->getName());
        $this->assertEmpty($obj->getContentItem()->getImage());
        $this->assertSame('PRODUCT', $obj->getContentItem()->getSource());
        $this->assertEmpty($obj->getContentItem()->getType());
        $this->assertEmpty($obj->getContentItem()->getLocation());
        $this->assertSame('TV', $obj->getContentItem()->getAccount());
        $this->assertFalse($obj->getContentItem()->getIsPresetable());
        $this->assertEmpty($obj->getTrack());
        $this->assertEmpty($obj->getArtist());
        $this->assertEmpty($obj->getAlbum());
        $this->assertEmpty($obj->getImage());
        $this->assertEmpty($obj->getDuration());
        $this->assertEmpty($obj->getPosition());
        $this->assertSame('PLAY_STATE', $obj->getPlayStatus());
        $this->assertEmpty($obj->getShuffleSetting());
        $this->assertEmpty($obj->getRepeatSetting());
        $this->assertEmpty($obj->getStreamType());
        $this->assertEmpty($obj->getStationName());
        $this->assertEmpty($obj->getStationLocation());
        $this->assertEmpty($obj->getDescription());
        $this->assertEmpty($obj->getArtistID());
        $this->assertEmpty($obj->getTrackID());
    }


    public function testConstructBluetooth()
    {
        $response = new Response('<?xml version="1.0" encoding="UTF-8" ?>
        <nowPlaying deviceID="2C6B7D5EC886" source="BLUETOOTH" sourceAccount="">
            <ContentItem source="BLUETOOTH" location="" sourceAccount="" isPresetable="false">
                <itemName>Android XX</itemName>
            </ContentItem>
            <track>Magnetic Fields, Pt. 1</track>
            <artist>Jean-Michel Jarre</artist>
            <album>Les Chants Magnétiques / Magnetic Fields</album>
            <stationName>Android XX</stationName>
            <art artImageStatus="SHOW_DEFAULT_IMAGE"/>
            <skipEnabled/>
            <playStatus>PAUSE_STATE</playStatus>
            <skipPreviousEnabled/>
            <genre/>
            <connectionStatusInfo status="CONNECTED" deviceName="Android XX"/>
        </nowPlaying>');
        $obj = new NowPlaying($response->getXml());
        $this->assertSame('BLUETOOTH', $obj->getSource());
        $this->assertSame('Android XX', $obj->getContentItem()->getName());
        $this->assertEmpty($obj->getContentItem()->getImage());
        $this->assertSame('BLUETOOTH', $obj->getContentItem()->getSource());
        $this->assertEmpty($obj->getContentItem()->getType());
        $this->assertEmpty($obj->getContentItem()->getLocation());
        $this->assertEmpty($obj->getContentItem()->getAccount());
        $this->assertFalse($obj->getContentItem()->getIsPresetable());
        $this->assertSame('Magnetic Fields, Pt. 1', $obj->getTrack());
        $this->assertSame('Jean-Michel Jarre', $obj->getArtist());
        $this->assertSame('Les Chants Magnétiques / Magnetic Fields', $obj->getAlbum());
        $this->assertEmpty($obj->getImage());
        $this->assertEmpty($obj->getDuration());
        $this->assertEmpty($obj->getPosition());
        $this->assertSame('PAUSE_STATE', $obj->getPlayStatus());
        $this->assertEmpty($obj->getShuffleSetting());
        $this->assertEmpty($obj->getRepeatSetting());
        $this->assertEmpty($obj->getStreamType());
        $this->assertSame('Android XX', $obj->getStationName());
        $this->assertEmpty($obj->getStationLocation());
        $this->assertEmpty($obj->getDescription());
        $this->assertEmpty($obj->getArtistID());
        $this->assertEmpty($obj->getTrackID());
    }

    public function testConstructTuneIn()
    {
        $response = new Response('<?xml version="1.0" encoding="UTF-8" ?>
        <nowPlaying deviceID="2C6B7D5EC886" source="TUNEIN" sourceAccount="">
            <ContentItem source="TUNEIN" type="stationurl" location="/v1/playback/station/s6616" sourceAccount="" isPresetable="true">
                <itemName>RFM</itemName>
                <containerArt>http://cdn-radiotime-logos.tunein.com/s6616q.png</containerArt>
            </ContentItem>
            <track>RFM</track>
            <artist>Vincent Richard</artist>
            <album/>
            <stationName>RFM</stationName>
            <art artImageStatus="IMAGE_PRESENT">http://cdn-radiotime-logos.tunein.com/p861736q.png</art>
            <favoriteEnabled/>
            <playStatus>PLAY_STATE</playStatus>
            <streamType>RADIO_STREAMING</streamType>
            <isFavorite/>
        </nowPlaying>');
        $obj = new NowPlaying($response->getXml());
        $this->assertSame('TUNEIN', $obj->getSource());
        $this->assertSame('RFM', $obj->getContentItem()->getName());
        $this->assertSame('http://cdn-radiotime-logos.tunein.com/s6616q.png', $obj->getContentItem()->getImage());
        $this->assertSame('TUNEIN', $obj->getContentItem()->getSource());
        $this->assertSame('stationurl', $obj->getContentItem()->getType());
        $this->assertSame('/v1/playback/station/s6616', $obj->getContentItem()->getLocation());
        $this->assertEmpty($obj->getContentItem()->getAccount());
        $this->assertTrue($obj->getContentItem()->getIsPresetable());
        $this->assertSame('RFM', $obj->getTrack());
        $this->assertSame('Vincent Richard', $obj->getArtist());
        $this->assertEmpty($obj->getAlbum());
        $this->assertSame('http://cdn-radiotime-logos.tunein.com/p861736q.png', $obj->getImage());
        $this->assertEmpty($obj->getDuration());
        $this->assertEmpty($obj->getPosition());
        $this->assertSame('PLAY_STATE', $obj->getPlayStatus());
        $this->assertEmpty($obj->getShuffleSetting());
        $this->assertEmpty($obj->getRepeatSetting());
        $this->assertSame('RADIO_STREAMING', $obj->getStreamType());
        $this->assertSame('RFM', $obj->getStationName());
        $this->assertEmpty($obj->getStationLocation());
        $this->assertEmpty($obj->getDescription());
        $this->assertEmpty($obj->getArtistID());
        $this->assertEmpty($obj->getTrackID());
    }


    public function testConstructDeezer()
    {
        $response = new Response('<?xml version="1.0" encoding="UTF-8" ?>
        <nowPlaying deviceID="2C6B7D5EC886" source="DEEZER" sourceAccount="toto@gmail.com">
            <ContentItem source="DEEZER" type="playlist" location="123456789" sourceAccount="toto@gmail.com" isPresetable="true">
                <itemName>Best Of 80 à moi</itemName>
                <containerArt>http://e-cdn-images.deezer.com/images/cover/0-0.jpg</containerArt>
            </ContentItem>
            <track>Master and Servant</track>
            <artist>Depeche Mode</artist>
            <album>The Best of Depeche Mode, Vol. 1 (Deluxe)</album>
            <stationName/>
            <art artImageStatus="IMAGE_PRESENT">http://api.deezer.com/album/6709077/image?size=big</art>
            <time total="227">45</time>
            <rating>NONE</rating>
            <skipEnabled/>
            <playStatus>PLAY_STATE</playStatus>
            <shuffleSetting>SHUFFLE_OFF</shuffleSetting>
            <repeatSetting>REPEAT_OFF</repeatSetting>
            <skipPreviousEnabled/>
            <streamType>TRACK_ONDEMAND</streamType>
            <artistID>545</artistID>
            <trackID>68514297</trackID>
        </nowPlaying>');
        $obj = new NowPlaying($response->getXml());
        $this->assertSame('DEEZER', $obj->getSource());
        $this->assertSame('Best Of 80 à moi', $obj->getContentItem()->getName());
        $this->assertSame('http://e-cdn-images.deezer.com/images/cover/0-0.jpg', $obj->getContentItem()->getImage());
        $this->assertSame('DEEZER', $obj->getContentItem()->getSource());
        $this->assertSame('playlist', $obj->getContentItem()->getType());
        $this->assertSame('123456789', $obj->getContentItem()->getLocation());
        $this->assertSame('toto@gmail.com', $obj->getContentItem()->getAccount());
        $this->assertTrue($obj->getContentItem()->getIsPresetable());
        $this->assertSame('Master and Servant', $obj->getTrack());
        $this->assertSame('Depeche Mode', $obj->getArtist());
        $this->assertSame('The Best of Depeche Mode, Vol. 1 (Deluxe)', $obj->getAlbum());
        $this->assertSame('http://api.deezer.com/album/6709077/image?size=big', $obj->getImage());
        $this->assertSame(227, $obj->getDuration());
        $this->assertSame(45, $obj->getPosition());
        $this->assertSame('PLAY_STATE', $obj->getPlayStatus());
        $this->assertSame('SHUFFLE_OFF', $obj->getShuffleSetting());
        $this->assertSame('REPEAT_OFF', $obj->getRepeatSetting());
        $this->assertSame('TRACK_ONDEMAND', $obj->getStreamType());
        $this->assertEmpty($obj->getStationName());
        $this->assertEmpty($obj->getStationLocation());
        $this->assertEmpty($obj->getDescription());
        $this->assertSame(545, $obj->getArtistID());
        $this->assertSame(68514297, $obj->getTrackID());
    }


    public function testConstructNull()
    {
        $response = new Response('<?xml version="1.0" encoding="UTF-8" ?><nowPlaying></nowPlaying>');
        $obj = new NowPlaying($response->getXml());
        $this->assertEmpty($obj->getSource());
        $this->assertEmpty($obj->getContentItem());
        $this->assertEmpty($obj->getTrack());
        $this->assertEmpty($obj->getArtist());
        $this->assertEmpty($obj->getAlbum());
        $this->assertEmpty($obj->getImage());
        $this->assertEmpty($obj->getDuration());
        $this->assertEmpty($obj->getPosition());
        $this->assertEmpty($obj->getPlayStatus());
        $this->assertEmpty($obj->getShuffleSetting());
        $this->assertEmpty($obj->getRepeatSetting());
        $this->assertEmpty($obj->getStreamType());
        $this->assertEmpty($obj->getStationName());
        $this->assertEmpty($obj->getStationLocation());
        $this->assertEmpty($obj->getDescription());
        $this->assertEmpty($obj->getArtistID());
        $this->assertEmpty($obj->getTrackID());
    }

}
