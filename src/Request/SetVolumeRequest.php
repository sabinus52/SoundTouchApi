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


class SetVolumeRequest extends RequestAbstract implements RequestInterface
{

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
        return '<volume>' . $this->volume . '</volume>';
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
     * @param Integer $volume
     * @return SetVolumeRequest
     */
    public function setVolume($volume)
    {
        $this->volume = intval($volume);
        return $this;
    }

}
