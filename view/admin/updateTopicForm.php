<?php
    $topic = $result["data"]['topic']; 
    $categories = $result["data"]["categories"];
    $categoryById = $result["data"]["categoryById"]
?>

<section class="update-form">
    <form action="index.php?ctrl=security&action=updateTopic&id=<?= $topic->getId() ?>" method="POST">
        <h1>MODIFIER UN<br><span class='red-word-h3'>SUJET</span>.</h1>

            <div class="content-form update-topic">
                <label for="title">Sujet</label>
                    <textarea name="title" id="title" required><?= $topic->getTitle() ?></textarea>
            </div>
            
            <div class="update-actif-topic">
                <label for="open">Sujet actif</label>
                    <input type="radio" id="open" name="closed" value="1"></input>
                <label for="closed">Clôre le sujet</label>
                    <input type="radio" id="closed" name="closed" value="0"></input>
            </div>

            <div class="update-category">
                <label for="category">Catégorie</label>
                    <select id="category" name="category"></input>
                        <option value="<?= $categoryById->getId() ?>"><?= $categoryById->getName() ?></option> 
                    <?php foreach($categories as $category) { ?>
                        <option value="<?= $category->getId() ?>"><?= $category->getName() ?></option>
                    <?php } ?>
            </div>
               

            <div class="button-form">
                <input type="submit" name="submit" value="Modifier sujet">
            </div>
    </form>
</section>