<?php
    include 'db.php';

    if (isset($_GET['id'])) {
        $removeID = $_GET['id'];

        $deleteSQL = "DELETE FROM programs WHERE progid = :progid";
        $stmt = $dbconnection->prepare($deleteSQL);
        $stmt->bindParam(':progid', $removeID);

        if ($stmt->execute()) {
            header("Location: admin/display-programs.php");
            exit();
        } else {
            echo "Error removing program: " . $stmt->errorInfo()[2];
        }
    } else {
        echo "Program ID not provided for removal.";
    }
?>
