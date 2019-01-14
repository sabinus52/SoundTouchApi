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
use \Sabinus\SoundTouch\Component\Info;
use \Sabinus\SoundTouch\Component\NowPlaying;
use \Sabinus\SoundTouch\Component\Volume;
use \Sabinus\SoundTouch\Component\SourceItem;


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