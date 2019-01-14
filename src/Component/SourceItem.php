<?php
/**
 * Contenu de la source
 *
 * @author Olivier <sabinus52@gmail.com>
 *
 * @package SoundTouchApi
 */

namespace Sabinus\SoundTouch\Component;


class SourceItem
{

    // Constantes de $status
    const UNAVAILABLE   = 'UNAVAILABLE';
    const READY         = 'READY';


    private $name;

    private $source;

    private $account;

    private $status;

    private $isLocal;

    private $multiroomallowed;


    /**
     * Contructeur
     * 
     * @param SimpleXMLElement $xml : Xml de la réponse
     */
    public function __construct($xml)
    {
        $this->source = strval($xml->attributes()->source);
        $this->name = strval($xml);
        if ( !$this->name ) $this->name = $this->source;
        $this->account = strval($xml->attributes()->sourceAccount);
        $this->status = strval($xml->attributes()->status);
        $this->isLocal = ($xml->attributes()->isLocal == 'false') ? false : true;
        $this->multiroomallowed = ($xml->attributes()->multiroomallowed == 'false') ? false : true;
    }


    /**
     * @return String
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return String
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @return String
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * @return String
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return Boolean
     */
    public function getIsLocal()
    {
        return $this->isLocal;
    }

    /**
     * @return Boolean
     */
    public function getMultiroomAllowed()
    {
        return $this->multiroomallowed;
    }

}
