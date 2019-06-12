<!DOCTYPE html>
<html>
<?php $title="Changer de mot de passe"; ?>
<?php ob_start(); ?>

<body>
    <div class="admin_page">
        <div class="admin">
            <?php $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

            if (strpos($fullUrl, "password_match=yes") == true ) {
                echo "<p>Le mot de passe a été modifié</p>";
            }
            elseif (strpos($fullUrl, "password_match=no") == true ) {
                echo "<p>Les mots de passe ne correspondent pas</p>";
            }
            ?>
            <form method="post">
                <input type="text" name="id" value="<?php echo $admin['id'] ?>" hidden><br>
                    <p>Nouveau mot de passe</p>
                    <p><input type="password" name="password" class="form"><br></p>
                    <p>Confirmez votre mot de passe</p>
                    <p><input type="password" name="password_confirm" class="form"><br></p>
                <input type="submit" value="Envoyer">
            </form>
        </div>
    </div>
</body>

<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>

</html>
