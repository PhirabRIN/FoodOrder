<?php

//Include constants.php for SITEURAL
include('../config/constants.php');
//1. Destroy the Session
session_destroy(); //unset $_SESSION

//2. Redirect to login page
header('location:'.SITEURL.'admin/login.php');
 ?>