<?php
/**
 * Contenu de la liste des sources
 *
 * @author Olivier <sabinus52@gmail.com>
 *
 * @package SoundTouchApi
 */

namespace Sabinus\SoundTouch\Component;

use \SimpleXMLElement;


class Sources
{

    private $sources;


    /**
     * Affecte la réponse de la requête
     * 
     * @param SimpleXMLElement $xml : Xml de la réponse
     */
    public function setResponse(SimpleXMLElement $xml)
    {
        $this->sources = array();
        foreach ($xml->sourceItem as $node) {
            $this->sources[] = new SourceItem( $node );
        }
    }


    /**
     * @return Array
     */
    public function getSources()
    {
        return $this->sources;
    }

}
