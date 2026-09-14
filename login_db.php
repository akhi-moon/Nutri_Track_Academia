<?php
// Start the session and include necessary files
include 'db_connection.php';
session_start(); // Start or resume the session

// Check if the form data is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $meal_cn = $_POST['meal_cn'];
    $log_password = $_POST['log_password'];

    // Validate inputs
    if (empty($meal_cn) || empty($log_password)) {
        header("Location: invalid.php"); // Redirect if inputs are empty
        exit();
    }

    // Establish database connection
    $connection = mysqli_connect("localhost", "root", "", "nutri_track");

    if (!$connection) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    // Use prepared statements to prevent SQL injection
    $query = "SELECT * FROM stu_info WHERE meal_cn = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "s", $meal_cn);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Check if the user exists
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Verify password
        if (password_verify($log_password, $user['password'])) {
            // Set session variables
            $_SESSION['meal_cn'] = $user['meal_cn']; // Use the value from the database
            header("Location: meal_menu.php"); // Redirect to the meal menu page
            exit();
        } else {
            header("Location: invalid_pass.php"); // Redirect on invalid password
            exit();
        }
    } else {
        header("Location: invalid_mc.php"); // Redirect on invalid meal card number
        exit();
    }

    // Close database connection
    mysqli_close($connection);
} else {
    // Redirect if the request method is not POST
    header("Location: invalid.php");
    exit();
}
?>
