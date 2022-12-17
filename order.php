<?php include("partials-front/menu.php"); ?>

<?php

    //Check whether id is passed or not
    if(isset($_GET['food_id'])){
        //Category id is set and get the id
        $food_id = $_GET['food_id'];

        $sql = "SELECT * FROM tbl_food WHERE id=$food_id";

        $res=mysqli_query($conn,$sql);

        $count=mysqli_num_rows($res);

        if($count==1)
        {
            $row = mysqli_fetch_assoc($res);
            $title = $row['title'];
            $price = $row['price'];
            $image_name = $row['image_name'];
        }
        else
        {
            header('location:'.SITEURL);
        }
    }
    else
    {
        //Category not Passed  and Redirect to home page
        header('location:'.SITEURL);
    }

?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">

            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" class="order" method="post">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php
                            if($image_name=="")
                            {
                                //display
                                echo "<div class='error'> Image Not Available.</div>";
                            }
                            else
                            {
                                //Image Available
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                <?php
                            }
                        ?>
                    </div>

                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>

                        <input type="hidden" name="food" value="<?php echo $title; ?>">

                        <p class="food-price">$<?php echo $price; ?></p>

                        <input type="hidden" name="price" value="<?php echo $price; ?>">


                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>

                    </div>

                </fieldset>

                <fieldset>
                    <legend>Delivery Details</legend>

                    <input type="submit" name="confirm" value="Confirm Order" class="btn btn-primary">
                    <input type="submit" name="submit&continueshopping" value="Confirm&continue Shopping" class="btn btn-primary">
                    <input type="submit" name="cancel" value="Cancel" class="btn btn-primary">
                </fieldset>

            </form>
            <?php
              //check if submit button id clicked or not
              if(isset($_POST['confirm'])){


                //get all the details from the form

                 $food=$_POST['food'];
                 $price=$_POST['price'];
                 $qty=$_POST['qty'];

                 $total=$price*$qty;

                 $order_date=$_SESSION['order_date'];//order date

                 $status="ordered";//Ordered, On delivery, delivered ,Cancelled

                 $customer_id=$_SESSION['customer_id'];


                //save the order in database
                //create sql to save the data

                $sql2="INSERT INTO tbl_order SET
                  food_id=$food_id,
                  food='$food',
                  price=$price,
                  qty=$qty,
                  total=$total,
                  status='$status',
                  order_date='$order_date',
                  customer_id=$customer_id
                  ";

                  //execute the query
                  $res2=mysqli_query($conn,$sql2);

                  if($res2==true){
                    //query exexcuted and order saved
                    $_SESSION['order']="<div class='success text-center'>Food Orderd Successfully. </div>";
                    header('location:'.SITEURL.'cart.php');
                  }
                  else{

                    //failed to save order
                    $_SESSION['order']="<div class='error text-center'>Failed to place order </div>";
                    header('location:'.SITEURL);
                  }
              }
              else if(isset($_POST['submit&continueshopping'])){


                //get all the details from the form

                $food=$_POST['food'];
                $price=$_POST['price'];
                $qty=$_POST['qty'];

                $total=$price*$qty;

                $order_date=$_SESSION['order_date'];//order date

                $status="ordered";//Ordered, On delivery, delivered ,Cancelled

                $customer_id=$_SESSION['customer_id'];


               //save the order in database
               //create sql to save the data

               $sql2="INSERT INTO tbl_order SET
                 food_id=$food_id,
                 food='$food',
                 price=$price,
                 qty=$qty,
                 total=$total,
                 status='$status',
                 order_date='$order_date',
                 customer_id=$customer_id
                 ";

                 //execute the query
                 $res2=mysqli_query($conn,$sql2);

                 if($res2==true){
                   //query exexcuted and order saved
                   $_SESSION['order']="<div class='success text-center'>Food Orderd Successfully. </div>";
                   header('location:'.SITEURL);
                 }
                  else{

                    //failed to save order
                    $_SESSION['order']="<div class='error text-center'>Failed to place order </div>";
                    header('location:'.SITEURL);
                  }
              }
              else if(isset($_POST['cancel'])){
                header('location:'.SITEURL);
              }

            ?>
        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->


<?php include("partials-front/footer.php"); ?>
