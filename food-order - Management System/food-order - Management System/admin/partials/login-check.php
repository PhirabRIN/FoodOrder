<?php
//Authorixation - Access Control
//Check whether the user is logged in or not
if(!isset($_SESSION['user'])) //If user session it's not set
{
    //User is not logged in
    //REdirct to login page with message
    $_SESSION['no-login-message'] = "<div class='error text-center'>Please login to Access Admin Panel.</div>";
    //REdirct to login page
    header('location: '.SITEURL.'admin/login.php');
}
?>