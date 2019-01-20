<?php
/**
 * Contenu de la liste des préselections
 *
 * @author Olivier <sabinus52@gmail.com>
 *
 * @package SoundTouchApi
 */

namespace Sabinus\SoundTouch\Component;

use \SimpleXMLElement;


class Presets
{

    private $presets;


    /**
     * Affecte la réponse de la requête
     * 
     * @param SimpleXMLElement $xml : Xml de la réponse
     */
    public function setResponse(SimpleXMLElement $xml)
    {
        $this->presets = array();
        foreach ($xml->preset as $node) {
            $this->presets[] = new Preset( $node );
        }
    }


    /**
     * @return Array
     */
    public function getPresets()
    {
        return $this->presets;
    }

}
