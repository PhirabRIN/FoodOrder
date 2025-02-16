<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h2>Add Admin</h2>
        <br/>   <br/>

        <?php 
        if(isset($_SESSION['add'])) //Checking whether the session is set or not
        {
            echo $_SESSION['add']; //Display the seesion messge if set
            unset ($_SESSION['add']);//Remove session message
        }
        ?>
        <form action="" method="POST">


    <table class="tbl-30">
        <tr>
            <td>Full Name: </td>
            <td>
                <input type="text" name="full_name" placeholder="Enter Your Name" autocomplete="off">
            </td>
        </tr>
        
        <tr>
            <td>Username: </td>
            <td>
                <input type="text" name="username" placeholder="Your Username" autocomplete="off">
            </td>
        </tr>

        <tr>
            <td>Password: </td>
            <td>
                <input type="password" name="password" placeholder="Your Password" autocomplete="new-password">
            </td>
        </tr>

        <tr>
            <td colspan="2">
                <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
            </td>
        </tr>
    </table>
</form>


    </div>
</div>

<?php include('partials/footer.php'); ?>
<?php 
//Process the Value Form and Save it in Database
//Check whether thr submit button is clicked or Not

if (isset($_POST['submit']))
{
    //Button Clicked
    //echo "Button clicked";

 // Get the data from form
 $full_name = $_POST['full_name'];
$username = $_POST['username'];
$password = md5($_POST['password']); // Password encryption with MD5

// SQL Query to save the data into database
$sql = "INSERT INTO tbl_admin SET
full_name='$full_name',
username='$username',
password='$password'
";
//Execute query and saving data into database
   $res = mysqli_query($conn, $sql) or die(mysql_error());

   //Check whether the (Wuery is executed ) data is inserted or not and display appropriate message
   if($res == TRUE)
   {
    //Data Inserted
    //echo "Data Inserted";
    //Create a session Variable to display message
    $_SESSION['add'] = "Admin Added Sucessfully";
    //Redirect Page to Manage Admin
    header("location:".SITEURL.'admin/manage-admin.php');
   }
   else
   {
    //Fields to Insert Data 
    //echo "Faile to Insert Data";
    //Create a session Variable to display message
    $_SESSION['add'] = "Fiale to Add Admin";
    //Redirect Page to Add Admin
    header("localhost:".SITEURL.'admin/add-admin.php');
   }
}

?>