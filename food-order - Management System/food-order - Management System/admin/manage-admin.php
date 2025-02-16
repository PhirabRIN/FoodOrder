<?php include('partials/menu.php'); ?>

<!-- Main Content Section Starts-->
 <div class="main-content">
 <div class = "wrapper">
    <h2>Manage Admin</h2>
    <br/>
    <br/>

    <?php  
    if(isset($_SESSION['add']))
    {
        echo  $_SESSION['add'];//Display session message
        unset($_SESSION['add']);//Removing session message
    }
    if(isset($_SESSION['delete']))
    {
        echo $_SESSION['delete'];
        unset($_SESSION['delete']);
    }
    if(isset($_SESSION['update']))
    {
        echo $_SESSION['update'];
        unset($_SESSION['update']);
    }
    
    if (isset($_SESSION['user-not-found']))
    {
        echo $_SESSION['user-not-found'];
        unset($_SESSION['user-not-found']); // Clear the message after displaying it
    }
    if (isset($_SESSION['pwd-not-match'])) 
    {
        echo $_SESSION['pwd-not-match'];
        unset($_SESSION['pwd-not-match']);
    }
    if (isset($_SESSION['change-pwd']))
    {
        echo $_SESSION['change-pwd'];
        unset($_SESSION['change-pwd']);
    }
    ?>
    <br/> <br/> <br/> 

    <!--Button to Add Admin-->
    <a href="add-admin.php" class="btn-primary">Add Admin</a>

    <br/>    <br/>    <br/>

    <table class="tbl-full">
    <tr>
        <th>S.N.</th>
        <th>Full Name</th>
        <th>Username</th>
        <th>Actions</th>
    </tr>
    <?php
    //Query to get all admin
    $sql = "SELECT * FROM tbl_admin";
    //Execute the query
    $res = mysqli_query($conn, $sql);

    //Check whether the query is executed or not
    if($res == TRUE)
    {
        //Count Row to check whether we have data is database or not
        $count = mysqli_num_rows($res);//Function to get all the rows in database

        $sn=1; //Create a variable and assign the value

        //Check the row of rows
        if($count>0)
        {
            //We have data in database
            while($rows=mysqli_fetch_assoc($res))
            {
                //Using while loop to get all the data from database.
                //Add while loop will run as long as we have data in database

                //get individual data
                // Get individual data
                $id = $rows['id'];
                $full_name = $rows['full_name'];
                $username = $rows['username'];

                //Display the value in our table
              ?>
                  <tr>
        <td><?php echo $sn++; ?></td>
        <td><?php echo $full_name; ?></td>
        <td><?php echo $username; ?></td>
        <td>
        <a href ="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
        <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
        <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
        </td>
    </tr>
              <?php
            }
        }
    else
    {
        //We do not have data in database
    }
    }
     ?>

   
</table>


</div>
</div>
<!-- Main Content Section End -->

<?php include('partials/footer.php'); ?>