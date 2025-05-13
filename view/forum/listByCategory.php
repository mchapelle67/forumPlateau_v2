<?php
    $topics = $result["data"]['topics']; 
    $category = $result["data"]["category"]
?>

<sections class="topics-by-category">            
     <h1> <?= $category->getName() ?></h1>
        <button><a href="index.php?ctrl=forum&action=addTopicForm&id=<?= $category->getId()?>">Créer un sujet !</a></button>

        <?php if(isset($topics)) { ?>
            <?php foreach($topics as $topic) { ?>
        <div class="topic">
            <div class="question-topic">
                <div class="topic-user"> 
                    <p><?= $topic->getUser()->getPseudo()." le ". $topic->getTopicCreation(); ?></p>
                </div>
                <div class="content-topic">
                    <p><a href="index.php?ctrl=forum&action=detailTopic&id=<?= $topic->getId()?>"><?= $topic->getTitle(); ?></a></p>
                </div>
            </div>
        </div>
            <?php } 
        } else { ?>
            <div class="no-topic">
                <p>Soyez le premier à créer un sujet dans cette catégorie !</p>
            </div>
        <?php } ?> 
</section>
