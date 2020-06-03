<?php
namespace Console\App\Models;
use Jajo\JSONDB;

class Model 
{
    private $db;
    private $db_path;

    function __construct()
    {
        $this->db = new JSONDB( __DIR__ . '\\..\\');
        $this->db_path = $this->getDBTablePath();
    }

    public function insert($json)
    {
        $this->db->insert($this->db_path, $json);
    }
    
    public function select($query = '*')
    {
        return $this->db->select($query)->from($this->db_path);
    }

    public function getName()
    {
        $path = explode('\\', get_called_class());
        return array_pop($path);
    }

    public function getModelSlug()
    {
        return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $this->getName())));
    }

    public function getDBTableName()
    {
        return $this->getModelSlug() .'s.json';
    }
    public function getDBTablePath()
    {
        return 'DB\\' . $this->getDBTableName();
    }

}