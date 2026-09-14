<?php
include 'db_connection.php';
include 'session_check.php';
$name = isset($_GET['name']) ? urldecode($_GET['name']) : 'Student';
$tdi = isset($_GET['tdi']) ? floatval($_GET['tdi']) : 0;
$date = isset($_GET['date']) ? $_GET['date'] : date("Y-m-d");
$formattedDate = date("j F Y", strtotime($date)); // e.g. 6 August 2025
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Very High Calorie Diet Chart - Nutri-Track Academia</title>

  <!-- External CSS & Fonts -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
  <link href="https://fonts.googleapis.com/css?family=Sofia" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

  <style>
    @import url("https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700&display=swap");

    :root {
      --white: #ffffff;
      --black: #000000;
      --cream: #f5f5dc;
      --grey: #e0e0e0;
      --light-bg: rgba(255, 255, 255, 0.1);
      --dark-bg: rgba(48, 48, 46, 0.9);
      --green: white;
      --green-light-opacity: rgba(0, 0, 0, 0.5);
    }

    * {
      margin: 0;
      padding: 0;
      outline: none;
      box-sizing: border-box;
    }

    html, body {
        font-size: 62.5%;
        height: auto;
        min-height: 100vh;
        margin: 0;
        padding: 0;
        font-family: 'Montserrat', sans-serif;
        background-image: url('images/nice 1.jpg');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        color: white;
        overflow-x: hidden;
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
        margin-top: 15px;
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


    /* Page Container */
    .page-wrapper {
        padding: 30px 70px;
        max-width: 95vw;
        margin: auto;
    }


    /* Diet Chart Box */
    #diet-chart-container {
        background: var(--dark-bg);
        border-radius: 20px;
        padding: 60px 80px;
        width: 95%;
        margin: 40px auto;
        box-shadow: 0 0 35px rgba(0,0,0,0.6);
        font-size: 1.8rem;
    }



    #diet-chart-container h2 {
      font-family: "Sofia", sans-serif;
      font-size: 2.6rem;
      text-align: center;
      font-size: 3rem;
      margin-bottom: 25px;
      color: var(--cream);
    }

    .info-box {
      background: rgba(255, 255, 255, 0.15);
      padding: 15px 25px;
      border-radius: 10px;
      color: var(--grey);
      font-size: 1.5rem;
      margin-bottom: 30px;
      line-height: 1.6;
      font-size: 1.7rem;
    }

    table.diet-table {
      width: 100%;
      border-collapse: collapse;
      background-color: rgba(255, 255, 255, 0.05);
      color: var(--cream);
      font-size: 1.4rem;
      margin-bottom: 25px;
      font-size: 1.7rem;
    }

    table.diet-table th,
    table.diet-table td {
      padding: 14px 18px;
      border: 1px solid rgba(255, 255, 255, 0.2);
      text-align: center;
    }

    table.diet-table th {
      background-color: rgba(255, 255, 255, 0.1);
      font-size: 1.7rem;
    }

    table.diet-table tr:hover {
      background-color: rgba(255, 255, 255, 0.08);
    }

    .tips-box {
      background: rgba(255, 255, 255, 0.1);
      padding: 25px;
      border-radius: 10px;
      color: var(--grey);
      font-size: 1.7rem;
      line-height: 1.8;
      font-size: 1.6rem;
    }

    .tips-box h3 {
      font-family: "Sofia", sans-serif;
      font-size: 2rem;
      margin-bottom: 15px;
      color: var(--cream);
      text-align: center;
    }

    /* Download Button */
    #download-btn {
        margin: 30px auto;
        padding: 12px 28px;
        font-size: 1.6rem;
        background-color: var(--dark-bg);
        color: var(--cream);
        font-weight: 600;
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 8px;
        cursor: pointer;
        display: block;
        transition: all 0.3s ease;
        font-family: "Montserrat", sans-serif;
    }

        #download-btn:hover {
        background-color: rgba(255, 255, 255, 0.3);
        color: white;
        border-color: white;
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
        <i class="fa-solid fa-arrow-right-from-bracket"></i>
        <a href="stu_logout.php"><span>Logout</span></a>
      </li>
    </ul>
  </div>
</nav>

