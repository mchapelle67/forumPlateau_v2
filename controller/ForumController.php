<?php
namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use App\Manager;
use Model\Managers\CategoryManager;
use Model\Managers\TopicManager;
use Model\Managers\UserManager;
use Model\Managers\PostManager;
use App\DAO;

class ForumController extends AbstractController implements ControllerInterface{

// on affiche les sujets par catégories    
    public function listByCategory($id) {
            
        $topicManager = new TopicManager();
        $categoryManager = new CategoryManager();
        $category = $categoryManager->findOneById($id);
        $topics = $topicManager->findTopicsByCategory($id);
            
        return [
            "view" => VIEW_DIR."forum/listByCategory.php",
            "meta_description" => "Liste des topics par catégorie : ".$category,
            "data" => [
                "category" => $category,
                "topics" => $topics
                ]
            ];
    }

// on affiche tous les sujets de manières antéchronologique 
    public function listTopics() {
        $topicManager = new TopicManager();
        $postManager = new PostManager();

        $topics = $topicManager->findAll(["topicCreation","DESC"]);
   

        return [
            "view" => VIEW_DIR."forum/listTopics.php",
            "meta_description" => "Liste des sujets.",
            "data" => [
                "topics" => $topics,
          
            ]
        ];
    }
    
// on affiche les listes de catégories
    public function listCategories() {
        $categoryManager = new CategoryManager();
        $categories = $categoryManager->findAll();

        return [
            "view" => VIEW_DIR."forum/listCategories.php",
            "meta_description" => "Liste des catégories",
            "data" => [
                "categories" => $categories
            ]
        ];
    }


// on créer  le formulaire de création de nouveaux sujets ...
    public function addTopicForm($id) {
        $categoryManager = new CategoryManager();
        $category = $categoryManager->findOneById($id);

        return [
            "view" => VIEW_DIR."forum/addTopicForm.php",
            "meta_description" => "Ajouter contenus",
            "data" => [
                "category" => $category
            ]
        ];
    }

// ... et la fonction associée permettant d'ajouter le contenus du formulaire à la bdd 
    public function addTopic($id) {
        DAO::connect();
        $text = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);

        $userManager = new UserManager();
        $categoryManager = new CategoryManager();

        $user = SESSION::getUser();
        $category = $categoryManager->findOneById($id);   
        
       
        // redirige ou affiche une erreur si l'user n'est pas connecté 
        if (!$user) {
        echo "Utilisateur non connecté.";
        $this->redirectTo("home");;
        }

        // si l'user à appuyé sur le bouton d'envois du formulaire 
        if(isset($_POST['submit'])) {

        $sql = "INSERT INTO topic (title, topicCreation, user_id, category_id) VALUES (:title, NOW(), :user, :category)";

                    DAO::insert($sql,[
                        'title' => $text,
                        'user' => $user->getId(),
                        'category' => $category->getId()
                    ]); 

        $this->redirectTo("forum", "listTopics");
        }
    }

// on affiche un sujet avec les commentaires associés
    public function detailTopic($id) {
        $topicManager = new TopicManager();
        $postManager = new PostManager();

        $topic = $topicManager->findOneById($id);
        $posts = $postManager->findPostsByTopic($id);
        $closed = $topic->getClosed();
        
        return [
            "view" => VIEW_DIR."forum/detailTopic.php",
            "meta_description" => "Liste des topics.",
            "data" => [
                "topic" => $topic,
                "posts" => $posts,
                "closed" => $closed
            ]
        ];
    }

// on permet à l'user de commenter un sujet 
    public function addPost($id) {
        DAO::connect();
        $text = filter_input(INPUT_POST, 'post', FILTER_SANITIZE_SPECIAL_CHARS);
        $userId = SESSION::getUser()->getId();
            
        $topicManager = new TopicManager();
     
        // si les champs sont remplis, on insère 
        if($text && $userId) {
        $sql = "INSERT INTO post (text, user_id, creationPost, topic_id) VALUES (:text, :user, NOW(), :topic)";

                    DAO::insert($sql,[
                        'text' => $text,
                        'user' => $userId,
                        'topic' => $id
                    ]); 

     $this->redirectTo("forum", "detailTopic&id=".$id);
        }
    }
}