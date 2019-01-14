<?php

require 'bootstrap.php';

use Sabinus\SoundTouch\SoundTouchApi;

$api = new SoundTouchApi('soundtouch');

// Info
$result = $api->getInfo();
print '--- Informations ---------------------------------------------------------------------------'."\n";
print 'Nom : '.$result->getName()."\n";
print 'Type : '.$result->getType()."\n";
print 'Compte : '.$result->getAccount()."\n";
print 'Mac : '.$result->getNetwork()->getMacAddress()."\n";
print 'IP : '.$result->getNetwork()->getIpAddress()."\n";
print "\n";

// En cours de lecture
$result = $api->getNowPlaying();
print '--- En cours de lecture --------------------------------------------------------------------'."\n";
print 'DeviceID : '.$result->getDeviceID()."\n";
print 'Source : '.$result->getSource()."\n";
print 'Contenu source : '.$result->getContentItem()->getSource()."\n";
print 'Contenu type : '.$result->getContentItem()->getType()."\n";
print 'Contenu location : '.$result->getContentItem()->getLocation()."\n";
print 'Contenu compte : '.$result->getContentItem()->getAccount()."\n";
print 'Contenu preselection : '.$result->getContentItem()->getIsPresetable()."\n";
print 'Contenu nom : '.$result->getContentItem()->getName()."\n";
print 'Contenu art : '.$result->getContentItem()->getImage()."\n";
print 'Piste : '.$result->getTrack()."\n";
print 'Artiste : '.$result->getArtist()."\n";
print 'Album : '.$result->getAlbum()."\n";
print 'Station : '.$result->getStationName()."\n";
print 'Image : '.$result->getImage()."\n";
print 'Statut : '.$result->getPlayStatus()."\n";
print 'Description : '.$result->getDescription()."\n";
print 'Station location : '.$result->getStationLocation()."\n";
print "\n";

// Volume
$result = $api->getVolume();
print '--- Volume ---------------------------------------------------------------------------------'."\n";
print 'Actuel : '.$result->getActual()."\n";
print 'Cible : '.$result->getTarget()."\n";
print 'Mute : '.$result->isMuted()."\n";
$api->setVolume(27);
$result = $api->getVolume();
print 'Volume à 27 : '.$result->getActual()."\n";
