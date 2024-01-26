<?php
declare(strict_types=1);
namespace iutnc\deefy\audio\tracks;


use iutnc\deefy\exception\InvalidPropertyNameException;
use iutnc\deefy\db\ConnectionFactory;
use iutnc\deefy\exception\NonEditablePropertyException;



class AudioTrack
{
    protected $title;

    protected $artiste;
    protected $genre;
    protected $duration;
    protected $audioFileName;

    public function __construct($title, $audioFileName,$artiste)
    {
        $this->title = $title;
        $this->audioFileName = $audioFileName;
        $this->artiste=$artiste;
    }

    public function __get($attrName)
    {
        if (property_exists($this, $attrName)) {

            return $this->$attrName;

        } else {
            throw new InvalidPropertyNameException("Invalid property name: $attrName");
        }
    }

    public function __set($property, $value)
    {
        if ($property === 'duree' || $property === 'genre' || $property === 'artiste') {
            $this->$property = $value;
        } else {
            throw new NonEditablePropertyException("Property $property is not editable. Magi");
        }
    }

    public  function insertTrack(){
        $connexion=ConnectionFactory::makeConnection();
        if(!empty($this->title) && !empty($this->genre) && !empty($this->duration) && !empty($this->audioFileName)){
            $sql = 'INSERT INTO track(titre,genre,duree,fileName,type)VALUES (:titre,:genre,:duree,:aFN,:type)';

            $resultset = $connexion->prepare($sql);

            $resultset->bindValue(':titre',$this->title);
            $resultset->bindValue(':genre',$this->genre);
            $resultset->bindValue(':duree',$this->duration);
            $resultset->bindValue(':aFN',$this->audioFileName);


            $result=  $resultset->execute();

            if(!$result){
                echo "Un problème est survenu, l'enregistrement n'a pas été éffectué";
            }else{
                echo "<script type=\text/javascript\"> alert('Vous êtes bien enregistré')</script>";

            }
        }else{
            echo "Tous les champs sont requis";
        }

    }



}
