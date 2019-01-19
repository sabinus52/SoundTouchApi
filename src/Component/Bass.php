<?php
/**
 * Basses de l'enceinte
 *
 * @author Olivier <sabinus52@gmail.com>
 *
 * @package SoundTouchApi
 */

namespace Sabinus\SoundTouch\Component;


class Bass
{

    private $actual;

    private $target;


    /**
     * Contructeur
     * 
     * @param SimpleXMLElement $xml : Xml de la réponse
     */
    public function __construct($xml)
    {
        $this->actual = intval($xml->actualbass);
        $this->target = intval($xml->targetbass);
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
   
}
