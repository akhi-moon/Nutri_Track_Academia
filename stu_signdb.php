<?php
include 'db_connection.php';


// Get form data
$stu_name = $_POST['stu_name'];
$email = $_POST['email'];
$password = $_POST['password'];
$conf_password = $_POST['conf_password'];
$varsity_pin = $_POST['varsity_pin'];
$department = $_POST['department'];
$semester = $_POST['semester'];
$student_id = $_POST['student_id'];

// Validate the passwords match
if ($password !== $conf_password) {
    header("Location: invalid_pass.php");
    exit();
}

// Check if the student already exists in the student_record table
$checkQuery = "SELECT * FROM student_record 
               WHERE stu_name = '$stu_name' 
               AND email = '$email' 
               AND department = '$department' 
               AND semester = '$semester' 
               AND student_id = '$student_id' 
               AND varsity_pin = '$varsity_pin'";

$checkResult = mysqli_query($connection, $checkQuery);

if (mysqli_num_rows($checkResult) > 0) {

    // NEW CHECK: student_id must be unique in stu_info
$idCheckQuery = "SELECT * FROM stu_info WHERE student_id = '$student_id'";
$idCheckResult = mysqli_query($connection, $idCheckQuery);

if (mysqli_num_rows($idCheckResult) > 0) {
    header("Location: invalid_id.php");
    exit();
}

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    // Insert data into the stu_info table
    $sql = "INSERT INTO stu_info 
            (stu_name, email, password, department, semester, student_id, varsity_pin) 
            VALUES 
            ('$stu_name', '$email', '$hashed_password', '$department', '$semester', '$student_id', '$varsity_pin')";

if (mysqli_query($connection, $sql)) {
    // Generate the Meal Card Number (MCN)
    $meal_cn = "MC" . substr($student_id, -3) . substr($varsity_pin, -3);

    // Update the stu_info table with the generated Meal Card Number
    $updateSql = "UPDATE stu_info 
                  SET meal_cn = '$meal_cn' 
                  WHERE student_id = '$student_id' AND email = '$email'";

    if (mysqli_query($connection, $updateSql)) {
        // Redirect to MC_provided.php with the MCN
        header("Location: MC_provided.php?meal_cn=$meal_cn");
        exit();
    } else {
        echo "Error updating meal card number: " . mysqli_error($connection);
    }
} else {
    echo "Error: " . mysqli_error($connection);
}
}  else {
    header("Location: invalid.php?");
    exit();
}

// Close the database connection
mysqli_close($connection);
?>
