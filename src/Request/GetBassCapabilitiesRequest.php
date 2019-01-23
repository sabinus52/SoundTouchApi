<?php
/**
 * Requête des basses Capabilities de l'enceinte
 *
 * @author Olivier <sabinus52@gmail.com>
 *
 * @package SoundTouchApi
 */

namespace Sabinus\SoundTouch\Request;

use Sabinus\SoundTouch\ClientApi;
use Sabinus\SoundTouch\Component\BassCapabilities;


class GetBassCapabilitiesRequest extends RequestAbstract implements RequestInterface
{
    
    /**
     * @see RequestAbstract::__construct
     */
    public function __construct($refresh = false)
    {
        parent::__construct(ClientApi::METHOD_GET, 'bassCapabilities', $refresh);
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
        return new BassCapabilities();
    }

}
