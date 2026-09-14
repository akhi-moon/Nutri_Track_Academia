<?php 
include 'db_connection.php';
include 'admin_session_check.php';

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Ensure the session variable `user_name` is set
if (!isset($_SESSION['user_name'])) {
    die("User is not logged in.");
}

// Establish database connection
$connection = mysqli_connect("localhost", "root", "", "nutri_track");

if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Fetch admin data using prepared statements
$user_name = $_SESSION['user_name'];
$query = "SELECT * FROM admin_info WHERE user_name = ?";
$stmt = $connection->prepare($query);
$stmt->bind_param("s", $user_name); // Bind string parameter
$stmt->execute();
$result = $stmt->get_result();

// Check if the user exists
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc(); // Fetch the admin data
} else {
    die("Admin information not found.");
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
    <title>Admin Section</title>
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
        margin-top: 30px;
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
        margin-left: -12rem;
        transition: opacity 0.1s ease, margin-left 0.5s ease;
        font-family: "Sofia", sans-serif;

        /* Prevent text from wrapping into multiple lines */
        white-space: nowrap;
      }

      /* Reduce padding on buttons inside navbar-icon to prevent wrapping */
      .navbar-icon a.btn {
        padding-left: 0.5rem;
        padding-right: 0.5rem;
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
        margin-left: 700px;
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
                    <li class="nav-item navbar-icon">
                        <a href="meal_menu_editing.php" class="nav-link text-white"
                          ><i class="far fa-clipboard"></i> <span>MenuEdit</span></a
                        >
                    </li>

                    <li class="nav-item navbar-icon active">
                        <a href="#" class="nav-link text-white"
                          ><i class="far fa-user-circle"></i> <span>Profile</span></a
                        >
                    </li>

                    <li class="navbar-icon">
                        <a href="order_list.php" class="btn btn-dark"
                          ><i class="fa-solid fa-arrow-up-wide-short"></i
                          ><span>OrderList</span></a
                        >
                    </li>

                    <li class="navbar-icon">
                        <a href="admin_bmi_history.php" class="btn btn-dark"
                          ><i class="fa-solid fa-user-check"></i
                          ><span>HealthMetrics</span></a
                        >
                    </li>

                    <li class="nav-item navbar-icon">
                        <a href="admin_logout.php" class="nav-link text-white"
                          ><i class="fas fa-sign-out-alt"></i> <span>Logout</span></a
                        >
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
                    <form
                      action="update_admin_save.php"
                      method="post"
                      enctype="multipart/form-data"
                    >
                        <input
                          type="hidden"
                          name="user_name"
                          value="<?php echo htmlspecialchars($row['user_name']); ?>"
                        />
                        <div class="text-center mb-4">
                            <?php if (!empty($row['profile_photo'])) : ?>
                            <img
                              src="images/profile_photos/<?php echo htmlspecialchars(
                                $row['profile_photo']
                              ); ?>"
                              class="img-fluid rounded-circle"
                              alt="Profile Photo"
                              style="width: 150px"
                            />
                            <?php else : ?>
                            <img
                              src="images/profile_photos/non_profile.jpeg"
                              class="img-fluid rounded-circle"
                              alt="Default Photo"
                              style="width: 150px"
                            />
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label for="admin_name" class="form-label">Name:</label>
                            <input
                              type="text"
                              class="form-control"
                              name="admin_name"
                              id="admin_name"
                              value="<?php echo htmlspecialchars($row['admin_name']); ?>"
                              required
                            />
                        </div>
                        <div class="mb-3">
                            <label for="admin_email" class="form-label">Email Address:</label>
                            <input
                              type="email"
                              class="form-control"
                              name="admin_email"
                              id="admin_email"
                              value="<?php echo htmlspecialchars($row['admin_email']); ?>"
                              required
                            />
                        </div>
                        <div class="mb-3">
                            <label for="user_name" class="form-label">User Name:</label>
                            <input
                              type="text"
                              class="form-control"
                              name="user_name"
                              id="user_name"
                              value="<?php echo htmlspecialchars($row['user_name']); ?>"
                              required
                              readonly
                            />
                        </div>
                        <div class="mb-3">
                            <label for="Mobile_Number" class="form-label">Mobile Number:</label>
                            <input
                              type="text"
                              class="form-control"
                              name="Mobile_Number"
                              id="Mobile_Number"
                              value="<?php echo htmlspecialchars($row['Mobile_Number']); ?>"
                            />
                        </div>
                        <div class="mb-3">
                            <label for="Permanent_Address" class="form-label">Address:</label>
                            <input
                              type="text"
                              class="form-control"
                              name="Permanent_Address"
                              id="Permanent_Address"
                              value="<?php echo htmlspecialchars($row['Permanent_Address']); ?>"
                            />
                        </div>
                        <div class="mb-3">
                            <label for="profile_photo" class="form-label"
                              >Update Your Profile Photo:</label
                            >
                            <input
                              type="file"
                              class="form-control"
                              id="profile_photo"
                              name="profile_photo"
                              onchange="previewImage(event)"
                            />
                            <div id="image-preview-container" class="mt-3"></div>
                        </div>
                        <div class="text-center">
                            <input
                              type="submit"
                              class="btn btn-custom btn-lg"
                              value="UPDATE"
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
