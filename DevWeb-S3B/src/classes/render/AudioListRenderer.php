<?php
declare(strict_types=1);
namespace iutnc\deefy\render;

use iutnc\deefy\audio\list\AudioList;
use  iutnc\deefy\exception\InvalidPropertyValueException;
require_once 'Renderer.php';
require_once 'src/classes/audio/list/AudioList.php';

class AudioListRenderer implements Renderer
{
    private $audioList;

    public function __construct(AudioList $audioList)
    {
        $this->audioList = $audioList;
    }

    public function render(int $selector): string
    {
        $html = "";
        if ($selector=== 2){
        $html = "<div class='audio-list'>";
        $html .= "<h2>{$this->audioList->__get('name')}</h2>
                <span>{$this->audioList->__get('numTrack') } pistes </span>";
        $html .= "<p>Durée totale : {$this->audioList->__get('totalDuration')} secondes</p>";
        $html .= "</div>";
        foreach ($this->audioList->__get('trackList') as $track){
                $AudTR = new AlbumTrackRenderer($track);
                $AudTR->render(2);
        }
     }else if ($selector=== 1){
            $html=  $html = "<div class='audio-list'>";
            $html .= "<h2>{$this->audioList->__get('name')}</h2>
                <span>{$this->audioList->__get('numTrack') } pistes </span>";
            $html .= "<p>Durée totale : {$this->audioList->__get('totalDuration')} secondes</p>";
            $html .= "</div>";
            }
        return $html;
    }


}
