<!DOCTYPE html>
<html>
<?php $title="Admin"; ?>
<?php ob_start(); ?>

<div class="global_page">
    <div class="global">
        <table class="tg">
            <?php
            for ($i=0; $i<count($posts); $i++){?>
            <tr>
                <td><?= date("d-m-Y H:i",strtotime($posts[$i]->date_creation()));?></td>
                <td class="cell-hyphens"><a href="index.php?action=post&postId=<?= $posts[$i]->id(); ?>"><?php echo $posts[$i]->title();?></a></td>
                <td class="cell-hyphens"><?= strip_tags(substr($posts[$i]->content(),0,30))."...";?></td>
                <td><a href="index.php?action=editPostForm&id=<?= $posts[$i]->id();?>" title="Editer le post"> <i class="fas fa-pencil-alt"></i></a></td>
                <td><a href="index.php?action=deletePost&id=<?= $posts[$i]->id();?>" title="Supprimer le post"> <i class="fas fa-trash"></i></a></td>
                <td><a href="index.php?action=post&postId=<?= $posts[$i]->id(); ?>" title="Voir les commentaires"><?php echo $commentManager->countComments($posts[$i]->id()); ?> <i class="fa fa-comment"></i></a></td>
                <td><a href="index.php?action=deleteComment" title="Voir les commentaires signalés"><?php echo $commentManager->countSignaledComments($posts[$i]->id()); ?> <i class="fas fa-exclamation-triangle"></i></a></td>
            </tr>
            <?php } ?>
        </table>
    </div>
</div>

<?php
$content = ob_get_clean();
require('view/template.php');
?>

</html>
