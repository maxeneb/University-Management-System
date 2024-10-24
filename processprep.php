<?php
require_once 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['user'];
    $password = $_POST['pass'];

    $sql = "SELECT * FROM users WHERE username = ?";
    $loginStatement = $dbconnection->prepare($sql);
    $loginStatement->bindParam(1, $username, PDO::PARAM_STR);
    $loginStatement->execute();

    $user = $loginStatement->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $user['username'];
        header("Location: admin/display-students.php");
        exit();
    } else {
        $_SESSION['error_message'] = "Invalid username or password";
        header("Location: admin/login.php?error=InvalidCredentials");
        exit();
    }
}
?>
