<?php  include('config/constants.php');?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Sign-up - Restaurant</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login.css">
  </head>

  <body>
    <div class="logo">
        <a href="#" title="Logo">
            <img src="images/logo.png" alt="Restaurant Logo" class="img-responsive">
        </a>
    </div>

    <?php

      if(isset($_SESSION['signup'])){
        echo $_SESSION['signup'];
        UNSET($_SESSION['signup']);
      }
      echo "<br><br>";
      ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">

        <div>
          <div class="form">

            <form class="login-form" method="post">
              <div class="order-label">Full Name</div>
              <input type="text" name="full-name" placeholder="E.g. Sultana Nasser" class="input-responsive" required>

              <div class="order-label">Password</div>
              <input type="password" name="password" placeholder="E.g.xxxxxxx" class="input-responsive" required>

              <div class="order-label">Phone Number</div>
              <input type="tel" name="contact" placeholder="E.g. 961xxxxxx" class="input-responsive" required>

              <div class="order-label">Email</div>
              <input type="email" name="email" placeholder="E.g. Hussein&sultana@gmail.com" class="input-responsive" required>

              <div class="order-label">Address</div>
              <textarea name="address" rows="5" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

              <input type="submit" name="submit" value="Sign up" class="btn btn-primary">

              <p class="text-center">Created by - <a href="#"> Hussein&Sultana</a> </p>
            </form>
          </div>
        </div>

        </form>

        </section>
        <?php

        if(isset($_POST['submit'])){
          //get all the details from the form


          $customer_name=$_POST['full-name'];
          $password=$_POST['password'];
          $customer_contact=$_POST['contact'];
          $customer_email=$_POST['email'];
          $customer_address=$_POST['address'];

          //save the order in database
          //create sql to save the dats
          $sql="INSERT INTO tbl_customer SET
            customer_name='$customer_name',
            password=$password,
            customer_contact='$customer_contact',
            customer_email='$customer_email',
            customer_address='$customer_address'
            ";

            //execute the query
            $res=mysqli_query($conn,$sql);

            if($res==true){
              //query exexcuted and order saved
              $_SESSION['signup']="<div class='success text-center'>sign-up was successful. Please login to access. </div>";
              header('location:'.SITEURL.'/customer-login.php');
            }
            else{
              //failed to save order
              $_SESSION['signup']="<div class='error text-center'>Failed to sign-up</div>";
              header('location:'.SITEURL.'/sign-up.php');
            }
        }


        ?>
