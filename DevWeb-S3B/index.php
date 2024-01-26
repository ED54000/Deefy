<?php
declare(strict_types=1);
use iutnc\deefy\dispatch\Dispatcher;
require_once('vendor/autoload.php');

session_start();

$connexion = new PDO('mysql:host=localhost;dbname=devwebs3', 'root', '');

if (isset($_GET["action"])) {
    $Dis = new Dispatcher();
    $Dis->run();
}else{
    if (isset($_SESSION["user"])) {
        echo <<< PAGE
        <h1>Bibliothèque musicale</h1>
            <ul>
            <li><a href="?action=add-playlist">Ajouter une playlist</a></li>
            <li><a href="?action=add-track">Ajouter une piste</a></li>
            <li><a href="?action=display-playlist">Afficher mes playlists</a></li>
            <li><a href="?action=disconnect-user">Se déconnecter</a></li>
        </ul>
    PAGE;
    }
    else {
        echo <<< PAGE
    <h1>Bibliothèque musicale</h1>
        <ul>
        <li><a href="?action=signin">Connexion</a></li>
        <li><a href="?action=add-user">Création d'un compte</a></li>
         
    </ul>
PAGE;
    }
}

function test_input($data): string
{
    $data=trim($data);
    $data=stripslashes($data);
    return htmlspecialchars($data);
}



