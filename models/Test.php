<?php

include_once '../config/Data.php';
include_once 'Model.php';

class Test extends Data implements Model
{
    public $tableName = 'model';
    
    public $tablePrimaryKey = 'id';

//    function attributes()
//    {

//    }
    
    function getTableName()
    {
        return 'model';
    }
    
    function getTablePrimaryKey()
    {
        return $this->tablePrimaryKey;
    }
    
    function getTableFields()
    {
        return [
            $this->getTablePrimaryKey() => 'chavePrimaria',
            'title' => 'title',
            'description' => 'description'
        ];
    }
}

$test = new Test();
//$result = $test->findOne(1);
//$result = $test->findAll();

/*echo ((string)__line__ . '-' . __file__ . '<br>');
echo ('<pre>');
//print_r($test->getTableFields());
print_r($result);
echo ('</pre>');
//die;*/

// DELETE OK
//$eita = $result->delete();

$test->title = 'CARACA';
$test->description = 'partiu!';

echo ((string)__line__ . '-' . __file__ . '<br>');
echo ('<pre>');
print_r($test->save());
echo ('</pre>');
die;