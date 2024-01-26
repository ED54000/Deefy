<?php
declare(strict_types=1);
namespace iutnc\deefy\audio\tracks;

require_once 'AudioTrack.php';

class PodcastTrack extends AudioTrack
{
    protected $date;

    public function __construct($title, $audioFileName, $date)
    {
        parent::__construct($title, $audioFileName,null);
        $this->date = $date;
    }
}