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
use \Sabinus\SoundTouch\Request\GetPresetsRequest;
use \Sabinus\SoundTouch\Request\SetNameRequest;
use \Sabinus\SoundTouch\Request\SetKeyRequest;
use \Sabinus\SoundTouch\Request\GetBassRequest;
use \Sabinus\SoundTouch\Request\SetBassRequest;
use \Sabinus\SoundTouch\Component\Info;
use \Sabinus\SoundTouch\Component\NowPlaying;
use \Sabinus\SoundTouch\Component\Volume;
use \Sabinus\SoundTouch\Component\SourceItem;
use \Sabinus\SoundTouch\Component\Preset;
use \Sabinus\SoundTouch\Component\Bass;


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
     * @param Integer $volume
     * @return Response
     */
    public function setVolume($volume)
    {
        $request = new SetVolumeRequest();
        $request->setVolume( $volume );
        return $this->client->request( $request );
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
     * @param Integer $bass
     * @return Response
     */
    public function setBass($bass)
    {
        $request = new SetBassRequest();
        $request->setBass( $bass );
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