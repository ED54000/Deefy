<?php
declare(strict_types=1);
namespace iutnc\deefy\db;


use iutnc\deefy\User;
use PDO;

class ConnectionFactory
{

   public static function setConfig(): bool|array
   {
       return parse_ini_file("text.txt");

   }

   public static function makeConnection(): PDO
   {

       $connexion = new PDO('mysql:host='.ConnectionFactory::setConfig()['host'].';dbname='.ConnectionFactory::setConfig()['dbname'], ConnectionFactory::setConfig()['user'],ConnectionFactory::setConfig()['pswd']);

       $connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);


       return $connexion;
   }


}