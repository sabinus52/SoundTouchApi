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
     * @param SimpleXMLElement|String $data
     */
    public function __construct($data = null)
    {
        if ( $data instanceof SimpleXMLElement ) {
            $this->master = strval($data->attributes()->master);
            foreach ($data->member as $member) {
                $this->slaves[] = new ZoneSlave($member);
            }
        } else {
            $this->master = $data;
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
