<?php  include('config/constants.php');?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Login - Restaurant</title>
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

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
          <h1 style="margin-bottom:10px;font-size:50px;"> Hello guest,</h1>
          <h1 style="margin-bottom:10px;font-size:50px;"> Welcome to WOW FOOD</h1>
          <p style="margin-bottom:10px;font-size:21px;">Kindly LOGIN to continue!!!</p>
        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <section>

<div class="login-page">
  <div class="form">

    <form class="login-form" method="post">
      <input type="text" name="username" placeholder="username"/>

      <input type="password" name="password" placeholder="password"/>

      <br>
      <input type="submit" name="submit" value="Login" class="btn-primary"><br><br>

      <p class="message">Not registered? <a href="sign-up.php">Create an account</a></p>

      <br><br>
      <p class="text-center">Created by - <a href="#"> Hussein&Sultana</a> </p>
    </form>
  </div>
</div>
    </section>


  </body>
</html>
<?php
  //check if the submit button is clicked

  if(isset($_POST['submit'])){
    $username=$_POST['username'];
    $password=$_POST['password'];


    //sql to check if the username and password exist or not
    $sql="SELECT * FROM tbl_customer WHERE customer_name='$username' AND password='$password'";

    //execute the query
    $res=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($res);
    $customer_id=$row['id'];
    $order_date=date("Y-m-d h:i");

    $_SESSION['order_date']=$order_date;
    $_SESSION['customer_id']=$customer_id;


    //check if user exists or not
    $count = mysqli_num_rows($res);

    if($count==1){
      //user available
      $_SESSION['login']="<div class='sucess'>Login Successful.</div> ";
      $_SESSION['user']=$username;//check if the user is logged in or not and logout will unset it

      //redirect to home page
      header("location:".SITEURL);
    }
    else{
      //user not available and login fail
      $_SESSION['login']="<div class='error text-center'> Username OR Password did not match </div>";
      header('location:'.SITEURL.'/customer-login.php');
    }

  }
?>
