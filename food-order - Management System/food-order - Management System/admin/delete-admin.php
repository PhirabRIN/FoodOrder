<?php 

//Include constants.php file here
include('../config/constants.php');
//1. Get the 10 of Admin to be deleted
 $id = $_GET['id'];

//2. Create SQL Query to Delete Admin
$sql = "DELETE FROM tbl_admin WHERE id=$id";

//Execute the query
$res = mysqli_query($conn, $sql);
// Check whether the query executed successfully or not
if ($res == TRUE) {
    // Query executed successfully and Admin deleted
    // echo "Admin Deleted";
    
    // Create session variable to display message
    $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully.</div>";
    
    // Redirect to Manage Admin Page
    header('location: ' . SITEURL . 'admin/manage-admin.php');
    exit; // Ensure no further code is executed after the redirect
} else {
    // Failed to delete Admin
    // echo "Failed to Delete Admin";
    $_SESSION['delete'] = "<div class='error'>Failed to Delete Admin. Try Again Later.</div>";
    // Redirect to Manage Admin Page with error message
    header('location: ' . SITEURL . 'admin/manage-admin.php');
}
//3. Redirect to Manage Admin page with message(Success/error)
?>