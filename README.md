# SoundTouchApi

SoundTouchApi is a PHP Library that allows you to interact with Bose SoundTouch speakers. It allows you to integrate control into your own PHP applications or domotic box.


## Installation

For install the package with composer :

~~~
composer require sabinus52/soundtouchapi
composer install
~~~


## Usage

~~~ php
require __DIR__ . '/vendor/autoload.php';

use Sabinus\SoundTouch\SoundTouchApi;
use Sabinus\SoundTouch\Component\ContentItem;
use Sabinus\SoundTouch\Constants\Source;
use Sabinus\SoundTouch\Constants\Key;


// Initialize object API
$api = new SoundTouchApi('192.168.0.1');

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

// Play preset No. 1
$api->playPreset(1);

// Set current source as preset No. 5
$api->setPreset(5);
~~~


## MutiRoom

~~~ php
require __DIR__ . '/vendor/autoload.php';

use Sabinus\SoundTouch\SoundTouchApi;
use Sabinus\SoundTouch\Component\ContentItem;
use Sabinus\SoundTouch\Constants\Source;
use Sabinus\SoundTouch\Constants\Key;

// Initialize object API
$api = new SoundTouchApi('192.168.0.1');

// Create zone
$zone = new Zone();
$zone->setMaster('ABCD123456')->setSender('192.168.0.1');
$slave1 = new ZoneSlave();
$slave1->setMacAddress('111ABCDEF')->setIpAddress('192.168.0.2');
$slave2 = new ZoneSlave();
$slave2->setMacAddress('222ABCDEF')->setIpAddress('192.168.0.3');
$zone->setSlaves( [ $slave1, $slave2 ] );
$api->setZone($zone);

// Remove slave
$api->removeZoneSlave($slave2);
// Add slave
$api->addZoneSlave($slave2);
~~~


## Jeedom

A specific class to integrate control into Jeedom. (More features)

See my Jeedom plugin : https://github.com/sabinus52/jeedom-bose-soundtouch

Example :

~~~ php
use Sabinus\SoundTouch\JeedomSoundTouchApi;

$speaker = new JeedomSoundTouchApi('soundtouch');

// Power ON
$speaker->powerOn();

// Select BlueTooth
$speaker->selectBlueTooth();
$status = $speaker->getNowPlaying();
print 'Source : '.$status->getSource()."\n";
print 'Track : '.$status->getTrack()."\n";
print 'Artist : '.$status->getArtist()."\n";
$speaker->play();
$speaker->nextTrack();
$status = $speaker->getNowPlaying(true); // Refresh status
print 'Track : '.$status->getTrack()."\n";
print 'Artist : '.$status->getArtist()."\n";

// Select source HDMI
$speaker->selectHDMI();

// Display volume and change it
print 'Volume Actual : '.$speaker->getLevelVolume()."\n";
print 'Mute : '.$speaker->isMuted()."\n";
$speaker->setVolume(27);
print 'New volume : '.$speaker->getLevelVolume(true)."\n";
~~~

