<?php
include 'db_connection.php';
include 'session_check.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['meal_cn'])) {
    die("Student is not logged in.");
}

$connection = mysqli_connect("localhost", "root", "", "nutri_track");

if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

$meal_cn = $_SESSION['meal_cn'];
$query = "SELECT * FROM stu_info WHERE meal_cn = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("s", $meal_cn);
$stmt->execute();
$result = $stmt->get_result();

if (!$result || $result->num_rows === 0) {
    die("Student information not found.");
}

$row = $result->fetch_assoc();
$stmt->close();
$connection->close();

// BMI and BMR calculation
$height = floatval($_POST['height']);
$weight = floatval($_POST['weight']);
$age = intval($_POST['age']);
$gender = strtolower(trim($_POST['gender']));

// Calculate BMI
$bmi = $weight / ($height * $height);
$bmi = round($bmi, 2);

// Calculate BMR (using Mifflin-St Jeor Equation)
if ($gender === 'male') {
    $bmr = 10 * $weight + 6.25 * ($height * 100) - 5 * $age + 5;
} else {
    $bmr = 10 * $weight + 6.25 * ($height * 100) - 5 * $age - 161;
}
$bmr = round($bmr, 2);
$activity_level = floatval($_POST['activity_level']);
$tdi = round($bmr * $activity_level, 2);
// Supportive and non-judgmental calorie guidance based on BMI
$calorie_advice = '';
$adjusted_tdi = $tdi;

if ($bmi < 18.5) {
    $adjusted_tdi = $tdi + 500;
    $calorie_advice = 'Based on your BMI, a higher daily intake of around <strong>' . $adjusted_tdi . ' kcal</strong> may help support healthy weight gain if needed.';
} elseif ($bmi >= 18.5 && $bmi < 25) {
    $adjusted_tdi = $tdi;
    $calorie_advice = 'Your BMI falls within the standard range. A daily intake of <strong>' . $adjusted_tdi . ' kcal</strong> can help you maintain your current weight and energy balance.';
} elseif ($bmi >= 25 && $bmi < 30) {
    $adjusted_tdi = $tdi - 300;
    $calorie_advice = 'To support overall well-being, a slightly reduced intake of around <strong>' . $adjusted_tdi . ' kcal</strong> per day may be beneficial if advised by a health expert.';
} else {
    $adjusted_tdi = $tdi - 500;
    $calorie_advice = 'For improved health outcomes, a moderated intake of around <strong>' . $adjusted_tdi . ' kcal</strong> per day is often recommended. Consider speaking with a professional for personalized guidance.';
}

$_SESSION['adjusted_tdi'] = $adjusted_tdi;
$_SESSION['stu_name'] = $row['stu_name'];
$_SESSION['diet_date'] = date("Y-m-d");

// Save to database
// Reconnect for insertion
$connection = mysqli_connect("localhost", "root", "", "nutri_track");

if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

