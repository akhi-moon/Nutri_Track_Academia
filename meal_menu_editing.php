<?php 
include 'db_connection.php';
include 'admin_session_check.php';

// Fetch all menus
$breakfastMenu = mysqli_query($connection, "SELECT * FROM breakfast");
$snacksMenu = mysqli_query($connection, "SELECT * FROM snacks");
$lunchMenu = mysqli_query($connection, "SELECT * FROM lunch");
$drinksMenu = mysqli_query($connection, "SELECT * FROM drinks");
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

      html,
      body {
        font-size: 62.5%; /*font-size = 10px*/;
      }

      body {
        display: flex;
        position: relative;
        height: 100%;
        width: 100%;
        background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),  url('images/nice 4.jpg');
        /* background-color: bisque; */
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
        margin-top: 250px;
        margin-left: -1520px;
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
        font-family: Arial, sans-serif;
        margin: 0 0 25px 25px;
    }
    .menu-item h3 {
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
    #edit_button {
        margin-top: -2px;
        padding: 10px 20px;
        background-color: #686867;
        color: #ececec;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: bold;
        font-size: 15px;
    }
    #edit_button:hover {
        background-color: #8e8e8d;
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
        <i class="fa-regular fa-clipboard"></i>
        <a href="#" class="btn btn-dark"><span>MenuEdit</span></a>
        </li>
       
        <li class="navbar-icon">
          <i class="fa-regular fa-circle-user"></i>
          <a href="update_admin.php" class="btn btn-dark"><span>Profile</span></a>
        </li>

        <li class="navbar-icon">
        <i class="fa-solid fa-arrow-up-wide-short"></i>
        <a href="order_list.php" class="btn btn-dark"><span>OrderList</span></a>
        </li>
        
        <li class="navbar-icon">
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
    <div id="menu-container">
      <!-- Snacks Menu -->
      <div class="menu-item" id="snacks_menu">
          <h3>Snacks</h3><br>
          <img src="images/snacks_0.jpg" alt="Snacks" class="menu-image">
          <table class="menu-table">
              <tr>
                  <th>Item</th>
                  <th>Price</th>
              </tr>
              <?php while ($row = mysqli_fetch_array($snacksMenu)) { ?>
                  <tr>
                      <td><?php echo $row['item_name']; ?></td>
                      <td><?php echo $row['item_price']; ?> TK</td>
                  </tr>
              <?php } ?>
          </table>
          <br>
           <!-- Edit Button -->
           <div id="edit-button-container" class="mt-4">
           <a href="edit_menu.php?menu=snacks" class="btn btn-dark btn-lg" id="edit_button">Edit</a>
          </div> 
      </div>
  

      <!-- Breakfast Menu -->
       <div class="menu-item" id="breakfast_menu">
          <h3>Breakfast</h3><br>
          <img src="images/breakfast_0.jpg" alt="Breakfast" class="menu-image">
          <table class="menu-table">
              <tr>
                  <th>Item</th>
                  <th>Price</th>
              </tr>
              <?php while ($row = mysqli_fetch_array($breakfastMenu)) { ?>
                  <tr>
                      <td><?php echo $row['item_name']; ?></td>
                      <td><?php echo $row['item_price']; ?> TK</td>
                  </tr>
              <?php } ?>
          </table>
          <br>
           <!-- Edit Button -->
           <div id="edit-button-container" class="mt-4">
           <a href="edit_menu.php?menu=breakfast" class="btn btn-dark btn-lg"  id="edit_button">Edit</a>
          </div> 
      </div>

      <!-- Drinks Menu -->
      <div class="menu-item" id="drinks_menu">
          <h3>Drinks</h3><br>
          <img src="images/drinks_0.png" alt="Drinks" class="menu-image">
          <table class="menu-table">
              <tr>
                  <th>Item</th>
                  <th>Price</th>
              </tr>
              <?php while ($row = mysqli_fetch_array($drinksMenu)) { ?>
                  <tr>
                      <td><?php echo $row['item_name']; ?></td>
                      <td><?php echo $row['item_price']; ?> TK</td>
                  </tr>
              <?php } ?>
          </table>
          <br>
           <!-- Edit Button -->
           <div id="edit-button-container" class="mt-4">
           <a href="edit_menu.php?menu=drinks" class="btn btn-dark btn-lg"  id="edit_button">Edit</a>
          </div> 
      </div>

      <!-- Lunch Menu -->
       <div class="menu-item" id="lunch_menu">
          <h3>Lunch</h3><br>
          <img src="images/lunch_0.jpg" alt="Lunch" class="menu-image">
          <table class="menu-table">
              <tr>
                  <th>Item</th>
                  <th>Price</th>
              </tr>
              <?php while ($row = mysqli_fetch_array($lunchMenu)) { ?>
                  <tr>
                      <td><?php echo $row['item_name']; ?></td>
                      <td><?php echo $row['item_price']; ?> TK</td>
                  </tr>
              <?php } ?>
          </table>
          <br>
           <!-- Edit Button -->
           <div id="edit-button-container" class="mt-4">
           <a href="edit_menu.php?menu=lunch" class="btn btn-dark btn-lg"  id="edit_button">Edit</a>
          </div> 
      </div>
      
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
