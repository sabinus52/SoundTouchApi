<?php
/**
 * Basses Capabilities de l'enceinte
 *
 * @author Olivier <sabinus52@gmail.com>
 *
 * @package SoundTouchApi
 */

namespace Sabinus\SoundTouch\Component;


class BassCapabilities
{

    private $available;

    private $min;

    private $max;

    private $default;


    /**
     * Contructeur
     * 
     * @param SimpleXMLElement $xml : Xml de la réponse
     */
    public function __construct($xml)
    {
        $this->actual = ($xml->bassAvailable == 'false') ? false : true;
        $this->target = intval($xml->bassMin);
        $this->target = intval($xml->bassMax);
        $this->target = intval($xml->bassDefault);
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
