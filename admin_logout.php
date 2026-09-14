<?php
include 'db_connection.php';
include 'admin_session_check.php';
session_destroy(); // Destroy the session
header('Location: admin_signin.php'); // Redirect to the login page
exit();
?>