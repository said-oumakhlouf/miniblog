<!DOCTYPE html>
<html>
    <?php $title="Mot de passe temporaire"; ?>
    <?php ob_start(); ?>

    <body>
        <div class="admin_page">
            <div class="admin">
                <form action="index.php?action=tempPassword" method="post">
                    <?php $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

                    if (strpos($fullUrl, "mail_sent=no") == true ) {
                        echo "<p>Ce n'est pas le mail de l'administrateur.</p>";
                    }
                    ?>
                    <p>
                        <input type="email" name="email" value="email" class="form" /><br>
                        <input type="submit" value="Demander un mot de passe provisoire" name="EMAIL_RESET"/>
                    </p>
                </form>

            </div>
        </div>
    </body>

    <?php $content = ob_get_clean(); ?>
    <?php require('view/template.php'); ?>

</html>
