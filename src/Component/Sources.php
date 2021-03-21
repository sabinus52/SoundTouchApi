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
use \Iterator;
use \Countable;
use \ArrayAccess;


class Sources implements Iterator, ArrayAccess, Countable
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
     * @see Iterator
     */
    public function rewind()
    {
        return reset($this->sources);
    }

    public function current()
    {
        return current($this->sources);
    }

    public function key()
    {
        return key($this->sources);
    }

    public function next()
    {
        return next($this->sources);
    }

    public function valid()
    {
        return key($this->sources) !== null;
    }


    /**
     * @see ArrayAccess
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->sources[] = $value;
        } else {
            $this->sources[$offset] = $value;
        }
    }

    public function offsetExists($offset)
    {
        return isset($this->sources[$offset]);
    }

    public function offsetUnset($offset)
    {
        unset($this->sources[$offset]);
    }

    public function offsetGet($offset)
    {
        return isset($this->sources[$offset]) ? $this->sources[$offset] : null;
    }


    /**
     * @see Countable
     */
    public function count()
    {
        return count($this->sources);
    }

}
