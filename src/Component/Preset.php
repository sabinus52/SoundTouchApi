<?php
/**
 * Contenu de la préselection
 *
 * @author Olivier <sabinus52@gmail.com>
 *
 * @package SoundTouchApi
 */

namespace Sabinus\SoundTouch\Component;


class Preset
{

    private $id;

    private $createdOn;

    private $updatedOn;

    private $contentItem;


    /**
     * Contructeur
     * 
     * @param SimpleXMLElement $xml : Xml de la réponse
     */
    public function __construct($xml)
    {
        $this->id = intval($xml->attributes()->id);
        $this->createdOn = new \DateTime();
        $this->createdOn->setTimestamp(intval($xml->attributes()->createdOn));
        $this->updatedOn = new \DateTime();
        $this->updatedOn->setTimestamp(intval($xml->attributes()->updatedOn));
        $this->contentItem = new ContentItem($xml->ContentItem);
    }


    /**
     * @return Integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return DateTime
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedOn()
    {
        return $this->updatedOn;
    }

    /**
     * @return ContentItem
     */
    public function getContentItem()
    {
        return $this->contentItem;
    }

}
