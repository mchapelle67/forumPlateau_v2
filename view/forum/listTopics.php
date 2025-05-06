<?php

    $category = $result["data"]['category']; 
    $topics = $result["data"]['topics']; 
    $users = $result["data"]['users'];
?>
<div class="frame-2">
    <img src="public/img/back/frame-2.png" alt="Mains qui se touchent dans une entraide collective avec la citation: toutes les idées, un seul lieu.">
</div>

<sections class="list-topics"> 
    <h1>Dernières publications.</h1>
    <div class="topic">
        <?php
        foreach($category as $categ ){ ?>
            <h2><?= $categ->getCategory() ?></h2>
            <?php } ?>
            <div class="question-topic">
                <div class="topic-user">
                <?php foreach($users as $user ){ ?>
                    <p><?= $topic->getUser() ?> le <!--date et heure--></p>
                <?php } ?>
                </div>
                <div class="content-topic">
                    <p><!--question --><p>
                </div>
            </div>
            <div class="topic-answer">
                <div class="topic-user"> 
                    <!-- refaire un foreach pour les commentaires avec  getMultipleResults-->
                    <p><?= $topic->getUser() ?> le <!--date et heure--></p>
                </div>
                <div class="content-topic">
                    <p><!--réponse --><p>
                </div>
            </div>
    </div>
</section>
