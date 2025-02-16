<?php
include('partials/menu.php');
?>
<div class="main-content">
    <div class="wrapper">
        <h2>Add Food</h2>
        <br><br>

        <?php
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the Food">
                    </td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description of the Food."></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">
                            <?php
                                // Create SQL to get all active categories from the database
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                                // Execute query
                                $res = mysqli_query($conn, $sql);
                                // Count rows to check if we have categories
                                $count = mysqli_num_rows($res);
                                // If we have categories
                                if ($count > 0) {
                                    while ($row = mysqli_fetch_assoc($res)) {
                                        $id = $row['id'];
                                        $title = $row['title'];
                                        ?>
                                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                        <?php
                                    }
                                } else {
                                    // If no categories, display this
                                    ?>
                                    <option value="0">No Category Found</option>
                                    <?php
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        // Check if the button is clicked
        if (isset($_POST['submit'])) {
            // Add the food to the database

            // 1. Get data from form
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];

            // Check whether radio buttons for featured and active are checked
            if(isset($_POST['featured']))
            {
                $featured = $_POST['featured'];

            }
            else
            {
                $featured = "No";
            }

            if(isset($_POST['active']))
            {
                $active = $_POST['active'];
            }
            else
            {
                $active = "No";
            }

            // 2. Upload the image if selected
          
            if (isset($_FILES['image']['name'])) {

              $image_name = $_FILES['image']['name'];

              if($image_name!="")
              {
                $ext = end(explode('.',$image_name));

                $image_name ="Food-Name-".rand(0000,9999).".".$ext;

                $src = $_FILES['image']['tmp_name'];

                $dst = "../images/food/".$image_name;

                $upload = move_uploaded_file($src, $dst);

                if($upload==false)
                {
                    $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                    header('location: '.SITEURL.'admin/add-food.php');
                    die();
                }
              }
            }
            else
            {
                $image_name ="";
            }

            // 3. Insert into database
            $sql2 = "INSERT INTO tbl_food SET 
                title = '$title',
                description = '$description',
                price = $price,
                image_name = '$image_name',
                category_id = $category,
                featured = '$featured',
                active = '$active'";

            // Execute the query
            $res2 = mysqli_query($conn, $sql2);

            // Check if the data was inserted
            if ($res2 == true) {
                // Data inserted successfully
                $_SESSION['add'] = "<div class='success'>Food Added Successfully.</div>";
                header('location: ' . SITEURL . 'admin/manage-food.php');
            } else {
                // Failed to insert data
                $_SESSION['add'] = "<div class='error'>Failed To Add Food.</div>";
                header('location: ' . SITEURL . 'admin/manage-food.php');
            }
        }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>
