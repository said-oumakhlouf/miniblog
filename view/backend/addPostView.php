<!DOCTYPE html>
<html>
<?php $title = "Ajouter un article"; ?>
<?php ob_start(); ?>

<script src='https://devpreview.tiny.cloud/demo/tinymce.min.js'></script>
<script>
    tinymce.init({
        selector: '#mytextarea',
        height: "400px"
    });
</script>

<body>
    <div class="edit_page">
        <div class="edit">
            <form method="post" action="">
                <input type="text" name="titlepost" value="Titre de l'article"><br>
                <textarea id="mytextarea" name="content"></textarea>
                <input type="submit" value="Envoyer">
            </form>
        </div>
    </div>
</body>

<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>

</html>