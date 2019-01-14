<?php
/**
 * Classe de base des réponses aux requêtes
 *
 * @author Olivier <sabinus52@gmail.com>
 *
 * @package SoundTouchApi
 */

namespace Sabinus\SoundTouch;


class Response
{

    /**
     * Message d'erreur
     */
    private $msgError;

    /**
     * Contenu brute de la réponse
     */
    private $content;

    /**
     * Object au format XML
     */
    protected $objectXml;


    /**
     * Contructeur
     * 
     * @param String $content : Contenu brute de la réponse
     */
    public function __construct($content)
    {
        $this->content = $content;
        $this->msgError = '';

        $this->parse();
    }


    /**
     * Parse la réponse pour le convertir au format objet XML
     */
    protected function parse()
    {
        // Si contenu vide alors erreur
        if ( empty($this->content) ) {
            $this->msgError = 'Response empty';
            return;
        }

        // Parse
        try {
            $this->objectXml = new \SimpleXMLElement($this->content);
        } catch (\Exception $e) {
            $this->msgError = 'Format XML invalid';
            return;
        }

        // Si erreur, récupère la première
        if ($this->objectXml->errors) {
            foreach ($this->objectXml->errors as $error) {
                $this->msgError = strval($error);
                break;
            }
        }
    }


    /**
     * Retourne l'objet XML
     *
     * @return SimpleXMLElement
     */
    public function getXML()
    {
        return $this->objectXml;
    }

}
