<?php
/**
 * Cache des données de récupération de l'enceinte
 *
 * @author Olivier <sabinus52@gmail.com>
 *
 * @package SoundTouchApi
 */

namespace Sabinus\SoundTouch;


class SoundTouchCache
{

    /**
     * Données contenant le cache
     * 
     * @var Array
     */
    private $datas;


    /**
     * Constructeur
     */
    public function __construct()
    {
        $this->clean();
    }


    /**
     * Efface les cache
     */
    public function clean()
    {
        $this->datas = array();
    }    


    /**
     * Affecte une donnée au cache
     * 
     * @param String $id
     * @param Mixed $data
     */
    public function setData($id, $data)
    {
        $this->datas[$id] = $data;
    }


    /**
     * Récupère le cache
     * 
     * @param String $id
     */
    public function getData($id)
    {
        if ( isset($this->datas[$id]) ) {
            return $this->datas[$id];
        } else {
            return null;
        }
    }

}