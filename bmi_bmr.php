<?php 
include 'db_connection.php';
include 'session_check.php';

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Ensure the session variable `user_name` is set
if (!isset($_SESSION['meal_cn'])) {
    die("Student is not logged in.");
}

// Establish database connection
$connection = mysqli_connect("localhost", "root", "", "nutri_track");

if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Fetch student data using prepared statements
$meal_cn = $_SESSION['meal_cn'];
$query = "SELECT * FROM stu_info WHERE meal_cn = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("s", $meal_cn); // Bind string parameter
$stmt->execute();
$result = $stmt->get_result();

// Check if the user exists
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc(); // Fetch the admin data
} else {
    die("Student information not found.");
}

// Close the database connection
$stmt->close();
$connection->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Student Section</title>
    <!-- Bootstrap CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Font Awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia" />
    <style>
        body {
            background-image: linear-gradient(
                rgba(0, 0, 0, 0.5),
                rgba(0, 0, 0, 0.5)
              ),
              url('images/edit.jpeg');
            background-size: cover;
            background-position: center;
            font-family: 'Montserrat', sans-serif;
        }
        .wrapper {
            background: linear-gradient(
              rgba(135, 134, 134, 0.5),
              rgba(255, 255, 255, 0.5)
            );
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            margin-top: 50px;
        }
        .navbar-brand h3 {
            color: white;
            font-family: "Sofia", sans-serif;
        }
        table td {
            font-weight: bold;
        }
        .btn-custom {
            background-color: #535062;
            color: #fff;
        }
        .btn-custom:hover {
            background-color: #e1e6db;
            color: #000;
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
        white-space: nowrap; /* Prevent line breaks */
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
        margin-left: 1rem;
        font-family: "Sofia", sans-serif;
      }
      #ntac_logo {
        height: 50px;
        width: 50px;
        clip-path: circle();
        margin-right: 20px;
        margin-left: 10px;
      }
      .navbar h3 a {
        font-size: 22px;
        font-family: "Sofia", sans-serif;
        color: #ffffff;
        margin-top: 10px;
        width: 220px;
      }
      #navbarNav {
        margin-left: 500px;
        width: 1000px;
        margin-bottom: -12px;
      }
      .mb-3 label {
        font-weight: bold;
        font-style: italic;
      }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img id="ntac_logo" src="images/ntac_logo.jpeg" alt="Logo" />
                <h3><a href="home.php">Nutri-Track Academia</a></h3>
            </a>
            <button
              class="navbar-toggler"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#navbarNav"
              aria-controls="navbarNav"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto navbar-icons">
                    <li class="navbar-icon">
                        <a href="meal_menu.php" class="btn btn-dark">
                            <i class="fa-regular fa-clipboard"><i class="fa-solid fa-utensils"></i></i>
                            <span>MealMenu</span>
                        </a>
                    </li>

                    <li class="navbar-icon">
                        <a href="drinks_menu.php" class="btn btn-dark">
                            <i class="fa-regular fa-clipboard"><i class="fa-solid fa-mug-hot"></i></i>
                            <span>DrinksMenu</span>
                        </a>
                    </li>

                    <li class="navbar-icon active">
                        <a href="#" class="btn btn-dark">
                            <i class="fa-solid fa-calculator"><i class="fa-solid fa-receipt"></i></i>
                            <span>BMI/BMR_Calculation</span>
                        </a>
                    </li>

                    <li class="navbar-icon">
                        <a href="student_order_history.php" class="btn btn-dark">
                            <i class="fa-solid fa-receipt"></i>
                            <span>Order History</span>
                        </a>
                    </li>

                    <li class="nav-item navbar-icon">
                        <a href="stu_sign_log.php" class="nav-link text-white">
                            <i class="fas fa-sign-out-alt"></i> <span>Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Wrapper -->
    <div class="container md-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="wrapper">
                    <form action="bmi_bmr_result.php" method="post" enctype="multipart/form-data">
                        <input
                          type="hidden"
                          name="meal_cn"
                          value="<?php echo htmlspecialchars($row['meal_cn']); ?>"
                        />
                        <div class="text-center mb-4">
                            <?php if (!empty($row['profile_photo'])) : ?>
                            <img
                              src="images/profile_photos/<?php echo htmlspecialchars($row['profile_photo']); ?>"
                              class="img-fluid rounded-circle"
                              alt="Profile Photo"
                              style="width: 150px;"
                            />
                            <?php else : ?>
                            <img
                              src="images/profile_photos/non_profile.jpeg"
                              class="img-fluid rounded-circle"
                              alt="Default Photo"
                              style="width: 150px;"
                            />
                            <?php endif; ?>
                        </div>
                        <div class="row mb-7">
                            <div class="col-md-6 mb-3">
                                <label for="stu_name" class="form-label">Name:</label>
                                <input
                                  type="text"
                                  class="form-control"
                                  name="stu_name"
                                  id="stu_name"
                                  value="<?php echo htmlspecialchars($row['stu_name']); ?>"
                                  required
                                  readonly
                                />
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="student_id" class="form-label">Metric Id:</label>
                                <input
                                  type="text"
                                  class="form-control"
                                  name="student_id"
                                  id="student_id"
                                  value="<?php echo htmlspecialchars($row['student_id']); ?>"
                                  required
                                  readonly
                                />
                            </div>
                        </div>
                        <div class="row mb-7">
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email Address:</label>
                                <input
                                  type="email"
                                  class="form-control"
                                  name="email"
                                  id="email"
                                  value="<?php echo htmlspecialchars($row['email']); ?>"
                                  required
                                  readonly
                                />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="meal_cn" class="form-label">Meal Card No.:</label>
                                <input
                                  type="text"
                                  class="form-control"
                                  name="meal_cn"
                                  id="meal_cn"
                                  value="<?php echo htmlspecialchars($row['meal_cn']); ?>"
                                  required
                                  readonly
                                />
                            </div>
                        </div>
                        <div class="row mb-7">
                            <div class="col-md-6 mb-3">
                                <label for="height" class="form-label">Height:</label>
                                <input
                                  type="number"
                                  id="height"
                                  name="height"
                                  class="form-control"
                                  step="any"
                                />
                                <div class="form-feedback">Input your height in Meter.</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="weight" class="form-label">Weight:</label>
                                <input
                                  type="number"
                                  id="weight"
                                  name="weight"
                                  class="form-control"
                                  step="any"
                                />
                                <div class="form-feedback">Input your weight in KG.</div>
                            </div>
                        </div>
                        <div class="row mb-7">
                            <div class="col-md-6 mb-3">
                                <label for="age" class="form-label">Age:</label>
                                <input
                                  type="number"
                                  id="age"
                                  name="age"
                                  class="form-control"
                                />
                                <div class="form-feedback">Input your age.</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="gender" class="form-label">Gender:</label>
                                <input
                                  type="text"
                                  id="gender"
                                  name="gender"
                                  class="form-control"
                                />
                                <div class="form-feedback">Input your gender.</div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="activity_level" class="form-label">Activity Level:</label>
                            <select
                              id="activity_level"
                              name="activity_level"
                              class="form-select"
                              required
                            >
                              <option value="" disabled selected>
                                Select your activity level
                              </option>
                              <option value="1.2">
                                Sedentary (little or no exercise)
                              </option>
                              <option value="1.375">
                                Lightly active (1–3 days/week)
                              </option>
                              <option value="1.55">
                                Moderately active (3–5 days/week)
                              </option>
                              <option value="1.725">
                                Very active (6–7 days/week)
                              </option>
                              <option value="1.9">
                                Super active (physical job or intense training)
                              </option>
                            </select>
                            <div class="form-feedback">
                              Select your activity level for accurate calorie calculation.
                            </div>
                        </div>
                        <div class="text-center">
                            <input
                              type="submit"
                              class="btn btn-custom btn-lg"
                              value="CALCULATE"
                            />
                        </div>
                    </form>
                </div>
            </div>
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
        reader.onload = function (e) {
          const imageContainer = document.getElementById("image-preview-container");
          imageContainer.innerHTML = `<img src="${e.target.result}" class="img-fluid rounded-circle" style="width: 120px;" alt="Profile Preview">`;
        };
        reader.readAsDataURL(file);
      }
    </script>
</body>
</html>
