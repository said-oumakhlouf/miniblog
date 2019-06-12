<!DOCTYPE html>
<html>
    <?php $title="Ajouter un post"; ?>
    <?php ob_start(); ?>

    <script src='https://devpreview.tiny.cloud/demo/tinymce.min.js'></script>
    <script>
        tinymce.init({
            selector: '#mytextarea'
        });
    </script>

    <body>
        <div class="edit_page">
            <div class="edit">
                <form method="post">
                    <input type="text" name="idPostEdit" value="<?php echo $post->id() ?>" hidden>
                    <input type="text" name="titlePostEdit" value="<?php echo $post->title() ?>"><br>
                    <textarea id="mytextarea" name="contentPostEdit"><?php echo preg_replace('/(<[^>]+) style=".*?"/i', '$1', $post->content()) ?></textarea>
                    <input type="submit"  value="Envoyer">
                </form>
            </div>
        </div>
    </body>

    <?php $content = ob_get_clean(); ?>
    <?php require('view/template.php'); ?>
</html>
