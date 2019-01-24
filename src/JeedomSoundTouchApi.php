<?php
/**
 * Librairie de base de l'API
 *
 * @author Olivier <sabinus52@gmail.com>
 *
 * @package SoundTouchApi
 */

namespace Sabinus\SoundTouch;

use \Sabinus\SoundTouch\SoundTouchApi;
use \Sabinus\SoundTouch\Constants\Key;
use \Sabinus\SoundTouch\Constants\Source;
use \Sabinus\SoundTouch\Request\GetVolumeRequest;
use \Sabinus\SoundTouch\Request\GetBassRequest;
use \Sabinus\SoundTouch\Component\Volume;
use \Sabinus\SoundTouch\Component\Bass;
use \Sabinus\SoundTouch\Component\ContentItem;


class JeedomSoundTouchApi extends SoundTouchApi
{

    /**
     * Constructeur
     * 
     * @param String $host
     */
    public function __construct($host)
    {
        parent::__construct($host, true);
        $this->getNowPlaying();
    }


    /**
     * @see parent::setKey($key)
     */
    public function sendCommand($key)
    {
        return $this->setKey($key);
    }

    
    /**
     * Retourne le niveau de volume
     * 
     * @return Integer
     */
    public function getLevelVolume($refresh = false)
    {
        $volume = $this->getVolume($refresh);
        return $volume->getActual();
    }

    
    /**
     * Retourne si le volume est coupé
     * 
     * @return Boolean
     */
    public function isMuted($refresh = false)
    {
        $volume = $this->getVolume($refresh);
        return $volume->isMuted();
    }


    /**
     * Activer ou pas le shuffle
     * 
     * @param Boolean $shuffle
     */
    public function shuffle($shuffle) {
        if ($shuffle)
            $this->setKey(Key::SHUFFLE_ON);
        else
            $this->setKey(Key::SHUFFLE_OFF);
    }


    /**
     * Allume l'enceinte
     */
    public function powerOn()
    {
        $status = $this->getNowPlaying(true);
        if ( $status->getSource() == Source::STANDBY )
            return $this->setKey(Key::POWER);
        return true;
    }


    /**
     * Eteins l'enceinte
     */
    public function powerOff()
    {
        $status = $this->getNowPlaying(true);
        if ( $status->getSource() != Source::STANDBY )
            return $this->setKey(Key::POWER);
        return true;
    }


    /**
     * Selectionne la source Bluetooth
     */
    public function selectBlueTooth()
    {
        $source = new ContentItem();
        $source->setSource(Source::BLUETOOTH);
        $this->selectSource($source);
    }


    /**
     * Selectionne la source TV
     */
    public function selectTV()
    {
        $source = new ContentItem();
        $source->setSource(Source::PRODUCT)
            ->setAccount('TV');
        $this->selectSource($source);
    }


    /**
     * Selectionne la source HDMI
     */
    public function selectHDMI()
    {
        $source = new ContentItem();
        $source->setSource(Source::PRODUCT)
            ->setAccount('HDMI_1');
        $this->selectSource($source);
    }

}