<?php
namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use App\Manager;
use Model\Managers\CategoryManager;
use Model\Managers\TopicManager;
use Model\Managers\UserManager;
use App\DAO;

class ForumController extends AbstractController implements ControllerInterface{

    public function index() {
        
        // créer une nouvelle instance de CategoryManager
        $categoryManager = new CategoryManager();
        // récupérer la liste de toutes les catégories grâce à la méthode findAll de Manager.php (triés par nom)
        $categories = $categoryManager->findAll(["name", "DESC"]);

        // le controller communique avec la vue "listCategories" (view) pour lui envoyer la liste des catégories (data)
        return [
            "view" => VIEW_DIR."forum/categories.php",
            "meta_description" => "Liste des catégories du forum",
            "data" => [
                "categories" => $categories
            ]
        ];
    }

    // public function listTopicsByCategory($id) {

    //     $topicManager = new TopicManager();
    //     $categoryManager = new CategoryManager();
    //     $category = $categoryManager->findOneById($id);
    //     $topics = $topicManager->findTopicsByCategory($id);

    //     return [
    //         "view" => VIEW_DIR."forum/listTopics.php",
    //         "meta_description" => "Liste des topics par catégorie : ".$category,
    //         "data" => [
    //             "category" => $category,
    //             "topics" => $topics
    //         ]
    //     ];
    // }

    public function listTopics() {
        DAO::connect();

        $topicManager = new TopicManager();
        $categoryManager = new CategoryManager();
        $userManager = new UserManager;

        $category = $categoryManager->findAll();
        $topics = $topicManager->findAll();
        $users = $userManager->findAll();

        return [
            "view" => VIEW_DIR."forum/listTopics.php",
            "meta_description" => "Liste des topics.",
            "data" => [
                "category" => $category,
                "topics" => $topics,
                "users" => $users
            ]
        ];
    }
    
    public function listUsers() {
        $userManager = new UserManager();
        $users = $userManager->findAll();
        
        $userManager = new UserManager();
        return [
            "view" => VIEW_DIR."admin/listUsers.php",
            "meta_description" => "Liste des utilisateurs",
            "data" => [
                "users" => $users
            ]
            ];
    }

    public function addTopic() {
    }
}