<?php

include_once 'Connection.php';

/**
 * Class Connection
 */
class Data extends Connection
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function run($query)
    {
        $result = $this->db->query($query);
        
        if ($result == false) {
            echo 'Fatal: ' . $this->getError();
            return false;
        } else {
            if (preg_match('/^SELECT/', $query)) {
                return $result->fetch_all(MYSQLI_ASSOC);
            }
            return true;
        }
    }
}
?>
