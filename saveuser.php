<?php
session_start();
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['user'];
    $password = password_hash($_POST['pass'], PASSWORD_BCRYPT);
    $sql = "insert into users values(null,?,?)";

    $prep = $dbconnection->prepare($sql);

    $prep->bindParam(1, $username);
    $prep->bindParam(2, $password);

    $result = $prep->execute();

    if ($result) {
        $_SESSION['alert_message'] = "Successfully registered!";
        header("Location: admin/register.php");
        exit();
    }
}