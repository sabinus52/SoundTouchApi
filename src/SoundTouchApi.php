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
use \Sabinus\SoundTouch\Component\Info;

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

}