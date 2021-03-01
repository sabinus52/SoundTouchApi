<?php
/**
 * Classe abstraites des requêtes
 *
 * @author Olivier <sabinus52@gmail.com>
 *
 * @package SoundTouchApi
 */

namespace Sabinus\SoundTouch\Request;


abstract class RequestAbstract
{

    /**
     * Méthode de la requête (GET ou POST)
     */
    private $method;

    /**
     * Chemin de la requête
     */
    private $uri;

    /**
     * Corps de la requête en mode POST
     */
    protected $payload;


    /**
     * Force le chargement du cache
     */
    protected $refresh;


    /**
     * Contructeur
     *
     * @param String $method : Méthode HTTP
     * @param String $uri : URI
     * @param Boolean $refresh : refresh le cache
     */
    public function __construct($method, $uri, $refresh = false)
    {
        $this->method = $method;
        $this->uri = $uri;
        $this->refresh = $refresh;
    }


    /**
     * Retourne la méthode HTTP
     *
     * @return String
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Affecte une nouvelle méthode
     *
     * @param String $method : Méthode HTTP
     * @return RequestInterface
     */
    public function setMethod($method)
    {
        $this->method = $method;
        return $this;
    }


    /**
     * Retourne l'URI de la requete
     *
     * @return String
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * Affecte une nouvelle URI
     *
     * @param String $uri : URI
     * @return RequestInterface
     */
    public function setUri($uri)
    {
        $this->uri = $uri;
        return $this;
    }


    /**
     * Si on doit rafraichir le cache
     * 
     * @return Boolean
     */
    public function isRefreshCache()
    {
        return $this->refresh;
    }

}
