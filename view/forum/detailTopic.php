<?php
    $topic = $result["data"]['topic']; 
    $posts = $result["data"]["posts"];
    $closed = $result["data"]["closed"];

?>

<section class="list-topics">
    <h1><?= $topic->getCategory() ?></h1>
        <div class="question-topic topic-detail">
            <h2><?= $topic->getUser()->getPseudo()." le ". $topic->getTopicCreation(); ?></h2>
            <div class="title-topic">        
            <p> <?= $topic->getTitle(); ?></p>
                <?php if ((App\Session::isAdmin()) && App\Session::getUser() || App\Session::getUser() == $topic->getUser()) { ?>
                    <div class="admin-fonctions">   
                        <a href="index.php?ctrl=security&action=updateTopicForm&id=<?= $topic->getId() ?>"><img src="public/img/icones/bouton-modifier.png"></a>
                        <a href="index.php?ctrl=security&action=deleteTopic&id=<?= $topic->getId() ?>"><img src="public/img/icones/poubelle.png"></a>
                    </div>    
                <?php } ?>
            </div>    
        </div> 

        <div class="post-topics">    
            
            <?php if((empty($posts)) && ($closed === 1)){ ?>
                <p>Soyez le premier à commenter !</p>
                <?php } elseif ((empty($posts)) && ($closed === 0)) { ?>
                    <p>Pas de commentaire.</p>
                <?php } else { ?> 
                    <?php foreach($posts as $post) { ?>
                        <div class="post-topic">
                            <h3><?= $post->getUser()->getPseudo()." le ".$post->getCreationPost($id) ?></h3>
                            <div class="title-topic">   
                                <p><?= $post->getText() ?></p> 
                                    <?php if ((App\Session::isAdmin()) && (App\Session::getUser())|| (App\Session::getUser()) == ($topic->getUser())) { ?>
                                        <div class="admin-fonctions">   
                                            <a href="index.php?ctrl=security&action=deletePost&id=<?= $post->getId() ?>"><img src="public/img/icones/poubelle.png"></a>
                                        </div>
                            </div>       
                                    <?php } ?>   
                        </div>
                <?php } 
            } ?>
                <form action="index.php?ctrl=forum&action=addPost&id=<?= $topic->getId()?>" method="POST">
                    <div class="comments-space">
                    <?php if(($closed) === 1) { ?>
                        <textarea id="post" name="post" placeholer>Commenter ...</textarea>
                            <button type="submit" value><img src="public/img/icones/send.png" alt="illustration d'un avion en papier"></button>
                    <?php } else { ?>
                            <div class="comments-space closed-topic"><textarea id="post" name="post" placeholer>SUJET CLOS.</textarea>
                                <button type="submit" value><img src="public/img/icones/send.png" alt="illustration d'un avion en papier"></button>
                            </div>
                    <?php } ?>
                    </div>
                </form>
            </div>
        </div> 
</section>
