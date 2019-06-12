<!DOCTYPE html>
<html>
<?php $title="Vue globale"; ?>
<?php ob_start();

 if (isset($_SESSION['admin'])){ ?>
<div class="admin_page">
    <div class="admin">
        <p><a href="index.php?action=globalView">Vue globale</a></p>
        <p><a href="index.php?action=addPost">Ajouter un article</a></p>
        <p><a href="index.php?action=editPost&page=1">Modifier un article</a></p>
        <p><a href="index.php?action=deleteComment">Modérer les commentaires</a></p>
        <p><a href="index.php?action=editPassword">Modifier le mot de passe</a></p>
        <p><a href="index.php?action=editEmail">Modifier votre email</a></p>
    </div>
</div>
<?php
    }
    $content = ob_get_clean();
    require('view/template.php');
    ?>

</html>
