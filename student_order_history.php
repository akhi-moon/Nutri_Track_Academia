<?php
$current_page = basename($_SERVER['PHP_SELF']);
session_start();
include 'db_connection.php';

if (!isset($_SESSION['meal_cn'])) {
    header("Location: login.php");
    exit();
}

$meal_cn = $_SESSION['meal_cn'];
$orders = [];
$error_message = "";
$has_searched = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $has_searched = true;
    $search_input = mysqli_real_escape_string($connection, $_POST['search_input']);

    $check_query = "
        SELECT * FROM order_info
        WHERE order_id = '$search_input'
           OR order_date = '$search_input'
           OR meal_cn = '$search_input'
    ";
    $check_result = mysqli_query($connection, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        $valid_query = "
            SELECT 
                oi.order_id,
                oi.order_date,
                oi.total_price,
                od.item_name,
                od.quantity,
                od.item_price
            FROM order_info oi
            JOIN order_detail od ON oi.order_id = od.order_id
            WHERE (
                oi.order_id = '$search_input' OR 
                oi.order_date = '$search_input' OR 
                oi.meal_cn = '$search_input'
            )
            WHERE '$meal_cn' = oi.meal_cn
            ORDER BY oi.order_date DESC, oi.order_id DESC
        ";
        $result = mysqli_query($connection, $valid_query);

        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $orders[] = $row;
            }
        } else {
            $error_message = "You cannot access this order history.";
        }
    } else {
        $error_message = "The Order ID / Date / Meal Card Number is incorrect.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Student Order History - Nutri Track</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
    />
    <link href="https://fonts.googleapis.com/css?family=Sofia" rel="stylesheet" />
    <style>
      @import url("https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700&display=swap");

      :root {
        --white: #ffffff;
        --black: #000000;

        --green: white;
        --green-light-opacity: rgba(0, 0, 0, 0.5);
      }

      * {
        margin: 0;
        padding: 0;
        outline: none;
        list-style-type: none;
        box-sizing: border-box;
      }

      html,
      body {
        font-size: 62.5%; /* font-size = 10px */
      }
      body {
        background-image: url('images/nice 1.jpg');
        background-size: cover;
        color: black;
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        align-items: center;
      }
      .navbar {
        display: flex;
        align-items: center;
        height: 6.5rem;
        padding: 1rem;
        width: 90%; /* better responsive width */
        max-width: 1680px;
        background-color: rgba(48, 48, 46, 0.9);
        border: 1px solid var(--white);
        border-radius: 50px;
        box-shadow: var(--shadow-black);
        font-family: "Sofia", sans-serif;
        margin: 30px 0 20px 0;
      }

      .navbar-icons {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: space-around;
      }

      .appearence-btn {
        height: fit-content;
        width: 0.5rem;
        right: 4rem;
        font-size: 1.5rem;
        top: 4rem;
        cursor: pointer;
        background-color: transparent;
        border-radius: 35px;
        border: none;
      }
      .navbar-icon {
        flex: 20%;
        display: flex;
        align-items: center;
        justify-content: space-evenly;
        text-decoration: none;
        cursor: pointer;
        border-radius: 35px;
        padding: 1.1rem 2rem 1.1rem 1.3rem;
        color: white;
      }

      .navbar-icon i {
        font-size: 2rem;
        color: var(--green-dark);
      }

      .navbar-icon a span {
        opacity: 0;
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--green);
        margin-left: -12rem;
        transition: opacity 0.1s ease, margin-left 0.5s ease;
        font-family: "Sofia", sans-serif;
        white-space: nowrap; /* Prevent text wrapping */
      }

      .active.navbar-icon a {
        display: flex;
        align-items: center;
        border-radius: 35px;
        width: auto;
        background-color: var(--green-light-opacity);
        padding: 1.1rem 2rem 1.1rem 1.3rem;
      }

      .active.navbar-icon i {
        color: var(--green);
      }

      .active.navbar-icon span {
        opacity: 1;
        font-size: 20px;
        margin-left: 1.5rem;
        font-family: "Sofia", sans-serif;
      }
      #ntac_logo {
        height: 50px;
        width: 50px;
        clip-path: circle();
        margin-right: 20px;
        margin-left: 10px;
      }
      .navbar h1 a {
        font-size: 22px;
        font-family: "Sofia", sans-serif;
        color: #ffffff;
        text-decoration: none;
      }
      .icon-section {
        margin-left: 500px;
        width: 700px;
        margin-bottom: -12px;
      }

      h2 {
        text-align: center;
        color: white;
        font-size: 36px;
        margin: 30px auto 20px auto;
        font-weight: bold;
        text-shadow: 2px 2px 6px #2f2f2f;
        border: 2px solid #2f2f2f;
        padding: 15px 30px;
        border-radius: 10px;
        background-color: rgba(0, 0, 0, 0.5);
        width: fit-content;
        font-family: "Sofia", sans-serif;
      }

      .form-container {
        text-align: center;
        margin-bottom: 25px;
      }

      .form-container input[type="text"] {
        padding: 10px;
        width: 300px;
        border-radius: 5px;
        border: 1px solid #aaa;
      }

      .form-container input[type="submit"] {
        padding: 10px 20px;
        background-color: #444;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
      }

      .form-container .prompt {
        margin-top: 15px;
        color: black;
        font-style: italic;
      }

      .error-message {
        text-align: center;
        color: red;
        font-weight: bold;
        margin-top: 10px;
      }

      table {
        width: 90%;
        margin: 20px auto;
        border-collapse: collapse;
        background-color: white;
      }

      th,
      td {
        padding: 12px;
        border: 1px solid #ccc;
        text-align: center;
        font-size: 20px;
      }

      th {
        background-color: #2f2f2f;
        color: white;
      }
      #search_bar{
    color: gray; /* Optional: adjust placeholder color */
    opacity: 0.7;
    width: 300px;
    height: 60px;
    font-size: 20px;
    text-align: center;
  }

  #search_button {
    border-radius: 30px;
    width: 100px;
    height: 50px;
    font-size: 20px;
    border-color: slategray;
  }
    </style>