$insert_stmt = $connection->prepare("
    INSERT INTO health_metrics
    (meal_cn, id, name, height, weight, age, gender, activity, bmi, bmr, tdi, calorie, date)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
");

$date = date("Y-m-d");

// Make sure name is trimmed to avoid accidental issues
$row['stu_name'] = trim($row['stu_name']);

$insert_stmt->bind_param(
    "ssssddsddddds",         // 13 types for 13 values
    $row['meal_cn'],         // s
    $row['student_id'],      // s
    $row['stu_name'],        // s
    $height,                 // d
    $weight,                 // d
    $age,                    // d
    $gender,                 // s
    $activity_level,         // d
    $bmi,                    // d
    $bmr,                    // d
    $tdi,                    // d
    $adjusted_tdi,           // d
    $date                    // s
);

if (!$insert_stmt->execute()) {
    echo "Insert failed: " . $insert_stmt->error;
}

$insert_stmt->close();
$connection->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>BMI & BMR Result</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
    <style>
        body {
            background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('images/edit.jpeg');
            background-size: cover;
            background-position: center;
            font-family: 'Montserrat', sans-serif;
        }
        .wrapper {
            background: rgba(255, 255, 255, 0.85);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
            margin-top: 70px;
        }
        h2 {
            font-family: "Sofia", sans-serif;
            font-weight: bold;
            color: #2d2d2d;
        }
        .result-box {
            font-size: 18px;
            font-weight: 600;
            margin-top: 25px;
            padding: 15px;
            background-color: #f1f1f1;
            border-radius: 10px;
        }
        .btn-custom {
            background-color: #535062;
            color: white;
            font-weight: bold;
        }
        .btn-custom:hover {
            background-color: #e1e6db;
            color: black;
        }
        .navbar {
            display: flex;
            align-items: center;
            height: 4rem;
            padding: 1rem;
            margin-top:30px;
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
            font-size: 1rem;
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
            font-size: 1rem;
            color: var(--green-dark);
        }

        .navbar-icon a span {
            opacity: 0;
            font-size: 1rem;
            font-weight: 600;
            color: var(--green);
            margin-left: -8rem;
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
            margin-left: 1rem;
            font-family: "Sofia", sans-serif;
        }

        #ntac_logo{
            height: 50px;
            width:50px;
            clip-path: circle();
            margin-right: 20px;
            margin-left: 10px;
        }

        .navbar h3 a{
            font-size: 22px;
            font-family: "Sofia", sans-serif;
            color:#ffffff;
            margin-top: 10px;
            width: 220px;
        }

        #navbarNav{
            margin-left:500px;
            width:1000px;
            margin-bottom: -12px;
        }

        .mb-3 label{
            font-weight: bold;
            font-style: italic;
        }

        .container {
            display: flex;
            gap: 100px;
            align-items: center;
            justify-content: center;
            font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            line-height: 3em;
        }

        .item {
            --color: rgb(205, 196, 158);
            width: 500px;
            background-color: var(--color);
            border-radius: 10px;
            padding: 25px 20px;
            box-shadow: 
            #3c40434d 0px 1px 2px 0px,
            #3c404326 0px 1px 3px 1px;
            position: relative;
            cursor: pointer;
            margin-top: 15px;
        }

        .item::after {
            content: "";
            position: absolute;
            top: 8px;
            left: 0;
            z-index: 2;
            height: 95%;
            box-sizing: border-box;
            border-style: solid;
            border-color: transparent transparent transparent var(--color);
            border-width: 60px 60px 60px 60px;
            filter: drop-shadow(5px 0 4px #00000094);
            transition: filter .5s;
        }

        .layer {
            background-color: aliceblue;
            border: 1px solid #fff;
            border-radius: inherit;
            padding: 10px;
            box-shadow: 
            #00000012 0px 1px 2px,
            #00000012 0px 2px 4px,
            #00000012 0px 4px 8px,
            #00000012 0px 8px 16px,
            #00000012 0px 16px 32px,
            #00000012 0px 32px 64px;
            position: relative;
            left: 10px;
            transition: left 1s;
        }

        h3 {
            font-weight: 700;
            text-align: center;
            color: var(--color);
        }

        h4 {
            color: #fff;
            text-align: center;
            font-size: 14px;
            padding-top: 10px;
        }

        p {
            color: #555;
        }

        .item span {
            width: 40px;
            height: 40px;
            color: #fff;
            background-color: var(--color);
            border-radius: 50%;
            display: grid;
            place-content: center;
            box-shadow: 
            #00000012 0px 1px 2px,
            #00000012 0px 2px 4px,
            #00000012 0px 4px 8px,
            #00000012 0px 8px 16px,
            #00000012 0px 16px 32px,
            #00000012 0px 32px 64px;
            font-size: 14px;
            position: absolute;
            right: 5px;
            bottom: 5px;
        }

        .item:hover:after {
            filter: drop-shadow(5px 0 4px #0000001a);
        }

        .item:hover .layer {
            left: 50px;
        }

        .notes-title {
            font-family: 'Sofia', cursive;
            font-size: 2rem;
            color: #7f612a;
            text-align: center;
            margin-bottom: 1rem;
            letter-spacing: 0.06em;
            text-shadow: 1px 1px 2px rgb(191 174 98 / 0.6);
        }

        code {
            background-color: #f5f5f5;
            color: rgb(127, 97, 42);
            font-size: 1.05rem;
            padding: 2px 6px;
            border-radius: 6px;
            font-family: 'Courier New', monospace;
        }
    </style>
</head>
<body>

<!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img id="ntac_logo" src="images/ntac_logo.jpeg" alt="Logo">
                <h3><a href="home.php">Nutri-Track Academia</a></h3>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto navbar-icons">
                     <li class="navbar-icon">
                        <a href="meal_menu.php" class="btn btn-dark"> <i class="fa-regular fa-clipboard"><i class="fa-solid fa-utensils"></i></i><span>MealMenu</span></a>
                    </li>
                
                    <li class="navbar-icon">
                        <a href="drinks_menu.php" class="btn btn-dark"> <i class="fa-regular fa-clipboard"><i class="fa-solid fa-mug-hot"></i></i><span>DrinksMenu</span></a>
                    </li>
                    

                    <li class="navbar-icon active">
                        <a href="#" class="btn btn-dark"> <i class="fa-solid fa-calculator"><i class="fa-solid fa-receipt"></i></i><span>BMI/BMR_Calculation</span></a>
                    </li>
                    
                    <li class="nav-item navbar-icon">
                        <a href="stu_sign_log.php" class="nav-link text-white"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

<div class="container mt-5">
    <div class="row justify-content-center align-items-center gx-5">
        <!-- Left Part (Larger BMI/BMR Section) -->
        <div class="col-md-7 mb-4">
            <div class="p-5 rounded-5 shadow-lg text-white" style="background: linear-gradient(135deg,rgb(91, 83, 67),rgb(210, 190, 136)); border-left: 10px solid #f2e9e4; min-height: 330px;">
                <h2 class="mb-4 display-6">Hello, <span style="color: #f2e9e4;"><?php echo htmlspecialchars($row['stu_name']); ?></span>!</h2>
                <div class="fs-5 mb-3"><i class="fas fa-id-card me-2"></i><strong>Student ID:</strong> <?php echo htmlspecialchars($row['student_id']); ?></div>
                <div class="fs-5 mb-3">
                    <i class="fas fa-utensils me-2"></i><strong>Meal Card No:</strong> <?php echo htmlspecialchars($row['meal_cn']); ?>
                </div>
                <div class="fs-5 mb-3">
                    <i class="fas fa-calendar-day me-2"></i><strong>Date:</strong> <?php echo date("l, j F Y"); ?>
                </div>
                <hr style="border-color: #f2e9e4;">
                <div class="fs-4 mt-4 mb-3"><i class="fas fa-weight me-2"></i><strong><span style="font-size: 2rem;">BMI:</strong></span> <span style="font-size: 2rem; color: #f2e9e4;"><?php echo $bmi; ?> kg/m²</span></div>
                <div class="fs-4"><i class="fas fa-fire-alt me-2"></i><strong><span style="font-size: 2rem;">BMR:</strong></span> <span style="font-size: 2rem; color: #f2e9e4;"><?php echo $bmr; ?> kcal/day</span></div>
                <div class="fs-4 mt-3"><i class="fas fa-running me-2"></i><strong><span style="font-size: 2rem;">TDI:</strong></span> <span style="font-size: 2rem; color: #f2e9e4;"><?php echo $tdi; ?> kcal/day</span></div>
                <div class="fs-5 mt-4 p-3 rounded-4" style="background-color: rgba(255, 255, 255, 0.15); color: #f2e9e4; border-left: 5px solid #f2e9e4;">
                <i class="fas fa-lightbulb me-2"></i> <?php echo $calorie_advice; ?>
                </div>
            </div>
        </div>

        <!-- Right Part with Sliding Card -->
        <div class="col-md-5 mb-5 d-flex justify-content-center">
    <a href="dietchart_redirect.php" style="text-decoration: none;">
        <div class="item" style="transform: scale(1.13); height: 100%;">
            <div class="layer p-4 d-flex flex-column justify-content-center" style="height: 100%;">
                <h3 style="font-size: 1.8rem; margin-bottom: 1rem;">Get Your Personalized Meal Chart</h3>
                <p style="font-size: 1.2rem; line-height: 1.9em;">
                    🌟 Tailored just for you —<br>
                    your daily calorie needs, activity level,<br>
                    and food preferences all taken into account.<br><br>

                    🥗 Whether you want to maintain,<br>
                    gain, or gently reduce weight —<br>
                    we’ll help you balance <strong>health & taste</strong><br><br>

                    📊 Using your <strong>BMI</strong>, <strong>BMR</strong>, and <strong>TDI</strong>,<br>
                    we’ll generate a chart that suits <em>your body</em>.<br><br>
                </p>

                <div class="text-center mt-3">
                    <strong style="font-size: 1.3rem; color: rgb(205, 196, 158); text-decoration: none;">====== View Chart ======</strong>
                    <span><i class="fas fa-arrow-right ms-2"></i></span>
                </div>
            </div>
        </div>
    </a>
</div>

    </div>
</div>
<div class="mx-4 my-5"> <!-- mx-4 adds left & right margin/padding -->
    <div class="p-4 rounded-5 shadow" style="background: rgba(243, 239, 226, 0.8); font-size: 1.15rem; line-height: 2em; font-family: 'Montserrat', sans-serif; color: #222; border: 1px solid #ddd;">
        <h2 class="notes-title">Notes</h2>

        <p><strong style="font-family: 'Sofia', cursive; font-size: 1.3rem;">BMI (Body Mass Index)</strong> is a simple ratio of weight to height that helps you understand your body status. <br>It's calculated as: <code>BMI = weight (kg) / height² (m²)</code>.</p>

        <p><strong style="font-family: 'Sofia', cursive; font-size: 1.3rem;">BMR (Basal Metabolic Rate)</strong> estimates how many calories your body needs at rest to support vital functions. <br>Formula (Mifflin-St Jeor): <code>BMR = 10 × weight + 6.25 × height(cm) − 5 × age ± gender factor</code>, where the gender factor is +5 for males and −161 for females.</p>

        <p><strong style="font-family: 'Sofia', cursive; font-size: 1.3rem;">TDI (Total Daily Intake)</strong> represents the calories you need each day based on activity level. <br>It is calculated as: <code>TDI = BMR × Activity Level</code>.</p>

        <p><em>Depending on your body type and health goal:</em><br>
            – For <strong>gradual weight gain</strong>, aim for <strong>TDI + 300 to 500 kcal</strong> daily.<br>
            – For <strong>maintenance</strong>, follow your calculated <strong>TDI</strong>.<br>
            – For <strong>healthy weight loss</strong>, reduce intake by <strong>300 to 500 kcal from TDI</strong>.</p>
    </div>
</div>




<!-- Bootstrap JS -->
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
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

        function previewImage(event) {
            const file = event.target.files[0];
            const reader = new FileReader();
            reader.onload = function(e) {
                const imageContainer = document.getElementById("image-preview-container");
                imageContainer.innerHTML = `<img src="${e.target.result}" class="img-fluid rounded-circle" style="width: 120px;" alt="Profile Preview">`;
            };
            reader.readAsDataURL(file);
        }
    </script>
</body>
</html>
