<?php include('partials/menu.php'); ?>


<div class="main-content">
  <div class="wrapper">
    <h1>Update Order</h1>
    <br><br>

    <?php

    if(isset($_GET['id'])){
      //get order details
      $id=$_GET['id'];

      $sql = "SELECT * FROM tbl_order WHERE order_id = $id";

      //execute the query
      $res = mysqli_query($conn,$sql);

          $count = mysqli_num_rows($res);


              //Get all the data
              if($count==1){
                //details available
                $row = mysqli_fetch_assoc($res);

                $food=$row['food'];
                $price=$row['price'];
                $qty=$row['qty'];
                $status=$row['status'];
                $customer_id=$row['customer_id'];

              }
              else{
                //details not avaiilable
                header('location:'.SITEURL.'admin/manage-order.php');
              }


    }
    else{
      //redirect ro manage order page
      header('location:'.SITEURL.'admin/manage-order.php');
    }

    ?>

    <form class="" action="" method="post">

      <table class="tbl-30">
        <tr>
          <td>Food Name</td>
          <td><b> <?php echo $food; ?> </b> </td>
        </tr>

        <tr>
          <td>Price</td>
          <td><b> $ <?php echo $price; ?> </b> </td>
        </tr>

        <tr>
          <td>Qty</td>
          <td>
            <input type="number" name="qty" value="<?php echo $qty ?>">
          </td>
        </tr>

        <tr>
          <td>Status</td>
          <td>
            <select class="" name="status">
              <option <?php if($status=="Ordered"){echo "selected";} ?>value="Ordered">Ordered</option>
              <option <?php if($status=="On Delivery"){echo "selected";} ?> value="On Delivery">On Delivery</option>
              <option <?php if($status=="Delivered"){echo "selected";} ?> value="Delivered">Delivered</option>
              <option <?php if($status=="Cancelled"){echo "selected";} ?> value="Cancelled">Cancelled</option>

            </select>
          </td>
        </tr>

        <tr>
          <td>Customer id: </td>
          <td>
            <input type="text" name="customer_id" value="<?php echo $customer_id; ?>">
          </td>
        </tr>

        <td colspan="2">
          <input type="hidden" name="id" value="<?php echo $id; ?>">
          <input type="hidden" name="price" value="<?php echo $price; ?>">
          <input type="submit" name="submit" value="Update order" class="btn-secondary" >
        </td>
      </table>

    </form>

    <?php

      if(isset($_POST['submit'])){
        echo "clicked";
        $id=$_POST['id'];
        $price=$_POST['price'];
        $qty=$_POST['qty'];
        $total = $price * $qty;

        $status=$_POST['status'];

        $customer_id=$_POST['customer_id'];

      $sql2 = "UPDATE tbl_order SET
        qty = $qty,
        total=$total,
        status = '$status',
        customer_id=$customer_id
        WHERE order_id = $id
      ";

      $res2 = mysqli_query($conn,$sql2);

      if($res2 == true){
        $_SESSION['update'] = "<div class='success'> Order Updated Successfully.</div>";
        header('location:' .SITEURL. 'admin/manage-order.php');
    }

      else{
          $_SESSION['update'] = "<div class='error'> Failed to update Order.</div>";
          header('location:' .SITEURL. 'admin/manage-order.php');
      }

      }
    ?>

    <br><br>
  </div>

</div>

<?php include('partials/footer.php'); ?>
