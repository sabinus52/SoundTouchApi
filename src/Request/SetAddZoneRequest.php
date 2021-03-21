<?php
/**
 * Requête de la zone MultiRoom de l'enceinte
 *
 * @author Olivier <sabinus52@gmail.com>
 *
 * @package SoundTouchApi
 */

namespace Sabinus\SoundTouch\Request;

use Sabinus\SoundTouch\ClientApi;
use Sabinus\SoundTouch\Component\ZoneSlave;


class SetAddZoneRequest extends RequestAbstract implements RequestInterface
{

    /**
     * @var ZoneSlave
     */
    private $slave;

    private $deviceID;

    
    /**
     * @see RequestAbstract::__construct
     */
    public function __construct($refresh = false)
    {
        parent::__construct(ClientApi::METHOD_POST, 'addZoneSlave', $refresh);
    }

    /**
     * @see RequestInterface
     */
    public function getPayload()
    {
        $result = '<zone master="' . $this->deviceID . '">';
        $result.= '<member ipaddress="' . $this->slave->getIpAddress() . '">' . $this->slave->getMacAddress() . '</member>';
        $result.= '</zone>';
        return $result;
    }

    /**
     * @see RequestInterface
     */
    public function createClass()
    {
        return null;
    }


    /**
     * Affecte l'ID du device
     * 
     * @param String $master
     * @return SetZoneRequest
     */
    public function setDeviceID($master)
    {
        $this->deviceID = $master;
        return $this;
    }


    /**
     * Affecte une esclave d'une zone
     * 
     * @param ZoneSlave $slave
     * @return SetZoneRequest
     */
    public function setSlave(ZoneSlave $slave)
    {
        $this->slave = $slave;
        return $this;
    }

}
