<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;
use App\Autoloader;
use App\DAO;

// se connecter à la session
// if(password_verify($password, $hash)){
//     $_SESSION['user'] = $user;
// } else {
//     echo "Erreur de mot de passe ou d'e-mail. Veuillez réessayer"; 
// }


// pour se deonnecter = unset($_SESSION["session ?? "]);


class SecurityController extends AbstractController{
    // contiendra les méthodes liées à l'authentification : register, login et logout

    public function register() {
    // connexion à la base
    DAO::connect();

    // récupération des filtrages de données 
    $pseudo = filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST,'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    // hashage du password
    $hash = password_hash($password, PASSWORD_DEFAULT);

    // on verifie si les données saisis sont déjà présentes dans la bdd
    $sqlEmail = "SELECT * FROM user WHERE email = :email";
    $sqlPseudo = "SELECT * FROM user WHERE pseudo = :pseudo";

    $emailExists = DAO::select($sqlEmail, ['email' => $email], false);
    $pseudoExists = DAO::select($sqlPseudo, ['pseudo' => $pseudo], false);

    if ($emailExists) {
        echo "Utilisateur déjà associé à l'email.";
    };

    if ($pseudoExists) {
        echo "Utilisateur déjà associé au pseudo.";
    };

    // si aucune donnée n'est déjà présente, on poursuit l'inscription
    if (!$emailExists && !$pseudoExists) {
        // inserer dans la bdd
        $sql = "INSERT INTO user (pseudo, email, password, profilCreation) VALUES (:pseudo, :email, :password, NOW())";

        DAO::insert($sql,[
            'pseudo' => $pseudo,
            'email' => $email,
            'password' => $hash, 
        ]);

        header('Location:home.php');
        exit;
    };
}

    public function login () {}
    public function logout () {}
};

