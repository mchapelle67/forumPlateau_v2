<section class="inscription-form">
    <form action="/manon_CHAPELLE/forumPlateau_V2/index.php?ctrl=security&action=register" method="POST">
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