<?php
/**
 * Requête du nom de l'enceinte
 *
 * @author Olivier <sabinus52@gmail.com>
 *
 * @package SoundTouchApi
 */

namespace Sabinus\SoundTouch\Request;

use Sabinus\SoundTouch\ClientApi;


class SetNameRequest extends RequestAbstract implements RequestInterface
{

    private $name;

    
    /**
     * @see RequestAbstract::__construct
     */
    public function __construct()
    {
        parent::__construct(ClientApi::METHOD_POST, 'name');
    }

    /**
     * @see RequestInterface
     */
    public function getPayload()
    {
        return '<name>' . $this->name . '</name>';
    }

    /**
     * @see RequestInterface
     */
    public function createClass()
    {
        return null;
    }


    /**
     * Affecte un nouveau nom
     * 
     * @param String $name
     * @return SetNameRequest
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

}
