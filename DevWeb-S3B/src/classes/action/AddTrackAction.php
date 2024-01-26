<?php
declare(strict_types=1);
namespace iutnc\deefy\action;

use iutnc\deefy\audio\tracks\PodcastTrack;
use iutnc\deefy\db\ConnectionFactory;
use iutnc\deefy\audio\tracks\AudioTrack;
use PDO;


class AddTrackAction extends Action
{

    function __construct()
    {
        parent::__construct();
    }

    public function execute(): string
    {

        $texte = "";

        if (isset($_SESSION['user'])) {


            $name = "";

            if ($this->http_method === 'GET') {

                $texte .= '<form method="post" action="?action=add-track">
                    Nom de la piste : <input type="text" name="name"><br>
                    Durée :<input type="text" name="duree"><br>
                    Année :<input type="text" name="annee"><br>
                    Artiste : <input type="text" name="art"><br>
                    Genre :<input type="text" name="genre"> (docu si documentaire)<br>
                    Titre de l album :<input type="text" name="TitreAblm"> <br>
                    Titre de la playlist:<input type="text" name="Playlist"><br> 
                    <input type = "submit" name = "ajout" value = "Ajout" >';
                return $texte;
            }elseif ($this->http_method === 'POST'){
                $nomPiste = filter_var($_POST['name'],FILTER_SANITIZE_STRING);
                $artiste = filter_var($_POST['art'],FILTER_SANITIZE_STRING);
                $duree = filter_var($_POST['duree'],FILTER_SANITIZE_NUMBER_INT);
                $annee = filter_var($_POST['annee'],FILTER_SANITIZE_NUMBER_INT);
                $genre = filter_var($_POST['genre'],FILTER_SANITIZE_STRING);
                $titre =filter_var($_POST['TitreAblm'],FILTER_SANITIZE_STRING);
                $play = filter_var($_POST['Playlist'],FILTER_SANITIZE_STRING);
                $db = ConnectionFactory::makeConnection();
                if ($genre==='docu'){
                    $type = 'P';
                    $pod= new PodcastTrack($titre,null,$annee);

                    $sql = "insert into track (titre,genre,duree,type,auteur_podcast,date_posdcast) VALUES (:titre,:genre,:duree,:type,:artiste,:annee)";

                    $resultset = $db->prepare($sql);

                    $resultset->bindParam(':titre',$nomPiste);
                    $resultset->bindParam(':genre',$genre);
                    $resultset->bindParam(':duree',$duree);
                    $resultset->bindParam(':type',$type);
                    $resultset->bindParam(':artiste',$artiste);
                    $resultset->bindParam(':annee',$annee);
                }   else{
                    $type = 'A';
                    $sql = "insert into track (titre,genre,duree,type,artiste_album,titre_album,annee_album) VALUES (:titre,:genre,:duree,:type,:artiste,:titreAlbm,:annee)";
                    $resultset = $db->prepare($sql);

                    $resultset->bindParam(':titre',$nomPiste);
                    $resultset->bindParam(':genre',$genre);
                    $resultset->bindParam(':duree',$duree);
                    $resultset->bindParam(':type',$type);
                    $resultset->bindParam(':artiste',$artiste);
                    $resultset->bindParam(':titreAlbm',$titre);
                    $resultset->bindParam(':annee',$annee);
                }


                    $ajout=$resultset->execute();
                    if($ajout){
                        $sql = "SELECT max(id) max from track";

                        $resultset = $db->prepare($sql);
                        $resultset->execute();
                        while ($row = $resultset->fetch(PDO::FETCH_ASSOC)) {
                            $id_track = $row['max'];
                        }

                        $sql = "SELECT id from playlist where nom=?";
                        $resultset = $db->prepare($sql);
                        $resultset->bindParam(1,$play);
                        $trouve = $resultset->execute();
                        while ($row = $resultset->fetch(PDO::FETCH_ASSOC)) {
                            $id_pl = $row['id'];
                        }
                        if ($trouve){
                            $sql = "SELECT max(no_piste_dans_liste) max from playlist2track where id_pl=? and id_track=?";
                            $resultset = $db->prepare($sql);
                            $resultset->bindParam(1,$id_pl);
                            $resultset->bindParam(2,$id_track);
                            $resultset->execute();
                            while ($row = $resultset->fetch(PDO::FETCH_ASSOC)) {
                                $max = $row['max'];
                                $max = $max + 1;
                            }

                            $sql="insert into playlist2track values (?,?,?)";
                            $resultset = $db->prepare($sql);
                            $resultset->bindParam(1,$id_pl);
                            $resultset->bindParam(2,$id_track);
                            $resultset->bindParam(3,$max);
                            $resultset->execute();
                        }
                    }
            }
        }else{
            $texte = 'Veuillez-vous connecter<br>
            <a href="?action=signin">Connexion</a>';
        }
        return $texte;
    }
}