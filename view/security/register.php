<?php 
$pseudo = filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_SPECIAL_CHARS);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

$hash = password_hash($password, PASSWORD_DEFAULT);
$user = user dans bdd;

faire INSERT INTO user 

sesssion start dans quel fichier ?? 

$user c où ? 

// se connecter à la session
if(password_verify($password, $hash)){
    $_SESSION['user'] = $user;
} else {
    echo "Erreur de mot de passe ou d'e-mail. Veuillez réessayer"; (mettre fenêtre pop up JS)
}

ajouter filtre email 
pour se deonnecter = unset($_SESSION["session ?? "]);
?>

<section class="inscription-form">
    <form action="" method="POST">
        <h3>Rejoindre la communauté.</h3>
            <label for="pseudo">Pseudo</label>
                <input type="text" name="pseudo" id="pseudo" required>

            <label for="email">E-mail</label>
                <input type="email" name="email" id="email" required>

            <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" required>
                
                <label for="password">Vérifier mot de passe</label>
                    <input type="password" name="password" id="password" required>

        <input type="submit" value="S'INSCRIRE">
    </form>
</section>