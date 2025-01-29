<?php
//Inculde constants file
include('../config/constants.php');

   // echo "Delete Page";
   //Check whether the id and image_name value is set or not
   if(isset($_GET['id']) AND isset($_GET['image_name']))
   {
    //Get the value and delted
    //echo "Get Value and Delete";
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    //Remove the physic image file is available
    if($image_name != "")
    {
        //Image is Available. SO remove it
        $path = "../images/category/".$image_name;
        //Remove the Image 
        $remove = unlink($path);

        //If failed to remove image than add an error message and stop the process
        if($remove==false)
        {
            //Set the Session Message
            $_SESSION['remove'] = "<div class='error'> Failed to Remove Category Image.</div>";

            //Redirect to Manage Category Page
            header('location: '.SITEURL.'admin/manage-category.php');
            //Stop the process
            die();
        }
    }

    //Delete data from database
    //Sql Query dalete data from database
    $sql = "DELETE FROM tbl_category WHERE id=$id";

    //Execute the query
    $res = mysqli_query($conn, $sql);

    //Check whether the data is delete from database or not
    if($res==true)
    {
        //Set success message and redirct
        $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully.</div>";
        //Redirect to message category
        header('location: '.SITEURL.'admin/manage-category.php');
    }
    else
    {
        //Set Fail Message and Redirect
        $_SESSION['delete'] = "<div class='error'>Failed To Delete Category.</div>";
        //Redirect to message category
        header('location: '.SITEURL.'admin/manage-category.php');
    }

    //Redirect to Manage Category Page with Message
   }
   else
   {
    
    //redirect to manage category page
    header('location: '.SITEURL.'admin/manage-category.php');
   }
 ?>