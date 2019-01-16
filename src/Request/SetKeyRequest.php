<?php
/**
 * Requête d'envoi de commande de touche à l'enceinte
 *
 * @author Olivier <sabinus52@gmail.com>
 *
 * @package SoundTouchApi
 */

namespace Sabinus\SoundTouch\Request;

use Sabinus\SoundTouch\ClientApi;


class SetKeyRequest extends RequestAbstract implements RequestInterface
{

    const PRESS   = 'press';
    const RELEASE = 'release';


    private $state;

    private $key;

    
    /**
     * @see RequestAbstract::__construct
     */
    public function __construct()
    {
        parent::__construct(ClientApi::METHOD_POST, 'key');
    }

    /**
     * @see RequestInterface
     */
    public function getPayload()
    {
        return '<key state="' . $this->state . '" sender="Gabbo">' . $this->key . '</key>';
    }

    /**
     * @see RequestInterface
     */
    public function getClass()
    {
        return null;
    }


    /**
     * Affecte une commande de touche
     * 
     * @param String $key
     * @return SetKeyRequest
     */
    public function setKey($key)
    {
        $this->key = $key;
        return $this;
    }

    /**
     * Affecte un statut à la commande
     * 
     * @param String $state
     * @return SetKeyRequest
     */
    public function setState($state)
    {
        $this->state = $state;
        return $this;
    }

}
