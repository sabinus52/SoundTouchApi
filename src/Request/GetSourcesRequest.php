<?php
/**
 * Requête des sources disponibles de l'enceinte
 *
 * @author Olivier <sabinus52@gmail.com>
 *
 * @package SoundTouchApi
 */

namespace Sabinus\SoundTouch\Request;

use Sabinus\SoundTouch\ClientApi;
use Sabinus\SoundTouch\Component\Sources;


class GetSourcesRequest extends RequestAbstract implements RequestInterface
{
    
    /**
     * @see RequestAbstract::__construct
     */
    public function __construct()
    {
        parent::__construct(ClientApi::METHOD_GET, 'sources');
    }

    /**
     * @see RequestInterface
     */
    public function getPayload()
    {
        return null;
    }

    /**
     * @see RequestInterface
     */
    public function createClass()
    {
        return new Sources();
    }

}
