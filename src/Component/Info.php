<?php
/**
 * Informations de l'enceinte
 *
 * @author Olivier <sabinus52@gmail.com>
 *
 * @package SoundTouchApi
 */

namespace Sabinus\SoundTouch\Component;

use Sabinus\SoundTouch\Component\Network;
use \SimpleXMLElement;


class Info
{

    private $deviceID;

    private $name;

    private $type;

    private $account;

    private $network;

    private $moduleType;

    private $variant;

    private $variantMode;

    private $countryCode;

    private $regionCode;


    /**
     * Affecte la réponse de la requête
     * 
     * @param SimpleXMLElement $xml : Xml de la réponse
     */
    public function setResponse(SimpleXMLElement $xml)
    {
        $this->deviceID = strval($xml->attributes()->deviceID);
        $this->name = strval($xml->name);
        $this->type = strval($xml->type);
        $this->account = strval($xml->margeAccountUUID);
        $this->network = new Network($xml->networkInfo);
        $this->moduleType = strval($xml->moduleType);
        $this->variant = strval($xml->variant);
        $this->variantMode = strval($xml->variantMode);
        $this->countryCode = strval($xml->countryCode);
        $this->regionCode = strval($xml->regionCode);
    }


    /**
     * @return String
     */
    public function getDeviceID()
    {
        return $this->deviceID;
    }

    /**
     * @return String
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return String
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return String
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * @return Network
     */
    public function getNetwork()
    {
        return $this->network;
    }

    /**
     * @return String
     */
    public function getModuleType()
    {
        return $this->moduleType;
    }

    /**
     * @return String
     */
    public function getVariant()
    {
        return $this->variant;
    }

    /**
     * @return String
     */
    public function getVariantMode()
    {
        return $this->variantMode;
    }

    /**
     * @return String
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * @return String
     */
    public function getRegionCode()
    {
        return $this->regionCode;
    }
    
}
