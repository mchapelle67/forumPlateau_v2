<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;
use App\Autoloader;
use App\DAO;
use App\Session;
use Model\Managers\UserManager;



class SecurityController extends AbstractController{
    // contiendra les méthodes liées à l'authentification : register, login et logout

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
                $this->redirectTo("register");
            // on verifie que les mdp saisis sont identiques
            } elseif ($password != $password2) {
                Session::addFlash("error", "Les mots de passes ne sont pas identiques.");
                $this->redirectTo("register");  
            } else {
                // si aucune donnée n'est déjà présente, on poursuit l'inscription
                if ((!$verifyEmail && !$verifyPseudo) && ($password === $password2)) {
                    // on insert une fonction regex, obligation de saisir un mot de passe comportant:
                    // (?=.*[a-z]) → au moins une lettre minuscule
                    // (?=.*[A-Z]) → au moins une lettre majuscule
                    // (?=.*\d) → au moins un chiffre
                    // .{8,} → minimum 8 caractères
                    if (preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/", $password)) {  

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
                        Session::addFlash("error", "Le mot de passe n'est pas valide. <br>Il doit au comporter au minimum: <br> - 1 minuscule,<br> - 1 majuscule,<br> - 1 chiffre<br>, - 8 caractères.");
                        $this->redirectTo("register");  
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
            Session::addFlash("error", "Mot de passe ou e-mail inccorect.");
            $this->redirectTo("home");

        }
     }
        


    
    
    public function logout () {}
}

