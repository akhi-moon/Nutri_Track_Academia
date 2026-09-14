<?php
include 'db_connection.php';

include 'session_check.php';

// Fetch all menus
$breakfastMenu = mysqli_query($connection, "SELECT * FROM breakfast");
$snacksMenu = mysqli_query($connection, "SELECT * FROM snacks");
$lunchMenu = mysqli_query($connection, "SELECT * FROM lunch");
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
        #menu-container {
        display: flex;
        justify-content: space-around;
        align-items: center;
        width: 1400px;
        height: 550px;
        background: rgba(48, 48, 46, 0.9);
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
        margin-bottom: -200px;
    }
    .menu-item {
        width: 25%;
        opacity: 0.5;
        transform: scale(0.9);
        transition: all 0.5s ease-in-out;
        height: auto;
        background: rgba(67, 67, 65, 0.9);
        border-radius: 10px;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 15px;
        transition: all 0.5s ease-in-out;
        font-size: 12px;
        font-family: Arial, sans-serif;
        margin: 0 0 25px 25px;
    }
    .menu-item.active {
            transform: scale(1.1);
            opacity: 1;
            z-index: 10;
        }
    .menu-item h4 {
        color: white;
        font-family: "Sofia", sans-serif;
        font-size: 20px;
    }
    .menu-table {
        width: 100%;
        margin-top: 10px;
        color: white;
    }
    .menu-table th, .menu-table td {
        padding: 10px;
        text-align: center;
    }
    .menu-image {
        width: 100%;
        height: 120px;
        max-height: 200px;
        object-fit: cover;
        border-radius: 10px;
    }
        .btn {
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #686867;
            color: #ececec;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }
        .btn:hover {
            background-color: #8e8e8d;
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
    #menu-container {
        display: flex;
        justify-content: space-around;
        align-items: center;
        width: 1400px;
        height: 650px;
        background: rgba(48, 48, 46, 0.9);
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
        margin-top: 200px;
        margin-left: -1520px;
        margin-bottom: -200px;
    }
    .menu-item {
        width: 25%;
        height: auto;
        background: rgba(67, 67, 65, 0.9);
        border-radius: 10px;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 15px;
        transition: all 0.5s ease-in-out;
        font-size: 12px;
        margin: 0 0 25px 25px;
    }
    .menu-item h3 {
        color: white;
        font-size: 20px;
    }
    .menu-table {
        width: 100%;
        margin-top: 10px;
        color: white;
    }
    .menu-table th, .menu-table td {
        padding: 10px;
        text-align: center;
    }
    .menu-image {
        width: 100%;
        height: 120px;
        max-height: 200px;
        object-fit: cover;
        border-radius: 10px;
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
<div id="menu-container">
    <!-- Breakfast Menu -->
    <div class="menu-item" id="breakfast_menu">
        <h4>Breakfast</h4>
        <img src="images/breakfast_0.jpg" alt="Breakfast" class="menu-image">
        <table class="menu-table">
            <tr>
                <th>Item</th>
                <th>Price</th>
                <th>Calorie</th>
            </tr>
            <?php while ($row = mysqli_fetch_array($breakfastMenu)) { ?>
                <tr>
                    <td><?php echo $row['item_name']; ?></td>
                    <td><?php echo $row['item_price']; ?> TK</td>
                    <td><?php echo $row['calorie']; ?> kcal</td>
                </tr>
            <?php } ?>
        </table>
    </div>

    <!-- Snacks Menu -->
    <div class="menu-item" id="snacks_menu">
        <h4>Snacks</h4>
        <img src="images/snacks_0.jpg" alt="Snacks" class="menu-image">
        <table class="menu-table">
            <tr>
                <th>Item</th>
                <th>Price</th>
                <th>Calorie</th>
            </tr>
            <?php while ($row = mysqli_fetch_array($snacksMenu)) { ?>
                <tr>
                    <td><?php echo $row['item_name']; ?></td>
                    <td><?php echo $row['item_price']; ?> TK</td>
                    <td><?php echo $row['calorie']; ?> kcal</td>
                </tr>
            <?php } ?>
        </table>
    </div>

    <!-- Lunch Menu -->
    <div class="menu-item" id="lunch_menu">
        <h4>Lunch</h4>
        <img src="images/lunch_0.jpg" alt="Lunch" class="menu-image">
        <table class="menu-table">
            <tr>
                <th>Item</th>
                <th>Price</th>
                <th>Calorie</th>
            </tr>
            <?php while ($row = mysqli_fetch_array($lunchMenu)) { ?>
                <tr>
                    <td><?php echo $row['item_name']; ?></td>
                    <td><?php echo $row['item_price']; ?> TK</td>
                    <td><?php echo $row['calorie']; ?> kcal</td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>

<!-- Order Button
<div id="order-button-container" class="mt-4 d-none">
        <a href="order.php" class="btn btn-dark btn-lg">Place Order</a>
</div> -->


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
    document.addEventListener("DOMContentLoaded", () => {
        // Function to determine active menu based on time
        const updateMenuBasedOnTime = () => {
            const currentTime = new Date();
            const hours = currentTime.getHours();
            const minutes = currentTime.getMinutes();
            const totalMinutes = hours * 60 + minutes;

            // Time ranges in minutes
            const breakfastStart = 7 * 60; // 7:00 AM
            const breakfastEnd = 10 * 60 + 30; // 10:30 AM
            const snacksStart1 = 11 * 60; // 11:00 AM
            const snacksEnd1 = 12 * 60 + 30; // 12:30 PM
            const lunchStart = 13 * 60; // 1:00 PM
            const lunchEnd = 14 * 60 + 30; // 2:30 PM
            const snacksStart2 = 15 * 60; // 3:00 PM
            const snacksEnd2 = 16 * 60 + 30; // 4:30 PM

            // Determine active menu
            let activeMenuId = null;
            let leftMenuId = null;
            let rightMenuId = null;
            if (totalMinutes >= breakfastStart && totalMinutes < breakfastEnd) {
                activeMenuId = "breakfast_menu";
                leftMenuId = "snacks_menu";
                rightMenuId = "lunch_menu";
            } else if (totalMinutes >= snacksStart1 && totalMinutes < snacksEnd1) {
                activeMenuId = "snacks_menu";
                leftMenuId = "lunch_menu";
                rightMenuId = "breakfast_menu";
            } else if (totalMinutes >= lunchStart && totalMinutes < lunchEnd) {
                activeMenuId = "lunch_menu";
                leftMenuId = "snacks_menu";
                rightMenuId = "breakfast_menu";
            } else if (totalMinutes >= snacksStart2 && totalMinutes < snacksEnd2) {
                activeMenuId = "snacks_menu";
                leftMenuId = "breakfast_menu";
                rightMenuId = "lunch_menu";
            }

            // Position menus
            document.querySelectorAll('.menu-item').forEach(menu => {
                menu.style.order = 1; // Reset order for all menus
                menu.classList.remove("active");
            });

            if (activeMenuId) {
                document.getElementById(activeMenuId).classList.add("active");
                document.getElementById(activeMenuId).style.order = 2;
                document.getElementById(leftMenuId).style.order = 1;
                document.getElementById(rightMenuId).style.order = 3;

                // Add "Place Order" button dynamically
                const activeMenu = document.getElementById(activeMenuId);
                const table = activeMenu.querySelector('.menu-table');

                // Remove existing button rows to prevent duplication
                const existingButtonRow = table.querySelector('.button-row');
                if (existingButtonRow) {
                    existingButtonRow.remove();
                }

                // Add new button row
                const buttonRow = document.createElement('tr');
                buttonRow.classList.add('button-row');
                const buttonCell = document.createElement('td');
                buttonCell.setAttribute('colspan', '2');
                buttonCell.innerHTML = `<a href="meal_order.php" class="btn btn-dark" 
                                         style="margin-left: 70px">Place Order</a>`;
                buttonRow.appendChild(buttonCell);
                table.appendChild(buttonRow);
            }
        };

        // Initial menu update
        updateMenuBasedOnTime();

        // Reapply menu logic every minute
        setInterval(updateMenuBasedOnTime, 1000);

        setInterval(() => 
     {
            console.log(new Date());
     }, 1000);

     setTimeout(() => {
    location.reload();
}, 6000); // Reload every 6 sec


    });
</script>
</body>
</html>
