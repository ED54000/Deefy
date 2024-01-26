<?php
declare(strict_types=1);
namespace iutnc\deefy\audio\tracks;

use iutnc\deefy\audio\list\AudioList;

require_once 'src/classes/audio/list/AudioList.php';

class Album extends AudioList
{
    protected $artist;
    protected $releaseDate;

    public function __construct($name, $trackList, $artist, $releaseDate)
    {
        parent::__construct($name, $trackList);
        $this->artist = $artist;
        $this->releaseDate = $releaseDate;
    }

    public function __set($property, $value)
    {
        if ($property === 'artist' || $property === 'releaseDate') {
            $this->$property = $value;
        } else {
            throw new Exception("Property $property is not editable for an Album.");
        }
    }
}
