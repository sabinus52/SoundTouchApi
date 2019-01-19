<?php
/**
 * Membre d'une zone MultiRoom de l'enceinte
 *
 * @author Olivier <sabinus52@gmail.com>
 *
 * @package SoundTouchApi
 */

namespace Sabinus\SoundTouch\Component;

use \SimpleXMLElement;


class ZoneSlave
{

    private $macAddress;

    private $ipAddress;


    /**
     * Contructeur
     * 
     * @param SimpleXMLElement $xml : Xml de la réponse
     */
    public function __construct(SimpleXMLElement $xml = null)
    {
        if ($xml instanceof SimpleXMLElement) {
            $this->macAddress = strval($xml);
            $this->ipAddress = strval($xml->attributes()->ipaddress);
        }
    }


    /**
     * @return String
     */
    public function getMacAddress()
    {
        return $this->macAddress;
    }

    /**
     * @var String $macAddress
     * @return ZoneSlave
     */
    public function setMacAddress($macAddress)
    {
        $this->macAddress = $macAddress;
        return $this;
    }


    /**
     * @return String
     */
    public function getIpAddress()
    {
        return $this->ipAddress;
    }

    /**
     * @var String $ipAddress
     * @return ZoneSlave
     */
    public function setIpAddress($ipAddress)
    {
        $this->ipAddress = $ipAddress;
        return $this;
    }
    
}
