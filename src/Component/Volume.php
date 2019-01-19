<?php
/**
 * Volume de l'enceinte
 *
 * @author Olivier <sabinus52@gmail.com>
 *
 * @package SoundTouchApi
 */

namespace Sabinus\SoundTouch\Component;

use Sabinus\SoundTouch\Component\ContentItem;
use \Sabinus\SoundTouch\Constants\ImageStatus;


class Volume
{

    private $actual;

    private $target;

    private $muted;


    /**
     * Contructeur
     * 
     * @param SimpleXMLElement $xml : Xml de la réponse
     */
    public function __construct($xml)
    {
        $this->actual = intval($xml->actualvolume);
        $this->target = intval($xml->targetvolume);
        $this->muted = ($xml->muteenabled == 'false') ? false : true;
    }


    /**
     * @return String
     */
    public function getActual()
    {
        return $this->actual;
    }

    /**
     * @return String
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * @return ContentItem
     */
    public function isMuted()
    {
        return $this->muted;
    }
    
}
