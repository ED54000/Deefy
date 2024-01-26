<?php
declare(strict_types=1);
namespace iutnc\deefy\audio\tracks;

use iutnc\deefy\audio\list\AudioList;
use iutnc\deefy\render\AudioTrackRenderer;
use PDO;

require_once 'src/classes/audio/list/AudioList.php';

class Playlist extends AudioList
{
    public function addTrack($track)
    {
        $this->trackList[] = $track;
        $this->numTracks++;
        $this->totalDuration += $track->duration;
    }

    public function removeTrack($index)
    {
        if (isset($this->trackList[$index])) {
            $removedTrack = array_splice($this->trackList, $index, 1);
            $this->numTracks--;
            $this->totalDuration -= $removedTrack[0]->duration;
        }
    }

    public function addTracks($tracks)
    {
        foreach ($tracks as $track) {
            $this->addTrack($track);
        }
    }


    public static function getTrackList($Playlist){
        $db = \iutnc\deefy\db\ConnectionFactory::makeConnection();

        $sql ="SELECT * FROM track 
        INNER JOIN playlist2track on track.id=playlist2track.id_track
        INNER JOIN playlist on playlist2track.id_pl=playlist.id
        WHERE playlist.nom=:play";

        $resultset = $db->prepare($sql);
        $resultset->bindParam(':play',$Playlist);

        $resultset->execute();
        $db=null;
        return $resultset;

    }

    public static function find($playlistId) {

        $db = \iutnc\deefy\db\ConnectionFactory::makeConnection();

        $sql = "SELECT * FROM `playlist`
                WHERE playlist.id = :idP
                
              ";

        $resultset = $db->prepare($sql);

        $resultset->bindParam(':idP', $playlistId);


        $resultset->execute();

        while ($row = $resultset->fetch(PDO::FETCH_ASSOC)) {

            echo '<h1>'.$row['nom'] . "<br></h1>";

            $play = Playlist::getTrackList($row['nom']);
            while ($row2 = $play->fetch(PDO::FETCH_ASSOC)) {
                if ($row2['genre'] !== 'docu'){
                echo "<ul>";
                echo "<li>".$row2['titre'] . " de ".$row2['artiste_album']. " en : ". $row2['annee_album']."</li>";
                echo "</ul>";

            }else{
                    echo "<ul>";
                    echo "<li>".$row2['titre'] . " de ".$row2['auteur_podcast']. " en : ". $row2['date_podcast']."</li>";
                    echo "</ul>";}
            }

        }

    }



}
