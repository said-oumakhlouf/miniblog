<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <title>
        <?= $title ?>
    </title>
    <link href="public/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
</head>

<body>
    <header>
        <nav>
            <div class="logo">
                <ul>
                    <li><a href="index.php"><i class="fas fa-home"></i><span class="home"> Accueil</span></a></li>
                    <li><a href="index.php?action=listPosts&page=1"><i class="far fa-newspaper"></i><span class="home"> Articles</span></a></li>
                </ul>
            </div>
            <ul>
                <div class="dropdown">
                    <li><a class="dropbtn" href="index.php?action=admin"><i class="far fa-user"></i><span class="home"> Admin</span></a></li>
                    <?php
                    if (isset($_SESSION['admin'])) {
                        ?>
                        <div id="myDropdown" class="dropdown-content">
                            <a href="index.php?action=globalView">Vue globale</a>
                            <a href="index.php?action=addPost">Ajouter un article</a>
                            <a href="index.php?action=editPost&page=1">Modifier un article</a>
                            <a href="index.php?action=deleteComment">Modérer les commentaires</a>
                            <a href="index.php?action=editPassword">Modifier le mot de passe</a>
                            <a href="index.php?action=editEmail">Modifier votre email</a>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <?php
                if (isset($_SESSION['admin'])) {
                    ?>
                    <li>
                        <a href="index.php?action=logout"><i class="fas fa-power-off"></i><span class="home"> Déconnexion</span></a>
                    </li>
                <?php
                }
                ?>
            </ul>
        </nav>
    </header>

    <?= $content ?>

    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
    <script src="public/js/nav.js"></script>
    <script src="public/js/navpage.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>