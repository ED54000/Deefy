<?php
declare(strict_types=1);
namespace iutnc\deefy\action;

use iutnc\deefy\auth\Auth;
class DisplayPlaylistAction extends Action
{
    function __construct()
    {
        parent::__construct();
    }

    public function execute(): string
 {
     $page = "";
     if ($this->http_method === "GET") {
         $page .= <<< FIN
            <form method="post">
                Id playlist :  <input type="number" name="id"><br>
                <button type="submit" name="playlist">Envoyer</button>
            </form>
FIN;
     }
     else {
         if (isset($_POST["id"])) {
             $id=$_POST["id"];

             Auth::authorize($id);

         }else{
             $page.= 'Il n y a rien a afficher';
         }
     }
     return $page;
 }

}