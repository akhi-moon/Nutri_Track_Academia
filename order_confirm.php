<?php
include 'db_connection.php';
include 'session_check.php';

// Define menu time ranges
date_default_timezone_set('Asia/Dhaka');
$currentMinutes = (int) date('H') * 60 + (int) date('i');

$activeMenuType = '';
if ($currentMinutes >= 420 && $currentMinutes < 630) {
    $activeMenuType = 'breakfast';
} elseif (($currentMinutes >= 660 && $currentMinutes < 750) || ($currentMinutes >= 900 && $currentMinutes < 990)) {
    $activeMenuType = 'snacks';
} elseif ($currentMinutes >= 780 && $currentMinutes < 870) {
    $activeMenuType = 'lunch';
} elseif ($currentMinutes >= 420 && $currentMinutes < 990) {
    $activeMenuType = 'drinks';
}

if (!$activeMenuType) {
    die('Error: No menu is active at this time.');
}

// Get order info
$order_id = $_GET['order_id'];
$meal_cn = $_SESSION['meal_cn'];

$query = "SELECT stu_name FROM stu_info WHERE meal_cn = '$meal_cn'";
$result = mysqli_query($connection, $query);
$student = mysqli_fetch_assoc($result);

$query = "SELECT * FROM order_detail WHERE order_id = '$order_id'";
$orderDetails = mysqli_query($connection, $query);

$query = "SELECT * FROM order_info WHERE order_id = '$order_id'";
$orderSummaryResult = mysqli_query($connection, $query);
$orderSummary = mysqli_num_rows($orderSummaryResult) > 0 ? mysqli_fetch_assoc($orderSummaryResult) : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Order Cart - Nutri Track</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">

  <style>
    body {
      background-image: url('images/nice 1.jpg');
      background-size: cover;
      background-position: center;
      background-attachment: fixed;
      font-family: Arial, sans-serif;
      margin: 0;
      padding-top: 80px;
      min-height: 100vh;
    }

    .navbar {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      display: flex;
      align-items: center;
      height: 6.5rem;
      padding: 1rem;
      background-color: rgba(48, 48, 46, 0.9);
      border: 1px solid #ffffff;
      border-radius: 0 0 20px 20px;
      z-index: 1000;
    }

    .navbar h1 a {
      font-size: 22px;
      font-family: "Sofia", sans-serif;
      color: #ffffff;
      text-decoration: none;
    }

    #ntac_logo {
      height: 50px;
      width: 50px;
      clip-path: circle();
      margin-right: 20px;
      margin-left: 10px;
    }

    .navbar-icons {
      flex: 1;
      display: flex;
      justify-content: flex-end;
    }

    .navbar-icon {
      display: flex;
      align-items: center;
      margin-left: 20px;
      padding: 10px 15px;
      border-radius: 30px;
      transition: background 0.3s;
    }

    .navbar-icon i {
      color: white;
      font-size: 18px;
      margin-right: 8px;
    }

    .navbar-icon a {
      color: white;
      font-size: 14px;
      text-decoration: none;
      font-family: "Sofia", sans-serif;
    }

    .navbar-icon:hover {
      background-color: rgba(255, 255, 255, 0.2);
    }

    .navbar-icon.active {
      background-color: rgba(0, 0, 0, 0.4);
    }

    .order-info-container {
      background-color: rgba(128, 128, 128, 0.6); /* Ashy semi-transparent */
      color: white;
      padding: 20px;
      border-radius: 15px;
      margin: 30px auto;
      width: 80%;
      text-align: center;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    }

    .order-info-container h1,
    .order-info-container h2,
    .order-info-container h3,
    .order-info-container h4 {
      margin: 10px 0;
      font-family: "Sofia", sans-serif;
    }

    table {
      margin: 30px auto;
      width: 95%;
      background-color: white;
      border-collapse: collapse;
      font-size: 1.6rem;
    }

    table, th, td {
      border: 1px solid #444;
    }

    th, td {
      padding: 12px;
      text-align: center;
    }

    th {
      background-color: #333;
      color: white;
    }

    .btn-dark {
      display: block;
      width: fit-content;
      margin: 20px auto;
      padding: 10px 20px;
      background-color: #222;
      color: white;
      text-decoration: none;
      border-radius: 5px;
    }

    .btn-dark:hover {
      background-color: #444;
    }
  </style>
</head>
<body>

  <nav class="navbar">
    <img id="ntac_logo" src="images/ntac_logo.jpeg">
    <h1><a href="home.php">Nutri-Track Academia</a></h1>
    <div class="navbar-icons">
      <li class="navbar-icon active">
        <i class="fa-solid fa-utensils"></i>
        <a href="meal_menu.php"><span>Meal Menu</span></a>
      </li>
      <li class="navbar-icon">
        <i class="fa-solid fa-mug-hot"></i>
        <a href="drinks_menu.php"><span>Drinks Menu</span></a>
      </li>
      <li class="navbar-icon">
        <i class="fa-solid fa-weight-scale"></i>
        <a href="bmi_bmr.php"><span>BMI/BMR</span></a>
      </li>
      <li class="navbar-icon">
        <i class="fa-solid fa-receipt"></i>
        <a href="student_order_history.php"><span>Order History</span></a>
      </li>
      <li class="navbar-icon">
        <i class="fa-solid fa-arrow-right-from-bracket"></i>
        <a href="stu_logout.php"><span>Logout</span></a>
      </li>
    </div>
  </nav>

  <!-- Order Info Container -->
  <div class="order-info-container">
    <h1>Order Confirmation</h1>
    <h2><?php echo $student['stu_name']; ?> (Meal Card: <?php echo $meal_cn; ?>)</h2>
    <h3>Order ID: <?php echo $order_id; ?></h3>
    <h4>Order Date: <?php echo $orderSummary ? $orderSummary['order_date'] : 'N/A'; ?></h4>
  </div>

  <table>
    <tr>
      <th>Item Name</th>
      <th>Price</th>
      <th>Quantity</th>
      <th>Subtotal</th>
    </tr>
    <?php 
      if ($orderDetails && mysqli_num_rows($orderDetails) > 0) {
        while ($row = mysqli_fetch_assoc($orderDetails)) {
          echo "<tr>
                  <td>{$row['item_name']}</td>
                  <td>{$row['item_price']} TK</td>
                  <td>{$row['quantity']}</td>
                  <td>" . ($row['item_price'] * $row['quantity']) . " TK</td>
                </tr>";
        }
      } else {
        echo "<tr><td colspan='4'>No order details available</td></tr>";
      }
    ?>
  </table>

  <h3 style="text-align: center; color: white;">Total Price: <?php echo $orderSummary ? $orderSummary['total_price'] . " TK" : 'N/A'; ?></h3>
  <a href="meal_menu.php" class="btn btn-dark">Back to Main</a>

</body>
</html>
