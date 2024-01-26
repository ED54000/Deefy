<?php
declare(strict_types=1);
namespace iutnc\deefy\audio\list;
use iutnc\deefy\exception\InvalidPropertyNameException;

class AudioList
{
    protected String $name;
    protected mixed $trackList = [];
    protected int $numTrack = 0;
    protected int $totalDuration = 0;

    public function __construct($name, $trackList = [])
    {
        $this->name = $name;
        $this->trackList = $trackList;
        if ($trackList===null){
            $this->numTrack=0;
        }else {
            $this->numTrack = count($trackList);
        }

        foreach ($trackList as $track) {
            $this->totalDuration += $track->duration;
        }
    }

    public function __get(string $property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
        else {
            throw new InvalidPropertyNameException("invalid property : " .  $property);
        }
    }
}


