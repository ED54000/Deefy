<?php
declare(strict_types=1);
namespace iutnc\deefy\audio\tracks;

require_once 'AudioTrack.php';

class AlbumTrack extends AudioTrack
{
    protected $artist;
    protected $album;
    protected $year;
    protected $trackNumber;

    public function __construct($title, $audioFileName,$artist)
    {
        parent::__construct($title, $audioFileName,$artist);
    }


    public function __toString()
    {
        $trackData = [
            'titre' => $this->title,
            'artiste' => $this->artist,
            'album' => $this->album,
            'année' => $this->year,
            'n ° ' => $this->trackNumber,
            'genre' => $this->genre,
            'durée' => $this->duration,
            'NomCheminDuFichier' => $this->audioFileName,
        ];

        return json_encode($trackData);
    }
}
