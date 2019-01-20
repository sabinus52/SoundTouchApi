<?php
/**
 * Zone Multi Room
 *
 * @author Olivier <sabinus52@gmail.com>
 *
 * @package SoundTouchApi
 */

namespace Sabinus\SoundTouch\Component;

use \SimpleXMLElement;


class Zone
{

    private $master;

    private $sender;

    private $slaves;


    /**
     * Contructeur
     * 
     * @param String $master
     */
    public function __construct($master = null)
    {
        if ($master) $this->master = $master;
    }


    /**
     * Affecte la réponse de la requête
     * 
     * @param SimpleXMLElement $xml : Xml de la réponse
     */
    public function setResponse(SimpleXMLElement $xml)
    {
        $this->master = strval($xml->attributes()->master);
        foreach ($xml->member as $member) {
            $this->slaves[] = new ZoneSlave($member);
        }
    }


    /**
     * @return String
     */
    public function getMaster()
    {
        return $this->master;
    }

    /**
     * @var String $master
     * @return Zone
     */
    public function setMaster($master)
    {
        $this->master = $master;
        return $this;
    }


    /**
     * @return String
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * @var String $sender
     * @return Zone
     */
    public function setSender($sender)
    {
        $this->sender = $sender;
        return $this;
    }


    /**
     * @return Array
     */
    public function getSlaves()
    {
        return $this->slaves;
    }

    /**
     * @var Array $slaves
     * @return Zone
     */
    public function setSlaves(array $slaves)
    {
        return $this->slaves = $slaves;
    }


    /**
     * Ajoute un slave
     * 
     * @var ZoneSlave $slave
     * @return Zone
     */
    public function addSlave(ZoneSlave $slave)
    {
        $this->slaves[] = $slave;
        return $this;
    }

    /**
     * Enlève un slave
     * 
     * @var ZoneSlave $slave
     * @return Zone
     */
    public function removeSlave(ZoneSlave $slave)
    {
        foreach ($this->slaves as $id => $member) {
            if ($slave->getMacAddress() == $member->getMacAddress() && $slave->getIpAddress() == $member->getIpAddress()) {
                unset($this->slaves[$id]);
                return $this;
            }
        }
        return $this;
    }

    /**
     * Si il y a déjà ce slave
     * 
     * @var ZoneSlave $slave
     * @return Boolean
     */
    public function hasSlave(ZoneSlave $slave)
    {
        foreach ($this->slaves as $member) {
            if ($slave->getMacAddress() == $member->getMacAddress() && $slave->getIpAddress() == $member->getIpAddress()) return true;
        }
        return false;
    }
   
}
