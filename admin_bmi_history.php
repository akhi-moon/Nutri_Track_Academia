<?php 
include 'db_connection.php';
include 'admin_session_check.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$connection = mysqli_connect("localhost", "root", "", "nutri_track");

if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

$query = "SELECT * FROM health_metrics ORDER BY date DESC, num DESC";
$result = mysqli_query($connection, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Section</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
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
      font-family: Arial, sans-serif;
    }

    html, body {
      font-size: 62.5%;
    }

    body {
      display: flex;
      flex-direction: column;
      position: relative;
      height: 100%;
      width: 100%;
      background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('images/nice 4.jpg');
    }

    .navbar {
        display: flex;
        align-items: center;
        height: 6.5rem;
        padding: 1rem;
        margin-top: 25px;
        width: 100%;
        background-color: rgba(48, 48, 46, 0.9);
        border: 1px solid var(--white);
        border-radius: 50px;
        box-shadow: var(--shadow-black);
        font-family: "Sofia", sans-serif;
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
      }

      .active.navbar-icon a{
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
      #ntac_logo{
        height: 50px;
        width:50px;
        clip-path: circle();
        margin-right: 20px;
        margin-left: 10px;
      }
      .navbar h1 a{
        font-size: 22px;
        font-family: "Sofia", sans-serif;
        color:#ffffff;
      }
      .icon-section{
        margin-left:850px;
        width:500px;
        margin-bottom: -12px;
      }
    /* UPDATED CSS END */

    h2 {
      color: white;
      text-align: center;
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

    .container {
      width: calc(100% - 60px);
      margin: 50px auto 60px auto;
      background-color: rgba(30, 30, 30, 0.95);
      border-radius: 15px;
      padding: 30px 20px;
      box-shadow: 0px 0px 20px rgba(255, 255, 255, 0.1);
      overflow-x: auto;
    }

    table {
      min-width: 1200px;
      width: 100%;
      border-collapse: collapse;
      border: 2px solid white;
      background-color: white;
      border-radius: 10px;
      overflow: hidden;
    }

    thead {
      background-color: #2f2f2f;
      color: white;
    }

    thead th {
      padding: 12px;
      font-size: 16px;
      text-align: center;
      border: 2px solid white;
    }

    tbody td {
      color: black;
      border: 2px solid black;
      padding: 10px;
      font-size: 15px;
      font-weight: bold;
      text-align: center;
    }

    tbody tr:nth-child(even) td {
      background-color: #f2f2f2;
    }

    .back-btn {
      margin-top: 20px;
      display: inline-block;
      padding: 10px 20px;
      background-color: black;
      color: white;
      text-decoration: none;
      font-weight: bold;
      border-radius: 6px;
      text-transform: uppercase;
      letter-spacing: 1px;
      transition: background-color 0.3s;
    }

    .back-btn:hover {
      background-color: #444;
    }
  </style>
</head>
<body>

  <nav class="navbar">
        <img id="ntac_logo" src="images/ntac_logo.jpeg">
        <h1><a href="home.php">Nutri-Track Academia</a></h1>
    <div class="icon-section">
      <ul class="navbar-icons">
        <li class="navbar-icon">
          <i class="fa-regular fa-clipboard"></i>
          <a href="meal_menu_editing.php" class="btn btn-dark"><span>MenuEdit</span></a>
        </li>
        <li class="navbar-icon">
          <i class="fa-regular fa-circle-user"></i>
          <a href="update_admin.php" class="btn btn-dark"><span>Profile</span></a>
        </li>
        <li class="navbar-icon">
          <i class="fa-solid fa-arrow-up-wide-short"></i>
          <a href="order_list.php" class="btn btn-dark"><span>OrderList</span></a>
        </li>
        <li class="navbar-icon active">
          <i class="fa-solid fa-user-check"></i>
          <a href="admin_bmi_history.php" class="btn btn-dark"><span>HealthMetrics</span></a>
        </li>
        <li class="navbar-icon">
          <i class="fa-solid fa-arrow-right-from-bracket"></i>
          <a href="admin_logout.php" class="btn btn-dark"><span>Logout</span></a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="container">
    <h2>Students' Health Metrics - NutriTrack</h2>
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Student ID</th>
          <th>Meal Card No</th>
          <th>Name</th>
          <th>Date</th>
          <th>Height (m)</th>
          <th>Weight (kg)</th>
          <th>Age</th>
          <th>Gender</th>
          <th>Activity</th>
          <th>BMI</th>
          <th>BMR</th>
          <th>TDI</th>
          <th>Recommended Calorie</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $count = 1;
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr>";
          echo "<td>" . $count++ . "</td>";
          echo "<td>" . htmlspecialchars($row['id']) . "</td>";
          echo "<td>" . htmlspecialchars($row['meal_cn']) . "</td>";
          echo "<td>" . htmlspecialchars($row['name']) . "</td>";
          echo "<td>" . htmlspecialchars($row['date']) . "</td>";
          echo "<td>" . htmlspecialchars($row['height']) . "</td>";
          echo "<td>" . htmlspecialchars($row['weight']) . "</td>";
          echo "<td>" . htmlspecialchars($row['age']) . "</td>";
          echo "<td>" . htmlspecialchars($row['gender']) . "</td>";
          echo "<td>" . htmlspecialchars($row['activity']) . "</td>";
          echo "<td>" . htmlspecialchars($row['bmi']) . "</td>";
          echo "<td>" . htmlspecialchars($row['bmr']) . "</td>";
          echo "<td>" . htmlspecialchars($row['tdi']) . "</td>";
          echo "<td>" . htmlspecialchars($row['calorie']) . "</td>";
          echo "</tr>";
        }
        mysqli_close($connection);
        ?>
      </tbody>
    </table>
    <a href="meal_menu_editing.php" class="back-btn">← Back</a>
  </div>

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
