<?php
/**
 * Interface des requêtes
 *
 * @author Olivier <sabinus52@gmail.com>
 *
 * @package SoundTouchApi
 */

namespace Sabinus\SoundTouch\Request;


interface RequestInterface
{

    /**
     * Constructeur
     */
    public function __construct();

    /**
     * Retourne le corps à envoyer dans la requête
     * 
     * @return String
     */
    public function getPayload();

    /**
     * Retourne l'objet de la réponse de la requête
     *
     * @return String
     */
    public function createClass();

}


