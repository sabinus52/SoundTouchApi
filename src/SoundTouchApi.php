<?php
/**
 * Librairie de base de l'API
 *
 * @author Olivier <sabinus52@gmail.com>
 *
 * @package SoundTouchApi
 */

namespace Sabinus\SoundTouch;

use \Sabinus\SoundTouch\Constants\Key;
use \Sabinus\SoundTouch\Constants\Source;
use \Sabinus\SoundTouch\Request\GetInfoRequest;
use \Sabinus\SoundTouch\Request\GetNowPlayingRequest;
use \Sabinus\SoundTouch\Request\GetVolumeRequest;
use \Sabinus\SoundTouch\Request\SetVolumeRequest;
use \Sabinus\SoundTouch\Request\GetSourcesRequest;
use \Sabinus\SoundTouch\Request\SetSelectRequest;
use \Sabinus\SoundTouch\Request\GetPresetsRequest;
use \Sabinus\SoundTouch\Request\GetZoneRequest;
use \Sabinus\SoundTouch\Request\SetNameRequest;
use \Sabinus\SoundTouch\Request\SetKeyRequest;
use \Sabinus\SoundTouch\Request\GetBassRequest;
use \Sabinus\SoundTouch\Request\SetBassRequest;
use \Sabinus\SoundTouch\Request\GetBassCapabilitiesRequest;
use \Sabinus\SoundTouch\Request\SetZoneRequest;
use \Sabinus\SoundTouch\Request\SetAddZoneRequest;
use \Sabinus\SoundTouch\Request\SetRemoveZoneRequest;
use \Sabinus\SoundTouch\Component\Info;
use \Sabinus\SoundTouch\Component\NowPlaying;
use \Sabinus\SoundTouch\Component\Volume;
use \Sabinus\SoundTouch\Component\ContentItem;
use \Sabinus\SoundTouch\Component\Sources;
use \Sabinus\SoundTouch\Component\SourceItem;
use \Sabinus\SoundTouch\Component\Preset;
use \Sabinus\SoundTouch\Component\Presets;
use \Sabinus\SoundTouch\Component\Bass;
use \Sabinus\SoundTouch\Component\BassCapabilities;
use \Sabinus\SoundTouch\Component\Zone;
use \Sabinus\SoundTouch\Component\ZoneSlave;


class SoundTouchApi
{

    /**
     * Client pour les requests à l'enceinte
     * 
     * @var ClientApi
     */
    protected $client;


    /**
     * @var String
     */
    protected $hostname;


    /**
     * Constructeur
     * 
     * @param String $host
     * @param Boolean $isCached : Activation du cache ou pas
     */
    public function __construct($host, $isCached = false)
    {
        $this->client = new ClientApi($host);
        $this->client->setCached($isCached);
        $this->hostname = $host;
    }


    /**
     * Retourne le message d'erreru
     * 
     * @return String
     */
    public function getMessageError()
    {
        return $this->client->getMessageError();
    }

    
    /**
     * Retourne les infos de l'enceinte
     * 
     * @return Info
     */
    public function getInfo($refresh = false)
    {
        return $this->client->request( new GetInfoRequest($refresh) );
    }


    /**
     * Retourne le statut en cours de l'enceinte
     * 
     * @return NowPlaying
     */
    public function getNowPlaying($refresh = false)
    {
        return $this->client->request( new GetNowPlayingRequest($refresh) );
    }


    /**
     * Retourne la liste des sources
     * 
     * @return Sources
     */
    public function getSources($refresh = false)
    {
        return $this->client->request( new GetSourcesRequest($refresh) );
    }


    /**
     * Selectionne et active une source de l'enceinte
     * 
     * @param ContentItem $source
     * @return Response
     */
    public function selectSource(ContentItem $source)
    {
        $request = new SetSelectRequest();
        $request->setSource( $source );
        return $this->client->request( $request );
    }


    /**
     * Send the pressing *and* releasing of a key to the speaker
     *
     * @param String $key
     * @return Response
     */
    public function setKey($key)
    {
        $result = $this->pressKey($key);
        if (!$result) return $result;
        $result = $this->releaseKey($key);
        return $result;
    }


    /**
     * Send the pressing of a key to the speaker
     *
     * @param String $key
     * @return Response
     */
    public function pressKey($key)
    {
        $request = new SetKeyRequest();
        $request->setKey( $key )->setState( SetKeyRequest::PRESS );
        $result = $this->client->request( $request );
        return $result;
    }


    /**
     * Send the releasing of a key to the speaker
     *
     * @param String $key
     * @return Response
     */
    public function releaseKey($key)
    {
        $request = new SetKeyRequest();
        $request->setKey( $key )->setState( SetKeyRequest::RELEASE );
        $result = $this->client->request( $request );
        return $result;
    }


    /**
     * Retourne le volume de l'enceinte
     * 
     * @return Volume
     */
    public function getVolume($refresh = false)
    {
        return $this->client->request( new GetVolumeRequest($refresh) );
    }

    
    /**
     * Affecte le pourcentage de volume de l'enceinte
     * 
     * @param Integer $value
     * @return Response
     */
    public function setVolume($value)
    {
        $request = new SetVolumeRequest();
        $volume = new Volume( $value );
        $request->setVolume( $volume );
        return $this->client->request( $request );
    }



    /**
     * Retourne la liste des préselections
     * 
     * @return Presets
     */
    public function getPresets($refresh = false)
    {
        return $this->client->request( new GetPresetsRequest($refresh) );
    }


