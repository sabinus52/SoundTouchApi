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
     * Contructeur
     *
     * @param String $method : Méthode HTTP
     * @param String $uri : URI
     */
    public function __construct($method, $uri)
    {
        $this->method = $method;
        $this->uri = $uri;
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

}
