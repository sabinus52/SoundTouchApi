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
    public function __construct($xml = null)
    {
        if ($xml instanceof \SimpleXMLElement) {
            $this->name = strval($xml->itemName);
            $this->image = strval($xml->containerArt);
            $this->source = strval($xml->attributes()->source);
            $this->type = strval($xml->attributes()->type);
            $this->location = strval($xml->attributes()->location);
            $this->account = strval($xml->attributes()->sourceAccount);
            $this->isPresetable = ($xml->attributes()->isPresetable == 'false') ? false : true;
        }
    }

    /**
     * @param String $name
     * @return ContentItem
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return String
     */
    public function getName()
    {
        return $this->name;
    }


    /**
     * @param String $image
     * @return ContentItem
     */
    public function setImage($image)
    {
        $this->image = $image;
        return $this;
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
     * @param String $source
     * @return ContentItem
     */
    public function setSource($source)
    {
        $this->source = $source;
        return $this;
    }

    
    /**
     * @return String
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param String $type
     * @return ContentItem
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }


    /**
     * @return String
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param String $location
     * @return ContentItem
     */
    public function setLocation($location)
    {
        $this->location = $location;
        return $this;
    }


    /**
     * @return String
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * @param String $account
     * @return ContentItem
     */
    public function setAccount($account)
    {
        $this->account = $account;
        return $this;
    }


    /**
     * @return Boolean
     */
    public function getIsPresetable()
    {
        return $this->isPresetable;
    }

}
