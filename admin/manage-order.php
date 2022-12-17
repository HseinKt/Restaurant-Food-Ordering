<?php  include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">

        <h1>Manage Order</h1>

        <br><br><br>

        <?php
        if(isset($_SESSION['update'])){
          echo $_SESSION['update'];
          unset($_SESSION['update']);
        }

         ?>
<br>
        <table class="tbl-full">
          <tr>
            <th>S.N.</th>
            <th>Food</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Total</th>
            <th>Order Date</th>
            <th>Status</th>
            <th>Custoner id</th>
            <th>Actions</th>
          </tr>

          <?php

          //get all the orders from database
          $sql="SELECT * FROM tbl_order ORDER BY order_id ASC";

          $res=mysqli_query($conn,$sql);

          //Count rows to check if we have food or not
          $count =mysqli_num_rows($res);
          $sn=1;

          if($count>0){

            while($row=mysqli_fetch_assoc($res)){

              $id=$row['order_id'];
              $food=$row['food'];
              $price=$row['price'];
              $qty=$row['qty'];
              $total=$row['total'];
              $order_date=$row['order_date'];
              $status=$row['status'];
              $customer_id=$row['customer_id'];
              ?>

                <tr>
                  <td><?php echo $sn++; ?></td>
                  <td><?php echo $food; ?></td>
                  <td><?php echo $price;?></td>
                  <td><?php echo $qty; ?></td>
                  <td><?php echo $total; ?></td>
                  <td><?php echo $order_date; ?></td>
                  <td><?php echo $status; ?></td>
                  <td><?php echo $customer_id;?></td>

                  <td>
                      <a href="<?php echo SITEURL;?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary"> Update Order</a>
                  </td>
                </tr>

              <?php
            }
          }
          else{
            //order not available
            echo "<tr><td colspan='12' class='error'>Orders Not Available</td></tr>";
          }
              ?>


        </table>
    </div>
</div>

<?php include('partials/footer.php') ?>
