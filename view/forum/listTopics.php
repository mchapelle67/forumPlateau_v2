<?php
    $topics = $result["data"]['topics']; 

?>

<div class="frame-2">
</div>

<sections class="list-topics"> 
    <h1>Dernières <span class="red-word-h1">publications</span>.</h1>
        <?php foreach($topics as $topic) { ?>
        <div class="topic">
            <h2> <?= $topic->getCategory(); ?></h2>
            <div class="question-topic">
                <div class="topic-user"> 
                    <p><?= $topic->getUser()->getPseudo()." le ". $topic->getTopicCreation(); ?></p>
                </div>
                <div class="content-topic">
                    <p><a href="index.php?ctrl=forum&action=detailTopic&id=<?= $topic->getId() ?>"><?= $topic->getTitle(); ?></a></p>
                </div>
            </div>
            <?php } ?>
        </div>
</section>
