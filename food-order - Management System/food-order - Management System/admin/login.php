<?php include('../config/constants.php'); ?>
<html>
    <head>
        <title>Login - Food Order System</title>
        <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <div class="login">
        <h2 class= "text-center">Login</h2>
        <br><br>

        <?php
             if(isset($_SESSION['login']))
             {
                 echo $_SESSION['login'];
                 unset($_SESSION['login']);
             }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            if(isset($_SESSION['no-login-message']))
            {
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
            }
        ?>


        <br><br>
        <!--Login Form Start Here -->
        <form action="" method="POST" class="text-center">
            Username: <br>
            <input type="text" name="username" placeholder="Enter Username"><br><br>
            Password:<br>
            <input type="password" name="password" placeholder="Enter Password"><br><br>

            <input type="submit" name="submit" value="login" class="btn-primary"><br><br>
</form>
<!-- Login Form Ends Here -->

        <p>Create By -<a href ="www.NUM_Group5(31-33:20E)">G5 Team</a></p> 
    </div>
</body>
</html>

<?php
//check whether the submit button is clicked or not
if(isset($_POST['submit']))
{
    //Process for Login
    //1. Get the data from login form
   // $username = $_POST['username'];
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    // $password =md5( $_POST['password']);
    // $password =mysqli_real_escape_string(md5($conn,  $_POST['password']));
    $raw_password = md5( $_POST['password']);
    $password = mysqli_real_escape_string($conn, $raw_password);

     //2. SQL to check whether the user with username and password exists or not
     $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND PASSWORD='$password'";

     //3. Execute The query
     $res = mysqli_query($conn, $sql);

     //4. Count rows to check whether the user exists or not
     $count = mysqli_num_rows($res);

     if($count==1)
     {
        //User Avaible and login success
        $_SESSION['login'] = "<div class='success'>Login SUccessful.</div>";
        $_SESSION['user'] = $username; //To check whether the user is logged in or not and loggout will unset it
        //Redirect to Home page/Dashboard
        header('location:'.SITEURL.'admin/');

     }
     else
     {
        //User Avaible and login success
        $_SESSION['login'] = "<div class='error text-center'>Username and Password didn't not Match.</div>";
        //Redirect to Home page/Dashboard
        header('location:'.SITEURL.'admin/login.php');

     }
}
?>