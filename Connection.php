<?php

/**
 * Class Connection
 */
class Connection
{
    private $_host = 'localhost';
    private $_username = 'root';
    private $_password = 'wika1983';
    private $_database = 'test';
    
    /**
     * @var mysqli
     */
    protected $db;
    
    /**
     * Connection constructor.
     */
    public function __construct()
    {
        if (!isset($this->db)) {
            $this->db = new mysqli($this->_host, $this->_username, $this->_password, $this->_database);
            
            if (!$this->db) {
                echo 'Cannot connect to database server';
                exit;
            }
        }
        
        return $this->db;
    }
    
    /**
     * @return bool|string
     */
    public function getError()
    {
        if (isset($this->db)) {
            return $this->db->connect_error;
        }
    
        return false;
    }
}
?>
