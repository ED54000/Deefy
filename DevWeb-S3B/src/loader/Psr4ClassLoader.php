<?php

namespace src\loader;

class Psr4ClassLoader{

    private string $pref;
    private string $chemin;
    public function __construct(string $prefixe, string $chemin ){
        $this->pref=$prefixe;
        $this->chemin=$chemin;


    }

    public function loadClass(string  $nomClass) :void{
        //var_dump($nomClass);
        $fichier = str_replace("\\",DIRECTORY_SEPARATOR,$nomClass);
        //var_dump($fichier);
        $fichier = $fichier.".php";
        //var_dump($fichier);
        $fichierFin = $this->chemin;
        $fichierFin.="/";
        $fichierFin.=$fichier;

        //var_dump($fichierFin);
     /* -calcule le chemin vers le fichier correspondant
             • ajouter le répertoire contenant le namespace
             • ajouter le suffixe '.php'
             • change les séparateurs de namespace " \ " en séparateurs de répertoire (DIRECTORY_SEPARATOR)
        – charge le fichier avec require_once s'il existe
     */
        if (is_file($fichierFin)){
        require_once $fichierFin;}

    }

    public function register() :void{
        spl_autoload_register( [$this, 'loadClass']);
    }
}