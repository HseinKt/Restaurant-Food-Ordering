<?php include("partials-front/menu.php"); ?>

<section class="food-search text-center">

  <div class="main-content">
    <div>

      <?php
      $customer_orderdate=$_SESSION['order_date'];
      $customer_id=$_SESSION['customer_id'];

      $sql2 = "SELECT * FROM tbl_order WHERE customer_id=$customer_id AND order_date='$customer_orderdate'";

      $res2=mysqli_query($conn,$sql2);

      $count=mysqli_num_rows($res2);

      if($count==0){
      ?>

      <h1 style="margin-bottom:15px;font-size:70px;font-weight:300"> Your Shopping Cart</h1>
      <p style="margin-bottom:15px; font-size:21px; font-weight:200">is Empty...!!!</p>
        </div>
        <br><br>
        </section>
      <?php
      }
      else{
       ?>
      <h1 style="margin-bottom:15px;font-size:70px;font-weight:300"> Your Shopping Cart</h1>
      <p style="margin-bottom:15px;font-size:21px;font-weight:200">Looks tasty...!!!</p>
    </div>
    <br><br>
    </section>
    <?php
    }
  ?>

  <?php
    if(isset($_SESSION['delete'])){
      echo $_SESSION['delete'];
      echo "<br><br>";
      unset($_SESSION['delete']);
  }
  ?>

    <div class="container">

      <style >
        table,td,th{
          padding: 15px;
          border:1px solid black;
          border-collapse:collapse;

        }
      </style>

      <?php if(isset($_SESSION['orders'])){
        echo $_SESSION['orders'];
        unset ($_SESSION['orders']);
      } ?>

      <form method="post">
      <table  style="width:100%;"class=" text-center">
        <tr>
          <th>S.N.</th>
          <th style="width:50%">Food Name</th>
          <th>Qty</th>
          <th>Price Details</th>
          <th>Order Total</th>
          <th>Actions</th>
        </tr>
  <?php
        $sql1 = "SELECT * FROM tbl_order WHERE customer_id=$customer_id AND order_date ='$customer_orderdate'";

        $res1=mysqli_query($conn,$sql1);

        $count=mysqli_num_rows($res1);

        $sn=1;
        $cart_tot=0;

        while($row1 = mysqli_fetch_assoc($res1)){

            $order_id=$row1['order_id'];
            $id=$row1['customer_id'];
            $title=$row1['food'];
            $price=$row1['price'];
            $qty=$row1['qty'];
            $total=$row1['total'];
            $cart_tot=$cart_tot+$total;
        ?>

        <tr>
          <td> <?php echo $sn++; ?> </td>
          <td><?php echo $title; ?>  </td>
          <td><?php echo $qty; ?></td>
          <td><?php echo $price; ?></td>
          <td><?php echo $total; ?></td>
          <td>

            <a href="<?php echo SITEURL; ?>delete-order.php?id=<?php echo $order_id; ?>" class="btn-danger">Remove</a>
          </td>
        </tr>
        <?php
     }

       ?>
        </table>

        <br>
        <section >
        <p style="float:right; font-size:30px;font-weight:300;"> Your total: $<?php echo $cart_tot ?></p>
      </section>
      <br><br>
        <section class="text-center">
        <section>

          <?php if(isset($_SESSION['payment'])){
            echo $_SESSION['payment'];
            unset ($_SESSION['payment']);
          }?>
          Payment Type:<input type="radio" name="payment" value="Check">Check
          <input type="radio" name="payment" value="Cash">Cash
        <section><br>
        <input type="submit" name="submit" value="Add To Cart" class="btn-primary" style="color:#E6110E; border:none;margin-bottom:15px;font-size:30px;font-weight:550; ">
        </section>

        <?php
          if(isset($_POST['submit'])){
            if($count==0){
              $_SESSION['orders']="<div class='error text-center' style='font-weight:550;'>you havent ordered anything yet!!!!</div>";
              header('location:'.SITEURL.'cart.php');
            }
            else{
            if(empty($_POST['payment'])){

              $_SESSION['payment']="<div class='error text-center' style='font-weight:550;'>you havent decided your payment type!!!!</div>";
              header('location:'.SITEURL.'cart.php');
            }
            else{
              $payType=$_POST['payment'];

              $sql3="INSERT INTO tbl_invoice SET
              customer_id=$customer_id,
              invoice_date='$customer_orderdate',
              total=$cart_tot,
              payment_type='$payType'
              ";
              $res3=mysqli_query($conn,$sql3);

              $sql5="SELECT invoice_id FROM tbl_invoice WHERE customer_id=$customer_id AND invoice_date='$customer_orderdate'";
              $res5=mysqli_query($conn,$sql5);

              while($row5 = mysqli_fetch_assoc($res5)){

              $invoice_id=$row5['invoice_id'];

            }

                ?>

                <?php

            }
          }
        }
         ?>
        <br>
        <section class="text-center">
          <p>
              <a href="<?php echo SITEURL; ?>invoice.php?invoice_id=<?php echo $invoice_id; ?>""  class="btn-primary" style=" margin-bottom:15px;font-size:21px;font-weight:550; color:#E6110E;" > <b >Show invoice </b>  </a>
          </p>
        </section>
  </form>
  </div>
</div>

</section>

<?php include("partials-front/footer.php"); ?>
