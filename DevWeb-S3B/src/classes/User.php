<?php
declare(strict_types=1);
namespace iutnc\deefy;

use iutnc\deefy\audio\tracks\Playlist;

require_once 'vendor/autoload.php';
class User
{
   public string $email;
   public  string $passwd;
   public int $role;


   function __construct($mail,$pwd,$r){
       $this->role=$r;
       $this->passwd=$pwd;
       $this->email=$mail;

   }
    public function getPlaylists() {
        try {
            $db = \iutnc\deefy\db\ConnectionFactory::makeConnection();

            $sql = "SELECT * FROM `playlist`
                INNER JOIN user2playlist ON playlist.id = user2playlist.id_pl
                INNER JOIN user ON user2playlist.id_user = user.id
                WHERE user.email = :email
                AND user.role = 1
              ";

            $resultset = $db->prepare($sql);

            $resultset->bindParam(':email', $this->email);


            $resultset->execute();



            return $resultset;
        } catch (PDOException $e) {

        } finally {
            $db = null;
        }
    }



}