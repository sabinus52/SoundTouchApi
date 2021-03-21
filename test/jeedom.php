<?php

require 'bootstrap.php';

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

