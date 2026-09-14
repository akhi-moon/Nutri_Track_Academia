<?php
include 'db_connection.php';

include 'session_check.php';

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


// Get order_id from the URL
$order_id = $_GET['order_id'];

// Get student details
$meal_cn = $_SESSION['meal_cn']; // Replace with your session variable
$query = "SELECT stu_name FROM stu_info WHERE meal_cn = '$meal_cn'"; // Assuming you have a `students` table
$result = mysqli_query($connection, $query);
$student = mysqli_fetch_assoc($result);

// Get order details
$query = "SELECT * FROM order_detail WHERE order_id = '$order_id'";
$orderDetails = mysqli_query($connection, $query);

// Get order summary
$query = "SELECT * FROM order_info WHERE order_id = '$order_id'";
$orderSummaryResult = mysqli_query($connection, $query);

if ($orderSummaryResult && mysqli_num_rows($orderSummaryResult) > 0) {
    $orderSummary = mysqli_fetch_assoc($orderSummaryResult);
} else {
    $orderSummary = null; // Set to null if no results
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
</head>
<body style="text-align:center; padding: 20px; color: white; background-color: #333;">
    <h1>Order Confirmation</h1>
    <h2><?php echo $student['stu_name']; ?> (Meal Card: <?php echo $meal_cn; ?>)</h2>
    <h3>Order ID: <?php echo $order_id; ?></h3>
    <h4>Order Date: 
        <?php 
        if ($orderSummary) {
            echo $orderSummary['order_date']; 
        } else {
            echo "N/A";
        }
        ?>
    </h4>
    <table style="margin: 20px auto; width: 80%; color: black; background: white; border: 1px;">
        <tr>
            <th>Item Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Subtotal</th>
        </tr>
        <?php 
        if ($orderDetails) {
            while ($row = mysqli_fetch_assoc($orderDetails)): ?>
                <tr>
                    <td><?php echo $row['item_name']; ?></td>
                    <td><?php echo $row['item_price']; ?> TK</td>
                    <td><?php echo $row['quantity']; ?></td>
                    <td><?php echo $row['item_price'] * $row['quantity']; ?> TK</td>
                </tr>
            <?php endwhile;
        } else {
            echo "<tr><td colspan='4'>No order details available</td></tr>";
        }
        ?>
    </table>
    <h3>Total Price: 
        <?php 
        if ($orderSummary) {
            echo $orderSummary['total_price'] . " TK";
        } else {
            echo "N/A";
        }
        ?>
    </h3>
    <a href="drinks_menu.php" class="btn btn-dark">Back to Main</a>
</body>
</html>
