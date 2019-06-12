<?php
require 'Post.php';
require 'config/Db.php';

class PostManager

{
    private $_db;

    public function __construct($db)
    {
        $this->setDb($db);
    }

    public function setDb(PDO $db)
    {
        $this->_db = $db;
    }

    public function getPosts($pagenumber)
    {
        $posts=[];
        $pagenumber = $pagenumber*5;
        $req = $this->_db->query('SELECT id, title, content, date_creation FROM posts ORDER BY date_creation DESC LIMIT '.$pagenumber.', 5;');
        while ($donnees = $req->fetch(PDO::FETCH_ASSOC))
        {
            $posts[] = new Post($donnees);
        }
        return $posts;
    }

    public function countPages()
    {
        $req = $this->_db->query('SELECT COUNT(*) FROM posts');
        $donnees = $req->fetch(PDO::FETCH_ASSOC);
        $pages_count=ceil($donnees['COUNT(*)']/5);
        return $pages_count;
    }

    public function getAllPosts()
    {
        $posts=[];
        $req = $this->_db->query('SELECT id, title, content, date_creation FROM posts ORDER BY date_creation DESC');

        while ($donnees = $req->fetch(PDO::FETCH_ASSOC))
        {
            $posts[] = new Post($donnees);
        }
        return $posts;
    }

    public function getPost($id)
    {
        $id = (int) $id;
        $req = $this->_db->query('SELECT id, title, content, date_creation FROM posts WHERE id = '.$id);
        $donnees = $req->fetch(PDO::FETCH_ASSOC);
        return new Post($donnees);
    }

    public function getLastPosts()
    {
        $req = $this->_db->query('SELECT * FROM posts ORDER BY id DESC LIMIT 3');
        while ($donnees = $req->fetch(PDO::FETCH_ASSOC))
        {
            $posts[] = new Post($donnees);
        }
        return $posts;

    }

    public function addPost($title, $content)
    {
        $date = date("Y-m-d H:i:s");
        $req = $this->_db->prepare('INSERT INTO posts(title, content, date_creation) VALUES(?, ?, ?)');
        $req->execute(array($title, $content, $date));
    }

    public function editPost($id, $title, $content)
    {
        $date = date("Y-m-d H:i:s");
        $querry = 'UPDATE posts SET title ="' .$title.'", content = "'.$content.'", date_creation = "'.$date.'" WHERE id=' .$id;
        $req = $this->_db->exec($querry);
    }

    public function deletePost($id)
    {
        $req = $this->_db->exec('DELETE FROM posts WHERE id=' .$id);
        $commentManager = new CommentManager($_ENV["DB"]);
        $commentManager->deletePostComments($id);
    }

}

