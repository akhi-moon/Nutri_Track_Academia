
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    
     <!-- Bootstrap CSS -->
     <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    
    <!-- Boxicons CDN -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    
    <style>
      /* General Styles */
body {
    margin: 0;
    font-family: Arial, sans-serif;
    background-color: #333;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    overflow: hidden;
    background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),  url('images/rsz_31admin_1.jpg');
}

.container {
    width: 80%;
    height: 70%;
    max-width: 1200px;
    display: flex;
    position: relative;
    border-radius: 20px;
    overflow: hidden;
    background-color: rgba(48, 48, 46, 0.9); /* Dark background */
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.5);
}

/* Left Panel */
.left-panel {
    flex: 1;
    background: linear-gradient(135deg, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5));
    color: white;
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
    clip-path: polygon(0 0, 100% 0, 80% 100%, 0% 100%);
    margin-right: -100px;
    margin-left: -20px;
}

.left-panel .info-text {
    text-align: center;
    padding: 20px;
}

.left-panel h1 {
    font-size: 2.5rem;
    margin-bottom: 20px;
}

.left-panel p {
    margin-bottom: 30px;
}


/* Right Panel */
.right-panel {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
    overflow: hidden;
}

.sign-in-form {
    width: 80%;
    max-width: 400px;
    transform: translateX(-100%);
    opacity: 0;
    transition: transform 0.8s ease, opacity 0.8s ease;
    padding: 30px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    border-radius: 10px;
    color: white;
    background:#333;
}
.sign-in-form i {
    color: none;
}

.sign-in-form.active {
    transform: translateX(0);
    opacity: 1;
}
button {
    width: 50%;
    padding: 10px;
    font-size: 16px;
    font-weight: 600;
    color: var(--white);
    background: black;
    border: none;
    border-radius: 40px;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-top: 20px;
    margin-left: 90px;
}

button:hover {
    background: white;
    color: black;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.4);
    transform: scale(1.1);
}
.form-feedback{
    color: gray;
}

.input-group {
    margin-bottom: 20px;
    display: flex;
    flex-direction: column;
}

.input-group input {
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    outline: none;
}

.input-group input:focus {
    border-color: #4e54c8;
    box-shadow: 0 0 5px rgba(78, 84, 200, 0.5);
}


.password-container {
            position: relative;
        }

        .password-container .eye {
            position: absolute;
            right: 10px; /* Distance from the right edge of the input */
            top: 30%;
            transform: translateY(-50%); /* Vertically center the icon */
            cursor: pointer; /* Makes the icon clickable */
        }
        .password-container input {
            padding-right: 40px; /* Add some padding to make room for the icon */
        }
#hide1_lp{
            color: black;
            display: none;
            bottom: -30px;
        }
        #hide2_lp{
            color: black;
            bottom: -30px;
        }
        .mid-pic{
            width: 200px;
            height: 200px;
            margin-top: -200px;
             border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="left-panel">
            <!-- Welcome Section -->
            <div class="info-text">
            <h2>Welcome to </h2>
            <h2>"Nutri_Track Academia"</h2>
            <p>Your trusted partner in streamlining cafeteria <br>
                management—automating meal planning, inventory,<br>
                order tracking, and billing to deliver efficient, <br>
                nutritious service for your institution.
            </p>
        </div>
        </div>
        <div class="right-panel">
            <form class="sign-in-form" action="admin_signindb.php" method="POST">
            <h2>Login</h2>
            <i class="fa-sharp-duotone fa-solid fa-address-book"></i>
                <label for="user_name" class="form-label">Username</label>
                <div class="input-box">
                    <input type="text" class="form-control" id="user_name" name="user_name" required>
                    <div class="form-feedback">Please provide your username.</div>
                </div>
                <i class="fa-solid fa-lock"></i>
                <label for="log_password" class="form-label">Password</label>
                <div class="input-box password-container">
                    <input type="password" id="log_password" name="log_password" class="form-control" required minlength="8">
                    <span class="eye" onclick=" myfunction_logp()">
                        <i id="hide1_lp" class="fa-solid fa-eye"></i>
                        <i id="hide2_lp" class="fa-regular fa-eye-slash"></i>
                    </span>
                        <div class="form-feedback">Provide your login password.</div>
                </div>
                <button type="submit">Login</button>
    </form>
</div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const signInForm = document.querySelector(".sign-in-form");

            // Add 'active' class after a short delay to trigger animation
            setTimeout(() => {
                signInForm.classList.add("active");
            }, 500);
        });

        function myfunction_logp() {
            var y = document.getElementById("log_password");
            var z = document.getElementById("hide1_lp");
            var u = document.getElementById("hide2_lp");

            if (y.type === 'password') {
                y.type = "text";
                z.style.display = "block";
                u.style.display = "none";
            } else {
                y.type = "password";
                z.style.display = "none";
                u.style.display = "block";
            }
        }
    </script>
</body>
</html>
