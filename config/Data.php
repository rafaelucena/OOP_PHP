<?php

include_once 'Connection.php';

/**
 * Class Connection
 * @property $table
 * @property $primaryKey
 */
class Data extends Connection
{
    public $tableName = ':table_name:';
    
    public $tablePrimaryKey = ':table_pk:';
    
    /**
     * Data constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * @param $query
     * @return bool|mixed
     */
    public function run($query)
    {
        $result = $this->db->query($query);
        
        if ($result == false) {
            echo 'Fatal: ' . $this->getError();
            return false;
        } else {
            if (preg_match('/^SELECT/', $query)) {
                return $result;
//                return $result->fetch_all(MYSQLI_ASSOC);
            }
            return true;
        }
    }
    
    private function getQuery($single = true, $value = null)
    {
        $fields = array_keys($this->getTableFields());
        $fieldsString = implode(', ', $fields);

        $tableNameString = $this->getTableName();
        
        $tablePrimaryKeyString = $this->getTablePrimaryKey();
    
        if ($single) {
            if ($value && is_int($value)) {
                return "SELECT $fieldsString FROM $tableNameString WHERE $tablePrimaryKeyString = $value";
            } else {
                return false;
            }
        } else {
            return "SELECT $fieldsString FROM $tableNameString";
        }
    }
    
    public function findOne($value = 0)
    {
        $result = $this->run($this->getQuery(true, $value));

        $return = false;

        if ($result) {
            $return = clone $this;
            foreach($result->fetch_assoc() as $associatedKey => $associatedValue) {
                $return->$associatedKey = $associatedValue;
            }
        }
        
        return $return;
    }
    
    public function findAll()
    {
        $result = $this->run($this->getQuery(false));
        
        $return = array();
    
        foreach ($result->fetch_all(MYSQLI_ASSOC) as $output) {
            $arrayInput = clone $this;
        
            foreach($output as $associatedKey => $associatedValue) {
                $arrayInput->$associatedKey = $associatedValue;
            }
        
            $return[] = $arrayInput;
        }
        
        return $return;
    }
    
    public function save()
    {
        $tableNameString = $this->getTableName();
    
        $fields = array_keys($this->getTableFields());
        $fieldsString = implode(', ', $fields);
    
        $tablePrimaryKeyString = $this->getTablePrimaryKey();
        
        if (!$this->$tablePrimaryKeyString) {
            
            $valuesToInsert = array();
            $columnsToInsert = array();
            
            foreach ($fields as $field) {
                if ($this->$field) {
                    $valuesToInsert[] =  '"' . $this->$field . '"';
                    $columnsToInsert[] = $field;
                }
            }
    
            $columnsString = implode(', ', $columnsToInsert);
            $valuesToInsert = implode(', ', $valuesToInsert);
            
            $query = "INSERT INTO $tableNameString ($fieldsString) VALUES ($tablePrimaryKeyString)";
        } else {
            return false;
        }
    
        return $this->run($query);
    }
    
    public function delete()
    {
        $tableNameString = $this->getTableName();
    
        $tablePrimaryKeyString = $this->getTablePrimaryKey();
    
        if ($this->$tablePrimaryKeyString) {
            $value = $this->$tablePrimaryKeyString;
            
            $query = "DELETE FROM $tableNameString WHERE $tablePrimaryKeyString = $value";
        } else {
            return false;
        }
        
        return $this->run($query);
    }
}
?>
