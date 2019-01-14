<?php
/**
 * Contenu de la source en cours
 *
 * @author Olivier <sabinus52@gmail.com>
 *
 * @package SoundTouchApi
 */

namespace Sabinus\SoundTouch\Component;


class ContentItem
{

    private $name;

    private $image;

    private $source;

    private $type;

    private $location;

    private $account;

    private $isPresetable;


    /**
     * Contructeur
     * 
     * @param SimpleXMLElement $xml : Xml de la réponse
     */
    public function __construct($xml)
    {
        $this->name = strval($xml->itemName);
        $this->image = strval($xml->containerArt);
        $this->source = strval($xml->attributes()->source);
        $this->type = strval($xml->attributes()->type);
        $this->location = strval($xml->attributes()->location);
        $this->account = strval($xml->attributes()->sourceAccount);
        $this->isPresetable = ($xml->attributes()->isPresetable == 'false') ? false : true;
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
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return String
     */
    public function getSource()
    {
        return $this->source;
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
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @return String
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * @return Boolean
     */
    public function getIsPresetable()
    {
        return $this->isPresetable;
    }

}
