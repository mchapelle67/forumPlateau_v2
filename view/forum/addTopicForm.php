<?php
    $category = $result["data"]['category']; 
?>

<section class="add-form">
    <form action="index.php?ctrl=forum&action=addTopic&id=<?= $category->getId() ?>" method="POST">
        <h1>AJOUTER UN<br><span class='red-word-h3'>CONTENUS</span>.</h1>

            <div class="content-form">
                <h2>Catégorie :</h2>
                <p><?php echo $category->getName()?></p>
            </div>

            <div class="content-form add-topic">
                <label for="title">Sujet</label>
                    <textarea name="title" id="title" required></textarea>
            </div>
            <div class="button-form">
                <input type="submit" name="submit" value="Créer sujet">
            </div>
    </form>
</section>