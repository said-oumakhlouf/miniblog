<?php

class Comment
{
    private $_id;
    private $_id_post;
    private $_author;
    private $_content_comment;
    private $_date_comment;
    private $_signal_comment;

    public function __construct(array $donnees)
    {
        foreach ($donnees as $key => $value)
        {
            $method = 'set'.ucfirst($key);

            if (method_exists($this, $method))
            {
                $this->$method($value);
            }
        }
    }

    // Liste des getters

    public function id() {return $this->_id;}
    public function id_post(){return $this->_id_post;}
    public function author(){return $this->_author;}
    public function content_comment(){return $this->_content_comment;}
    public function date_comment(){return $this->_date_comment;}
    public function signal_comment(){return $this->_signal_comment;}

    //Liste des setters

    public function setId($id)
    {
        $id = (int) $id;
        if ($id > 0)
        {
            $this->_id = $id;
        }
    }

    public function setId_post($id_post)
    {
        $id_post = (int) $id_post;
        if ($id_post > 0)
        {
            $this->_id_post = $id_post;
        }
    }

    public function setAuthor($author)
    {
        if (is_string($author))
        {
            $this->_author = $author;
        }
    }

    public function setContent_comment($content_comment)
    {
        if (is_string($content_comment))
        {
            $this->_content_comment = $content_comment;
        }
    }

    public function setDate_comment($date_comment)
    {
        if (is_string($date_comment))
        {
            $this->_date_comment = $date_comment;
        }
    }

    public function setSignal_comment($signal_comment)
    {
        $signal_comment = (int) $signal_comment;
        if ($signal_comment >= 0)
        {
            $this->_signal_comment = $signal_comment;
        }
    }

}
