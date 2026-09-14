<?php
include 'db_connection.php';

include 'session_check.php';


// Determine the active menu based on the current time
date_default_timezone_set('Asia/Dhaka'); // Set timezone to your region
$currentTime = date('H:i');
$currentMinutes = (int) date('H') * 60 + (int) date('i');

// Define menu time ranges in minutes
$breakfastStart = 7 * 60; // 7:00 AM
$breakfastEnd = 10 * 60 + 30; // 10:30 AM
$snacksStart1 = 11 * 60; // 11:00 AM
$snacksEnd1 = 12 * 60 + 30; // 12:30 PM
$lunchStart = 13 * 60; // 1:00 PM
$lunchEnd = 14 * 60 + 30; // 2:30 PM
$snacksStart2 = 15 * 60; // 3:00 PM
$snacksEnd2 = 16 * 60 + 30; // 4:30 PM;

// Determine the active menu type
$activeMenuType = null;
if ($currentMinutes >= $breakfastStart && $currentMinutes < $breakfastEnd) {
    $activeMenuType = 'breakfast';
} elseif ($currentMinutes >= $snacksStart1 && $currentMinutes < $snacksEnd1) {
    $activeMenuType = 'snacks';
} elseif ($currentMinutes >= $lunchStart && $currentMinutes < $lunchEnd) {
    $activeMenuType = 'lunch';
} elseif ($currentMinutes >= $snacksStart2 && $currentMinutes < $snacksEnd2) {
    $activeMenuType = 'snacks';
}

// Fetch active menu data
if ($activeMenuType) {
    $query = "SELECT * FROM $activeMenuType";
    $menuData = mysqli_query($connection, $query);
} else {
    die('No menu available at this time.');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo ucfirst($activeMenuType); ?> Menu</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('images/edit.jpeg');
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            text-align: center;
        }

        h2 {
            color:white;
            margin-bottom: 20px;
        }
        .menu-image {
            width: 75%;
            height: auto;
            max-height: 200px;
            object-fit: cover;
            border-radius: 10px;
        }
        table {
            width: 80%;
            margin: 0 auto;
            border-collapse: collapse;
            background-color: black;
            border-radius: 8px;
            overflow: hidden;
            font-weight: bold;
        }

        th, td {
            padding: 15px;
            text-align: center;
            border: 1px solid black;
            border-width: 5px;
            border-radius: 20px;
        }

        th {
            background-color: #b4b4b3; /* Soft gray for headers */
            color: #1d1d1b; /* Charcoal text for contrast */
        }

        tr:nth-child(even) {
            background-color:#c7c7c6;
            color: black;
        }

        tr:nth-child(odd) {
            background-color: #d9d9d9;
            color: black;
        }

        select {
            padding: 5px;
            border-radius: 5px;
            border: 1px solid white;
            background-color: #333;
            color: #F2ECDD;
        }

        #total {
            margin-top: 20px;
            font-size: 1.2em;
            font-weight: bold;
            color: white;
        }

        .btn{
        margin-top: 15px;
        padding: 10px 20px;
        background-color: #686867; /* Neutral gray for buttons */
        color: #ececec; /* Light text */
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }

    .btn:hover {
        background-color: #8e8e8d; /* Slightly lighter gray on hover */
    }

    .btn:disabled {
        background-color: #565654; /* Darker gray for disabled */
        cursor: not-allowed;
    }
    </style>
    <script>
        function calculateTotal() {
            const prices = document.querySelectorAll('.item-price');
            const quantities = document.querySelectorAll('.quantity');
            let total = 0;
            for (let i = 0; i < prices.length; i++) {
                total += parseFloat(prices[i].dataset.price) * parseInt(quantities[i].value);
            }
            document.getElementById('total').innerText = `Total Price: ${total} TK`;
        }
    </script>
</head>
<body>
    <h2><?php echo ucfirst($activeMenuType); ?> Menu</h2>
    <form action="confirm_order.php" method="POST">
    <?php 
        // Display image based on menu type
        if ($activeMenuType == 'breakfast') {
            echo '<img src="images/breakfast_0.jpg" alt="Breakfast" class="menu-image">';
        } elseif ($activeMenuType == 'lunch') {
            echo '<img src="images/lunch_0.jpg" alt="Lunch" class="menu-image">';
        } elseif ($activeMenuType == 'snacks') {
            echo '<img src="images/snacks_0.jpg" alt="Snacks" class="menu-image">';
        }
    ?>
        <table>
            <tr>
                <th>Item</th>
                <th>Price</th>
                <th>Quantity</th>
            </tr>
            <?php while ($row = mysqli_fetch_array($menuData)): ?>
            <tr>
                <td><?php echo $row['item_name']; ?></td>
                <td class="item-price" data-price="<?php echo $row['item_price']; ?>"><?php echo $row['item_price']; ?> TK</td>
                <td>
                    <select name="quantity[<?php echo $row['item_id']; ?>]" class="quantity" onchange="calculateTotal()">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
        <p id="total">Total Price: 0 TK</p>
        <button class="btn btn-dark" type="submit">Confirm Order</button>
    </form>
</body>
</html>
