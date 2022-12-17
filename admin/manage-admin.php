<?php  include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Admin</h1>
        <br><br>
        <?php
          if(isset($_SESSION['add'])){
            echo $_SESSION['add'];//Displaying session message
            echo "<br><br>";
            unset($_SESSION['add']);//Removing session message
          }

          if(isset($_SESSION['delete'])){
            echo $_SESSION['delete'];
            echo "<br><br>";
            unset($_SESSION['delete']); 
          }

          if(isset($_SESSION['update'])){
            echo $_SESSION['update'];
            echo "<br><br>";
            unset($_SESSION['update']);
          }

          if(isset($_SESSION['user-not-found'])){
            echo $_SESSION['user-not-found'];
            echo "<br><br>";
            unset($_SESSION['user-not-found']);
          }

          if(isset($_SESSION['pwd-not-match'])){
            echo $_SESSION['pwd-not-match'];
            echo "<br><br>";
            unset($_SESSION['pwd-not-match']);
          }

          if(isset($_SESSION['change-pwd'])){
            echo $_SESSION['change-pwd'];
            echo "<br><br>";
            unset($_SESSION['change-pwd']);
          }

        ?>

        <!-- button to add admin-->
        <a href="add-admin.php" class="btn-primary">Add Admin</a>
        <br><br><br>

        <table class="tbl-full">
          <tr>
            <th>S.N.</th>
            <th>Full Name</th>
            <th>username</th>
            <th>Actions</th>
            </tr>

        <?php
          //query to get all admin
          $sql="SELECT * FROM tbl_admin";
          //execute the query
          $res=mysqli_query($conn,$sql);

          //check wether the query is executed or not
          if($res==TRUE){
            //count rows to check wether we have data in database or not
            $count = mysqli_num_rows($res);//function to get all the rows in database

            $sn=1;
            //check the number of rows
            if($count>0){
              //using while loop do get all the data from database
              while($rows=mysqli_fetch_assoc($res)){
                $id=$rows['id'];
                $full_name=$rows['full_name'];
                $username=$rows['username'];
                //create a variable and assign the value
                //display values in our table
          ?>
            <tr>
              <td><?php echo $sn++; ?> </td>
              <td><?php echo $full_name; ?></td>
              <td><?php echo $username; ?></td>
              <td>
                
                <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary"> update Admin</a>
                <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger"> delete Admin</a>
              </td>
            </tr>
          <?php
              }
            }
            else{

            }

          }
          ?>
        </table>
  </div>
</div>

<?php include('partials/footer.php'); ?>
