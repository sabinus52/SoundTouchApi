<?php
/**
 * Requête de la séléction de la source de l'enceinte
 *
 * @author Olivier <sabinus52@gmail.com>
 *
 * @package SoundTouchApi
 */

namespace Sabinus\SoundTouch\Request;

use Sabinus\SoundTouch\ClientApi;
use Sabinus\SoundTouch\Component\ContentItem;


class SetSelectRequest extends RequestAbstract implements RequestInterface
{

    /**
     * @var ContentItem
     */
    private $source;
    
    
    /**
     * @see RequestAbstract::__construct
     */
    public function __construct()
    {
        parent::__construct(ClientApi::METHOD_POST, 'select');
    }

    /**
     * @see RequestInterface
     */
    public function getPayload()
    {
        $result = '<ContentItem source="' . $this->source->getSource() . '"';
        if ($this->source->getAccount())
            $result.= ' sourceAccount="' . $this->source->getAccount() . '"';
        if ($this->source->getLocation())
            $result.= ' location="' . $this->source->getLocation() . '"';
        if ($this->source->getType())
            $result.= ' type="' . $this->source->getType() . '"';
        $result.= '></ContentItem>';
        return $result;
    }

    /**
     * @see RequestInterface
     */
    public function getClass()
    {
        return null;
    }


    /**
     * Affecte une source
     * 
     * @param ContentItem $source
     * @return SetSelectRequest
     */
    public function setSource(ContentItem $source)
    {
        $this->source = $source;
        return $this;
    }

}
