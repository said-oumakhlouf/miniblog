<?php

class Post
{
    private $_id;
    private $_title;
    private $_content;
    private $_date_creation;

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
    public function title(){return $this->_title;}
    public function content(){return $this->_content;}
    public function date_creation(){return $this->_date_creation;}


    //Liste des setters

    public function setId($id)
    {
        $id = (int) $id;
        if ($id > 0)
        {
            $this->_id = $id;
        }
    }

    public function setTitle($title)
    {
        if (is_string($title))
        {
        $this->_title = $title;
        }
    }

    public function setContent($content)
    {
        if (is_string($content))
        {
            $this->_content = $content;
        }
    }

    public function setDate_creation($date_creation)
    {
        if (is_string($date_creation))
        {
            $this->_date_creation = $date_creation;
        }
    }

}
