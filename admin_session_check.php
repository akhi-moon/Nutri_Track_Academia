<?php
session_start();
if (!isset($_SESSION['user_name'])) {
    header("Location: admin_signin.php?error=session_expired");
    exit();
}
$user_name = $_SESSION['user_name']; // You can now safely use $meal_cn
?>
