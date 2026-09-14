<?php
// Start the session and include necessary files
include 'db_connection.php';
session_start(); // Start or resume the session

// Check if the form data is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $user_name = $_POST['user_name'];
    $log_password = $_POST['log_password'];

    // Validate inputs
    if (empty($user_name) || empty($log_password)) {
        header("Location: invalid.php"); // Redirect if inputs are empty
        exit();
    }

    // Establish database connection
    $connection = mysqli_connect("localhost", "root", "", "nutri_track");

    if (!$connection) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    // Use prepared statements to prevent SQL injection
    $query = "SELECT * FROM admin_info WHERE user_name = ?";
    $stmt = mysqli_prepare($connection, $query);

    if (!$stmt) {
        // Handle error in preparing the statement
        die("Statement preparation failed: " . mysqli_error($connection));
    }

    mysqli_stmt_bind_param($stmt, "s", $user_name);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Check if the user exists
    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Verify password (adjust depending on your actual password storage)
        if ($log_password === $user['password']) { // Plain-text comparison
            // Set session variables
            $_SESSION['user_name'] = $user['user_name']; // Use the value from the database
            header("Location: meal_menu_editing.php"); // Redirect to the meal menu page
            exit();
        } else {
            header("Location: invalid_pass.php"); // Redirect on invalid password
            exit();
        }
    } else {
        header("Location: invalid_username.php"); // Redirect on invalid meal card number
        exit();
    }

    // Close database connection
    mysqli_close($connection);
} else {
    // Redirect if the request method is not POST
    header("Location: admin_invalid.php");
    exit();
}
?>
