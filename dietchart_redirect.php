<?php
session_start();

if (!isset($_SESSION['adjusted_tdi']) || !isset($_SESSION['stu_name']) || !isset($_SESSION['diet_date'])) {
    die("Required session data missing.");
}

$tdi = $_SESSION['adjusted_tdi'];
$name = urlencode($_SESSION['stu_name']);
$date = $_SESSION['diet_date'];

if ($tdi >= 1200 && $tdi < 1600) {
    header("Location: dietchart_low.php?name={$name}&tdi={$tdi}&date={$date}");
    exit();
} elseif ($tdi >= 1600 && $tdi < 1900) {
    header("Location: dietchart_mid.php?name={$name}&tdi={$tdi}&date={$date}");
    exit();
} elseif ($tdi >= 1900 && $tdi < 2300) {
    header("Location: dietchart_high.php?name={$name}&tdi={$tdi}&date={$date}");
    exit();
} elseif ($tdi >= 2300 && $tdi <= 2700) {
    header("Location: dietchart_veryhigh.php?name={$name}&tdi={$tdi}&date={$date}");
    exit();
} else {
    header("Location: nodietchart.php");
    exit();
}
