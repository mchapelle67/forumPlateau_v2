<?php
    $topics = $result["data"]['topics']; 
    $posts = $result["data"]["posts"]
?>

<div class="frame-2">
</div>

<sections class="list-topics"> 
    <h1>Dernières <span class="red-word-h1">publications</span>.</h1>
        <button><a href="">Voir sujet par contenus</a></button>
        <?php foreach($topics as $topic) { ?>
        <div class="topic">
            <h2> <?= $topic->getCategory(); ?></h2>
            <div class="question-topic">
                <div class="topic-user"> 
                    <p><?= $topic->getUser()->getPseudo()." le ". $topic->getTopicCreation(); ?></p>
                </div>
                <div class="content-topic">
                    <p><?= $topic->getTitle(); ?></p>
                </div>
            </div>
            <?php } 
                foreach ($posts as $post) { ?>
                <div class="topic-answer">
                    <div class="topic-user"> 
                        <p><?= $post->getUser(); ?></p>
                    </div>
                    <div class="content-topic">
                        <p><?= $post->getText(); ?><p>
                    </div>
              </div>
            <?php } ?>
            <div class="post">
                <h3>COMMENTER</h3>
            </div>
        </div>
</section>
