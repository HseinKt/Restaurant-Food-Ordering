<?php  include("config/constants.php");

if(isset($_GET['id'])){

  $id=$_GET['id'];

  $sql = "DELETE  FROM  tbl_order where order_id = $id ";
  $res = mysqli_query($conn,$sql);

  if($res==true){
  $_SESSION['delete'] = "<div class=text-center><b>order Deleted Successfully</b></div>";
  header('location:'.SITEURL.'cart.php');
  }

else{
  $_SESSION['delete'] = "Failed to Delete Order.";
  header('location:'.SITEURL.'cart.php');
}
}
?>
