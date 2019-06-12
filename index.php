<?php
require('controller/controller.php');

if (isset($_GET['action'])) {

    //frontend
    if ($_GET['action'] == 'listPosts') {
        $page = $_GET['page'];
        if ($page>0){
            listPosts($page);
        }
        else {
            listPosts(1);
        }
    }
    elseif ($_GET['action'] == 'post') {
        if (isset($_GET['postId']) && $_GET['postId'] > 0) {
            post();
        }
        else {
            echo 'Erreur : aucun identifiant de billet envoyé';
        }
    }

    //backend
    elseif ($_GET['action'] == 'admin') {
        admin();
    }
    elseif ($_GET['action'] == 'addPost') {
            addPost();
        }
    elseif ($_GET['action'] == 'editPost') {
        $page = $_GET['page'];
        editPost($page);
    }
    elseif ($_GET['action'] == 'editPostForm') {
        if (isset($_GET['id']) && $_GET['id'] > 0){
            editPostForm();
        }
        else{
            echo 'Erreur : aucun identifiant de billet envoyé';
        }
    }
    elseif ($_GET['action'] == 'deleteComment') {
        deleteComment();
    }
    elseif ($_GET['action'] == 'signaledComments') {
        signaledComments();
    }
    elseif ($_GET['action'] == 'logout') {
        logout();
    }
    elseif ($_GET['action'] == 'editPassword') {
        editPassword();
    }
    elseif ($_GET['action'] == 'deletePost') {
        $id=$_GET['id'];
        goDeletePost($id);
    }
    elseif ($_GET['action'] == 'globalView') {
        globalView();
    }
    elseif( $_GET['action'] == 'tempPassword'){
        tempPassword();
    }
    elseif( $_GET['action'] == 'editEmail'){
        editEmail();
    }
}
else {
    lastPosts();
}

