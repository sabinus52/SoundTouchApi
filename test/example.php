<?php

require 'bootstrap.php';

use Sabinus\SoundTouch\SoundTouchApi;
use Sabinus\SoundTouch\Component\ContentItem;
use Sabinus\SoundTouch\Constants\Source;
use Sabinus\SoundTouch\Constants\Key;
use Sabinus\SoundTouch\Component\Zone;
use Sabinus\SoundTouch\Component\ZoneSlave;


// Initialize object API
$api = new SoundTouchApi('soundtouch');

// Get informations
$info = $api->getInfo();
print 'DeviceID : '.$info->getDeviceID()."\n";
print 'Nom : '.$info->getName()."\n";

// Get now playing
$result = $api->getNowPlaying();
print 'Source : '.$result->getSource()."\n";

// Volume
$volume = $api->getVolume();
print 'Volume : '.$volume->getActual()."\n";
print 'Mute : '.$volume->isMuted()."\n";
$api->setVolume(27); // Set new volume 0..100
$api->mute(); // Cut volume

// Select source BLUETOOTH
$source = new ContentItem();
$source->setSource(Source::BLUETOOTH);
$api->selectSource($source);

// Select station radio TUNEIN
$source = new ContentItem();
$source->setSource(Source::TUNEIN)
    ->setType('stationurl')
    ->setLocation('/v1/playback/station/s17695');
$api->selectSource($source);

// Send Command pause music
$api->setKey(Key::PAUSE);
$result = $api->getNowPlaying();
print 'Track : '.$result->getTrack()."\n";
print 'Artist : '.$result->getArtist()."\n";

// List of the sources
$result = $api->getSources();
foreach ($result as $key => $source) {
    print $key.' : '.$source->getName().' / '.$source->getSource()."\n";
}

// Liste of presets
$result = $api->getPresets();
foreach ($result as $preset) {
    print 'Preset '.$preset->getId().' : '.$preset->getContentItem()->getSource().' / '.$preset->getContentItem()->getName()."\n";
}


// Zone MultiRoom : Create zone master
$zone = new Zone('XXXXXXXXXXXX');
$slave = new ZoneSlave();
$slave->setMacAddress('XXXXXXXXXXXX')->setIpAddress('192.168.0.11');
$zone->addSlave($slave);
$api->setZone($zone);
// Zone MultiRoom : Add zone slave
$slave = new ZoneSlave();
$slave->setMacAddress('YYYYYYYYYYYY')->setIpAddress('192.168.0.12');
$api->addZoneSlave($slave);

$result = $api->getZone();
print_r($result);
