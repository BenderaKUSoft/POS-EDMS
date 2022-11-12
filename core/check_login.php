<?php

include ('../config/config.php');

error_reporting(0);
session_start();

$username = $_POST['username'];
$password = $_POST['pass'];
$check_session = $_SESSION['csrf_token'];

if (isset($check_session) == $_SESSION['csrf_token']) {
    $sql = "SELECT id FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($result);

    if ($row > 0) {
        $_SESSION['user_id'] = $row;
        $_SESSION['username'] = $username;
        $_SESSION['status'] = "login";

        header("Location: ../views/index.php?msg=login_success");
    } else {
        header("Location: ../?msg=failed");
    }
} else {
    header("Location: ../?msg=token_invalid");
}

?>