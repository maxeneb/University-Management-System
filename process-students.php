<?php
session_start();
include 'db.php';

$studID = '';
$studfirstname = '';
$studmidname = '';
$studlastname = '';
$studcollid = '';
$studprogid = '';
$studyear = '';


if (isset($_GET['edit'])) {
    $editID = $_GET['edit'];

    $sql = "SELECT * FROM students WHERE studid = :studid";
    $stmt = $dbconnection->prepare($sql);
    $stmt->bindParam(':studid', $editID);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $studID = $row['studid'];
    $studfirstname = $row['studfirstname'];
    $studmidname = $row['studmidname'];
    $studlastname = $row['studlastname'];
    $studcollid = $row['studcollid'];
    $studprogid = $row['studprogid'];
    $studyear = $row['studyear'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $studID = $_POST['studID'];
    $studfirstname = $_POST['fName'];
    $studmidname = $_POST['mName'];
    $studlastname = $_POST['lName'];
    $studcollid = $_POST['college'];
    $studprogid = $_POST['program'];
    $studyear = $_POST['year'];

    if (!preg_match("/^[0-9]+$/", $studID) || (!preg_match("/^[A-Za-z.'\s\-]+$/", $studfirstname)) || (!preg_match("/^[A-Za-z.'\s\-]+$/", $studmidname)) 
    || (!preg_match( "/^[A-Za-z.\'\-\s]+$/", $studlastname)) || !is_numeric($studyear) || $studyear < 1 || $studyear > 5) {
        $_SESSION['student_error'] = "Please enter a valid input.";
        header("Location: student-entry.php");
        exit();
    } else {
            $checkSQL = "SELECT * FROM students WHERE studid = :studID";
            $stmt = $dbconnection->prepare($checkSQL);
            $stmt->bindParam(':studID', $studID);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $updateSQL = "UPDATE students SET
                studfirstname = :studfirstname,
                studmidname = :studmidname,
                studlastname = :studlastname,
                studcollid = :studcollid,
                studprogid = :studprogid,
                studyear = :studyear
                WHERE studid = :studID";

                $stmt = $dbconnection->prepare($updateSQL);
            } else {
                $insertSQL = "INSERT INTO students (studid, studfirstname, studmidname, studlastname, studcollid, studprogid, studyear)
                VALUES (:studID, :studfirstname, :studmidname, :studlastname, :studcollid, :studprogid, :studyear)";

                $stmt = $dbconnection->prepare($insertSQL);
            }

            $stmt->bindParam(':studID', $studID);
            $stmt->bindParam(':studfirstname', $studfirstname);
            $stmt->bindParam(':studmidname', $studmidname);
            $stmt->bindParam(':studlastname', $studlastname);
            $stmt->bindParam(':studcollid', $studcollid);
            $stmt->bindParam(':studprogid', $studprogid);
            $stmt->bindParam(':studyear', $studyear);

            if ($stmt->execute()) {
                header("Location: admin/display-students.php");
                exit();
            } else {
                echo "Error saving user information: " . $stmt->errorInfo()[2];
            }
        }
    }

?>