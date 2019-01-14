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
