<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Register Form</title>

    <!-- Bootstrap CSS -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    
    <!-- Boxicons CDN -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        :root {
            --white: #c8c4c4;
            --black: #000000;
            --lightBlue: rgb(203, 199, 193);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),  url('images/nice 3.jpg');
            background-size: cover;
            background-position: center;
            font-family: 'Arial', sans-serif;
            color: white;
        }

        .wrapper {
            position: relative;
            width: 1200px;
            height: 500px;
            background: var(--white);
            border: 2px solid var(--black);
            color: white;
            border-radius: 10px;
            background-color: rgba(48, 48, 46, 0.9); /* Dark background */
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.5);
            overflow: hidden;
            display: flex;
            flex-direction: row;
            overflow-y: auto;
        }

        .info-text {
            width: 50%;
            height: auto;
            background: var(--white);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: black;
            text-align: center;
            animation: fadeIn 0.5s ease-in-out;
            margin-top: -20px;
        }

        .info-text h2 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 10px;
            margin-right: 20px;
            margin-left: 20px;
            color: black;
        }

        .info-text p {
            font-size: 16px;
            margin-right: 20px;
            margin-left: 20px;
            color: black;
        } 

        .intro {
            width: 50%;
            height: auto;
            background: var(--black);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
            animation: fadeIn 0.5s ease-in-out;
            margin-top: -20px;
        }

        .intro h2 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 10px;
            margin-right: 20px;
            margin-left: 20px;
            color: white;
        }

        .intro p {
            font-size: 16px;
            margin-right: 20px;
            margin-left: 20px;
            color: white;
        } 
        #meal_cn{
            font-style: italic;
            background-color: #c8c4c4;
            color: black;
            width: 250px;
        }
    </style>
</head>

<body>
    <div class="wrapper">
    <div class="intro">
            <h2>Your Meal Card Number is</h2>
            <h2 id="meal_cn">
                <?php
                // Display the Meal Card Number
                if (isset($_GET['meal_cn'])) {
                    echo htmlspecialchars($_GET['meal_cn']);
                } else {
                    echo "Meal Card Number not generated.";
                }
                ?>
            </h2>
            <br>
            <p>Now Proceed to order food<br><br><a href="stu_sign_log.php" class="btn btn-dark">LOG IN</a></p>
    </div>
    

        <!-- Welcome Section -->
        <div class="info-text">
            <h2>Welcome to </h2>
            <h2>"Nutri_Track Academia"</h2>
            <p>A system that manages students' meals at an educational institution, 
                ensuring healthy, timely meals while automating food orders and 
                bill calculations to save time and energy for staff.
            </p>
        </div>
    </div>
</body>

</html>
