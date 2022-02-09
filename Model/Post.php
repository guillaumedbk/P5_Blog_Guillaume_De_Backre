<?php

class Post
{
    private $_id;
    private $_userId;
    private $_title;
    private $_chapo;
    private $_content;
    private $_lastUpdate;

    //Constructor
    public function __construct(array $data)
    {
        $this->hydrate($data);
    }
    //Hydrate
    public function hydrate(array $data)
    {
        foreach ($data as $key => $value)
        {
            $method = 'set'.ucfirst($key);

            if(method_exists($this, $method))
                $this->$method($value);
        }
    }
    //Setters
    public function setId($id)
    {
        $id = (int) $id;
        if($id>0)
            $this->_id = $id;
    }
    public function setUserId($userId)
    {
        $this->_userId = $userId;
    }
    public function setTitle($title)
    {
        if(is_string($title))
            $this->_title = $title;
    }
    public function setChapo($chapo)
    {
        if(is_string($chapo))
            $this->_chapo = $chapo;
    }
    public function setContent($content)
    {
        $this->_content = $content;
    }
    public function setLastUpdate($date)
    {
        $this->_lastUpdate = $date;
    }
    //Getters
    public function getId()
    {
        return $this->_id;
    }
    public function getUserId()
    {
        return $this->_userId;
    }
    public function getTitle()
    {
        return $this->_title;
    }
    public function getChapo()
    {
        return $this->_chapo;
    }
    public function getContent()
    {
        return $this->_content;
    }
    public function getLastUpdate()
    {
        return $this->_lastUpdate;
    }



}