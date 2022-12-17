<?php  include('partials/menu.php');?>


<div class="main-content">
  <div class="wrapper">
    <h1>Add Admin</h1>

    <br><br>
    <?php
      if(isset($_SESSION['add'])){//checking wether the session is set or not
      echo $_SESSION['add'];//display message if set
      unset($_SESSION['add']);//removing session message
    }
    ?>


    <form action="" method="post">
        <table class="tbl-30">
          <tr>
              <td>Full Name: </td>
              <td>
                  <input type="text" name="full_name" placeholder="Enter Your Name">
              </td>
          </tr>

          <tr>
              <td>Username: </td>
              <td>
                  <input type="text" name="username" placeholder="Your Username">
              </td>
          </tr>

          <tr>
              <td>Password: </td>
              <td>
                  <input type="password" name="password" placeholder="Your Password">
              </td>
          </tr>

          <tr>
            <td colspan="2">
            <input type="submit" name="submit" value="Add Admin" class=btn-secondary>
            </td>
          </tr>

        </table>
    </form>
  </div>
</div>
<?php include('partials/footer.php'); ?>

<?php

//Process the value from form and save it in the database

if(isset($_POST['submit'])){
  //Button clicked
  //1. get the data from form
   $full_name=$_POST['full_name'];
   $username=$_POST['username'];
   $password=$_POST['password'];

   //2. sql query to save data into database
   $sql="INSERT INTO tbl_admin SET
      full_name='$full_name',
      username='$username',
      password='$password'
   ";

   //executing query and saving data in database
   $res=mysqli_query($conn,$sql) or die(mysqli_error());

   //check if the data is inserted or not and display message
   if($res==TRUE){
     //data inserted
     //create a variable to display Message
     $_SESSION['add']="Admin added successfully";
     //redirect page to Manage Admin
     header("location:".SITEURL.'admin/manage-admin.php');
   }
   else{
     //failed to insert
     //create a variable to display Message
     $_SESSION['add']="Failed to add admin";
     //redirect page to add Admin
     header("location:".SITEURL.'admin/add-admin.php');
   }
}

?>
