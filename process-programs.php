<?php
include 'db.php';

$progID = '';
$progFullName = '';
$progShortName = '';
$progCollID = '';

if (isset($_GET['edit'])) {
    $editID = $_GET['edit'];

    $sql = "SELECT * FROM programs WHERE progid = :progid";
    $stmt = $dbconnection->prepare($sql);
    $stmt->bindParam(':progid', $editID);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $progID = $row['progid'];
    $progFullName = $row['progfullname'];
    $progShortName = $row['progshortname'];
    $progCollID = $row['progcollid'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $progID = $_POST['progID'];
    $progFullName = $_POST['progfullname'];
    $progShortName = $_POST['progshortname'];
    $progCollID = $_POST['college'];
    $progDeptID = $_POST['department'];

    if (!preg_match("/^[0-9]+$/", $progID) || (!preg_match("/^[A-Za-z.'\s\-]+$/", $progFullName)) || (!preg_match("/^[A-Za-z.'\s\-]+$/", $progShortName))) {
        session_start();
        $_SESSION['program_error'] = "Please enter a valid input.";
        header("Location: program-entry.php");
        exit();
    } else {
        $checkSQL = "SELECT * FROM programs WHERE progid = :progID";
        $stmt = $dbconnection->prepare($checkSQL);
        $stmt->bindParam(':progID', $progID);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $updateSQL = "UPDATE programs SET
            progfullname = :progfullname,
            progshortname = :progshortname,
            progcollid = :progcollid
            progcolldeptid = :progdeptid
            WHERE progid = :progID";

            $stmt = $dbconnection->prepare($updateSQL);
        } else {
            $insertSQL = "INSERT INTO programs (progid, progfullname, progshortname, progcollid, progcolldeptid)
            VALUES (:progID, :progfullname, :progshortname, :progcollid, :progdeptid)";

            $stmt = $dbconnection->prepare($insertSQL);
        }

        $stmt->bindParam(':progID', $progID);
        $stmt->bindParam(':progfullname', $progFullName);
        $stmt->bindParam(':progshortname', $progShortName);
        $stmt->bindParam(':progcollid', $progCollID);
        $stmt->bindParam(':progdeptid', $progDeptID);

        try {
            if ($stmt->execute()) {
                header("Location: admin/display-programs.php");
                exit();
            } else {
                echo "Error saving program information: " . $stmt->errorInfo()[2];
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}

?>