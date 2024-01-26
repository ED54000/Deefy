<?php
declare(strict_types=1);
namespace iutnc\deefy\action;

class AddUserAction extends Action
{
    function __construct()
    {
        parent::__construct();
    }


    public function execute(): string
    {
     $texte ='';

        if ($this->http_method === 'GET') {
            $texte.= '<form method="post" action="">
                   E-mail: <input type="email" name="email"><br>
                   Mot de passe:<input type="text" name="mdp"><br>
                   <input type = "submit" name = "connection" value = "Connexion" >
                </form>';

        } elseif ($this->http_method === 'POST') {
            $EmailFiltrer = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $pwd = filter_var($_POST['mdp'], FILTER_SANITIZE_STRING);


            $ter = Auth::register($EmailFiltrer, $pwd);
            if ($ter) {
                $texte.= 'Création de compte terminée <br>';
            } else {
                $texte.= 'Erreur lors de la création du compte, veuillez ressayer <br>';
            }
        }


     return $texte;
    }
}