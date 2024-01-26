<?php
declare(strict_types=1);
namespace iutnc\deefy\action;

use iutnc\deefy\auth\Auth;
use iutnc\deefy\User;
use PDO;

class SigninAction extends Action
{

    function __construct()
    {
        parent::__construct();
    }


    public function execute(): string
    {
        $texte = '';

        if ($this->http_method == 'GET') {

         $texte.='E - mail : <input type = "email" name = "email" ><br >
                        Mot de passe : <input type = "password" name = "pwd" ><br >
                     <input type = "submit" name = "connection" value = "Connexion" ><br>
                     
                     ';

        } elseif ($this->http_method === 'POST'){
            $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
            if ($email) {
                $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
                $pwd = filter_var($_POST["pwd"], FILTER_SANITIZE_STRING);
                $var = Auth::authenticate($email, $pwd);

                if ($var === true) {
                    $texte.= '<h1>Bienvenue </h1>
                        <h2>Vos playlists : </h2>';
                    $user = new User($email, $pwd, 1);

                    $test = $user->getPlaylists();


                    while ($row = $test->fetch(PDO::FETCH_ASSOC)) {

                        $texte.= $row['nom'] . "<br>";

                    }
                }
            }

        }

        return $texte;
    }
}
