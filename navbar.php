<?php
include 'db_connection.php';
include 'session_check.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Meal Menu Display</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia" />
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
        font-size: 62.5%; /*font-size = 10px*/;
      }

      body {
          /* background-image removed */
          color: black;
          font-family: Arial, sans-serif;
          margin: 0;
          padding: 0;
          display: flex;
          justify-content: center;
          align-items: center;
          height: 100vh;
      }

      .navbar {
        display: flex;
        align-items: center;
        height: 6.5rem;
        padding: 1rem;
        width: 1680px;
        background-color: rgba(48, 48, 46, 0.9);
        border: 1px solid var(--white);
        border-radius: 50px;
        box-shadow: var(--shadow-black);
        font-family: "Sofia", sans-serif;
        margin-top: -620px;
        margin-left: -120px;
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
      }

      .icon-section {
        margin-left: 600px;
        width: 700px;
        margin-bottom: -12px;
      }
    </style>
</head>
<body>
<nav class="navbar">
    <img id="ntac_logo" src="images/ntac_logo.jpeg" />
    <h1><a href="home.php">Nutri-Track Academia</a></h1>
    <div class="icon-section">
      <ul class="navbar-icons">
        <li class="navbar-icon active">
          <i class="fa-regular fa-clipboard"><i class="fa-solid fa-utensils"></i></i>
          <a href="meal_menu.php"><span>MealMenu</span></a>
        </li>

        <li class="navbar-icon">
          <i class="fa-regular fa-clipboard"><i class="fa-solid fa-mug-hot"></i></i>
          <a href="drinks_menu.php"><span>DrinksMenu</span></a>
        </li>

        <li class="navbar-icon">
          <i class="fa-solid fa-calculator"><i class="fa-solid fa-receipt"></i></i>
          <a href="bmi_bmr.php"><span>BMI/BMR_Calculation</span></a>
        </li>

        <li class="navbar-icon">
          <i class="fa-solid fa-receipt"></i>&nbsp;
          <i class="fa-solid fa-clock-rotate-left"></i>
          <a href="student_order_history.php"><span>Order History</span></a>
        </li>

        <li class="navbar-icon">
          <i class="fa-solid fa-arrow-right-from-bracket"></i>
          <a href="stu_logout.php"><span>Logout</span></a>
        </li>
      </ul>
    </div>
</nav>

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
 with background code -   <?php
include 'db_connection.php';

include 'session_check.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meal Menu Display</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
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
      }

      html,
      body {
        font-size: 62.5%; /*font-size = 10px*/;
      }
        body {
            background-image: url('images/nice 1.jpg');
            color: black;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .navbar {
        display: flex;
        align-items: center;
        height: 6.5rem;
        padding: 1rem;
        width: 1680px;
        background-color: rgba(48, 48, 46, 0.9);
        border: 1px solid var(--white);
        border-radius: 50px;
        box-shadow: var(--shadow-black);
        font-family: "Sofia", sans-serif;
        margin-top: -620px;
        margin-left: -120px;
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
        margin-left:600px;
        width:700px;
        margin-bottom: -12px;
      }

      </style>
</head>
<body>
<nav class="navbar">
        <img id="ntac_logo" src="images/ntac_logo.jpeg">
        <h1><a href="home.php">Nutri-Track Academia</a></h1>
    <div class="icon-section">
      <ul class="navbar-icons">
        <li class="navbar-icon active">
        <i class="fa-regular fa-clipboard"><i class="fa-solid fa-utensils"></i></i>
        <a href="meal_menu.php"><span>MealMenu</span></a>
        </li>
       
        <li class="navbar-icon">
          <i class="fa-regular fa-clipboard"><i class="fa-solid fa-mug-hot"></i></i>
          <a href="drinks_menu.php"><span>DrinksMenu</span></a>
        </li>

        <li class="navbar-icon">
          <i class="fa-solid fa-calculator"><i class="fa-solid fa-receipt"></i></i>
          <a href="bmi_bmr.php"><span>BMI/BMR_Calculation</span></a>
        </li>

        <li class="navbar-icon">
  <i class="fa-solid fa-receipt"></i>&nbsp;
  <i class="fa-solid fa-clock-rotate-left"></i>
  <a href="student_order_history.php"><span>Order History</span></a>
</li>


        <li class="navbar-icon">
        <i class="fa-solid fa-arrow-right-from-bracket"></i>
        <a href="stu_logout.php"><span>Logout</span></a>
        </li>
      </ul>
      </div>
    </nav>

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
      };
      </script>
</body>
</html>   