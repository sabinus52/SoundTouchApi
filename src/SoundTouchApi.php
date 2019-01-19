<?php
/**
 * Librairie de base de l'API
 *
 * @author Olivier <sabinus52@gmail.com>
 *
 * @package SoundTouchApi
 */

namespace Sabinus\SoundTouch;

use \Sabinus\SoundTouch\Request\GetInfoRequest;
use \Sabinus\SoundTouch\Request\GetNowPlayingRequest;
use \Sabinus\SoundTouch\Request\GetVolumeRequest;
use \Sabinus\SoundTouch\Request\SetVolumeRequest;
use \Sabinus\SoundTouch\Request\GetSourcesRequest;
use \Sabinus\SoundTouch\Request\SetSelectRequest;
use \Sabinus\SoundTouch\Request\GetPresetsRequest;
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
use \Sabinus\SoundTouch\Component\SourceItem;
use \Sabinus\SoundTouch\Component\Preset;
use \Sabinus\SoundTouch\Component\Bass;
use \Sabinus\SoundTouch\Component\BassCapabilities;
use \Sabinus\SoundTouch\Component\Zone;


class SoundTouchApi
{

    /**
     * Client pour les requests à l'enceinte
     * 
     * @var ClientApi
     */
    private $client;


    /**
     * Constructeur
     * 
     * @param String $host
     */
    public function __construct($host)
    {
        $this->client = new ClientApi($host);
    }

    
    /**
     * Retourne les infos de l'enceinte
     * 
     * @return Info
     */
    public function getInfo()
    {
        return new Info( $this->client->request( new GetInfoRequest() ));
    }


    /**
     * Retourne le statut en cours de l'enceinte
     * 
     * @return NowPlaying
     */
    public function getNowPlaying()
    {
        return new NowPlaying( $this->client->request( new GetNowPlayingRequest() ));
    }


    /**
     * Retourne la liste des sources
     * 
     * @return Array of SourceItem
     */
    public function getSources()
    {
        $result = array();
        $xml = $this->client->request( new GetSourcesRequest() );
        foreach ($xml->sourceItem as $node) {
            $result[] = new SourceItem( $node );
        }
        return $result;
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
     * Envoie une commande de touche à l'enceinte
     * 
     * @param String $key
     * @return Response
     */
    public function setKey($key)
    {
        $request = new SetKeyRequest();
        $request->setKey( $key )->setState( SetKeyRequest::PRESS );
        $result = $this->client->request( $request );
        $request->setKey( $key )->setState( SetKeyRequest::RELEASE );
        return $this->client->request( $request );
    }
    public function sendCommand($key) { return $this->setKey($key); }


    /**
     * Retourne le volume de l'enceinte
     * 
     * @return Volume
     */
    public function getVolume()
    {
        return new Volume( $this->client->request( new GetVolumeRequest() ));
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
     * @return Array of Preset
     */
    public function getPresets()
    {
        $result = array();
        $xml = $this->client->request( new GetPresetsRequest() );
        foreach ($xml->preset as $node) {
            $result[] = new Preset( $node );
        }
        return $result;
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
    public function getBass()
    {
        return new Bass( $this->client->request( new GetBassRequest() ));
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
    public function getBassCapabilities()
    {
        return new BassCapabilities( $this->client->request( new GetBassCapabilitiesRequest() ));
    }


    /**
     * Retourne la zone MultiRoom de l'enceinte
     * 
     * @return Zone
     */
    public function getZone()
    {
        return new Zone( $this->client->request( new GetZoneRequest() ));
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


    /**
     * Retourne le niveau de volume
     * 
     * @return Integer
     */
    public function getLevelVolume()
    {
        $volume = new Volume( $this->client->request( new GetVolumeRequest() ));
        return $volume->getActual();
    }

}