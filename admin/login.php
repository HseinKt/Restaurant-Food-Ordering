<?php  include('../config/constants.php');?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

  <head>
    <meta charset="utf-8">
    <title> Login - Food Order System</title>
    <link rel="stylesheet" href="../css/admin1.css">
  </head>

  <body>

    <div class="login">

      <h1 class="text-center">Login</h1>
      <br><br>

      <?php

        if(isset($_SESSION['login'])){
          echo $_SESSION['login'];
          UNSET($_SESSION['login']);
        }
        echo "<br><br>";

        if(isset($_SESSION['no-login-message'])){
          echo $_SESSION['no-login-message'];
          unset($_SESSION['no-login-message']);
          echo "<br><br>";
        }
      ?>

      <!--login form starts here-->
      <form class="text-center" action="" method="post">
        username:
        <input type="text" name="username" placeholder="Enter username">
        <br><br>
        Password:
        <input type="Password" name="password" placeholder="Enter password">
        <br><br>
        <input type="submit" name="submit" value="Login" class="btn-primary"><br><br>
      </form>
      <!--login form ends here-->

      <p class="text-center">Created by - <a href="#"> Hussein&Sultana</a> </p>
    </div>



  </body>
</html>
<?php
  //check if the submit button is clicked

  if(isset($_POST['submit'])){
    $username=$_POST['username'];
    $password=$_POST['password'];

    //sql to check if the username and password exist or not
    $sql="SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
    //execute the query
    $res=mysqli_query($conn,$sql);

    //check if user exists or not
    $count = mysqli_num_rows($res);

    if($count==1){
      //user available
      $_SESSION['login']="<div class='sucess'>Login Successful.</div>";
      $_SESSION['user']=$username;//check if the user is logged in or not and logout will unset it
      //redirect to home page
      header("location:".SITEURL.'admin/');
    }
    else{
      //user not available and login fail
      $_SESSION['login']="<div class='error text-center'> Username OR Password did not match </div>";
      header('location:'.SITEURL.'admin/login.php');
    }

  }
?>
