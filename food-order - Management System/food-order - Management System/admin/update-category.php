<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>

        <br><br>

        <?php
            //Check whether the id is set or not
            if(isset($_GET['id']))
            {
                //Get the ID and all other details
                //echo "Getting the Data";
                $id = $_GET['id'];
                //Create SQL Query to Get all other details
                $sql = "SELECT * FROM tbl_category WHERE id=$id";

                //Execute the Query 
                $res = mysqli_query($conn, $sql);

                //Count the rows to check whether the id is valid or not
                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    //Get all the data
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                }
                else
                {
                    //Redirect to manage category with session message
                    $_SESSION['no-category-found'] = "<div class='error'>Category not Found.</div>";
                    header('location: '.SITEURL.'admin/manage-category.php');

                }
            }
            else
            {
                //Redirect to Manage Category
                header('location: '.SITEURL.'admin/manage-category.php');
            
            }
        ?>
                <form action="" method="POST" enctype="multipart/form-data">

                <table class="tbl-30">      
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
        </td>
            </tr>
            <tr>
                <td>Current Image: </td>
                <td>
                    <?php
                    if($current_image != "")
                    {
                        //Display the image
                        ?>
                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>"width= "250px">
                        <?php
                    }
                    else
                    {
                        //Display Message
                        echo "<div class='error'>Image Not Added.</div>";
                    }
                    ?>
        </td>
        </tr>
            <tr>
                <td>New Image: </td>
                <td>
                <input type="file" name="image">
        </td>
        </tr>
        <tr>
            <td>Featured: </td>
            <td>
                <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes">Yes
                <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No">No
</td>
</tr>
        <tr>
            <td>Active: </td>
            <td>
            <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes">Yes 
            <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No">No
</td>
</tr>
        <tr>
            <td>
                <input type="hidden" name="current_image" value="<?php echo $current_image ?> ">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="submit" name="submit" value="Update Category" class="btn-secondary">
</td>
</tr>

            </table>
            </form>

            <?php
                if(isset($_POST['submit']))
                {
                    //echo "Clicked";
                    //1. Get all the values from our form
                    $id = $_POST['id'];
                    $title = $_POST['title'];
                    $current_image = $_POST['current_image'];
                    $featured = $_POST['featured'];
                    $active = $_POST['active'];

                   
                    //2. Updating New Image If selected
                    //Check whether the image is selected or not
                    if (isset($_FILES['image']['name'])) {
                        $image_name = $_FILES['image']['name'];
                    
                        if ($image_name != "") {
                            // Get the file extension safely
                            $ext = pathinfo($image_name, PATHINFO_EXTENSION);
                    
                            // Rename the image
                            $image_name = "Food_Category_" . rand(000, 999) . '.' . $ext;
                    
                            $source_path = $_FILES['image']['tmp_name'];
                            $destination_path = "../images/category/" . $image_name;
                    
                            // Upload the image
                            $upload = move_uploaded_file($source_path, $destination_path);
                    
                            if ($upload == false) {
                                $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. </div>";
                                header('location:' . SITEURL . 'admin/manage-category.php');
                                die();
                            }
                    
                            // Remove the old image if it exists
                            $remove_path = "../images/category/" . $current_image;
                            if (file_exists($remove_path)) {
                                $remove = unlink($remove_path);
                            } else {
                                $remove = true; // Continue if no file exists
                            }
                    
                            if ($remove == false) {
                                $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current Image.</div>";
                                header('location: ' . SITEURL . 'admin/manage-category.php');
                                die();
                            }
                        } else {
                            $image_name = $current_image; // Keep current image if no new image uploaded
                        }
                    } else {
                        $image_name = $current_image; // Keep current image if no image input detected
                    }
                    
                    // Update database with the new image name
                    $sql2 = "UPDATE tbl_category SET 
                        title = '$title',
                        featured = '$featured',
                        active = '$active',
                        image_name = '$image_name'
                        WHERE id=$id";
                    
                    $res2 = mysqli_query($conn, $sql2);
                    
                    if ($res2 == true) {
                        $_SESSION['update'] = "<div class='success'>Category Updated Successfully.</div>";
                        header('location: ' . SITEURL . 'admin/manage-category.php');
                    } else {
                        $_SESSION['update'] = "<div class='error'>Failed to Update Category.</div>";
                        header('location: ' . SITEURL . 'admin/manage-category.php');
                    }
                    
                }
            ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>
