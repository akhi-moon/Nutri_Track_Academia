<?php
session_start();
if (!isset($_SESSION['meal_cn'])) {
    header("Location: stu_sign_log.php?error=session_expired");
    exit();
}
$meal_cn = $_SESSION['meal_cn']; // You can now safely use $meal_cn
?>
