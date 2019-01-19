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
     * @param SimpleXMLElement|Integer $data
     */
    public function __construct($data = null)
    {
        if ( $data instanceof SimpleXMLElement ) {
            $this->actual = intval($data->actualvolume);
            $this->target = intval($data->targetvolume);
            if ($data->muteenabled) $this->muted = ($data->muteenabled == 'false') ? false : true;
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
