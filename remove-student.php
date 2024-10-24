<?php
    include 'db.php';

    if (isset($_GET['id'])) {
        $removeID = $_GET['id'];

        $deleteSQL = "DELETE FROM students WHERE studid = :studid";
        $stmt = $dbconnection->prepare($deleteSQL);
        $stmt->bindParam(':studid', $removeID);

        if ($stmt->execute()) {
            header("Location: admin/display-students.php");
            exit();
        } else {
            echo "Error removing student: " . $stmt->errorInfo()[2];
        }
    } else {
        echo "Student ID not provided for removal.";
    }
?>