</head>
<body>
    <nav class="navbar">
        <img id="ntac_logo" src="images/ntac_logo.jpeg" alt="NTAC Logo" />
        <h1><a href="home.php">Nutri-Track Academia</a></h1>
        <div class="icon-section">
            <ul class="navbar-icons">
                <li class="navbar-icon <?= ($current_page == 'meal_menu.php') ? 'active' : '' ?>">
                    <i class="fa-regular fa-clipboard"></i><i class="fa-solid fa-utensils"></i>
                    <a href="meal_menu.php"><span>MealMenu</span></a>
                </li>

                <li class="navbar-icon <?= ($current_page == 'drinks_menu.php') ? 'active' : '' ?>">
                    <i class="fa-regular fa-clipboard"></i><i class="fa-solid fa-mug-hot"></i>
                    <a href="drinks_menu.php"><span>DrinksMenu</span></a>
                </li>

                <li class="navbar-icon <?= ($current_page == 'bmi_bmr.php') ? 'active' : '' ?>">
                    <i class="fa-solid fa-calculator"></i><i class="fa-solid fa-receipt"></i>
                    <a href="bmi_bmr.php"><span>BMI/BMR_Calculation</span></a>
                </li>

                <li class="navbar-icon <?= ($current_page == 'student_order_history.php') ? 'active' : '' ?>">
                    <i class="fa-solid fa-receipt"></i>&nbsp;
                    <i class="fa-solid fa-clock-rotate-left"></i>
                    <a href="student_order_history.php"><span>Order History</span></a>
                </li>

                <li class="navbar-icon <?= ($current_page == 'stu_logout.php') ? 'active' : '' ?>">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    <a href="stu_logout.php"><span>Logout</span></a>
                </li>
            </ul>
        </div>
    </nav>

    <h2>Student Order History - Nutri Track</h2>

    <div class="form-container">
        <form method="POST" action="" >
            <input type="text" name="search_input" placeholder="Enter Order ID / Date / Meal Card No"  id="search_bar" required />
            <input type="submit" value="Search" id="search_button"/>
        </form>

        <?php if (!$has_searched): ?>
        <div class="prompt" style="font-size: 20px;">Enter your Order ID / Date / Meal Card No to view your order history.</div>
        <?php endif; ?>

        <?php if ($has_searched && !empty($error_message)): ?>
        <div class="error-message"><?= htmlspecialchars($error_message) ?></div>
        <?php endif; ?>
    </div>

    <?php if (!empty($orders)): ?>
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Order Date</th>
                <th>Item Name</th>
                <th>Quantity</th>
                <th>Item Price</th>
                <th>Total Price</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
            <tr>
                <td><?= htmlspecialchars($order['order_id']) ?></td>
                <td><?= htmlspecialchars($order['order_date']) ?></td>
                <td><?= htmlspecialchars($order['item_name']) ?></td>
                <td><?= htmlspecialchars($order['quantity']) ?></td>
                <td><?= htmlspecialchars($order['item_price']) ?> Tk</td>
                <td><?= htmlspecialchars($order['total_price']) ?> Tk</td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>

    <script>
      let links = document.querySelectorAll(".navbar-icon");
      const navbar = document.querySelector(".navbar");
      let isDark = false;
      const clearActive = () => {
        for (link of links) link.classList.remove("active");
      };

      for (link of links) {
        link.onmouseover = function () {
          clearActive();
          this.classList.add("active");
        };
      }
    </script>
</body>
</html>
