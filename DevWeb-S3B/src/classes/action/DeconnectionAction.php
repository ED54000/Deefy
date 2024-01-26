<?php

namespace iutnc\deefy\action;

use iutnc\deefy\action\Action;

class DeconnectionAction extends Action
{

    public function execute(): string
    {
        if(isset($_SESSION['user'])){
            // On supprime l'utilisateur de la session
            unset($_SESSION['user']);
            // Redirection vers la page principale
            header("Location: index.php");
            exit();
        }
        return "Deconnexion";
    }
}