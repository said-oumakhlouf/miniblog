<!DOCTYPE html>
<html>
<?php $title = "Billet simple pour l'Alaska"; ?>
<?php ob_start(); ?>


<div class="lastPost">
    <h2>Les trois derniers Articles publiés :</h2>
</div>
<div class="news">
    <?php for ($i = 0; $i < count($posts); $i++) {
        ?>
        <div class="post_container">
            <div class="header">
                <div class="title"><a href="index.php?action=post&postId=<?= $posts[$i]->id(); ?>"><span><i class="fas fa-snowflake"></i>
                            <?= $posts[$i]->title(); ?></span></a></div>
                <div class="date_creation"><span><i class="far fa-calendar-alt"></i>
                        <?= date("d-m-Y H:i", strtotime($posts[$i]->date_creation())) ?>
                        <?php ?></span></div>
            </div>
            <div class="content">
                <p>
                    <?= substr($posts[$i]->content(), 0, 100) . '...'; ?>
                    <a href="index.php?action=post&postId=<?= $posts[$i]->id(); ?>">Lire la suite</a>
                </p>
            </div>
            
            <div class="comment">
                <a href="index.php?action=post&postId=<?= $posts[$i]->id(); ?>" title="Voir le post et les commentaires"><i class="far fa-comment"></i>
                    <?= $commentManager->countComments($posts[$i]->id()); ?> commentaire(s)</a>
            </div>
        </div>
    <?php
}
?>
</div>
<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>

</html>