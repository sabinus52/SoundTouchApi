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
use \Iterator;
use \Countable;
use \ArrayAccess;


class Presets implements Iterator, ArrayAccess, Countable
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
     * @see Iterator
     */
    public function rewind()
    {
        return reset($this->presets);
    }

    public function current()
    {
        return current($this->presets);
    }

    public function key()
    {
        return key($this->presets);
    }

    public function next()
    {
        return next($this->presets);
    }

    public function valid()
    {
        return key($this->presets) !== null;
    }


    /**
     * @see ArrayAccess
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->presets[] = $value;
        } else {
            $this->presets[$offset] = $value;
        }
    }

    public function offsetExists($offset)
    {
        return isset($this->presets[$offset]);
    }

    public function offsetUnset($offset)
    {
        unset($this->presets[$offset]);
    }

    public function offsetGet($offset)
    {
        return isset($this->presets[$offset]) ? $this->presets[$offset] : null;
    }


    /**
     * @see Countable
     */
    public function count()
    {
        return count($this->presets);
    }

}
