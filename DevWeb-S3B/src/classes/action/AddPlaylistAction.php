<?php
declare(strict_types=1);

namespace iutnc\deefy\action;

use iutnc\deefy\action\Action;
use iutnc\deefy\audio\tracks\Playlist;
use iutnc\deefy\render\AudioListRenderer;
use iutnc\deefy\db\ConnectionFactory;
use PDO;

class AddPlaylistAction extends Action
{
    function __construct()
    {
        parent::__construct();
    }

    public function execute(): string
    {

        if (isset($_SESSION['user'])) {

            $texte = "";
            $name = "";
            if ($this->http_method === 'GET') {

                $texte .= '<form method="post" action="?action=add-playlist">
                    Nom de la Playlist : <input type="text" name="name"><br>
                    <input type = "submit" name = "ajout" value = "Ajout" >';

                return $texte;
            } elseif ($this->http_method === 'POST') {
                if (empty($_POST["name"])) {
                    $texte = "Name is required";
                } else {
                    $name = test_input($_POST["name"]);

                }
                $play = new Playlist($name);
                $db = ConnectionFactory::makeConnection();
                $sql = "SELECT max(id) from playlist";
                $resultset = $db->prepare($sql);
                $resultset->execute();

                while ($row = $resultset->fetch(PDO::FETCH_ASSOC)) {
                    $max = $row['max(id)'];
                    $max = $max + 1;
                }
                $sql = "insert into playlist values (?,?) ";
                $resultset = $db->prepare($sql);
                $resultset->bindParam(1, $max);
                $resultset->bindParam(2, $_POST["name"]);
                $creation = $resultset->execute();
                if ($creation) {
                    $texte = 'Playlist créée';
                    $sql = "insert into user2playlist values (?,?) ";
                    $resultset = $db->prepare($sql);
                    $resultset->bindParam(1, $_SESSION["user"]);
                    $resultset->bindParam(2, $max);
                    $creation = $resultset->execute();
                    if ($creation) {

                        $render = new AudioListRenderer($play);
                        echo $render->render(1);
                    }
                } else {
                    echo "Une erreur est survenue, la playlist n'a pas été créée";
                }
            }

        } else {
            $texte = 'Veuillez-vous connecter<br>
            <a href="?action=signin">Connexion</a>';
        }
        return $texte;
    }
}