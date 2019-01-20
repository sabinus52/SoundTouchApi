<?php
/**
 * Status de la lecture en cours de l'enceinte
 *
 * @author Olivier <sabinus52@gmail.com>
 *
 * @package SoundTouchApi
 */

namespace Sabinus\SoundTouch\Component;

use Sabinus\SoundTouch\Component\ContentItem;
use Sabinus\SoundTouch\Constants\ImageStatus;
use \SimpleXMLElement;


class NowPlaying
{

    // Constantes de $playStatus
    const PLAY      = 'PLAY_STATE';
    const PAUSE     = 'PAUSE_STATE';
    const STOP      = 'STOP_STATE';
    const BUFFERING = 'BUFFERING_STATE';
    const INVALID   = 'INVALID_PLAY_STATUS';


    private $source;

    private $contentItem;

    private $track;

    private $artist;

    private $album;

    private $image;

    private $duration;

    private $position;

    private $playStatus;

    private $shuffleSetting;

    private $repeatSetting;

    private $streamType;

    private $stationName;

    private $stationLocation;

    private $description;

    private $artistID;

    private $trackID;


    /**
     * Affecte la réponse de la requête
     * 
     * @param SimpleXMLElement $xml : Xml de la réponse
     */
    public function setResponse(SimpleXMLElement $xml)
    {
        $this->source = strval($xml->attributes()->source);
        if ( $xml->ContentItem ) {
            $this->contentItem = new ContentItem($xml->ContentItem);
        }
        $this->track = strval($xml->track);
        $this->artist = strval($xml->artist);
        $this->album = strval($xml->album);
        if ($xml->art) {
            $imgStatus = strval($xml->art->attributes()->artImageStatus);
            if ($imgStatus == ImageStatus::IMAGE_PRESENT) {
                $this->image = strval($xml->art);
            }
        }
        if ($xml->time) {
            $this->duration = intval($xml->time->attributes()->total);
            $this->position = intval($xml->time);
        }
        $this->playStatus = strval($xml->playStatus);
        $this->shuffleSetting = strval($xml->shuffleSetting);
        $this->repeatSetting = strval($xml->repeatSetting);
        $this->streamType = strval($xml->streamType);
        $this->stationName = strval($xml->stationName);
        $this->stationLocation = strval($xml->stationLocation);
        $this->description = strval($xml->description);
        $this->artistID = intval($xml->artistID);
        $this->trackID = intval($xml->trackID);
    }


    /**
     * @return String
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @return ContentItem
     */
    public function getContentItem()
    {
        return $this->contentItem;
    }

    /**
     * @return String
     */
    public function getTrack()
    {
        return $this->track;
    }

    /**
     * @return String
     */
    public function getArtist()
    {
        return $this->artist;
    }

    /**
     * @return String
     */
    public function getAlbum()
    {
        return $this->album;
    }

    /**
     * @return String
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return Integer
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @return Integer
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @return String
     */
    public function getPlayStatus()
    {
        return $this->playStatus;
    }

    /**
     * @return String
     */
    public function getShuffleSetting()
    {
        return $this->shuffleSetting;
    }

    /**
     * @return String
     */
    public function getRepeatSetting()
    {
        return $this->repeatSetting;
    }
    
    /**
     * @return String
     */
    public function getStreamType()
    {
        return $this->streamType;
    }

    /**
     * @return String
     */
    public function getStationName()
    {
        return $this->stationName;
    }

    /**
     * @return String
     */
    public function getStationLocation()
    {
        return $this->stationLocation;
    }

    /**
     * @return String
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return Integer
     */
    public function getArtistID()
    {
        return $this->artistID;
    }

    /**
     * @return Integer
     */
    public function getTrackID()
    {
        return $this->trackID;
    }
    
}
