<?php
declare(strict_types=1);
namespace iutnc\deefy\dispatch;

use iutnc\deefy\action\AddTrackAction;
use iutnc\deefy\action\DeconnectionAction;
use iutnc\deefy\action\SigninAction;
use iutnc\deefy\action\AddUserAction;
use iutnc\deefy\action\DisplayPlaylistAction;
use \iutnc\deefy\action\AddPlaylistAction;
use iutnc\deefy\action\SignUp;

class Dispatcher
{


    public string $action;

    public function __construct()
    {
        $this->action = $_GET['action'];

    }

    public function run(): void
    {

        echo "<form method='post'>";
        switch ($this->action) {
            case"signin":
                $Signin = new SigninAction();
                $this->renderPage($Signin->execute());
                break;

            case 'add-user':
                $addUser = new AddUserAction();
                $this->renderPage($addUser->execute());
                break;

            case 'add-playlist' :
                $AddPlaylist = new AddPlaylistAction();
                $this->renderPage($AddPlaylist->execute());
                break;

            case 'display-playlist' :
                $displayPlaylist = new DisplayPlaylistAction();
                $this->renderPage($displayPlaylist->execute());
                break;

            case 'add-track' :
                $AddTrack = new AddTrackAction();
                $this->renderPage($AddTrack->execute());
                break;
            case 'disconnect-user' :
                $disconnect = new DeconnectionAction();
                $this->renderPage($disconnect->execute());
        }
    }

    public function renderPage(string $html): void {
        echo <<<FIN
        <!DOCTYPE html>
            <html lang="fr">
                <head>
                <meta charset="utf-8"/>
                <title>$this->action</title>
                </head>
            <body>
                $html
                <br><a href='index.php'>Accueil</a>
            </body>
        </html>

FIN;

    }


}