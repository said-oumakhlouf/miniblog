<!DOCTYPE html>
<html>
<?php $title="Admin"; ?>
<?php ob_start();?>

<div class="admin_page">
    <div class="admin">
        <p>Entrez votre nom d'utilisateur et votre mot de passe</p>
        <form action="index.php?action=admin" method="post">
            <?php $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

            if (strpos($fullUrl, "id_error=yes") == true ) {
                echo "<p>L'identifiant ou le mot de passe est faux<br>";
            }
            ?>
            <p>
                <input type="text" name="user" value="user" class="form" /><br>
                <input type="password" name="password" value="password" class="form" /><br>
                <input type="submit" value="LOGIN" name="login-submit"/>
            </p>
        </form>
        <p><a href="index.php?action=tempPassword">Mot de passe oublié ?</a></p>
    </div>
</div>

<?php
$content = ob_get_clean();
require('view/template.php');
?>

</html>
