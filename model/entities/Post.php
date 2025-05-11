<?php
namespace Model\Entities;

use App\Entity;

/*
    En programmation orientée objet, une classe finale (final class) est une classe que vous ne pouvez pas étendre, c'est-à-dire qu'aucune autre classe ne peut hériter de cette classe. En d'autres termes, une classe finale ne peut pas être utilisée comme classe parente.
*/

final class Post extends Entity{

    private $id;
    private $text;
    private $user;


    public function __construct($data){         
        $this->hydrate($data);        
    }

    /**
     * Get the value of id
     */ 
    public function getId(){
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id){
        $this->id = $id;
        return $this;
    }

 
    public function getText(){
        return $this->text;
    }

    /**
     * Set the value 
     *
     * @return  self
     */ 
    public function setText($text){
        $this->text = $text;
        return $this;
    }

 
    public function getUser(){
        return $this->user;
    }

    /**
     * Set the value
     *
     * @return  self
     */ 
    public function setUser($user){
        $this->user = $user;
        return $this;
    }

}