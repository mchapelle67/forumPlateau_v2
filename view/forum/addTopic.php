<?php
    $category = $result["data"]['category']; 
?>

<section class="add-form">
    <form action="index.php?ctrl=security&action=add" method="POST">
        <h1>AJOUTER UN<br><span class='red-word-h3'>CONTENUS</span>.</h1>

            <div class="content-form">
                <label for="category">Catégorie</label>
                    <select name="category" id="category" required>
                <?php foreach ($category as $categ) { ?>
                    <option value="<?= $categ->getId() ?>"><?= $categ->getName()?></option>
                <?php } ?>
                    </select>
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