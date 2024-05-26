<?php
include_once("MysqliDb.php");

$db = new Mysqlidb('localhost', 'root', '', 'iportal');

$id = $db->insert('contest', $_POST);
if($id){

	echo "success";
}
