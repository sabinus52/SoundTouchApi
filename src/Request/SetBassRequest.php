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
use Sabinus\SoundTouch\Component\Bass;


class SetBassRequest extends RequestAbstract implements RequestInterface
{

    /**
     * @var Bass
     */
    private $bass;
    
    
    /**
     * @see RequestAbstract::__construct
     */
    public function __construct($refresh = false)
    {
        parent::__construct(ClientApi::METHOD_POST, 'bass', $refresh);
    }

    /**
     * @see RequestInterface
     */
    public function getPayload()
    {
        return '<bass>' . $this->bass->getTarget() . '</bass>';
    }

    /**
     * @see RequestInterface
     */
    public function createClass()
    {
        return null;
    }


    /**
     * Affecte des basses
     * 
     * @param Bass $bass
     * @return SetBassRequest
     */
    public function setBass(Bass $bass)
    {
        $this->bass = $bass;
        return $this;
    }

}
