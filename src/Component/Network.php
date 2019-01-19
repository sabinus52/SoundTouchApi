<?php
/**
 * Informations réseau de l'enceinte
 *
 * @author Olivier <sabinus52@gmail.com>
 *
 * @package SoundTouchApi
 */

namespace Sabinus\SoundTouch\Component;

use \SimpleXMLElement;


class Network
{

    private $macAddress;

    private $ipAddress;


    /**
     * Contructeur
     * 
     * @param SimpleXMLElement $xml : Xml de la réponse
     */
    public function __construct(SimpleXMLElement $xml)
    {
        $this->macAddress = strval($xml->macAddress);
        $this->ipAddress = strval($xml->ipAddress);
    }


    /**
     * @return String
     */
    public function getMacAddress()
    {
        return $this->macAddress;
    }

    /**
     * @return String
     */
    public function getIpAddress()
    {
        return $this->ipAddress;
    }
    
}
