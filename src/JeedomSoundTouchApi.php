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
     * @param Boolean $init : initialise ou pas le statut de l'enceinte
     */
    public function __construct($host, $init = true)
    {
        parent::__construct($host, true);
        if ($init) $this->getNowPlaying();
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
     * Retrourne si l'enceinte est allumée
     */
    public function isPowered($refresh = false)
    {
        $status = $this->getNowPlaying($refresh);
        return ( $status->getSource() != Source::STANDBY );
    }


    /**
     * Retourne la source sélectionnée
     */
    public function getCurrentSource($refresh = false)
    {
        $status = $this->getNowPlaying($refresh);
        if ( !$status->getSource() )
            return null;
        elseif ( $status->getSource() != 'PRODUCT' )
            return strval($status->getSource());
        elseif ( $status->getContentItem() && $status->getContentItem()->getAccount() )
            return strval($status->getContentItem()->getAccount());
        else
            return strval($status->getSource());
    }


    /**
     * Retourne l'image de la source courante
     */
    public function getCurrentImage($refresh = false)
    {
        $status = $this->getNowPlaying($refresh);
        return $status->getContentItem()->getImage();
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


    /**
     * Retourne les données d'une préselection
     */
    public function getPresetByNum($num, $refresh = false)
    {
        $presets = $this->getPresets($refresh);
        $num--;
        if ( !isset($presets[$num]) ) return null;
        return array(
            'source' => $presets[$num]->getContentItem()->getSource(),
            'name' => $presets[$num]->getContentItem()->getName(),
            'image' => $presets[$num]->getContentItem()->getImage(),
        );
    }


    /**
     * Retourne le status en cours
     */
    public function getArrayStatus($refresh = false)
    {
        $status = parent::getNowPlaying($refresh);
        return array(
            'source.type' => $this->getCurrentSource(),
            'source.name' => $status->getContentItem()->getName(),
            'source.image' => $status->getContentItem()->getImage(),
        );
    }

}