<?php
//authorization - Access Control
//check if user is logged in

if(!isset($_SESSION['user'])){
  //user is not logged in
  //redirect to login page with Message
  $_SESSION['no-login-message']="<div class='error text-center'>Please login to access Home</div>";
  //redirect to login page
  header('location:'.SITEURL.'customer-login.php');
}
 ?>
