<?php

include_once("config/Data.php");

$data = new Data();

$query = "SELECT * FROM users ORDER BY id DESC";
$result = $data->run($query);
?>
