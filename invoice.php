<?php include("config/constants.php"); ?>
<!doctype html>

<html>
<head>
    <meta charset="utf-8">
    <title>Invoice</title>
    <link rel="stylesheet" href="css/invoice.css">

</head>
<?php if(isset($_SESSION['payment'])){
  echo $_SESSION['payment'];
  unset ($_SESSION['payment']);
} ?>

<?php

$customer_id=$_SESSION['customer_id'];

if($_GET['invoice_id']){

$invoice_id=$_GET['invoice_id'];

$sql = "SELECT * FROM tbl_customer WHERE id=$customer_id ";

$res=mysqli_query($conn,$sql);

$count=mysqli_num_rows($res);

if($count==1){
  $row=mysqli_fetch_assoc($res);
  $customer_address=$row['customer_address'];
  $customer_name=$row['customer_name'];
  $customer_email=$row['customer_email'];
}

$sql2 = "SELECT * FROM tbl_invoice WHERE invoice_id=$invoice_id ";
$res2=mysqli_query($conn,$sql2);
$count2=mysqli_num_rows($res2);

if($count2==1){
  $row2=mysqli_fetch_assoc($res2);
  $invoice_date=$row2['invoice_date'];
  $customer_id=$row2['customer_id'];
  $cart_tot=$row2['total'];
  $payType=$row2['payment_type'];
}
}
else{
  header('location:'.SITEURL.'cart.php');
}
?>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="images/logo.png" style="width:50%; max-width:300px;">
                            </td>

                            <td>
                                Invoice #: <?php echo $invoice_id ?><br>
                                Created: <?php echo date('Y-m-d',strtotime($invoice_date));?> <br>

                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                Wow Food Restaurant<br>
                                12345 Sunny Road<br>
                                Sunnyville, 12345
                            </td>

                            <td>
                                <?php echo $customer_name ?><br>
                                <?php echo $customer_email ?><br>
                                <?php echo $customer_address ?><br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>



            <tr class="heading">
                <td>
                    Payment Method
                </td>

                <td>
                    <?php echo $payType ?>
                </td>
            </tr>

            <tr class="heading">
                <td>
                    Item
                </td>

                <td>
                    Qty Price
                </td>
            </tr>

            <?php
            $sql3 = "SELECT * FROM tbl_order WHERE customer_id=$customer_id AND order_date='$invoice_date'";
            $res3=mysqli_query($conn,$sql3);
            $count3=mysqli_num_rows($res3);

            if($count3>=1){
              while($row3=mysqli_fetch_assoc($res3)){
              $food=$row3['food'];
              $qty=$row3['qty'];
              $tot=$row3['total'];

            ?>

            <tr class="item">
                <td>
                    <?php echo $food; ?>
                </td>



                <td>
                     <?php echo $qty; ?>   $<?php echo $tot; ?>
                </td>
            </tr>


                <?php
              }
            }
                ?>
            <tr class="total">
                <td></td>

                <td>
                   $<?php echo $cart_tot; ?>
                </td>
            </tr>
        </table>

    </div>
</body>

</html>
