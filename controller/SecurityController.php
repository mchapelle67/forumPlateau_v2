<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;
use App\Autoloader;
use App\DAO;
use App\Session;
use Model\Managers\UserManager;
use Model\Managers\TopicManager;
use Model\Managers\PostManager;
use Model\Managers\CategoryManager;


class SecurityController extends AbstractController{
// contiendra les méthodes liées à l'authentification et à la gestion

    public function register() {
        // connexion à la base
        DAO::connect();

        // filtrages de données 
        $pseudo = filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST,'email', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $password2 = filter_input(INPUT_POST, "password2", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        // hashage du password
        $hash = password_hash($password, PASSWORD_DEFAULT);

        // on instencie un nouvel user 
        $user = new UserManager();

        // on verifie si les données saisis sont déjà présentes dans la bdd
        $verifyEmail = $user->findOneByEmail($email);
        $verifyPseudo = $user->findOneByPseudo($pseudo);

        // si l'utilisateur a envoyé le formulaire 
        if(isset($_POST['submit'])) {

            // on affiche un message d'erreur si l'email ou le pseudo est déjà en bdd
            if (($verifyEmail) || ($verifyPseudo)) {
            Session::addFlash("error", "Utilisateur déjà associé à l'email ou au pseudo.");
                $this->redirectTo("home", "registerForm");
            // on verifie que les mdp saisis sont identiques
            } elseif ($password != $password2) {
                Session::addFlash("error", "Les mots de passes ne sont pas identiques.");
                $this->redirectTo("home", "registerForm");  
            } else {
                // si aucune donnée n'est déjà présente, on poursuit l'inscription
                if ((!$verifyEmail && !$verifyPseudo) && ($password === $password2)) {
                    // on insert une fonction regex, obligation de saisir un mot de passe comportant:
                    // (?=.*[a-z]) → au moins une lettre minuscule
                    // (?=.*[A-Z]) → au moins une lettre majuscule
                    // (?=.*\d) → au moins un chiffre
                    // .{12,} → minimum 12 caractères
                    if (preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{12,}$/", $password)) {  

                    // si toutes ces étapes sont passés, on insere les données dans la bdd et on valide l'inscription
                    $sql = "INSERT INTO user (pseudo, email, password, profilCreation) VALUES (:pseudo, :email, :password, NOW())";

                    DAO::insert($sql,[
                        'pseudo' => $pseudo,
                        'email' => $email,
                        'password' => $hash, 
                    ]);

                    Session::addFlash("success", "Inscription bien prise en compte.");
                    $this->redirectTo("home");

                    } else {
                    // message d'erreur si le mot de passe ne correspond pas à la fonction regex
                        Session::addFlash("error", "Le mot de passe n'est pas valide. <br>Il doit au comporter au minimum: <br> - 1 minuscule,<br> - 1 majuscule,<br> - 1 chiffre,<br> - 12 caractères.");
                        $this->redirectTo("home", "registerForm");  
                    }
                    
                }
            }
        }
    }

    public function login () {
        // connexion à la base
        DAO::connect();

        // filtrages de données 
        $email = filter_input(INPUT_POST,'email', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        // on instencie un nouvel user 
        $userManager = new UserManager();
        
        // on verifie si le mail saisis est en bdd
        $user = $userManager->findOneByEmail($email);
                
        // on verifie si on trouve un email correspondant dans la bdd et si le mdp correspond
        if($user && password_verify($password, $user->getPassword())){
            Session::setUser($user);

            Session::addFlash("success", "Bienvenue, ".$user->getPseudo());
            $this->redirectTo('home');
        } else {
            Session::addFlash("error", "Mot de passe ou e-mail incorrect.");
            $this->redirectTo("home");

        }
     }


// on permet à l'user de se deconnecter
    public function logout () {
        unset($_SESSION['user']);
            $this->redirectTo("home");
    }

    
// affichage du formulaire d'inscription
    public function registerForm() {
        return [
            "view" => VIEW_DIR."security/registerForm.php",
            "meta_description" => "Page d'inscription du forum"
        ];
    }
    

// affichage de la listes et users (visible uniquement par l'admin) ... 
    public function listUsers() {
        $userManager = new UserManager();
        $users = $userManager->findAll();
        
        return [
            "view" => VIEW_DIR."admin/listUsers.php",
            "meta_description" => "Liste des utilisateurs",
            "data" => [
                "users" => $users
                ]
            ];
        }
        
//  ... et la possibilité de supprimer un user (toujours que pour un admin)
    public function deleteUser($id) {
        $userManager = new UserManager() ;
        $userManager->delete($id);
        
        $this->redirectTo("security", "listUsers");
    }

// suppression d'un sujet par un admin OU par l'user ayant crée le sujet 
    public function deleteTopic($id) {
        $topicManager = new TopicManager() ;
        $topicManager->delete($id);
        
        $this->redirectTo("forum", "listTopics");
    }

// suppression d'un commentaire par un admin OU par l'user ayant crée le commentaire 

    public function deletePost($id) {
        $postManager = new PostManager() ;
        $postManager->delete($id);
        
        $this->redirectTo("forum", "listTopics");
    }

//  affichage de formulaire d'update de sujet 
    public function updateTopicForm($id) {
        $topicManager = new TopicManager();
        $categoriesManager = new CategoryManager;
        
        
        $topic = $topicManager->findOneById($id);
        
        $category_id = $topic->getCategory();
        $categories = $categoriesManager->findAll();
        
        
        return [
            "view" => VIEW_DIR."admin/updateTopicForm.php",
            "meta_description" => "Modification d'un sujet",
            "data" => [
                "topic" => $topic,
                "categories" => $categories,
                "categoryById" => $categoryById
                ]
            ];
        }
        
    
// modification d'un sujet par un admin OU par l'user ayant crée le sujet 
    public function updateTopic($id) {        
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);

        $topicManager = new TopicManager();
      
        $sql = "UPDATE topic SET title = :title, closed = :closed, category_id = :category WHERE id_topic = :id";
                
            DAO::update($sql,[
            'title' => $title,
            'closed' => $_POST['closed'],
            'category' => $_POST['category'],
            'id' => $id
        ]);


        $this->redirectTo("forum", "listTopics");

    }

}
    
