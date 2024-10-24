<?php
include 'db.php';

$collID = '';
$collfullname = '';
$collshortname = '';

if (isset($_GET['edit'])) {
    $editID = $_GET['edit'];

    $sql = "SELECT * FROM colleges WHERE collid = :collid";
    $stmt = $dbconnection->prepare($sql);
    $stmt->bindParam(':collid', $editID);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $collID = $row['collid'];
    $collfullname = $row['collfullname'];
    $collshortname = $row['collshortname'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $collID = $_POST['collID'];
    $collfullname = $_POST['collfullname'];
    $collshortname = $_POST['collshortname'];

    if (!preg_match("/^[0-9]+$/", $collID) || (!preg_match("/^[A-Za-z.'\s\-]+$/", $collfullname)) || (!preg_match("/^[A-Za-z.'\s\-]+$/", $collshortname))) {
        session_start();
        $_SESSION['college_error'] = "Please enter a valid input.";
        header("Location: college-entry.php");
        exit();
    } else {

        $checkSQL = "SELECT * FROM colleges WHERE collid = :collID";
        $stmt = $dbconnection->prepare($checkSQL);
        $stmt->bindParam(':collID', $collID);
        $stmt->execute();

        if (!is_numeric($collID)) {
            $_SESSION['invalid'] = "College ID should only contain numbers.";
            header("Location: college-entry.php?error=InvalidCredentials");
            exit();
        }
        if ($stmt->rowCount() > 0) {
            $updateSQL = "UPDATE colleges SET
            collfullname = :collfullname,
            collshortname = :collshortname
            WHERE collid = :collID";

            $stmt = $dbconnection->prepare($updateSQL);
        } else {
            $insertSQL = "INSERT INTO colleges (collid, collfullname, collshortname)
            VALUES (:collID, :collfullname, :collshortname)";
            $stmt = $dbconnection->prepare($insertSQL);
        }

        $stmt->bindParam(':collID', $collID);
        $stmt->bindParam(':collfullname', $collfullname);
        $stmt->bindParam(':collshortname', $collshortname);


        if ($stmt->execute()) {
            header("Location: admin/display-colleges.php");
            exit();
        } else {
            echo "Error saving college information: " . $stmt->errorInfo()[2];
        }
    }
}


?>