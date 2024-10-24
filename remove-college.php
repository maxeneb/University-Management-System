<?php

include 'db.php';

if (isset($_GET['id'])) {
    $removeID = $_GET['id'];
} else {
    echo "No college ID specified for removal.";
    exit();
}

$checkDepartmentsSQL = "SELECT COUNT(*) FROM departments WHERE deptcollid = :collid";
$stmtCheckDepartments = $dbconnection->prepare($checkDepartmentsSQL);
$stmtCheckDepartments->bindParam(':collid', $removeID);
$stmtCheckDepartments->execute();
$departmentCount = $stmtCheckDepartments->fetchColumn();

if ($departmentCount > 0) {
    $deleteDepartmentsSQL = "DELETE FROM departments WHERE deptcollid = :collid";
    $stmtDeleteDepartments = $dbconnection->prepare($deleteDepartmentsSQL);
    $stmtDeleteDepartments->bindParam(':collid', $removeID);

    if ($stmtDeleteDepartments->execute()) {
        $deleteCollegeSQL = "DELETE FROM colleges WHERE collid = :collid";
        $stmtDeleteCollege = $dbconnection->prepare($deleteCollegeSQL);
        $stmtDeleteCollege->bindParam(':collid', $removeID);

        if ($stmtDeleteCollege->execute()) {
            header("Location: admin/display-colleges.php");
            exit();
        } else {
            echo "Error removing college: " . $stmtDeleteCollege->errorInfo()[2];
        }
    } else {
        echo "Error removing related departments: " . $stmtDeleteDepartments->errorInfo()[2];
    }
} else {
    $deleteCollegeSQL = "DELETE FROM colleges WHERE collid = :collid";
    $stmtDeleteCollege = $dbconnection->prepare($deleteCollegeSQL);
    $stmtDeleteCollege->bindParam(':collid', $removeID);

    if ($stmtDeleteCollege->execute()) {
        header("Location: admin/display-colleges.php");
        exit();
    } else {
        echo "Error removing college: " . $stmtDeleteCollege->errorInfo()[2];
    }
}

?>
