<?php
/**
 * Basses de l'enceinte
 *
 * @author Olivier <sabinus52@gmail.com>
 *
 * @package SoundTouchApi
 */

namespace Sabinus\SoundTouch\Component;

use \SimpleXMLElement;


class Bass
{

    private $actual;

    private $target;


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
        $this->actual = intval($xml->actualbass);
        $this->target = intval($xml->targetbass);
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
     * @return Bass
     */
    public function setTarget($value)
    {
        $this->target = intval($value);
        return $this;
    }
   
}
