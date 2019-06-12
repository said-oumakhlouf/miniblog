<!DOCTYPE html>
<html>
<title>
    <?= htmlspecialchars_decode($post->title()); ?>
</title>
<?php ob_start(); ?>
<div class="news">
    <div class="post_container">
        <div class="header">
            <div class="title"><i class="fas fa-snowflake"></i>
                <?= htmlspecialchars_decode($post->title()); ?>
            </div>
            <div class="date_creation"><i class="far fa-calendar-alt"></i>le
                <?php echo date("d-m-Y", strtotime($post->date_creation())) ?>
                <?php ?> à
                <?php echo date("H:i", strtotime($post->date_creation())) ?>
                <?php ?>
            </div>
        </div>
        <div class="content">
            <p>
                <?php echo $post->content(); ?>
            </p>
        </div>
    </div>
</div>

<div class="comments">
    <div class="comments_head">
        <span><i class="fa fa-comment"></i>
            <?php echo $commentManager->countComments($post->id()); ?> commentaires</span>
    </div>

    <?php
    for ($i = 0; $i < count($comments); $i++) { ?>
        <div class="comments_header">
            <div class="author"><i class="far fa-user"></i><strong>
                    <?php echo $comments[$i]->author(); ?></strong>
            </div>
            <div class="date"><i class="far fa-calendar-alt"></i>le
                <?php echo date("d-m-Y", strtotime($comments[$i]->date_comment())); ?> à
                <?php echo date("H:i", strtotime($comments[$i]->date_comment())); ?>
            </div>
        </div>
        <div class="comments_content">
            <p>
                <?php echo nl2br($comments[$i]->content_comment()); ?>
            </p>
            <form action="index.php?action=post&postId=<?php echo $post->id(); ?>" method="post">
                <input type="hidden" name="id" value="<?php echo $comments[$i]->id(); ?>">
                <input type="hidden" name="signal_comment" value="1">
                <?php $signal = $comments[$i]->signal_comment();
                if ($signal != 0) { ?>
                    <input type="submit" value="Commentaire signalé" disabled>
                <?php
            } else {
                ?>
                <span title="Signaler ce commentaire">
                    <button class='btn btn-danger'><i class="fas fa-exclamation-triangle"></i></button>
                </span>
                <?php
            }
            ?>
            </form>
        </div>
    <?php
}
?>
</div>

<div class="comment_form">
    <form action="index.php?action=post&postId=<?php echo $post->id(); ?>" method="post">
        Nom
        <input type="text" name="author" value=""><br>
        Commentaire
        <textarea name="content_comment" value=""></textarea><br>
        <input type="hidden" name="id_post" value="<?php echo $post->id(); ?>">
        <input type="submit" value="Envoyer" />
    </form>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>

</html>