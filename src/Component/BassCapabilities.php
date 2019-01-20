<?php
/**
 * Basses Capabilities de l'enceinte
 *
 * @author Olivier <sabinus52@gmail.com>
 *
 * @package SoundTouchApi
 */

namespace Sabinus\SoundTouch\Component;

use \SimpleXMLElement;


class BassCapabilities
{

    private $available;

    private $min;

    private $max;

    private $default;


    /**
     * Affecte la réponse de la requête
     * 
     * @param SimpleXMLElement $xml : Xml de la réponse
     */
    public function setResponse(SimpleXMLElement $xml)
    {
        if ($xml->bassAvailable) $this->available = ($xml->bassAvailable == 'false') ? false : true;
        $this->min = intval($xml->bassMin);
        $this->max = intval($xml->bassMax);
        $this->default = intval($xml->bassDefault);
    }


    /**
     * @return Boolean
     */
    public function getAvailable()
    {
        return $this->available;
    }

    /**
     * @return Integer
     */
    public function getMin()
    {
        return $this->min;
    }

    /**
     * @return Integer
     */
    public function getMax()
    {
        return $this->max;
    }

    /**
     * @return Integer
     */
    public function getDefault()
    {
        return $this->default;
    }
   
}
