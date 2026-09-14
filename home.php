<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INDEX</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
    <head>
        <title>Nutri-Track Academia</title>
       <style>
        *
{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family:'Cambria, Cochin, Georgia, Times, Times New Roman, serif';
  font-size:20px;
}
.banner
{
    width: 100%;
    height: 100vh;
    background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(41, 38, 29, 0.96)), url('images/edit.jpeg');
    background-size: cover;
    background-position: center;
}
.icon{
    width: 200px;
    clip-path: circle();
    margin-left: 95vh;
    margin-top: 5vh;
    margin-bottom: 2vh;
}
.home
{
    width: 100%;
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    text-align: center;
    color: rgb(234, 234, 234);
}
.home h1
{
    font-style: italic;
    font-size: 50px;
    margin-top: 160px;
}
.home h2
{
    font-style: italic;
    margin: 15px auto;
    font-size: 35px;
    font-weight: 2000;
    line-height: 50px;
    color: rgba(228, 224, 219, 0.94);
}
.home h3
{
    font-style: italic;
    margin: 15px 50px 0 50px;
    font-size: 25px;
    font-weight: 1500;
    line-height: 50px;
    color: rgba(255, 255, 255, 0.96);
}
.home a
{
    width: 200px;
    margin: 20px 10px;
    padding: 15px;
    text-align: center;
    font-size: 25px;
    border: 1px solid black;
    border-radius: 25px;
    color: rgb(255, 255, 255);
    cursor: pointer;
    font-weight: bold;
    position: relative;
    overflow: hidden;
}
span
{
    background: rgb(21, 23, 26);
    height: 100%;
    width: 0;
    border-radius: 25px;
    position: absolute;
    left: 0;
    bottom: 0;
    z-index: -1;
    transition: 0.5s;
}
.home a:hover span
{
    width: 100%;
}
.home:hover
{
    border: none;
}
</style>
    </head>
    <body>
        <div class="banner">
            <div class="logo">
                <img src="images/ntac_logo_1.jpg"
                class="icon" alt="icon">
            </div>
            <div class="home">
                <h1>Nutri-Track Academia</h1>
                <h2>A Students' Daily Meal Management System</h2>
                <p>
                    <h3>A meal booking and billing system 
                        that manages student meal accounts for purchases of 
                        meals at food outlets on campuses. It's a planned 
                        series of events which is mainly concerned with 
                        menu-planning, food purchasing, managing the bills. </h3><br>
                </p>
                <a href="about_this_page.php"  name="stu_sign_log"  id="stu_sign_log">
                <span></span>About Nutri-Track</a>
                <br><br><br>

                <a href="admin_signin.php" name="admin_signin" id="admin_signin">
                <span></span>Access as An Admin</a>

                <a href="stu_sign_log.php"  name="stu_sign_log"  id="stu_sign_log">
                    <span></span>Access as A Student</a>

            </div>
        </div>
    </body>
</html>