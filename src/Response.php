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
     */
    public function __construct()
    {
        $this->content = '';
        $this->msgError = '';
    }


    /**
     * Affecte et parse le contenu
     * 
     * @param String $content : Contenu brute de la réponse
     */
    public function parseContent($content)
    {
        $this->content = strval($content);
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
            $this->objectXml = @new \SimpleXMLElement($this->content);
        } catch (\Exception $e) {
            $this->msgError = 'Format XML invalid';
            return;
        }

        // Si erreur, récupère la première
        if ($this->objectXml->error) {
            foreach ($this->objectXml->error as $error) {
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


    /**
     * Retourne si pas d'erreur
     * 
     * @return Boolean
     */
    public function isSuccess()
    {
        return ( empty($this->msgError) );
    }


    /**
     * Retourne le message d'erreur
     * 
     * @return String
     */
    public function getMessageError()
    {
        return $this->msgError;
    }

}
