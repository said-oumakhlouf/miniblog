<!DOCTYPE html>
<html>
    <?php $title="Changer d'email'"; ?>
    <?php ob_start(); ?>

    <body>
        <div class="admin_page">
            <div class="admin">
                <form method="post">
                    <p>Nouvelle adresse email</p>
                    <p><input type="email" name="email" class="form"><br></p>
                    <input type="submit" value="Envoyer" name="EMAIL_EDIT">
                </form>
            </div>
        </div>
    </body>

    <?php $content = ob_get_clean(); ?>
    <?php require('view/template.php'); ?>

</html>
