<?php include('partials/menu.php'); ?>


<div class="main-content">
    <div class="wrapper">
        <h2>Update Admin</h2>
        <br/>  <br/>

                <?php
        // 1. Get the ID of Selected Admin
        $id = $_GET['id'];

        // 2. Create SQL Query to Get the Details
        $sql = "SELECT * FROM tbl_admin WHERE id='$id'";

        // 3. Execute the Query
        $res = mysqli_query($conn, $sql);

        // 4. Check whether the query is executed or not
        if ($res == true) {
            // Check whether the data is available or not
            $count = mysqli_num_rows($res);
            
            // Check whether we have admin data or not
            if ($count == 1) {
                // Get the details
                //echo 'Admin Available';
                $row=mysqli_fetch_assoc($res);

                $full_name = $row['full_name'];
                $username = $row['username'];
            } else {
                // Readirect to Manage Page
                header('location:'.SITEURL.'admin/mange-admin.php');
            }
        }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
</td>

</tr>
<tr>
    <td>Username: </td>
    <td>
        <input type="text" name="username" value="<?php echo $username; ?>">
</td>
</tr>

<tr>
    <td colspan="2">
        <input type="hidden" name="id" value="<?php echo $id; ?> ">
        <input type="submit" name="submit" value="Update Admin" class="btn-secondary"></td>
</tr>

            </table>
</form>
    </div>
</div>
<?php
//Check whether the submit buttons in clicked or not
if(isset($_POST['submit']))
{
   // echo "Button Clicked";
   //Get all the value from form to update
  $id = $_POST['id'];
$full_name = $_POST['full_name'];
$username = $_POST['username'];

//Create a sql query to update admin
$sql = "Update tbl_admin SET
full_name = '$full_name',
username = '$username'
Where id = '$id'
";

//Execute th equery
$res = mysqli_query($conn, $sql);

//Check whether the query executed successfully or not
if($res==true)
{
    //Query Executed and Admin Update
    $_SESSION['update'] = "<div class='success'>Admin Updated Successfully.</div>";
    //Readirect to ManageAdmin page
    header('location: '.SITEURL.'admin/manage-admin.php');

}
    else
    {
        //Failed to update Admin
        $_SESSION['update'] = "<div class='error'>Failed to Deleted Admin.</div>";
        //Readirect to ManageAdmin page
        header('location: '.SITEURL.'admin/manage-admin.php');
    }
}
?>



<?php include('partials/footer.php'); ?>

