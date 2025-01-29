<?php
//Include Constants page
include('../config/constants.php');

    //echo "Delete Food Page";
    if(isset($_GET['id']) && isset($_GET['image_name'])) //Either use '&&' or 'AND'
    {
        //Process to delete
       // echo "Process to Delete";

       //1. Get ID and Image Name
       $id = $_GET['id'];
       $image_name = $_GET['image_name'];
     //2. Remove the Image if Available
       //Check whether the image is available or not and delete only if available
       if($image_name != "")
       {
        //It has image and need to remove from folder
        //Get has Image path
        $path ="../images/food/".$image_name;

        //Remove Image file from folder
        $remove = unlink($path);

        //Check whether the image is removed or not
        if($remove==false)
        {
            //Failed to Remive image
            $_SESSION['upload'] = "<div class='error'>Failed to Remove File.</div>";
            //Redirect to Manage Food
            header('location: '.SITEURL.'admin/manage-food.php');
            //Stop the process of deleting food
            die();
        }
       }

       //3. Dalete from database
       $sql = "DELETE FROM tbl_food WHERE id=$id";

       //Execute the query
       $res = mysqli_query($conn, $sql);

       //Check whether the query executed or not and set the session message respectivelly
       if($res==true)
       {
        //Food Deleted
        $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
       }
       else
       {
        $_SESSION['delete'] = "<div class='error'>Failed to  Delete Foood.</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
       }

       //4. Redirect to manage food with session message
    }
    else
    {
        //Redirect to manage food page
        //echo "REdirect";
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
        header('location: '.SITEURL.'admin/manage-food.php');
    }
?>