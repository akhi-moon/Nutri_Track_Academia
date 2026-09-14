<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Nutri-Track Academia</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
    <style>
      @import url("https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700&display=swap");
        /* General Styles */
        body {
            
            font-family: 'Montserrat', sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
            color: #333;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* Navbar */
        .navbar {
            background-color:rgb(32, 18, 6);
            border: none;
            border-radius: 0;
            margin-bottom: 0;
            height: 80px;
        }

        .navbar-brand, .navbar-nav > li > a {
            font-size: 25px;
            color: #ffffff !important;
            font-family: "Sofia", sans-serif;
        }

        #index_page{
           font-size: 22px;
           border-radius: 10px;
           box-shadow: 0 4px 8px rgba(99, 106, 117, 0.5);
           margin-top: 15px;
           margin-right: -100px;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(rgba(62, 62, 62, 0.8), rgba(159, 158, 158, 0.8)), url('images/nice 3.jpg') no-repeat center center/cover;
            color: rgba(17, 10, 4, 0.8);
            text-align: center;
            padding: 70px 20px;
            position: relative;
        }

        .hero-section h1 {
            font-size: 4rem;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .hero-section p {
            font-size: 1.6rem;
            margin-bottom: 30px;
        }

        .hero-section .btn {
            background-color:rgb(35, 31, 22);
            color: #fff;
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            font-size: 1.2rem;
            transition: background-color 0.3s;
        }

        .hero-section .btn:hover {
            background-color:rgb(39, 31, 25);
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(232, 216, 216, 0.5);
            font-size: 1.7rem;
        }

        /* Features Section */
        .features-section {
            padding: 50px 20px;
            background-color: #e8e4c5ff;
        }

        .features-section h2 {
            text-align: center;
            margin-bottom: 40px;
            font-size: 5rem;
            color:rgba(24, 9, 6, 0.81);
            font-family: "Sofia", sans-serif;
        }

        .features-section .feature-box {
            text-align: center;
            padding: 20px;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            margin-bottom: 20px;
            background-color: #f9f9f9;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .features-section .feature-box:hover {
            transform: scale(1.07);
            box-shadow: 0 4px 15px rgb(44, 35, 35);
        }

        .features-section .feature-box i {
            font-size: 3rem;
            color:rgb(45, 28, 8);
            margin-bottom: 15px;
        }

        .features-section .feature-box h4 {
            margin-bottom: 10px;
            font-size: 1.5rem;
            font-weight: 600;
        }

        /* Statistics Section */
        .stats-section {
            background-color:rgb(30, 29, 27);
            color: #ffffff;
            padding: 50px 20px;
            text-align: center;
        }

        .stats-section h2 {
            margin-bottom: 30px;
            font-size: 2.5rem;
        }

        .stats-box {
            display: flex;
            justify-content: center;
            gap: 30px;
        }

        .stats-box .stat {
            flex: 1;
            max-width: 200px;
            padding: 20px;
            background:rgb(53, 53, 53);
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .stats-box .stat h3 {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .stats-box .stat p {
            font-size: 1.2rem;
        }

        /* Call-to-Action Section */
        .cta-section {
            background-color:rgb(39, 29, 23);
            color: white;
            text-align: center;
            padding: 40px 20px;
        }

        .cta-section h2 {
            margin-bottom: 20px;
            font-size: 2.2rem;
        }

        .cta-section .btn {
            background-color:rgb(255, 255, 255);
            color: rgb(32, 30, 28);
            padding: 12px 25px;
            font-size: 1.2rem;
            border-radius: 5px;
            border: none;
            transition: background-color 0.3s;
        }

        .cta-section .btn:hover {
            background-color:rgb(190, 190, 190);
            color: black;
            font-size: 1.5rem;
        }

        /* Footer */
        .footer {
            background-color:rgb(39, 38, 36);
            color: #ffffff;
            text-align: center;
            padding: 20px 0;
            margin-top: 30px;
        }

        @media (max-width: 768px) {
            .stats-box {
                flex-direction: column;
                gap: 20px;
            }

            .stats-box .stat {
                max-width: 100%;
            }

            .hero-section h1 {
                font-size: 3rem;
            }

            .hero-section p {
                font-size: 1.4rem;
            }
        }
.icon{
    width: 50px;
    clip-path: circle();
    margin-left: -100px;
    margin-top: 0.1vh;
    margin-bottom: 1vh;
}
#title{
    font-size: 23px;
    margin-top: -42px;
    margin-left: -35px;
}
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="home.php"> <img src="images/ntac_logo.jpeg"
                class="icon" alt="icon"><span></span><h4 id="title">Nutri-Track Academia</h4></a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="home.php" id="index_page">Back to Index</a></li>
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-section">
        <h1>Welcome to Nutri-Track Academia</h1>
        <p>Effortless meal management and billing for campus life.</p>
        <a href="#features" class="btn">Explore Features</a>
    </div>

    <!-- Features Section -->
    <div class="features-section" id="features">
        <div class="container">
            <h2>Our Features</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="feature-box">
                    <i class="fa-solid fa-utensils"></i>
                        <h4>Healthy Meals</h4>
                        <p>Savor nutritious, thoughtfully curated meals tailored to promote 
                            a healthier lifestyle.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box">
                        <i class="fa-solid fa-user-circle"></i>
                        <h4>Student Portal</h4>
                        <p>Track and manage your meal orders with ease.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box">
                        <i class="fa-solid fa-file-invoice"></i>
                        <h4>Automated Billing</h4>
                        <p>Quick and accurate billing system for all purchases.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="feature-box">
                    <i class="fa-solid fa-user-tie"></i>
                        <h4>Admin Portal</h4>
                        <p>Effortlessly manage menus, 
                           monitor student orders & health, and streamline operations through 
                           our intuitive Admin Portal.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="feature-box">
                    <i class="fa-solid fa-bowl-food"></i>
                        <h4>Personalized Dietary Recommendations</h4>
                        <p>Analyzes health profiles using BMI, BMR, and TDI 
                           calculations to provide tailored diet charts, matching 
                           nutritional needs and fitness goals.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Section -->
    <div class="stats-section">
        <h2>Our Impact</h2>
        <div class="stats-box">
            <div class="stat">
                <h3>5,000+</h3>
                <p>Meals Served</p>
            </div>
            <div class="stat">
                <h3>2,000+</h3>
                <p>Students Registered</p>
            </div>
            <div class="stat">
                <h3>86%</h3>
                <p>User Satisfaction</p>
            </div>
        </div>
    </div>

    <!-- Call-to-Action Section -->
    <div class="cta-section">
        <h2>Join Nutri-Track Academia Today!</h2>
        <p>Experience a streamlined approach to meal management and billing on campus.</p>
        <a href="stu_sign_log.php" class="btn">Sign Up Now</a>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <p>© 2025 Nutri-Track Academia. All rights reserved.</p>
    </footer>
</body>
</html>
