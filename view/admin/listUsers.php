<?php
    use App\Session;

    $users = $result["data"]["users"];
?>

<section class="list-user">
<h1>Liste des utilisateurs.</h1>

<?php if (Session::getUser() && Session::isAdmin()) {
    foreach($users as $user ){ ?>
        <div class="user">
            <p><strong><?= $user->getPseudo() ?></strong> inscrit le <?= $user->getProfilCreation() ?><a href="index.php?ctrl=security&action=deleteUser&id=<?= $user->getId() ?>"> - BANNIR</a></p>
        </div>
    <?php }; ?>
<?php }?>
</section>