    /**
     * Affecte un nouveau nom à l'enceinte
     * 
     * @param String $name
     * @return Response
     */
    public function setName($name)
    {
        $request = new SetNameRequest();
        $request->setName( $name );
        return $this->client->request( $request );
    }


    /**
     * Retourne les basses de l'enceinte
     * 
     * @return Bass
     */
    public function getBass($refresh = false)
    {
        return $this->client->request( new GetBassRequest($refresh) );
    }

    
    /**
     * Affecte le basses de l'enceinte
     * 
     * @param Integer $value
     * @return Response
     */
    public function setBass($value)
    {
        $request = new SetBassRequest();
        $volume = new Bass( $value );
        $request->setBass( $bass );
        return $this->client->request( $request );
    }


    /**
     * Retourne les basses Capabilities de l'enceinte
     * 
     * @return BassCapabilities
     */
    public function getBassCapabilities($refresh = false)
    {
        return $this->client->request( new GetBassCapabilitiesRequest($refresh) );
    }


    /**
     * Retourne la zone MultiRoom de l'enceinte
     * 
     * @return Zone
     */
    public function getZone($refresh = false)
    {
        return $this->client->request( new GetZoneRequest($refresh) );
    }


    /**
     * Affecte la zone MultiRoom de l'enceinte
     * 
     * @param Zone $Zone
     * @return Response
     */
    public function setZone(Zone $zone)
    {
        $request = new SetZoneRequest();
        $request->setZone( $zone );
        return $this->client->request( $request );
    }


    /**
     * Ajoute un slave à la zone MultiRoom de l'enceinte
     * 
     * @param ZoneSlave $slave
     * @return Response
     */
    public function addZoneSlave(ZoneSlave $slave)
    {
        $info = $this->getInfo();
        $request = new SetAddZoneRequest();
        $request
            ->setDeviceID( $info->getDeviceID() )
            ->setSlave( $slave );
        return $this->client->request( $request );
    }


    /**
     * Enlève un slave à la zone MultiRoom de l'enceinte
     * 
     * @param ZoneSlave $slave
     * @return Response
     */
    public function removeZoneSlave(ZoneSlave $slave)
    {
        $info = $this->getInfo();
        $request = new SetRemoveZoneRequest();
        $request
            ->setDeviceID( $info->getDeviceID() )
            ->setSlave( $slave );
        return $this->client->request( $request );
    }


   
    // ### Raccourci Commandes ####################################################################

    public function mute() { return $this->setKey(Key::MUTE); }

    public function upVolume() { return $this->setKey(Key::VOLUME_UP); }

    public function downVolume() { return $this->setKey(Key::VOLUME_DOWN); }

    public function nextTrack() { return $this->setKey(Key::NEXT_TRACK); }

    public function previousTrack() { return $this->setKey(Key::PREV_TRACK); }

    public function pause() { return $this->setKey(Key::PAUSE); }

    public function play() { return $this->setKey(Key::PLAY); }

    public function stop() { return $this->setKey(Key::STOP); }

    public function playPause() { return $this->setKey(Key::PLAY_PAUSE); }

    public function repeatOff() { return $this->setKey(Key::REPEAT_OFF); }

    public function repeatOne() { return $this->setKey(Key::REPEAT_ONE); }

    public function repeatAll() { return $this->setKey(Key::REPEAT_ALL); }

    public function shuffleOn() { return $this->setKey(Key::SHUFFLE_ON); }

    public function shuffleOff() { return $this->setKey(Key::SHUFFLE_OFF); }

    public function power() { return $this->setKey(Key::POWER); }

    public function setPreset($id)
    {
        return $this->pressKey(constant(Key::class . '::PRESET_' . (string)$id));
    }

    public function playPreset($id)
    {
        return $this->releaseKey(constant(Key::class . '::PRESET_' . (string)$id));
    }


    /**
     * Activer ou pas le shuffle
     * 
     * @param Boolean $shuffle
     */
    public function shuffle($shuffle) {
        if ($shuffle)
            $this->setKey(Key::SHUFFLE_ON);
        else
            $this->setKey(Key::SHUFFLE_OFF);
    }


    /**
     * Allume l'enceinte
     */
    public function powerOn()
    {
        $status = $this->getNowPlaying(true);
        if ( ! ($status instanceof NowPlaying) ) return null;
        if ( $status->getSource() == Source::STANDBY )
            return $this->setKey(Key::POWER);
        return true;
    }


    /**
     * Eteins l'enceinte
     */
    public function powerOff()
    {
        $status = $this->getNowPlaying(true);
        if ( ! ($status instanceof NowPlaying) ) return null;
        if ( $status->getSource() != Source::STANDBY )
            return $this->setKey(Key::POWER);
        return true;
    }


    /**
     * Retourne le niveau de volume
     * 
     * @return Integer
     */
    public function getLevelVolume($refresh = false)
    {
        $volume = $this->getVolume($refresh);
        if ( ! ($volume instanceof Volume) ) return null;
        return $volume->getActual();
    }

    
    /**
     * Retourne si le volume est coupé
     * 
     * @return Boolean
     */
    public function isMuted($refresh = false)
    {
        $volume = $this->getVolume($refresh);
        if ( ! ($volume instanceof Volume) ) return null;
        return $volume->isMuted();
    }


    /**
     * Retrourne si l'enceinte est allumée
     */
    public function isPowered($refresh = false)
    {
        $status = $this->getNowPlaying($refresh);
        if ( ! ($status instanceof NowPlaying) ) return null;
        return ( $status->getSource() != Source::STANDBY );
    }

}
