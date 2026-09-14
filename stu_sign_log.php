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

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">

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
            font-family: "Arial", sans-serif;
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
            width: 800px;
            max-height: 100vh;
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
            font-size: 18px;
        }

        .form-box {
            width: 50%;
            height: auto;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slideInLeft {
    from {
        opacity: 0;
        transform: translateX(-100%);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes slideInRight {
    from {
        opacity: 0;
        transform: translateX(100%);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.wrapper {
    position: relative;
    width: 800px;
    max-height: 100vh;
    background: var(--white);
    border: 2px solid var(--black);
    border-radius: 10px;
    background-color: rgba(48, 48, 46, 0.9); /* Dark background */
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.5);
    overflow: hidden;
    display: flex;
    flex-direction: row;
    overflow-y: auto;
    padding-top: 20px;
    animation: fadeIn 0.8s ease-in-out;
}

.form-box {
    width: 50%;
    height: auto;
    padding: 60px 40px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    position: relative;
    animation: slideInLeft 0.6s ease-in-out;
}

.info-text {
    width: 50%;
    height: auto;
    background: var(--white);
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    color: var(--white);
    text-align: center;
    padding-top: 60px;
    animation: slideInRight 0.6s ease-in-out;
}

.form-box button {
    width: 100%;
    padding: 10px;
    font-size: 25px;
    font-weight: 600;
    color: var(--white);
    background: var(--white);
    border: none;
    border-radius: 40px;
    cursor: pointer;
    transition: all 0.3s ease;

}

.form-box button:hover {
    background: var(--white);
    color: var(--black);
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.4);
    transform: scale(1.1);
}

.form-feedback{
    color: gray;
}

.input-box input,
.input-box select {
    width: 100%;
    padding: 10px 40px 10px 10px;
    font-size: 16px;
    color: var(--black);
    border: none;
    border-bottom: 2px solid var(--black);
    outline: none;
    transition: 0.3s;
    background-color: white;
}

.input-box input:focus,
.input-box select:focus {
    border-bottom: 2px solid var(--lightBlue);
    transform: scale(1.02);
    background: white;
}

.input-box label {
    position: absolute;
    top: 50%;
    left: 10px;
    transform: translateY(-50%);
    font-size: 14px;
    color: var(--white);
    pointer-events: none;
    transition: 0.3s;
}

.input-box input:focus~label,
.input-box input:not(:placeholder-shown)~label,
.input-box select:focus~label {
    top: -10px;
    font-size:8px;
    color: var(--white);
}

.input-box i {
    position: absolute;
    top: 50%;
    right: 10px;
    transform: translateY(-50%);
    font-size: 10px;
    color: var(--white);
}

.linkTxt span {
    color: rgb(181, 167, 148);
    cursor: pointer;
    font-weight: 1000;
    transition: color 0.3s;
}

.linkTxt span:hover {
    color: darkcyan;
}

.input-box input,
.input-box select {
            width: 100%;
            padding: 10px 40px 10px 10px;
            font-size: 16px;
            color: var(--white);
            border: none;
            border-bottom: 2pxsolid var(--black);
            outline: none;
            background: transparent;
            transition: 0.3s;
        }

        .form-box.hidden {
            display: none;
        }

        .form-box h2 {
            font-size: 20px;
            font-weight: 600;
            text-align: center;
            margin-bottom: 20px;
        }

        .input-box {
            position: relative;
            margin-bottom: 20px;
            color:#000000;
        }

        .input-box input,
        .input-box select {
            width: 100%;
            padding: 10px 40px 10px 10px;
            font-size: 12px;
            color: black;
            border: none;
            border-bottom: 2px solid var(--black);
            outline: none;
            background: transparent;
            transition: 0.3s;
            font-family: Arial, sans-serif;
        }

        .input-box input:focus,
        .input-box select:focus {
            border-bottom: 2px solid var(--white);
        }

        .input-box select {
            appearance: none;
            background: transparent;
            color: black;
        }

        .input-box label {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            font-size: 14px;
            color: var(--white);
            pointer-events: none;
            transition: 0.3s;
        }

        .input-box input:focus~label,
        .input-box input:not(:placeholder-shown)~label,
        .input-box select:focus~label {
            top: -10px;
            font-size: 12px;
            color: var(--white);
        }

        .input-box i {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            font-size: 12px;
            color: var(--white);
        }

        .form-box button {
            width: 60%;
            padding: 10px;
            font-size: 12px;
            font-weight: 600;
            color: var(--white);
            background: var(--black);
            border: none;
            border-radius: 40px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-left: 65px;
        }

        .form-box button:hover {
            background: var(--white);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            transform: scale(1.2);
        }

        .linkTxt {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
        }

        .linkTxt span {
            color: darkslategray;
            cursor: pointer;
            font-weight: 600;
        }

        .linkTxt span:hover {
            font-size: 15px;
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
            font-size: 18px;
            font-weight: 900;
            margin-bottom: 10px;
            color: white;
        }

        .info-text p {
            font-size: 12px;
            color: white;
        }
        .wrapper {
        position: relative;
        display: flex;
        flex-direction: row;
        width: 850px;
        height: auto;
        max-height: 100vh;
        overflow: hidden;
        background-color: rgba(48, 48, 46, 0.9);
        border: 2px solid var(--black);
        border-radius: 10px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.5);
        transition: transform 0.8s ease-in-out;
    }

    .form-box,
    .info-text {
        width: 50%;
        height: auto;
        padding: 40px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        position: relative;
        transition: transform 0.8s ease-in-out;
        margin-top: -20px;
    }

    .form-box {
        background: var(--white);
        color: black;
        font-size: 13px;
    }

    .info-text {
        color: white;
        text-align: center;
        background: transparent;
    }


        .wrapper.swapped .form-box#login-form {
        transform: translateX(100%);
    }

    .wrapper.swapped .form-box#sign-up-form {
        transform: translateX(100%);
    }
    .wrapper.swapped .info-text {
        transform: translateX(-100%);
    }
        .password-container {
            position: relative;
        }

        .password-container .eye {
            position: absolute;
            right: 10px; /* Distance from the right edge of the input */
            top: 50%;
            transform: translateY(-50%); /* Vertically center the icon */
            cursor: pointer; /* Makes the icon clickable */
        }
        .password-container input {
            padding-right: 40px; /* Add some padding to make room for the icon */
        }
        #hide1{
            color: black;
            display: none;
        }
        #hide2{
            color: black;
        }
        #hide1_cp{
            color: black;
            display: none;
        }
        #hide2_cp{
            color: black;
        }
        #hide1_lp{
            color: black;
            display: none;
        }
        #hide2_lp{
            color: black;
        }

        select option {
            color: var(--black);
            background: var(--white);
        }

        @media screen and (max-width: 900px) {
            .wrapper {
                flex-direction: column;
            }

            .form-box,
            .info-text {
                width: 100%;
                color: white;
            }
        }
        
    </style>
