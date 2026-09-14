<?php

include 'db_connection.php';

include 'admin_session_check.php';

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Ensure the session variable `user_name` is set
if (!isset($_SESSION['user_name'])) {
    die("User is not logged in.");
}

$admin_name = $_POST['admin_name'];
$admin_email= $_POST['admin_email'];
$user_name = $_POST['user_name'];
$Mobile_Number = $_POST['Mobile_Number'];
$Permanent_Address = $_POST['Permanent_Address'];


// Ensure student_id is set
if (empty($user_name)) {
    die("Error: username is not set or is empty.");
}

// Fetch the current image name
$query = "SELECT profile_photo FROM admin_info WHERE user_name='$user_name'";
$result = mysqli_query($connection, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($connection));
}

$row = mysqli_fetch_assoc($result);
$currentImage = $row ? $row['profile_photo'] : null;

// Debug: Show current image
echo "Current image in database: $currentImage<br>";

// Handle the uploaded image
if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] == 0) {
    echo "File detected for upload: " . $_FILES['profile_photo']['name'] . "<br>";

    $profile_photo = $_FILES['profile_photo'];
    $profile_photoTmpName = $profile_photo['tmp_name'];
    $profile_photoSize = $profile_photo['size'];
    $profile_photoType = strtolower(pathinfo($profile_photo['name'], PATHINFO_EXTENSION));

    // Allowed file types
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

    if (in_array($profile_photoType, $allowedTypes)) {
        if ($profile_photoSize <= 5000000) { // 5MB limit
            $newprofile_photoName = uniqid('', true) . "." . $profile_photoType;
            $uploadPath = 'images/profile_photos/' . $newprofile_photoName;

            if (move_uploaded_file($profile_photoTmpName, $uploadPath)) {
                echo "New image uploaded to: $uploadPath<br>";

                // Delete the old image
                if (!empty($currentImage)) {
                    $oldFilePath = 'images/profile_photos/' . $currentImage;
                    if (file_exists($oldFilePath)) {
                        if (unlink($oldFilePath)) {
                            echo "Old image deleted successfully.<br>";
                        } else {
                            die("Failed to delete old image: $oldFilePath<br>");
                        }
                    } else {
                        echo "Old image not found: $oldFilePath<br>";
                    }
                }

                $currentImage = $newprofile_photoName; // Update current image to the new one
            } else {
                die("Failed to upload new image. Check folder permissions.");
            }
        } else {
            die("Image size exceeds 5MB.");
        }
    } else {
        die("Invalid file type. Allowed types: JPG, JPEG, PNG, GIF.");
    }
} else {
    echo "No new image uploaded; using existing image: $currentImage<br>";
}

// Update the database record
$sql = "UPDATE admin_info SET 
    admin_name='$admin_name', 
    admin_email='$admin_email',
    user_name='$user_name', 
    Mobile_Number='$Mobile_Number', 
    Permanent_Address='$Permanent_Address', 
    profile_photo='$currentImage' 
WHERE user_name='$user_name'";

echo "SQL Query: $sql<br>";

if (mysqli_query($connection, $sql)) {
    echo "Database updated successfully.<br>";
    header("location:update_admin.php"); // Redirect to form_new.php
    exit;
} else {
    die("Database update failed: " . mysqli_error($connection));
}

// Close the database connection
mysqli_close($connection);
?>
