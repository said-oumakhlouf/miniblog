<?php
session_start();
require('model/PostManager.php');
require('model/CommentManager.php');
require('model/AdminManager.php');
require('config/Db.php');
use  PHPMailer\PHPMailer\PHPMailer;

//FRONTEND
// Affiche la liste d'article
function listPosts($page)
{
    $postManager = new PostManager($_ENV["DB"]);
    $pagenumber = $page - 1;
    $posts = $postManager->getPosts($pagenumber);
    $pages_count = $postManager->countPages();
    $commentManager = new CommentManager($_ENV["DB"]);
    require('view/frontend/indexView.php');
}
// Affiche les dernier articles
function lastPosts()
{
    $postManager = new PostManager($_ENV["DB"]);
    $posts = $postManager->getLastPosts();
    $commentManager = new CommentManager($_ENV["DB"]);
    require('view/frontend/accueilView.php');
}
// Affiche un article
function post()
{
    $postManager = new PostManager($_ENV["DB"]);
    $post = $postManager->getPost($_GET['postId']);
    $commentManager = new CommentManager($_ENV["DB"]);
    if (isset($_POST['id_post']) && isset($_POST['author']) && isset($_POST['content_comment'])) 
    {
        $postId = $_POST['id_post'];
        $author = htmlspecialchars($_POST['author']);
        $content_comment = htmlspecialchars($_POST['content_comment']);
        $commentManager->addComment($postId, $author, $content_comment);
    }
    if (isset($_POST['signal_comment'])) 
    {
        $id = $_POST['id'];
        $commentManager->signalComment($id);
    }
    $comments = $commentManager->getComments($_GET['postId']);
    require('view/frontend/postView.php');
}
//backend
function admin()
{
    $adminManager = new AdminManager($_ENV["DB"]);
    $admin = $adminManager->connectAdmin();
    if (isset($_POST['login-submit'])) 
    {
        if (!isset($_POST['user']) or !isset($_POST['password']) or ($_POST['user'] != $admin['user'] or !password_verify($_POST['password'], $admin['password']))) 
        {
            ?>
            <script type="text/javascript">
                window.location.href = './index.php?action=admin&id_error=yes';
            </script>
        <?php
        } 
        else if ($_POST['user'] == $admin['user'] && password_verify($_POST['password'], $admin['password'])) 
        {
            $_SESSION['admin'] = $_POST['user'];
            require('view/backend/adminView.php');
        }
    } 
    else if (empty($_SESSION['admin']) and (!isset($_POST['login-submit']))) 
    {
        require('view/backend/adminConnect.php');
    } 
    else if (isset($_SESSION['admin'])) 
    {
        require('view/backend/adminView.php');
    }
}
// Edition d'un mot de passe en admin
function editPassword()
{
    if (empty($_SESSION['admin'])) 
    {
        header('Location: index.php');
        exit();
    } 
    else 
    {
        $adminManager = new AdminManager($_ENV["DB"]);
        $admin = $adminManager->connectAdmin();
        if (isset($_POST['password']) && isset($_POST['password_confirm']) && ($_POST['password']) == ($_POST['password_confirm'])) 
        {
            $id = $_POST['id'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $adminManager->editPassword($id, $password);
            header("location: index.php?action=editPassword&password_match=yes");
            exit();
        } 
        elseif (isset($_POST['password']) && isset($_POST['password_confirm']) && ($_POST['password']) != ($_POST['password_confirm'])) 
        {
            header("location: index.php?action=editPassword&password_match=no");
            exit();
        }
    }
    require('view/backend/editPasswordView.php');
}
// Déconnexion de l'admin
function logout()
{
    unset($_SESSION['admin']);
    header("location: index.php");
    exit();
}
// Ajout d'un article
function addPost()
{
    if (empty($_SESSION['admin'])) 
    {
        header('Location: index.php');
        exit();
    } 
    else 
    {
        $postmanager = new PostManager($_ENV["DB"]);
        if (isset($_POST['titlepost']) && $_POST['content']) 
        {
            $titlepost = $_POST['titlepost'];
            $content = $_POST['content'];
            $postmanager->addPost($titlepost, $content);
            header('Location: index.php');
            exit();
        }
        require('view/backend/addPostView.php');
    }
}
// Permet de supprimer un commentaire 
function deleteComment()
{
    if (empty($_SESSION['admin'])) 
    {
        header('Location: index.php');
        exit();
    } 
    else 
    {
        $commentManager = new CommentManager($_ENV["DB"]);
        if (isset($_POST['id_delete'])) 
        {
            $id = $_POST['id_delete'];
            $commentManager->deleteComment($id);
        }
        if (isset($_POST['id_ignore'])) 
        {
            $id = $_POST['id_ignore'];
            $commentManager->ignoreSignaledComment($id);
        }
        $signaledcomments = $commentManager->getSignaledComments();
        require('view/backend/deleteCommentView.php');
    }
}
// Permet d'éditer un article en admin 
function editPost($page)
{
    if (empty($_SESSION['admin'])) 
    {
        header('Location: index.php');
        exit();
    } 
    else 
    {
        $postManager = new PostManager($_ENV["DB"]);
        $pagenumber = $page - 1;
        $posts = $postManager->getPosts($pagenumber);
        $pages_count = $postManager->countPages();
        $commentManager = new CommentManager($_ENV["DB"]);
        if (isset($_POST['post_delete'])) 
        {
            $id = $_POST['post_delete'];
            $postManager->deletePost($id);
            header("Refresh:0");
        }
        require('view/backend/editPostView.php');
    }
}
function editPostForm()
{
    if (empty($_SESSION['admin'])) 
    {
        header('Location: index.php');
        exit();
    } 
    else 
    {
        $postmanager = new PostManager($_ENV["DB"]);
        if (isset($_GET['id'])) 
        {
            $id = $_GET['id'];
            $post = $postmanager->getPost($_GET['id']);
        }
        if (isset($_POST['titlePostEdit']) && isset($_POST['idPostEdit']) && isset($_POST['contentPostEdit'])) 
        {
            $id = $_POST['idPostEdit'];
            $titlepost = $_POST['titlePostEdit'];
            $content = $_POST['contentPostEdit'];
            $postmanager->editPost($id, $titlepost, $content);
            header('Location: index.php');
            exit();
        }
        require('view/backend/editPostFormView.php');
    }
}
// Permet de signaler un commentaire
function signaledComments()
{
    if (empty($_SESSION['admin'])) 
    {
        header('Location: index.php');
        exit();
    } 
    else 
    {
        $postManager = new PostManager($_ENV["DB"]);
        $post = $postManager->getPost($_GET['postId']);
        $commentManager = new CommentManager($_ENV["DB"]);
        if (isset($_POST['id_post']) && isset($_POST['author']) && isset($_POST['content_comment'])) 
        {
            $postId = $_POST['id_post'];
            $author = $_POST['author'];
            $content_comment = $_POST['content_comment'];
            $commentManager->addComment($postId, $author, $content_comment);
        }
        if (isset($_POST['signal_comment'])) 
        {
            $id = $_POST['id'];
            $commentManager->signalComment($id);
        }
        $comments = $commentManager->getComments($_GET['postId']);
        require('view/frontend/postView.php');
    }
}
// Permet de supprimer un article en admin
function goDeletePost($id)
{
    if (empty($_SESSION['admin'])) 
    {
        header('Location: index.php');
        exit();
    } 
    else 
    {
        $postManager = new PostManager($_ENV["DB"]);
        $commentManager = new CommentManager($_ENV["DB"]);
        $posts = $postManager->getAllPosts();
        $postManager->deletePost($id);
        header("Location: index.php");
        exit();
    }
    require('view/backend/globalView.php');
}
// Fait montrer une vue d'ensemble en mode admin
function globalView()
{
    if (empty($_SESSION['admin'])) 
    {
        header('Location: index.php');
        exit();
    } 
    else 
    {
        $postManager = new PostManager($_ENV["DB"]);
        $posts = $postManager->getAllPosts();
        $commentManager = new CommentManager($_ENV["DB"]);
    }
    require('view/backend/globalView.php');
}
// Permet de demander un password temporaire 
function tempPassword()
{ {
        $adminManager = new AdminManager($_ENV["DB"]);
        $temp_password = $adminManager->resetPassword();
        $user_mail = $adminManager->connectAdmin();
        $user_mail = $user_mail['mail'];
        if (isset($_POST['EMAIL_RESET'])) 
        {
            if ($_POST['email'] == $user_mail) 
            {
                include_once "PHPMailer/PHPMailer.php";
                include_once "PHPMailer/Exception.php";
                include_once "PHPMailer/SMTP.php";
                $mail = new PHPMailer();
                $mail->Host = "smtp.gmail.com";
                // $mail->isSMTP(); //à désactiver sur serveur
                $mail->SMTPAuth = true;
                $mail->Username = "blog.oumakhlouf.said@gmail.com";
                $mail->SMTPSecure = "ssl";
                $mail->SetFrom("lawwisss.23@gmail.com", "lewis", 0);
                $mail->AddAddress($user_mail);
                $mail->Port = 465;
                $subject = "Mot de passe provisoire";
                $mail->Subject = $subject;
                $body = "Votre mot de passe est " . $temp_password . ". Ce mot de passe est provisoire, il faut impérativement le modifier !";
                $mail->Body = $body;
                $mail->send();
            } 
            elseif ($_POST['email'] != $user_mail) 
            {
                header("location: index.php?action=tempPassword&mail_sent=no");
                exit();
            }
        } 
        elseif (!isset($_POST['EMAIL_RESET'])) { }
        require('view/backend/tempPasswordView.php');
    }
}
// Permet d'éditer son mail
function editEmail()
{
    if (empty($_SESSION['admin'])) 
    {
        header('Location: index.php');
        exit();
    } 
    else 
    {
        $adminManager = new AdminManager($_ENV["DB"]);
        $admin = $adminManager->connectAdmin();
        if (isset($_POST['EMAIL_EDIT'])) 
        {
            $id = $admin['id'];
            $email = $_POST['email'];
            $adminManager = new AdminManager($_ENV["DB"]);
            $adminManager->editEmail($id, $email);
        } 
        else { }
        require('view/backend/editEmailView.php');
    }
}