<?php
namespace Model\Entities;

use App\Entity;

/*
    En programmation orientée objet, une classe finale (final class) est une classe que vous ne pouvez pas étendre, c'est-à-dire qu'aucune autre classe ne peut hériter de cette classe. En d'autres termes, une classe finale ne peut pas être utilisée comme classe parente.
*/

final class Topic extends Entity{

    private $id;
    private $title;
    private $user;
    private $category;
    private $topicCreation;
    private $closed;

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

    /**
     * Get the value of title
     */ 
    public function getTitle(){
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title){
        $this->title = $title;
        return $this;
    }

    /**
     * Get the value of category
     */ 
    public function getCategory(){
        return $this->category;
    }

    /**
     * Set the value of category
     *
     * @return  self
     */ 
    public function setCategory($category){
        $this->category = $category;
        return $this;
    }

    /**
     * Get the value of user
     */ 
    public function getUser(){
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @return  self
     */ 
    public function setUser($user){
        $this->user = $user;
        return $this;
    }

    public function __toString(){
        return $this->title;
    }

    /**
     * Get the value of date creation
     */ 
    public function getTopicCreation(){
        return $this->topicCreation;
    }

    /**
     * Set the value of date creation
     *
     * @return  self
     */ 
    public function setTopicCreation($topicCreation){
        // on met la date en fr
        // $formatter = new \IntlDateFormatter('fr_FR', \IntlDateFormatter::LONG, \IntlDateFormatter::SHORT);
        // $formatter->setPattern("d MMMM yyyy, HH:mm");

        // $topicCreation = $formatter->format(new \DateTime($this->topicCreation));

        
        $this->topicCreation = $topicCreation;
        return $this;

    }
}