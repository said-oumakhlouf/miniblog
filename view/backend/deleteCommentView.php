<!DOCTYPE html>
<html>
<?php $title = "Supprimer un commentaire"; ?>
<?php ob_start(); ?>
<div class="news">
    <div class="comments">
        <div class="comments_head">
            <span><i class="fa fa-comment"></i>Commentaires signalés</span>
        </div>
        <?php
        for ($i = 0; $i < count($signaledcomments); $i++) 
        {
            ?>
            <div class="comments_header">
                <div class="author"><strong><i class="far fa-user"></i>
                        <?php echo $signaledcomments[$i]->author(); ?></strong> </div>
            </div>
            <div class="comments_content">
                <p>
                    <?php echo $signaledcomments[$i]->content_comment(); ?>
                </p>
                <form method="post">
                    <input type="hidden" name="id_delete" value="<?php echo $signaledcomments[$i]->id(); ?>">
                    <input type="submit" value="Supprimer" />
                </form>
                <form method="post">
                    <input type="hidden" name="id_ignore" value="<?php echo $signaledcomments[$i]->id(); ?>">
                    <input type="submit" value="Ignorer" />
                </form>
            </div>
        <?php
    }
    ?>
    </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>

</html>