<?php
require_once 'db.php';
header('Content-type: application/json');

if(isset($_GET['collegeID'])){
    $collegeID = filter_var($_GET['collegeID'], FILTER_SANITIZE_NUMBER_INT);

    $sql = "SELECT progid, progfullname FROM programs 
            WHERE progcollid = :collid";

    $stmt = $dbconnection->prepare($sql);
    $stmt->bindParam(':collid', $collegeID, PDO::PARAM_INT);
    $stmt->execute();

    $programs = $stmt->fetchAll(PDO::FETCH_NUM);

    echo json_encode($programs);
} else {
    echo json_encode([]);
}
?>
