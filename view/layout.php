<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="<?= $meta_description ?>">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <script src="https://cdn.tiny.cloud/1/zg3mwraazn1b2ezih16je1tc6z7gwp5yd4pod06ae5uai8pa/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        <!-- intégration police et icones -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous" />
        <link rel="stylesheet" href="<?= PUBLIC_DIR ?>/css/style.css">
        <title>FORUM</title>
    </head>
    <body>
        <div id="wrapper"> 
            <div id="mainpage">
                <!-- c'est ici que les messages (erreur ou succès) s'affichent-->
                <h3 class="message" style="color: red"><?= App\Session::getFlash("error") ?></h3>
                <h3 class="message" style="color: green"><?= App\Session::getFlash("success") ?></h3>
                <header>
                    <nav>
                        <div id="nav-left">
                            <img src="public/img/logo/logo.png" alt="logo">
                        </div>
                        <div id="nav-middle">
                            <a href="/">Accueil</a>
                            <a href="/">Derniers sujets</a>
                            <a href="/">Créer contenus</a>
                        </div>
                        <div id="nav-right">
                            <?php
                            if(App\Session::getUser()){                                 
                                $user = App\Session::getUser(); ?>
                            <p><?php echo "Bienvenue, ".$user->getPseudo()."."; ?></p>
                                <button class="burger-menu" aria-label="Menu">&#9776;</button>
                                    <ul class="menu">
                                        <!-- ajouter un SI admin pour l'espace -->
                                        <li><a href="">Espace admin</a></li>
                                        <li><button><a href="index.php?ctrl=security&action=logout">Se déconnecter</a></button></li>
                                    </ul>
                                        <img src="public/img/icones/user.svg" alt="logo admin"> 
                            <?php } ?>
                        </div>
                    </nav>
                </header>
                
                <main id="forum">
                    <?= $page ?>
                </main>
            </div>
            <footer>
                <div id="footer-left">
                    <img src="public/img/logo/logo.png" alt="logo">
                </div>
                <div id="footer-middle">
                    <div id="social-media">
                        <a target="_blank" href="https://www.instagram.com/"><img src="public/img/icones/instagram.svg" alt="logo instagram"></a>
                        <a target="_blank" href="https://www.facebook.com/"><img src="public/img/icones/facebook.svg" alt="logo facebook"></a>
                        <a target="_blank" href="https://x.com/"><img src="public/img/icones/twitter.svg" alt="logo twitter"></a>
                    </div>
                    <div id="legals-mentions">
                        <p >&copy; <?= date_create("now")->format("Y") ?> - <a href="#">Règlement du forum</a> - <a href="#">Mentions légales</a></p>
                    </div>
                </div>
                <div id="footer-right">
                    <p>Nous contacter</p>
                    <img src="public/img/icones/mail.svg" alt="logo mail">

                </div>
            </footer>
        </div>
        <script> 
        // pour que quand on clique sur le menu burger il puisse s'ouvrir 
            document.addEventListener("DOMContentLoaded", () => {
                const burger = document.querySelector(".burger-menu");
                const menu = document.querySelector(".menu");

                burger.addEventListener("click", () => {
                menu.classList.toggle("open");
                });
            });
        </script>
        <script
            src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous">
        </script>
        <script>
            $(document).ready(function(){
                $(".message").each(function(){
                    if($(this).text().length > 0){
                        $(this).slideDown(500, function(){
                            $(this).delay(3000).slideUp(500)
                        })
                    }
                })
                $(".delete-btn").on("click", function(){
                    return confirm("Etes-vous sûr de vouloir supprimer?")
                })
                tinymce.init({
                    selector: '.post',
                    menubar: false,
                    plugins: [
                        'advlist autolink lists link image charmap print preview anchor',
                        'searchreplace visualblocks code fullscreen',
                        'insertdatetime media table paste code help wordcount'
                    ],
                    toolbar: 'undo redo | formatselect | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',
                    content_css: '//www.tiny.cloud/css/codepen.min.css'
                });
            })
        </script>
        <script src="<?= PUBLIC_DIR ?>/js/script.js"></script>
    </body>
</html>