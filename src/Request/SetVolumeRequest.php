<?php
/**
 * Requête du volume de l'enceinte
 *
 * @author Olivier <sabinus52@gmail.com>
 *
 * @package SoundTouchApi
 */

namespace Sabinus\SoundTouch\Request;

use Sabinus\SoundTouch\ClientApi;
use Sabinus\SoundTouch\Component\Volume;


class SetVolumeRequest extends RequestAbstract implements RequestInterface
{

    /**
     * @var Volume
     */
    private $volume;
    
    
    /**
     * @see RequestAbstract::__construct
     */
    public function __construct()
    {
        parent::__construct(ClientApi::METHOD_POST, 'volume');
    }

    /**
     * @see RequestInterface
     */
    public function getPayload()
    {
        return '<volume>' . $this->volume->getTarget() . '</volume>';
    }

    /**
     * @see RequestInterface
     */
    public function getClass()
    {
        return null;
    }


    /**
     * Affecte un volume
     * 
     * @param Volume $volume
     * @return SetVolumeRequest
     */
    public function setVolume(Volume $volume)
    {
        $this->volume = $volume;
        return $this;
    }

}
