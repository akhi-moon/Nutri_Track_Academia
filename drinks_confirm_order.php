<?php
include 'db_connection.php';
include 'session_check.php';

$meal_cn = $_SESSION['meal_cn'] ?? null;
if (!$meal_cn) {
    die('Error: Meal card number is not set in the session.');
}

// Define menu time ranges in minutes
$drinksStart = 7 * 60; // 7:00 AM
$drinksEnd = 16 * 60 + 30; // 04:30 PM

// Validate active menu type

    // Re-determine active menu type based on current time
    date_default_timezone_set('Asia/Dhaka');
    $currentMinutes = (int) date('H') * 60 + (int) date('i');

    if ($currentMinutes >= $drinksStart && $currentMinutes < $drinksEnd) {
        $activeMenuType = 'drinks';
    }

    if (!$activeMenuType) {
        die('Error: No menu is active at this time.');
    }


// Get form data
$quantities = $_POST['quantity'] ?? [];
//$activeMenuType = $_POST['activeMenuType'] ?? null; // Get active menu type from the form
$order_date = date('Y-m-d');
$total_price = 0;

// Validate active menu type
if (!$activeMenuType) {
    die('Error: Active menu type is not set.');
}

// Generate a unique order_id
$date_prefix = date('dmy');
$query = "SELECT COUNT(*) AS order_count FROM order_info WHERE order_date = '$order_date'";
$result = mysqli_query($connection, $query);

if (!$result) {
    die('Error fetching order count: ' . mysqli_error($connection));
}

$order_count = mysqli_fetch_assoc($result)['order_count'];
$date_prefix = date('dmy');
$unique_suffix = time() % 1000; // Add a unique suffix based on the current time
$order_id = "O" . $date_prefix . str_pad($unique_suffix, 3, '0', STR_PAD_LEFT);

// Insert order into `order_info` table
foreach ($quantities as $item_id => $quantity) {
    if ($quantity > 0) {
        // Get item price
        $query = "SELECT item_name, item_price FROM `$activeMenuType` WHERE item_id = '$item_id'";
        $result = mysqli_query($connection, $query);
        
        if (!$result) {
            die('Error fetching item details: ' . mysqli_error($connection));
        }

        $item = mysqli_fetch_assoc($result);


        $item_name = $item['item_name'];
        $item_price = $item['item_price'];

        // Calculate total price for this item
        $total_price += $item_price * $quantity;

        // Insert order details
        $insertQuery = "
            INSERT INTO order_detail (order_id, item_id, item_name, item_price, quantity) 
            VALUES ('$order_id', '$item_id', '$item_name', '$item_price', '$quantity')";
        if (!mysqli_query($connection, $insertQuery)) {
            die('Error inserting order details: ' . mysqli_error($connection));
        }
    }
}

// Insert order summary
$insertOrderQuery = "
    INSERT INTO order_info (meal_cn, order_id, order_date, total_price) 
    VALUES ('$meal_cn', '$order_id', '$order_date', '$total_price')";
if (!mysqli_query($connection, $insertOrderQuery)) {
    die('Error inserting order summary: ' . mysqli_error($connection));
}

// Redirect to confirmation page
header("Location: drinks_order_confirm.php?order_id=$order_id");
exit();
?>

