<?php
/**
 * Volume de l'enceinte
 *
 * @author Olivier <sabinus52@gmail.com>
 *
 * @package SoundTouchApi
 */

namespace Sabinus\SoundTouch\Component;

use \SimpleXMLElement;


class Volume
{

    private $actual;

    private $target;

    private $muted;


    /**
     * Contructeur
     * 
     * @param Integer $value
     */
    public function __construct($value = null)
    {
        $this->target = intval($value);
    }


    /**
     * Affecte la réponse de la requête
     * 
     * @param SimpleXMLElement $xml : Xml de la réponse
     */
    public function setResponse(SimpleXMLElement $xml)
    {
        $this->actual = intval($xml->actualvolume);
        $this->target = intval($xml->targetvolume);
        if ($xml->muteenabled) $this->muted = ($xml->muteenabled == 'false') ? false : true;
    }


    /**
     * @return Integer
     */
    public function getActual()
    {
        return $this->actual;
    }


    /**
     * @return Integer
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * @var Integer $value
     * @return Volume
     */
    public function setTarget($value)
    {
        $this->target = intval($value);
        return $this;
    }


    /**
     * @return Boolean
     */
    public function isMuted()
    {
        return $this->muted;
    }
    
}
