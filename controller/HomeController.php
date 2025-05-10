<?php
namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use App\DAO;
use Model\Managers\UserManager;
use Model\Managers\TopicManager;
use Model\Managers\PostManagers;


class HomeController extends AbstractController implements ControllerInterface {

    public function index(){
        return [
            "view" => VIEW_DIR."home.php",
            "meta_description" => "Page d'accueil du forum"
        ];
    }

    public function registerForm() {
        return [
            "view" => VIEW_DIR."security/registerForm.php",
            "meta_description" => "Page d'inscription du forum"
        ];
    }

    public function listTopics() {
        return [
            "view" => VIEW_DIR."forum/listTopics.php",
            "meta_description" => "Derniers sujets"
        ];
    }

    public function listUsers() {
        $userManager = new \Model\Managers\UserManager();
    $users = $userManager->findAll();

        return [
            "view" => VIEW_DIR."admin/listUsers.php",
            "meta_description" => "Liste utilisateurs"
        ];
    }

    public function addTopic() {
        return [
            "view" => VIEW_DIR."forum/addTopic.php",
            "meta_description" => "Ajouter contenus"
        ];
    }
}
