<?php
require_once 'db.php';
header('Content-type: application/json');

$collegeID = isset($_GET['collegeID']) ? $_GET['collegeID'] : null;

if ($collegeID) {
    $sql = "SELECT deptid, deptfullname FROM departments WHERE deptcollid = :collegeID";
    $departments = $dbconnection->prepare($sql);
    $departments->bindParam(':collegeID', $collegeID, PDO::PARAM_INT);
    $departments->execute();
    $rows = $departments->fetchAll();
} else {
    $sql = "SELECT deptid, deptfullname FROM departments";
    $departments = $dbconnection->prepare($sql);
    $departments->execute();
    $rows = $departments->fetchAll();
}

$json = json_encode($rows);
echo $json;
?>
