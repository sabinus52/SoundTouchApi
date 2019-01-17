<?php
/**
 * Requête des basses de l'enceinte
 *
 * @author Olivier <sabinus52@gmail.com>
 *
 * @package SoundTouchApi
 */

namespace Sabinus\SoundTouch\Request;

use Sabinus\SoundTouch\ClientApi;


class SetBassRequest extends RequestAbstract implements RequestInterface
{

    private $bass;
    
    
    /**
     * @see RequestAbstract::__construct
     */
    public function __construct()
    {
        parent::__construct(ClientApi::METHOD_POST, 'bass');
    }

    /**
     * @see RequestInterface
     */
    public function getPayload()
    {
        return '<bass>' . $this->bass . '</bass>';
    }

    /**
     * @see RequestInterface
     */
    public function getClass()
    {
        return null;
    }


    /**
     * Affecte des basses
     * 
     * @param Integer $bass
     * @return SetBassRequest
     */
    public function setBass($bass)
    {
        $this->bass = intval($bass);
        return $this;
    }

}
