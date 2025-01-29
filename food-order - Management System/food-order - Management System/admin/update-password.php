<?php include('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h2>Change Password</h2>
        <br><br>

        <?php
        if(isset($_GET['id']))
        {
            $id=$_GET['id'];
        }
        ?>
        <form action = "" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Current Password: </td>
                    <td>
                    <input type="password" name="current_password" placeholder="Current_password">
                    </td>
</td>
</tr>
<tr>
    <td>New Password: </td>
    <td>
        <input type="password" name="new_password" placeholder="New Password">
</td>
</tr>
<tr>
    <td>Confirm Password: </td>
    <td>
        <input type="password" name="confirm_password" placeholder="Confirm Password">
</td>
</tr>
<tr>
    <td colspan="2">
        <input type="hidden" name="id" value= "<?php echo $id; ?> ">
        <input type="submit" name="submit" value="Change Password" class="btn-secondary">

</td>
</tr>

</table>
        </form>
    </div>
</div>
<?php

    //Check whether the submit button is clicked or not
    if (isset($_POST['submit'])) {

 //echo "Clicked";
 //1. Get the data from form
 $id = $_POST['id'];
 $current_password = md5($_POST['current_password']);
 $new_password = md5($_POST['new_password']);
 $confirm_password = md5($_POST['confirm_password']);

 //2. Check whether with current passwordExists or not
 $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

//Execute the Query
$res = mysqli_query($conn, $sql);

if($res==true)
{
    //Check whether data is available or not
    $count = mysqli_num_rows($res);
    if($count == 1)
    {
        //User Exists and password can be change
       // echo "User Found";
       //check whether the new password and confirm match or not
       if($new_password==$confirm_password)
       {
        //Update the password
        // echo "Password Match";

        $sql2 = "UPDATE tbl_admin SET password='$new_password'
        Where id=$id
        ";
        //Execute the query
        $res2 = mysqli_query($conn, $sql2);
        //Check whether the query executed or not 
        if($res2==true)
        {
            //Display success Message
            //Redirect to Manage Admin page whith Success message
            $_SESSION['change-pwd'] = "<div class= 'success'>Password Change Successfully.</div>";
            //Redirect the user
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
        else
        {
          //Display Error Message
        //Redirect to Manage Admin page whith error message
        $_SESSION['change-pwd'] = "<div class= 'error'>Failed to Change Password.</div>";
        //Redirect the user
        header('location:'.SITEURL.'admin/manage-admin.php');  
        }
       }

       else
       {
        
        $_SESSION['pwd-not-match'] = "<div class='error'> Password Did Not Match.</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
        
       }
    }
    else
    {
        //User Does not Exist Set Message and Midirect
        $_SESSION['user-not-found'] = "<div class='error'>User Not Found.</div>";
        //readirect the user
        header('location: ' . SITEURL . 'admin/manage-admin.php');
    }
}

 //3. Check whether the new Password and confirm Password Match or not

 //4. Change password if all above is true
  }
?>
<?php include('partials/footer.php'); ?>