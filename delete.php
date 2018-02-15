<?php

include_once("config/Data.php");

$data = new Data();

$id = $_GET['id'];

$result = $data->run("DELETE FROM users WHERE id = $id");

if ($result) {
	header("Location:index.php");
}
?>

