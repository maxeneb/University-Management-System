<?php 
require_once 'db.php';
header('Content-type: application/json');

$sql = "select * from colleges";

$colleges = $dbconnection->prepare($sql);
$colleges->execute();
$rows = $colleges->fetchAll();

$json = json_encode($rows);
echo $json;
?>