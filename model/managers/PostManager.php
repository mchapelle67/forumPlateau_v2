<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;

class PostManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\Post";
    protected $tableName = "post";
    // comment faire avec ma table CONTENT ? un nouveau Manager ? 

    public function __construct(){
        parent::connect();
    }
    
}