<div class="page-wrapper">
    <div id="diet-chart-container">
        <div class="text-center p-4 mb-5 rounded-5 shadow-lg" style="background: linear-gradient(135deg, #5b5343, #d2be88); color: #f2e9e4; font-family: 'Montserrat', sans-serif;">
            <h2 style="font-size: 4rem; font-weight: bold;">
                <?php echo htmlspecialchars($name); ?>'s Personalized Diet Chart
            </h2>
            <p class="mt-3 fs-5" style="font-size: 2rem;">
                <strong>Calculated Calorie Requirement:</strong> <?php echo $tdi; ?> kcal/day
            </p>
            <p class="fs-5" style="font-size: 2rem;">
                <strong>Date:</strong> <?php echo $formattedDate; ?>
            </p>
        </div>
        
        <div class="info-box">
            <strong>Total Calorie Requirement Range:</strong> 2300–2700 kcal/day<br />
            <strong>Campus Meal Target:</strong> 60–65% of daily intake = 1380–1755 kcal/day<br />
            <em>Dinner is assumed to be taken at home, covering the rest 35–40%</em>
        </div>

        <h2>Very High Calorie Diet Chart (On Campus: 1380–1755 kcal)</h2>

        <div id="chart-section">
            <table class="diet-table">
            <thead>
                <tr>
                <th>Day</th>
                <th>Breakfast</th>
                <th>Lunch</th>
                <th>Snacks</th>
                <th>Drinks</th>
                <th>Total kcal</th>
                </tr>
            </thead>
            <tbody>
                <tr><td>Saturday</td><td>2 Paratha (360) + Egg Omelette (90) + Milk (100)</td><td>Biryani (350) + Fried Egg (90) + Salad (50)</td><td>Chicken Sandwich (300) + Seasonal Fruits (90)</td><td>Lassi (150)</td><td>1580</td></tr>
                <tr><td>Sunday</td><td>Bread (70) + Jam (60) + Boiled Egg (75) + Milk (100)</td><td>Fried Rice (300) + Chicken Curry (220) + Daal (150)</td><td>Fried Chicken (250) + Seasonal Fruits (90)</td><td>Milk Tea (110)</td><td>1425</td></tr>
                <tr><td>Monday</td><td>Khichuri (350) + Boiled Egg (75)</td><td>Fried Rice (300) + Beef Curry (300) + Mixed Veg (100)</td><td>Noodles (350) + Fuchka (220)</td><td>Lemon Juice (60)</td><td>1755</td></tr>
                <tr><td>Tuesday</td><td>2 Roti (140) + Lentils Curry (180) + Jam (60) + Milk (100)</td><td>Plain Rice (200) + Fish Curry (250) + Daal (150)</td><td>Burger (400)</td><td>Coffee (120)</td><td>1600</td></tr>
                <tr><td>Wednesday</td><td>Paratha (180) + Mixed Veg (100) + Milk (100)</td><td>Biryani (350) + Chicken Curry (220) + Salad (50)</td><td>Chotpoti (250) + Seasonal Fruits (90)</td><td>Green Coconut (60)</td><td>1400</td></tr>
            </tbody>
            </table>
        </div>

        <div class="tips-box">
            <h3>Tips for Students Needing Very High Calorie</h3>
            <ul>
            <li>Include high-energy meals and snacks throughout the day.</li>
            <li>Choose full-cream dairy, protein-rich meals, and calorie-dense items.</li>
            <li>Stay physically active to balance the high intake healthily.</li>
            <li>Avoid skipping meals – consistency is key for energy levels.</li>
            </ul>
        </div>
    </div>
    <button id="download-btn">Download Diet Chart</button>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script>
let links = document.querySelectorAll(".navbar-icon");
  const clearActive = () => {
    for (link of links) link.classList.remove("active");
  };
  for (link of links) {
    link.onmouseover = function () {
      clearActive();
      this.classList.add("active");
    };
  }

  document.getElementById("download-btn").addEventListener("click", function () {
    const chart = document.getElementById("diet-chart-container");

    // Use html2canvas with proper background
    html2canvas(chart, {
      backgroundColor: null, // Keep your dark background
      scale: 2,
      useCORS: true
    }).then(canvas => {
      const link = document.createElement("a");
      link.download = "Diet_Chart.png";
      link.href = canvas.toDataURL("image/png");
      link.click();
    });
  });
</script>
</body>
</html>
