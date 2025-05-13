<?php
    $categories = $result["data"]['categories']; 
?>

<section class="list">
<h1>Liste des <span class='red-word-h3'>catégories</span>.</h1>

<?php
foreach($categories as $category ){ ?>
    <p><a href="index.php?ctrl=forum&action=listByCategory&id=<?= $category->getId() ?>"><?= $category->getName() ?></a></p>
<?php } ?>

</section>


  
