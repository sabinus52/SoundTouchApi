<?php
/**
 * Librairie de base de l'API
 *
 * @author Olivier <sabinus52@gmail.com>
 *
 * @package SoundTouchApi
 */

namespace Sabinus\SoundTouch;


class SoundTouchApi
{

    /**
     * Hostname ou IP de l'enceinte
     * 
     * @var String
     */
    private $host;


    /**
     * Constructeur
     * 
     * @param String $host
     */
    public function __construct($host)
    {
        $this->host = $host;
    }

}