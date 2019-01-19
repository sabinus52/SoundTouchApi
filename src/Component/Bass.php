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
     * @param SimpleXMLElement|Integer $data
     */
    public function __construct($data = null)
    {
        if ( $data instanceof SimpleXMLElement ) {
            $this->actual = intval($data->actualbass);
            $this->target = intval($data->targetbass);
        } else {
            $this->target = intval($data);
        }
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