</head>

<body>
    <div class="wrapper">
        <!-- Login Form -->
        <div class="form-box active" id="login-form">
            <h2>Login</h2>
            <form action="login_db.php" method="POST">
               <i class="fa-solid fa-address-card"></i>
                <label for="meal_cn" class="form-label">Meal Card No.</label>
                <div class="input-box">
                    <input type="text" class="form-control" id="meal_cn" name="meal_cn" required>
                    <div class="form-feedback">Please provide your meal card number.</div>
                </div>
                <i class="fa-solid fa-lock"></i>
                <label for="log_password" class="form-label">Password:</label>
                <div class="input-box password-container">
                    <input type="password" id="log_password" name="log_password" class="form-control" required minlength="8">
                    <span class="eye" onclick=" myfunction_logp()">
                        <i id="hide1_lp" class="fa-solid fa-eye"></i>
                        <i id="hide2_lp" class="fa-regular fa-eye-slash"></i>
                    </span>
                        <div class="form-feedback">Provide your login password.</div>
                </div>
                <button type="submit">Login</button>
                <div class="linkTxt">
                    <p>Don't have an account? <span onclick="switchForm()">Sign Up</span></p>
                </div>
            </form>
        </div>

        <!-- Sign Up Form -->
        <div class="form-box hidden" id="sign-up-form">
            <h2>Sign Up</h2>
           <form action="stu_signdb.php" method="POST">
                <i class="fa-solid fa-signature"></i>
                <label for="stu_name" class="form-label">Name:</label>
                <div class="input-box">
                   <input type="text" class="form-control" id="stu_name" name="stu_name" required>
                   <div class="form-feedback">Please provide a first name.</div>
                </div>
                <i class="fa-solid fa-envelope"></i>
                <label for="email" class="form-label">Email Address:</label>
                <div class="input-box">
                        <input type="email" class="form-control" id="email" name="email" required>
                        <div class="form-feedback">Please provide a valid email address.</div>
                </div>
                <div class="row mb-7">
                <div class="col-md-6 col-sm-4 col-lg-6">
                <i class="fa-solid fa-lock">
                <label for="password" class="form-label">Password:</label></i>
                <div class="input-box">
                <div class="password-container">
                            <input type="password" id="password" name="password" class="form-control" required minlength="8">
                            <span class="eye" onclick=" myfunction()">
                                <i id="hide1" class="fa-solid fa-eye"></i>
                                <i id="hide2" class="fa-regular fa-eye-slash"></i>
                            </span>
                </div>
                            <div class="form-feedback">Provide a strong password.</div>
                </div>
                </div>
                <div class="col-md-6 col-sm-4 col-lg-6">
                <i class="fa-solid fa-key">
                <label for="conf_password" class="form-label">Confirm Password:</label></i>
                <div class="input-box">
                <div class="password-container">
                            <input type="password" id="conf_password" name="conf_password" class="form-control" required minlength="8">
                            <span class="eye" onclick=" myfunction_cp()">
                                <i id="hide1_cp" class="fa-solid fa-eye"></i>
                                <i id="hide2_cp" class="fa-regular fa-eye-slash"></i>
                            </span>
                </div>
                            <div class="form-feedback">Confirm provided password.</div>
                </div>
                </div>
                </div>

                <div class="row mb-7">
                <div class="col-md-12 col-sm-4 col-lg-12">
                <i class="fa-solid fa-thumbtack"></i>
                <label for="varsity_pin" class="form-label">Varsity Pin:</label></i>
                <div class="input-box">
                <div class="password-container">
                            <input type="password" id="varsity_pin" name="varsity_pin" class="form-control" required minlength="5">
                </div>
                            <div class="form-feedback">Provide your varsity pin.</div>
                </div>
                </div>
                </div>

        <div class="row mb-7">
            <div class="col-md-4 col-sm-4 col-lg-4">
                <i class="fa-solid fa-school">
                <label for="department" class="form-label">Department:</label></i>
                <div class="input-box">
                        <input type="text" class="form-control" id="department" name="department">
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-lg-4">
                <i class="fa-solid fa-user-graduate"></i>
                        <label for="semester" class="form-label">Semester:</label>
                <div class="input-box">
                        <select class="form-select" id="semester" name="semester" required>
                            <option value=""></option>
                            <option value="1">1st</option>
                            <option value="2">2nd</option>
                            <option value="3">3rd</option>
                            <option value="4">4th</option>
                            <option value="5">5th</option>
                            <option value="6">6th</option>
                            <option value="7">7th</option>
                            <option value="8">8th</option>
                        </select>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-lg-4">
                <i class="fa-solid fa-id-card-clip"></i>
                        <label for="student_id" class="form-label">Student ID:</label>
                    <div class="input-box">
                        <input type="text" class="form-control" id="student_id" name="student_id">
                   </div>
            </div>
        </div>
            <button type="submit">Sign Up</button>
                <div class="linkTxt">
                    <p>Already have an account? <span onclick="switchForm()">Login</span></p>
                </div>
            </form>
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

    <script>
         function myfunction(){
            var x = document.getElementById("password");
            var z = document.getElementById("hide1");
            var u = document.getElementById("hide2");

            if(x.type==='password'){
                x.type ="text";
                z.style.display = "block";
                u.style.display = "none";
            }

            else{
                x.type ="password";
                z.style.display = "none";
                u.style.display = "block";
            }
        }
        
        function myfunction_cp(){
            var y = document.getElementById("conf_password");
            var z = document.getElementById("hide1_cp");
            var u = document.getElementById("hide2_cp");

            if(y.type==='password'){
                y.type ="text";
                z.style.display = "block";
                u.style.display = "none";
            }

            else{
                y.type ="password";
                z.style.display = "none";
                u.style.display = "block";
            }
        }
        function myfunction_logp(){
            var y = document.getElementById("log_password");
            var z = document.getElementById("hide1_lp");
            var u = document.getElementById("hide2_lp");

            if(y.type==='password'){
                y.type ="text";
                z.style.display = "block";
                u.style.display = "none";
            }

            else{
                y.type ="password";
                z.style.display = "none";
                u.style.display = "block";
            }
        }

        function switchForm() {
        const wrapper = document.querySelector('.wrapper');
        const loginForm = document.getElementById('login-form');
        const signUpForm = document.getElementById('sign-up-form');

        // Toggle the swapped class to animate the position change
        wrapper.classList.toggle('swapped');

        // Toggle active and hidden states
        loginForm.classList.toggle('active');
        loginForm.classList.toggle('hidden');
        signUpForm.classList.toggle('active');
        signUpForm.classList.toggle('hidden');
    }
    </script>
</body>

</html>
