<?php
include 'db_connection.php';
include 'session_check.php';

session_destroy(); // Destroy the session
header('Location: stu_sign_log.php'); // Redirect to the login page
exit();
?>